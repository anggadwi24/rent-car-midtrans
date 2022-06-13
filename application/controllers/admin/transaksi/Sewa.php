<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Sewa extends CI_Controller 
{

	public function __construct()
	{
        parent::__construct();
    	if(!isset($this->session->userdata['login_admin']['status']))
		{
		redirect(base_url("admin/auth_admin"));
		}
	}
    function index(){
        $data['record'] = $this->model_app->view_order('cr_transaksi','trans_no','DESC');
        $this->template->load('template_admin','admin/transaksi',$data);
    }
    function add(){
        $data['merk'] = $this->model_app->view_order('cr_merk','merk_name','ASC');
        $data['customer'] = $this->model_app->view_where_ordering('cr_customer',array('cus_active'=>'y'),'cus_name','ASC');
        $data['kabupaten'] = $this->model_app->view_where_ordering('cr_kabupaten',array('kab_prov_id'=>51),'kab_name','ASC');
        $this->template->load('template_admin','admin/transaksi_add',$data);
        
    }
    function detail(){
        $no = $this->input->get('no');
        $cek = $this->model_app->view_where('cr_transaksi',array('trans_no'=>$no));
        if($cek->num_rows() > 0){
           $row = $cek->row_array();
           $data['row'] = $row ;
           $data['title'] = $row['trans_no'].' -  PT Mas Diani Chandra';
           $data['mobil'] = $this->model_app->view_where('cr_mobil',array('mobil_id'=>$row['trans_mobil_id']))->row_array();
           $data['package'] = $this->model_app->view_where('cr_package',array('pack_id'=>$row['trans_pack_id']))->row_array();
           $this->template->load('template_admin','admin/transaksi_detail',$data);
           
        }else{
            $this->session->set_flashdata('error','Transaksi tidak ditemukan');
            redirect('admin/transaksi/sewa');
        }
    }
    function payment(){
        $no = $this->input->get('no');
        $cek = $this->model_app->view_where('cr_transaksi',array('trans_no'=>$no));
        if($cek->num_rows() > 0){
           $row = $cek->row_array();
           if($row['trans_status'] == 'waiting'){
            $data['row'] = $row ;
            $data['title'] = $row['trans_no'].' -  PT Mas Diani Chandra';
            $data['mobil'] = $this->model_app->view_where('cr_mobil',array('mobil_id'=>$row['trans_mobil_id']))->row_array();
            $data['package'] = $this->model_app->view_where('cr_package',array('pack_id'=>$row['trans_pack_id']))->row_array();
            $this->template->load('template_admin','admin/transaksi_payment',$data);
           }else{
            $this->session->set_flashdata('error','Transaksi tidak dalam status waiting');
            redirect('admin/transaksi/sewa');
           }
           
           
        }else{
            $this->session->set_flashdata('error','Transaksi tidak ditemukan');
            redirect('admin/transaksi/sewa');
        }
    }
    function customer(){
        $id = $this->input->post('id');
        $cek = $this->model_app->view_where('cr_customer',array('cus_id'=>$id,'cus_active'=>'y'));
        if($cek->num_rows() > 0){
            $status = true;
            $row = $cek->row_array();
            $arr = array('cus_name'=>$row['cus_name'],'cus_email'=>$row['cus_email'],'cus_phone'=>$row['cus_phone']);
        }else{
            $status = false;
            $arr = null;
        }
        echo json_encode(array('status'=>$status,'arr'=>$arr));
    }
    function checking(){
        $mobil = $this->input->post('mobil');
        $delivery = $this->input->post('delivery');
        $kab = $this->input->post('kabupaten');
        $kec = $this->input->post('kecamatan');
        $pack = $this->input->post('package');
        $output = null;
        $msg = null;
        $sDate = $this->input->post('startDate');
        $eDate = $this->input->post('endDate');
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
                       
                        $output .= "<div class='col-12 '><h6 class='text-right'>Harga Sewa : ".rp($rowP['pack_price'])."</h6></div>";
                        $output .= "<div class='col-12 '><h6 class='text-right'>Lama Sewa : ".$day." Hari  </h6></div>";

                            
                       
                        if($delivery == 'y'){
                            $cekShuttleAll = $this->model_app->view_where('cr_shuttle_price',array('sp_kab_id'=>$kab,'sp_kec_id'=>$kec));
                            if($cekShuttleAll->num_rows() > 0){
                                $status = true;
                                $rowS = $cekShuttleAll->row_array();
                                $delPrice = $rowS['sp_price'];
                                $output .= "<div class='col-12 '><h6 class='text-right'>Biaya Antar/Jemput : ".rp($delPrice)."</h6></div>";

                            }else{
                                $cekShuttleKab = $this->model_app->view_where('cr_shuttle_price',array('sp_kab_id'=>$kab,'sp_kec_id'=>NULL));
                                if($cekShuttleKab->num_rows() > 0){
                                    $status = true;
                                    $rowS = $cekShuttleKab->row_array();
                                    $delPrice = $rowS['sp_price'];
                                    $output .= "<div class='col-12 '><h6 class='text-right'>Biaya Antar/Jemput : ".rp($delPrice)."</h6></div>";

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
                            $amount = $price + $delPrice;
                            $output .= "<div class='col-12 '><h6 class='text-right'>Biaya Keseluruhan : ".rp($amount)."</h6></div>";
                            $output .= '<div class="col-12 text-right form-group">
                                            <span class="p-3">Cash</span>
                                            <label class="switch">
                                                <input type="checkbox" name="payment" id="paymentSelect">
                                                <span class="slider round"></span>
                                            </label>
                                            <span class="p-3">E-Payment</span>
                                        </div>';
                            $output .= "<div class='col-12 '><button class='btn btn-primary float-right'>Payment</button></div>";

                            
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
        echo json_encode(array('status'=>$status,'msg'=>$msg,'output'=>$output));
        
    }
    function doPay(){
        if($this->input->method() == 'post'){
            $trans_no = $this->input->post('no');
            $cek = $this->model_app->view_where('cr_transaksi',array('trans_no'=>$trans_no));
            if($cek->num_rows() > 0){
                $row = $cek->row_array();
                if($row['trans_status'] == 'waiting'){
                    $method = $this->input->post('payment');
                    if($method){
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
                        $phone = $row['trans_cus_phone'];
                        $email = $row['trans_cus_email'];
                        $mobil = $row['trans_mobil_id'];
                        $amount = $row['trans_total'];
                        $redirect = base_url('admin/transaksi/sewa/detail?no='.$trans_no);
                        $payment = false;
                        $con = 'paid';
                        $this->model_app->update('cr_transaksi',array('trans_status'=>'paid'),array('trans_no'=>$trans_no));
                        
                         $this->model_app->update('cr_mobil',array('mobil_available'=>'n'),array('mobil_id'=>$mobil));
                         $dataPaym = array('pay_trans_no'=>$trans_no,'pay_method'=>'CASH','pay_amount'=>$amount,'pay_date'=>date('Y-m-d H:i:s'));
                         $this->model_app->insert('cr_payment',$dataPaym);
                         $status = true; 
                         $msg = 'Penyewaan berhasil dibayar';
                         $this->mail($trans_no);
                    }
                }else{
                    $status = false;
                    $msg = 'Transaksi dalam status '.$row['trans_status'];
                }
            }else{
                $status = false;
                $msg = 'Transaksi tidak ditemukan';
            }
            echo json_encode(array('status'=>$status,'msg'=>$msg,'payment'=>$payment,'redirect'=>$redirect));
        }
    }
    function cancel(){
        $no = $this->input->get('no');
        $cek = $this->model_app->view_where('cr_transaksi',array('trans_no'=>$no));
        if($cek->num_rows() > 0){
            $row = $cek->row_array();
            if($row['trans_status'] == 'paid' OR $row['trans_status'] == 'waiting' ){
                if($row['trans_status'] == 'paid'){
                    $this->model_app->update('cr_mobil',array('mobil_available'=>'y'),array('mobil_id'=>$row['trans_mobil_id']));
                }
                $this->model_app->update('cr_transaksi',array('trans_status'=>'cancel','trans_return'=>'y'),array('trans_no'=>$no));
                $this->session->set_flashdata('success','Transaksi Berhasil dibatalkan');
                redirect('admin/transaksi/sewa/detail?no='.$no);
                
            }else{
                $this->session->set_flashdata('error','Transaksi dalam status '.$row['trans_status']);
                redirect('admin/transaksi/sewa/detail?no='.$no);
            }
        }else{
            $this->session->set_flashdata('error','Transaksi tidak ditemukan');
            redirect('admin/transaksi/sewa');
        }
    }
    function done(){
        $no = $this->input->get('no');
        $cek = $this->model_app->view_where('cr_transaksi',array('trans_no'=>$no));
        if($cek->num_rows() > 0){
            $row = $cek->row_array();
            if($row['trans_status'] == 'paid' ){
                if($row['trans_status'] == 'paid'){
                    $this->model_app->update('cr_mobil',array('mobil_available'=>'y'),array('mobil_id'=>$row['trans_mobil_id']));
                }
                $this->model_app->update('cr_transaksi',array('trans_status'=>'done','trans_return'=>'y'),array('trans_no'=>$no));
                $this->session->set_flashdata('success','Transaksi Berhasil diselesaikan');
                redirect('admin/transaksi/sewa/detail?no='.$no);
                
            }else{
                $this->session->set_flashdata('error','Transaksi dalam status '.$row['trans_status']);
                redirect('admin/transaksi/sewa/detail?no='.$no);
            }
        }else{
            $this->session->set_flashdata('error','Transaksi tidak ditemukan');
            redirect('admin/transaksi/sewa');
        }
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
    function mobil(){
        $msg = null;
        $output = null;
        $id = $this->input->post('id');
        $data=  $this->model_app->view_where_ordering('cr_mobil',array('mobil_merk'=>$id,'mobil_available'=>'y'),'mobil_name','ASC');
        if($data->num_rows() > 0){
            $status = true;
            $output .= "<option disabled selected>Pilih Mobil</option>";
            foreach($data->result_array() as $row){
                $output .= '<option value="'.$row['mobil_id'].'">'.$row['mobil_name'].'</option>';
            }
        }else{
            $status = false;
            $msg = 'Tidak ada mobil yang tersedia';
        }
        echo json_encode(array('status'=>$status,'output'=>$output,'msg'=>$msg));
    }
    function package(){
        $msg = null;
        $output = null;
        $id = $this->input->post('id');
        $data = $this->model_app->view_where_ordering('cr_package',array('pack_mobil_id'=>$id),'pack_name','ASC');
        if($data->num_rows() > 0){
            $status = true;
            $output .= "<option disabled selected>Pilih Paket</option>";
            foreach($data->result_array() as $row){
                $output .= "<option value='".$row['pack_id']."'>".$row['pack_name']."</option>";
            }
        }else{
            $status = false;
            $msg = 'Tidak ada paket pada mobil yang dipilih';
        }
        echo json_encode(array('status'=>$status,'output'=>$output,'msg'=>$msg));
    }

}