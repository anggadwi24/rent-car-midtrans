<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pembayaran extends CI_Controller 
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
        $data['record'] = $this->model_app->join_where_order2('cr_payment','cr_transaksi','pay_trans_no','trans_no',array('trans_status !='=>'cancel'),'pay_date','DESC');
		$this->template->load('template_admin','admin/pembayaran',$data);
	}

}
