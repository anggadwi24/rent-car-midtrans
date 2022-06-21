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
        // $data['paket'] = $this->model_app->view('cr_package');
        $data['paket'] = $this->model_app->join_order2('cr_package','cr_mobil','pack_mobil_id','mobil_id','pack_id','DESC');
        $data['mobil'] = $this->model_app->view_order('cr_mobil','mobil_name','ASC');
		$this->template->load('template_admin','admin/paket',$data);
	}

    public function paket_add()
    {
        $pack_name = $this->input->post('pack_name');
        $pack_mobil_id = $this->input->post('pack_mobil_id');
        $pack_desc = $this->input->post('pack_desc');
        $pack_price = $this->input->post('pack_price');
        $ktp = $this->input->post('ktp');
        $sim = $this->input->post('sim');
        $kk = $this->input->post('kk');
        if($ktp){
            $ktp = 'y';
        }else{
            $ktp = 'n';
        }
        if($sim){
            $sim = 'y';
        }else{
            $sim = 'n';
        }
        if($kk){
            $kk = 'y';
        }else{
            $kk = 'n';
        }
        $data = array(
            'pack_name' => $pack_name,
            'pack_mobil_id' => $pack_mobil_id,
            'pack_desc' => $pack_desc,
            'pack_price' => $pack_price,
            'pack_ktp' => $ktp,
            'pack_sim' => $sim,
            'pack_kk' => $kk
        );

        $this->model_app->insert('cr_package',$data);
        $this->session->set_flashdata('success','Paket Berhasil ditambah');

        redirect('admin/master/paket');
    }

    public function paket_edit()
    {
        $pack_id   = $this->input->post('pack_id');
        $cek = $this->model_app->view_where('cr_package',array('pack_id' => $pack_id));
        if($cek->num_rows() > 0){
            $pack_name = $this->input->post('pack_name');
            $pack_mobil_id = $this->input->post('pack_mobil_id');
            $pack_desc = $this->input->post('pack_desc');
            $pack_price = $this->input->post('pack_price');
            $ktp = $this->input->post('ktp');
            $sim = $this->input->post('sim');
            $kk = $this->input->post('kk');
            if($ktp){
                $ktp = 'y';
            }else{
                $ktp = 'n';
            }
            if($sim){
                $sim = 'y';
            }else{
                $sim = 'n';
            }
            if($kk){
                $kk = 'y';
            }else{
                $kk = 'n';
            }
            $data = array(
                'pack_name' => $pack_name,
                'pack_mobil_id' => $pack_mobil_id,
                'pack_desc' => $pack_desc,
                'pack_price' => $pack_price,
                'pack_ktp' => $ktp,
                'pack_sim' => $sim,
                'pack_kk' => $kk
            );
    
            $where = array(
                'pack_id' => $pack_id
            );
    
            $this->model_app->update('cr_package',$data,$where);
            $this->session->set_flashdata('success','Paket Berhasil diubah');
        }else{
            $this->session->set_flashdata('error','Paket tidak ditemukan');
        }
       
       

       
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
