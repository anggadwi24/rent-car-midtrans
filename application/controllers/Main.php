<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Main extends CI_Controller 
{
	public function index()
	{
		$data['mobil'] = $this->model_app->view('cr_mobil');
		$this->template->load('template','beranda',$data);
	}

	public function profil()
	{
		$data['customer'] = $this->model_app->view_where('cr_customer',array('cus_id'=>$this->session->userdata['login_cus']['cus_id']))->row_array();
		$this->template->load('template','profil',$data);
	}

	public function edit_profil()
	{
		$data['customer'] = $this->model_app->view_where('cr_customer',array('cus_id'=>$this->session->userdata['login_cus']['cus_id']))->row_array();
		$this->template->load('template','profil_edit',$data);
	}

	public function profil_update()
    {
        $cus_id       = $this->input->post('cus_id');
        $cus_name     = $this->input->post('cus_name');
        $cus_phone    = $this->input->post('cus_phone');
        $cus_address  = $this->input->post('cus_address');
        $cus_email    = $this->input->post('cus_email');

        $data = array(
            'cus_name'        => $cus_name,
            'cus_phone'       => $cus_phone,
            'cus_address'     => $cus_address,
            'cus_email'       => $cus_email,
        );

        $where = array(
            'cus_id' => $cus_id
        );

        $this->model_app->update('cr_customer',$data,$where);
        redirect('main/profil');
    }

    public function profil_gambar_update()
    {
    	$config['upload_path']          = './upload/user/';
        $config['encrypt_name']         = TRUE;
        $config['allowed_types']        = 'gif|jpg|png|jpeg';
        $config['max_size']             = 3000;
            
        $this->load->library('upload', $config,'main');
        if ($this->main->do_upload('file')){
        $upload_data    = $this->main->data();
        $main           = $upload_data['file_name'];
        $cus_id        = $this->input->post('cus_id');

        $data = array(
            'cus_photo'       => $main,
        );

        $where = array(
            'cus_id' => $cus_id
        );

        $this->model_app->update('cr_customer',$data,$where);
        }   
        redirect('main/profil');
    }
}
