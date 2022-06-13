<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Paket extends CI_Controller 
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
        $data['paket'] = $this->model_app->view('cr_package');
        $data['mobil'] = $this->model_app->view_order('cr_mobil','mobil_name','ASC');
		$this->template->load('template_admin','admin/paket',$data);
	}

    public function paket_add()
    {
        $pack_name = $this->input->post('pack_name');
        $pack_mobil_id = $this->input->post('pack_mobil_id');
        $pack_desc = $this->input->post('pack_desc');
        $pack_price = $this->input->post('pack_price');
        
        $data = array(
            'pack_name' => $pack_name,
            'pack_mobil_id' => $pack_mobil_id,
            'pack_desc' => $pack_desc,
            'pack_price' => $pack_price
        );

        $this->model_app->insert('cr_package',$data);
        $this->session->set_flashdata('success','Paket Berhasil ditambah');

        redirect('admin/master/paket');
    }

    public function paket_edit()
    {
        $pack_id   = $this->input->post('pack_id');
        $pack_name = $this->input->post('pack_name');
        $pack_mobil_id = $this->input->post('pack_mobil_id');
        $pack_desc = $this->input->post('pack_desc');
        $pack_price = $this->input->post('pack_price');
        
        $data = array(
            'pack_name' => $pack_name,
            'pack_mobil_id' => $pack_mobil_id,
            'pack_desc' => $pack_desc,
            'pack_price' => $pack_price
        );

        $where = array(
            'pack_id' => $pack_id
        );

        $this->model_app->update('cr_package',$data,$where);
        $this->session->set_flashdata('success','Paket Berhasil diubah');

       
        redirect('admin/master/paket');
    }

    public function paket_hapus()
    {
        $pack_id   = $this->input->get('id');
        
        $where = array(
            'pack_id' => $pack_id
        );

        $this->model_app->delete('cr_package',$where);
        $this->session->set_flashdata('success','Paket Berhasil dihapus');

       
        redirect('admin/master/paket');
    }

}
