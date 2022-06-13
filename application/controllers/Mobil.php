<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mobil extends CI_Controller 
{
	public function index()
	{
		$cari_mobil = $this->input->get('cari_mobil'); 

        if(empty($cari_mobil)){ 
            $data1 = $this->model_app->view('cr_mobil'); 
            $label = '';
        }else{ 
            $data1 = $this->model_app->like('cr_mobil',array('mobil_name'=>$cari_mobil));
            $label = 'Kata Kunci "'.$cari_mobil.'"';
        }

        $data['mobil'] = $data1;
        $data['label']= $label;

		$this->template->load('template','mobil',$data);

	}

	public function detail_mobil()
	{
		$seo = $this->input->get('seo');
		$data['mobil'] = $this->model_app->view_where('cr_mobil',array('mobil_seo'=>$seo))->row_array();
		$this->template->load('template','mobil_detail',$data);
	}
}
