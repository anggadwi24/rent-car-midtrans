<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ketersediaan extends CI_Controller 
{

	public function __construct()
	{
        parent::__construct();
    	if(!isset($this->session->userdata['login_admin']['status']))
		{
		redirect(base_url("admin/auth_admin"));
		}
	}

	public function index()
	{
        $data['mobil'] = $this->model_app->view_where('cr_mobil',array('mobil_available='=>'y'));
		$this->template->load('template_admin','admin/sewa_ketersediaan',$data);
	}

}
