<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Payment extends CI_Controller {

	function doPay(){
	    if($this->input->method() == 'post'){
	        $trans_no = $this->input->post('no');
	        $cek = $this->model_app->view_where('cr_transaksi',array('trans_no'=>$trans_no));
	        if($cek->num_rows() > 0){
	            $row = $cek->row_array();
	            if($row['trans_status'] == 'waiting'){
	               
	                    $params = array('server_key' => 'SB-Mid-server-qmIfhYvgAOG3RA0495D81dWv', 'production' => false);
	                    $this->load->library('veritrans');
	                    $this->veritrans->config($params);
	                    $con = 'waiting';
	                    $phone = $row['trans_cus_phone'];
	                    $email = $row['trans_cus_email'];
	                    $mobil = $row['trans_mobil_id'];
	                    $amount = $row['trans_total'];
	                    $nama = $row['trans_cus_name'];
	                   
	                    $status = true;
	                    $rowM = $this->model_app->view_where('cr_mobil',array('mobil_id'=>$mobil))->row_array();
	                    $day = daysDifference($row['trans_date_start'],$row['trans_date_end']);
	                    if($row['trans_sp_id'] == 'y'){
	                        $del = 'Antar/Jemput ';
	                        
	                    }else{
	                        $del = '';
	                       
	                    }
	                    $rowP = $this->model_app->view_where('cr_package',array('pack_id'=>$row['trans_pack_id'],'pack_mobil_id'=>$mobil))->row_array();
	                    $packageName = $rowM['mobil_name']. ' - '.$rowP['pack_name'].' x'.$day.'D';
	                    $transaction_details = array(
	                        'order_id' 		=>$trans_no,
	                        'gross_amount' 	=> $amount
	                    );
	            
	                    // Populate items
	                    $items = [
	                        array(
	                            'id' 		=> $mobil,
	                            'price' 	=> $amount,
	                            'quantity' 	=> 1,
	                            'name' 		=> $packageName
	                        ),
	                       
	                    ];
	            
	                   
	                    $customer_details = array(
	                        'first_name' 			=> 'CUSTOMER',
	                        'last_name' 			=> $nama,
	                        'email' 				=> $email,
	                        'phone' 				=>$phone,
	                       
	                        );
	            
	                    // Data yang akan dikirim untuk request redirect_url.
	                    // Uncomment 'credit_card_3d_secure' => true jika transaksi ingin diproses dengan 3DSecure.
	                    $transaction_data = array(
	                        'payment_type' 			=> 'vtweb', 
	                        'vtweb'					=> array(
                            //'enabled_payments' 	=> ['credit_card'],
                            'credit_card_3d_secure' => true
	                        ),
	                        'transaction_details'	=> $transaction_details,
	                        'item_details' 			=> $items,
	                        'customer_details' 	 	=> $customer_details
	                    );
	                
	                    try
	                    {
	                        $redirect = base_url('transaksi/detail?no='.$trans_no);
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
	                $status = false;
	                $msg = 'Transaksi dalam status '.$row['trans_status'];
	            }
	        }else{
	            $status = false;
	            $msg = 'Transaksi tidak ditemukan';
	        }
	        echo json_encode(array('status'=>$status,'msg'=>$msg,'redirect'=>$redirect));
	    }
	}
}
