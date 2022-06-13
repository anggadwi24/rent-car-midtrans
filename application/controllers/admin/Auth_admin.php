<?php
defined('BASEPATH') OR exit('No direct script access allowed');

	class Auth_admin extends CI_controller
	{		
		public function index() 
		{
			$this->load->view('admin/login');
		}

		public function proseslogin()
		{
			$username 	= $this->input->post('email');
			$pwd 		= $this->input->post('password');
			$pw 		= sha1($pwd);
			// $password = sha1($pwd);

			$where = array(
				'users_email'  		=> $username,
				'users_password'  	=> $pw
				);
			$cek = $this->model_app->view_where('users',$where)->num_rows();
			$p_login = $this->model_app->view_where('users',$where);
			foreach($p_login->result() as $p){
				$users_name 	= $p->users_name;
				$users_id 		= $p->users_id;
				$users_email 	= $p->users_email;
				$users_level 	= $p->users_level;
			}

			if($cek > 0){
	 
				$data_session = array(
					'users_name' 	=> $users_name,
					'users_email'	=> $users_email,
					'users_id'		=> $users_id,
					'users_level'	=> $users_level,
					'status'		=> "login"
					);
	 
				$this->session->set_userdata('login_admin',$data_session);

	 		
				$this->session->set_flashdata('benar_login','selamat datang ' .$this->session->userdata['login_admin']['users_level']. ' '. $this->session->userdata['login_admin']['users_name']);
		        redirect('admin/main_admin');
	 
			}else{
				$this->session->set_flashdata('salah_login','Username atau password yang anda masukkan salah..!');
				redirect('admin/auth_admin');
			}
		}
	 
		public function logout()
		{
			$this->session->sess_destroy();
			$this->session->unset_userdata('username');
			redirect('admin/auth_admin');
		}
	}


