<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller 
{
	public function index()
	{
		$this->load->view('login');
	}

	public function proses_login()
		{
			$username 	= $this->input->post('email');
			$pwd 		= $this->input->post('password');
			$pw 		= sha1($pwd);
			// $password = sha1($pwd);

			$where = array(
				'cus_email'  		=> $username,
				'cus_password'  	=> $pw
				);
			$cek = $this->model_app->view_where('cr_customer',$where)->num_rows();
			$p_login = $this->model_app->view_where('cr_customer',$where);
			foreach($p_login->result() as $p){
				$cus_name 		= $p->cus_name;
				$cus_phone 		= $p->cus_phone;
				$cus_email 		= $p->cus_email;
				$cus_id 		= $p->cus_id;
				$cus_address 	= $p->cus_address;
			}

			if($cek > 0){
	 
				$data_session = array(
					'cus_name' 		=> $cus_name,
					'cus_email'		=> $cus_email,
					'cus_phone'		=> $cus_phone,
					'cus_address'	=> $cus_address,
					'cus_id'		=> $cus_id,
					'status'		=> "login"
					);
	 
				$this->session->set_userdata('login_cus',$data_session);
		        redirect('main');
	 
			}else{
				$this->session->set_flashdata('salah_login_cus','Username atau password yang anda masukkan salah..!');
				redirect('auth');
			}
		}
	 
		public function logout()
		{
			$this->session->sess_destroy();
			$this->session->unset_userdata('username');
			redirect('auth');
		}

	public function register()
	{
		$this->load->view('register');
	}

	 public function register_add()
    {
		$this->form_validation->set_rules('cus_email','Email','required|is_unique[cr_customer.cus_email]');
		$this->form_validation->set_rules('cus_name','Nama','required');
		$this->form_validation->set_rules('cus_phone','No. HP','required');
		$this->form_validation->set_rules('cus_password','Password','required');

		$this->form_validation->set_rules('cus_retype', 'Password Confirmation', 'required|matches[cus_password]');
		
		if($this->form_validation->run() === FALSE){
			$msg = str_replace(array('</p>'),'<br>',validation_errors());

			$ree = str_replace(array('<p>'),'',$msg);
			$this->session->set_flashdata('error',$ree);

			redirect('auth/register');
			
		}else{

    	$config['upload_path']          = './upload/user/';
        $config['encrypt_name']         = TRUE;
        $config['allowed_types']        = 'gif|jpg|png|jpeg';
        $config['max_size']             = 3000;
            
        $this->load->library('upload', $config,'main');
        if ($this->main->do_upload('file')){
			$upload_data    = $this->main->data();
			$main           = $upload_data['file_name'];
			$cus_name 		= $this->input->post('cus_name');
			$cus_email 		= $this->input->post('cus_email');
			$cus_phone 		= $this->input->post('cus_phone');
			$cus_address 	= $this->input->post('cus_address');
			$password 		= $this->input->post('cus_password');
			$pw 			= sha1($password);
			
			$data = array(
				'cus_name' 			=> $cus_name,
				'cus_email' 		=> $cus_email,
				'cus_phone' 		=> $cus_phone,
				'cus_address' 		=> $cus_address,
				'cus_photo' 		=> $main,
				'cus_active' 		=> 'y',
				'cus_password' 		=> $pw
			);

			$this->model_app->insert('cr_customer',$data);
			$this->session->set_flashdata('new_register','Sukses Mendaftar Akun, Silahkan Login terlebih dahulu!');
			redirect('auth');
    	}else{
			$msg = str_replace(array('</p>'),'',$this->main->display_errors());

			$ree = str_replace(array('<p>'),'',$msg);
			$this->session->set_flashdata('error',$ree);
			redirect('auth/register');
			

		}
		
	  }
    }
}
