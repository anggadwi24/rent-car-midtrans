<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Transaksi extends CI_Controller 
{
	public function __construct()
	{
        parent::__construct();
    	if(!isset($this->session->userdata['login_cus']['status']))
		{
		redirect(base_url("auth"));
		}
	}

	public function booking()
	{
		$seo = $this->input->get('seo');
		$data['seo'] = $seo;
		$this->template->load('template','booking',$data);
	}

	public function cek_paket()
	{
		$mobil_id = $this->input->post('mobil_id');
        $sub = $this->model_app->view_where('cr_package',array('pack_mobil_id'=>$mobil_id));
        $html ="<option selected disabled>Pilih Paket..</option>";
        foreach ($sub->result_array() as $sb){
        	$html.="
        	<option value='".$sb['pack_id']."' required>".$sb['pack_name']."</option>
        	";
        }

        echo $html;
	}

	public function form_delivery()
	{
		$kab = $this->model_app->view_where_ordering('cr_kabupaten',array('kab_prov_id'=>51),'kab_name','ASC');
        $sub = $this->model_app->view('cr_shuttle_price');
        $html="
        <div class='col-6 form-group'>
        <label>Kabupaten</label>
        <select class='custom-select px-4 mb-3' id='kabupaten' name='kabupaten' style='height:50px;'>
        <option selected disabled>Pilih Kabupaten yang tersedia..</option>
        ";
        foreach($kab->result_array() as $sb){
        	$html.="
        		<option value='".$sb['kab_id']."'>".$sb['kab_name']."</option>
        	";
        }

        	$html.="
        		</select>
	            </div>
	            <div class='form-group col-6'>
	            	<label>Kecamatan</label>
	            	<select class='custom-select px-4 mb-3' id='kecamatan' name='kecamatan' style='height:50px;'>
	            	</select>
	            </div>
	            <div class='form-group col-12'>
	            	<label>Alamat</label>
	            	<textarea class='form-control p-4' name='trans_address'></textarea>
	            </div>
        	";
        echo $html;
	}

	function kecamatan(){
        $kab_id = $this->input->post('kab');
        $data = $this->model_app->view_where_ordering('cr_kecamatan',array('kec_kab_id'=>$kab_id),'kec_name','ASC');
        if($data->num_rows() > 0){
            $status = true;
            $html = '<option value="all">Semua</option>';
            foreach($data->result_array() as $row){
                $html .= '<option value="'.$row['kec_id'].'">'.$row['kec_name'].'</option>';
            }

        }else{
            $status = false;
            $html = null;
        }
        echo json_encode(array('status'=>$status,'html'=>$html));
    }

	public function proses1()
	{
		$delivery = $this->input->post('delivery');
		$msg=null;
        $kab = $this->input->post('kab');
        $kec = $this->input->post('kec');
        $output="";
		$start = $this->input->post('date_start');
		$end = $this->input->post('date_end');
		$paket_id = $this->input->post('paket_id');
		$this->form_validation->set_rules('date_start','Tanggal Pinjam','required');
		$this->form_validation->set_rules('date_end','Tanggal Sewa','required');
		$this->form_validation->set_rules('time','Waktu Ambil/Antar Mobil','required');
		$this->form_validation->set_rules('paket_id','Paket ','required');


		if($this->form_validation->run() === FALSE){
			$status = false;
			$msg = str_replace(array('<p>','</p>'),'',validation_errors());
		}else{
			if($start <= $end){

		
				if($delivery == 'y')
				{
					$cekShuttleAll = $this->model_app->view_where('cr_shuttle_price',array('sp_kab_id'=>$kab,'sp_kec_id'=>$kec));
					if($cekShuttleAll->num_rows() > 0){
						$status = true;
						$rowS = $cekShuttleAll->row_array();
						$delPrice = $rowS['sp_price'];
					
	
					}else{
						$cekShuttleKab = $this->model_app->view_where('cr_shuttle_price',array('sp_kab_id'=>$kab,'sp_kec_id'=>NULL));
						if($cekShuttleKab->num_rows() > 0){
							$status = true;
							$rowS = $cekShuttleKab->row_array();
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
				
				if ($status==true) {
					$output .= "<div class='row'>";
					$date_start = $this->input->post('date_start');
					$date_end = $this->input->post('date_end');
					$hari = daysDifference($date_start,$date_end);
					
					$sub = $this->model_app->view_where('cr_package',array('pack_id'=>$paket_id))->row_array();
					$harga = $sub['pack_price']*$hari;
					$output  .=
					"
						
						<div class='col-6'><p>Tanggal : </p></div><div class='col-6 text-right'> <p>".format_indo($date_start)." s/d <br>".format_indo($date_end)."</p></div>
						<div class='col-6'><p>Harga Sewa : </p></div><div class='col-6 text-right'><p > ".rp($sub['pack_price'])."</p></div>
						<div class='col-6'><p>Durasi : </p></div><div class='col-6 text-right'><p > ".daysDifference($date_start,$date_end)." Hari</p></div>
						
	
					";
					if ($delPrice>0) {
						$output .="
						<div class='col-6'><p>Harga Delivery : </p></div><div class='col-6 text-right'><p> ".rp($delPrice)."</p></div>
						";
					}
					$output .= "<div class='col-6'><p>Total Harga : </p></div><div class='col-6 text-right'><p > ".rp($harga)."</p></div>";
					$output .= "</div>";
				}else{
					$output=null;
				}
			}else{
				$status = false;
				$msg = 'Format tanggal sewa salah!';
				$output = null;
			}
		}
		
        echo json_encode(array('status'=>$status,'msg'=>$msg,'output'=>$output));
	}

	public function booking_add()
	{
		$config1['upload_path']     = './upload/user/';
		$config1['encrypt_name'] 	= TRUE;
		$config1['allowed_types']   = 'gif|jpg|png|jpeg';
		$config1['max_size']        = 1000;
			
				
		$this->load->library('upload', $config1,'ktp');
		$this->ktp->initialize($config1);

		
		$config2['upload_path']     = './upload/user/';
		$config2['encrypt_name'] 	= TRUE;
		$config2['allowed_types']   = 'gif|jpg|png|jpeg';
		$config2['max_size']        = 1000;
			
				
		$this->load->library('upload', $config2,'sim');
		$this->sim->initialize($config2);

        if(!$this->ktp->do_upload('ktp') OR !$this->sim->do_upload('sim')){
            $this->upload->display_errors();
        }else{
             $upload_data1 = $this->ktp->data();
				$trans_cus_ktp = $upload_data1['file_name'];
			$upload_data2 = $this->sim->data();
				$trans_cus_sim = $upload_data2['file_name'];
        }

		$trans_cus_name 	= $this->input->post('trans_cus_name');
        $trans_cus_id 		= $this->input->post('trans_cus_id');
        $trans_cus_phone 	= $this->input->post('trans_cus_phone');
        $trans_cus_email 	= $this->input->post('trans_cus_email');
        $trans_date_start 	= $this->input->post('trans_date_start');
        $trans_date_end 	= $this->input->post('trans_date_end');
        $trans_time 		= $this->input->post('trans_time');
        $trans_mobil_id 	= $this->input->post('trans_mobil_id');
        $trans_pack_id 		= $this->input->post('trans_pack_id');
        $kab 				= $this->input->post('kabupaten');
        $kec 				= $this->input->post('kecamatan');

        $harga_anjen = 0;
        $trans_total =0;

        $mobil = $this->model_app->view_where('cr_mobil',array('mobil_id'=>$trans_mobil_id));

        if ($mobil -> num_rows()>0) {
        	$row = $mobil->row_array();
        	if ($this->input->post('delivery')=='y') {
        		$cekShuttleAll = $this->model_app->view_where('cr_shuttle_price',array('sp_kab_id'=>$kab,'sp_kec_id'=>$kec));
	            if($cekShuttleAll->num_rows() > 0){
	                $rowS = $cekShuttleAll->row_array();
	                $harga_anjen = $rowS['sp_price'];
	                $trans_sp_id = $rowS['sp_id'];
	                $trans_address = $this->input->post('trans_address');
	            }else{
	                $cekShuttleKab = $this->model_app->view_where('cr_shuttle_price',array('sp_kab_id'=>$kab,'sp_kec_id'=>NULL));
	                if($cekShuttleKab->num_rows() > 0){
	                    $rowS = $cekShuttleKab->row_array();
	                    $harga_anjen = $rowS['sp_price'];
	                	$trans_sp_id = $rowS['sp_id'];
	                	$trans_address = $this->input->post('trans_address');
	            	}
	            }
	        }else{
	        	$trans_sp_id 		= null;
	        	$trans_address 		= null;
	        }
			$hari = daysDifference($trans_date_start,$trans_date_end);
			
	        $harga_paket = $this->model_app->view_where('cr_package',array('pack_id'=>$trans_pack_id))->row_array();
	        $trans_total = $harga_paket['pack_price'];
			$price = ($hari*$trans_total)+$harga_anjen;
	        $trans_no = $this->model_app->generateInvoice();
	        $data = array(
	        	'trans_no'			=> $trans_no,
	            'trans_cus_name' 	=> $trans_cus_name,
	            'trans_cus_id' 		=> $trans_cus_id,
	            'trans_cus_phone' 	=> $trans_cus_phone,
	            'trans_cus_email' 	=> $trans_cus_email,
	            'trans_cus_ktp' 	=> $trans_cus_ktp,
	            'trans_cus_sim' 	=> $trans_cus_sim,
	            'trans_date_start' 	=> $trans_date_start,
	            'trans_date_end' 	=> $trans_date_end,
	            'trans_time' 		=> $trans_time,
	            'trans_mobil_id' 	=> $trans_mobil_id,
	            'trans_pack_id' 	=> $trans_pack_id,
	            'trans_sp_id' 		=> $trans_sp_id,
	            'trans_address' 	=> $trans_address,
	            'trans_total' 		=> $price,
	            'trans_status' 		=> 'waiting',
	            'trans_by' 			=> 'customer',
	            'trans_return' 		=> 'n',
	            'trans_date' 		=> date('Y-m-d H:i:s')
	        );

	        $this->model_app->insert('cr_transaksi',$data);
        	
        	$stokmobil = $this->model_app->view_where('cr_mobil',array('mobil_id'=>$trans_mobil_id));
        	if ($mobil -> num_rows()>0) {
        		$row = $stokmobil->row_array();
				$this->db->query("UPDATE cr_mobil set mobil_qty = mobil_qty - 1 where mobil_id = $row[mobil_id]");
        	}else{}
	        $this->session->set_userdata('trans_no',$trans_no);
	        redirect('transaksi/checkout');
	        
        }else{
        	$this->session->set_flashdata('error','Mobil tidak ditemukan!');
        	redirect('transaksi/booking');
        }

        
	}

	public function checkout()
	{	
		if (isset($this->session->userdata['trans_no'])) {
			$no = $this->session->userdata['trans_no'];
		}else{
			$no = $this->input->get('no');
		}
		$transaksi = $this->model_app->view_where('cr_transaksi',array('trans_no'=>$no));
		if ($transaksi->num_rows() > 0) {
		    $data['checkout'] = $this->model_app->view_where('cr_transaksi',array('trans_no'=>$no))->row_array();
			$this->template->load('template','checkout',$data);
		}
	}

	public function detail()
	{
		$data1 = $this->input->get('no');
	    $data['checkout'] = $this->model_app->view_where('cr_transaksi',array('trans_no'=>$data1))->row_array();
		$this->template->load('template','booking_detail',$data);
	}
}
