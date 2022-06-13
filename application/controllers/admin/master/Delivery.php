<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Delivery extends CI_Controller 
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
        $data['delivery'] = $this->model_app->view('cr_shuttle_price');
        $data['kabupaten'] = $this->model_app->view_where_ordering('cr_kabupaten',array('kab_prov_id'=>51),'kab_name','ASC');
		$this->template->load('template_admin','admin/delivery',$data);
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
    public function delivery_add()
    {
        $sp_kab_name = $this->input->post('kabupaten');
        $sp_price = $this->input->post('price');
        $kec = $this->input->post('kecamatan');
        if($kec == 'all'){
            $kecamatan = null;
        }else{
            $kecamatan = $kec;
        }
        
        $data = array(
            'sp_kab_id' => $sp_kab_name,
            'sp_kec_id'=>$kecamatan,
            'sp_price' => $sp_price
        );

        $this->model_app->insert('cr_shuttle_price',$data);
        $this->session->set_flashdata('success','Delivery Berhasil ditambah');

        redirect('admin/master/delivery');
    }

    public function delivery_edit()
    {
        $sp_id   = $this->input->post('sp_id');
        $sp_kab_name = $this->input->post('kabupaten');
        $sp_price = $this->input->post('price');
        $kec = $this->input->post('kecamatan');
        if($kec == 'all'){
            $kecamatan = null;
        }else{
            $kecamatan = $kec;
        }
        
        $data = array(
            'sp_kab_id' => $sp_kab_name,
            'sp_kec_id'=>$kecamatan,
            'sp_price' => $sp_price
        );


        $where = array(
            'sp_id' => $sp_id
        );
        
        $this->model_app->update('cr_shuttle_price',$data,$where);
        $this->session->set_flashdata('success','Delivery Berhasil diubah');

        redirect('admin/master/delivery');
    }

    public function delivery_hapus()
    {
        $sp_id   = $this->input->get('id');
        
        $where = array(
            'sp_id' => $sp_id
        );

        $this->model_app->delete('cr_shuttle_price',$where);
        $this->session->set_flashdata('success','Delivery Berhasil dihapus');

        redirect('admin/master/delivery');
    }

}
