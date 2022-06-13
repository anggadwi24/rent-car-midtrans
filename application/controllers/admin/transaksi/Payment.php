<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Payment extends CI_Controller 
{

	public function __construct()
	{
        parent::__construct();
    	if(!isset($this->session->userdata['login_admin']['status']))
		{
		redirect(base_url("admin/auth_admin"));
		}else{
            $params = array('server_key' => 'SB-Mid-server-qmIfhYvgAOG3RA0495D81dWv', 'production' => false);
            $this->load->library('veritrans');
            $this->veritrans->config($params);
        }
	}
    function index(){
        $redirect = null;
        $mobil = $this->input->post('mobil');
        $delivery = $this->input->post('delivery');
        $kab = $this->input->post('kabupaten');
        $kec = $this->input->post('kecamatan');
        $pack = $this->input->post('package');
        $output = null;
        $msg = null;
        $sDate = $this->input->post('startDate');
        $eDate = $this->input->post('endDate');
        $payment = null;
        if($sDate < $eDate){
            $cekMobil = $this->model_app->view_where('cr_mobil',array('mobil_id'=>$mobil));
            if($cekMobil->num_rows() > 0 ){
                $rowM = $cekMobil->row_array();
                if($rowM['mobil_available'] == 'y'){
                    $cekPackage = $this->model_app->view_where('cr_package',array('pack_id'=>$pack,'pack_mobil_id'=>$mobil));
                    if($cekPackage->num_rows() > 0){
                        
                        $rowP = $cekPackage->row_array();
                        $day = daysDifference($sDate,$eDate);
                        $price = $day*$rowP['pack_price'];
                       
                        

                            
                       
                        if($delivery == 'y'){
                            $cekShuttleAll = $this->model_app->view_where('cr_shuttle_price',array('sp_kab_id'=>$kab,'sp_kec_id'=>$kec));
                            if($cekShuttleAll->num_rows() > 0){
                                $status = true;
                                $rowS = $cekShuttleAll->row_array();
                                $sp_id = $rowS['sp_id'];
                                $delPrice = $rowS['sp_price'];
                              

                            }else{
                                $cekShuttleKab = $this->model_app->view_where('cr_shuttle_price',array('sp_kab_id'=>$kab,'sp_kec_id'=>NULL));
                                if($cekShuttleKab->num_rows() > 0){
                                    $status = true;
                                    $rowS = $cekShuttleKab->row_array();
                                    $sp_id = $rowS['sp_id'];

                                    $delPrice = $rowS['sp_price'];
                               

                                }else{
                                    $status = false;
                                    $msg = 'Delivery pada kabupaten dan kecamatan belum diatur';
                                }
                            }
                        }else{
                            $delPrice = 0;
                            $status = true;
                        }
                        if($status  == true){
                            $hari = daysDifference($sDate,$eDate);

                            $amount = ($price*$hari) + $delPrice;
                            $trans_no = $this->model_app->generateInvoice();
                            $nama = $this->input->post('name');
                            $email = $this->input->post('email');
                            $phone = $this->input->post('phone');
                            $cus = $this->input->post('customer');
                            if($cus == 'no'){
                                $customer = NULL;
                            }else{
                                $customer = $cus;
                            }
                            if($delivery == 'y'){
                                $del = 'Antar/Jemput ';
                                $shuttlePrice = $sp_id;
                                $address = $this->input->post('address');
                            }else{
                                $del = '';
                                $shuttlePrice = null;
                                $address = null;
                            }
                            $time = $this->input->post('time');

                           
                            $method = $this->input->post('payment');
                            if($method){
                                $con = 'waiting';
                                $data = array('trans_no'=>$trans_no,'trans_cus_name'=>$nama,'trans_cus_email'=>$email,
                                          'trans_cus_phone'=>$phone,'trans_cus_id'=>$customer,'trans_date_start'=>$sDate,'trans_pack_id'=>$pack,
                                          'trans_date_end'=>$eDate,'trans_time'=>$time,'trans_mobil_id'=>$mobil,'trans_sp_id'=>$shuttlePrice,
                                          'trans_address'=>$address,'trans_total'=>$amount,'trans_status'=>$con,
                                          'trans_by'=>$this->session->userdata['login_admin']['users_level'],'trans_date'=>date('Y-m-d H:i:s'),

                                        );
                                $this->model_app->insert('cr_transaksi',$data);
                               
                                $status = true;
                                $packageName = $rowM['mobil_name']. ' - '.$rowP['pack_name'].' x'.$day.'D';
                                $transaction_details = array(
                                    'order_id' 			=>$trans_no,
                                    'gross_amount' 	=> $amount
                                );
                        
                                // Populate items
                                $items = [
                                    array(
                                        'id' 				=> $mobil,
                                        'price' 		=> $amount,
                                        'quantity' 	=> 1,
                                        'name' 			=> $packageName
                                    ),
                                   
                                ];
                        
                               
                                $customer_details = array(
                                    'first_name' 			=> 'CUSTOMER',
                                    'last_name' 			=> $nama,
                                    'email' 					=> $email,
                                    'phone' 					=>$phone,
                                   
                                    );
                        
                                // Data yang akan dikirim untuk request redirect_url.
                                // Uncomment 'credit_card_3d_secure' => true jika transaksi ingin diproses dengan 3DSecure.
                                $transaction_data = array(
                                    'payment_type' 			=> 'vtweb', 
                                    'vtweb' 						=> array(
                                        //'enabled_payments' 	=> ['credit_card'],
                                        'credit_card_3d_secure' => true
                                    ),
                                    'transaction_details'=> $transaction_details,
                                    'item_details' 			 => $items,
                                    'customer_details' 	 => $customer_details
                                );
                            
                                try
                                {
                                    $redirect = base_url('admin/transaksi/sewa/detail?no='.$trans_no);
                                    $this->session->set_userdata('redirect',$redirect);

                                    $status = true;
                                    $msg = $this->veritrans->vtweb_charge($transaction_data);
                                    $payment = true;
                                } 
                                catch (Exception $e) 
                                {
                                    $status = false;
                                    $msg = $e->getMessage();	
                                }
                                
                            }else{
                                $redirect = base_url('admin/transaksi/sewa/detail?no='.$trans_no);
                                $payment = false;
                                $con = 'paid';
                                $data = array('trans_no'=>$trans_no,'trans_cus_name'=>$nama,'trans_cus_email'=>$email,
                                'trans_cus_phone'=>$phone,'trans_cus_id'=>$customer,'trans_date_start'=>$sDate,
                                'trans_date_end'=>$eDate,'trans_time'=>$time,'trans_mobil_id'=>$mobil,'trans_sp_id'=>$shuttlePrice,'trans_pack_id'=>$pack,
                                'trans_address'=>$address,'trans_total'=>$amount,'trans_status'=>$con,
                                'trans_by'=>$this->session->userdata['login_admin']['users_level'],'trans_date'=>date('Y-m-d H:i:s'),

                              );
                                 $this->model_app->insert('cr_transaksi',$data);
                                 $this->model_app->update('cr_mobil',array('mobil_available'=>'n'),array('mobil_id'=>$mobil));
                                 $dataPaym = array('pay_trans_no'=>$trans_no,'pay_method'=>'CASH','pay_amount'=>$amount,'pay_date'=>date('Y-m-d H:i:s'));
                                 $this->model_app->insert('cr_payment',$dataPaym);
                                 $status = true; 
                                 $msg = 'Penyewaan berhasil ditambahkan';
                                 $this->mail($trans_no['trans_no']);
                            }
                            

                            
                        }
                        
                    }else{
                        $status = false;
                        $msg = 'Paket tidak ditemukan';
                    }
                }else{
                    $status = false;
                    $msg = 'Mobil tidak tersedia';
                }
            }else{
                $status = false;
                $msg = 'Mobil tidak ditemukan';
            }
        }else{
            $status = false;
            $msg = 'Format tanggal penyewaan salah';
        }
        echo json_encode(array('status'=>$status,'msg'=>$msg,'payment'=>$payment,'redirect'=>$redirect));
    }
    private function mail($no){
        $cek = $this->model_app->view_where('cr_transaksi',array('trans_no'=>$no));
        if($cek->num_rows() > 0){
            $row = $cek->row_array();
            $data['row'] = $row;
            $data['mobil'] = $this->model_app->view_where('cr_mobil',array('mobil_id'=>$row['trans_mobil_id']))->row_array();
            $data['package'] = $this->model_app->view_where('cr_package',array('pack_id'=>$row['trans_pack_id']))->row_array();
            $html = $this->load->view('admin/email',$data,true);
            $title = '[ PT MAS DIANI CHANDRA ] - #'.$row['trans_no'];
            pushEmail($row['trans_cus_email'],$title,$html);
        }
    }
}