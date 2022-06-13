<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Main_admin extends CI_Controller 
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
		$data['row'] = $this->model_app->view_where('users',array('users_id'=>$this->session->userdata['login_admin']['users_id']))->row_array();
		$data['title'] = 'Dashboard - PT Mas Diani Chandra';
		$this->template->load('template_admin','admin/dashboard',$data);
	}
}
