<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mobil extends CI_Controller 
{

	public function __construct()
	{
        parent::__construct();
    	if(!isset($this->session->userdata['login_admin']['status']))
		{
		redirect(base_url("admin/auth_admin"));
		}
	}

    function seo($s) {
        $c = array (' ');
        $d = array ('-','/','\\',',','.','#',':',';','\'','"','[',']','{','}',')','(','|','`','~','!','@','%','$','^','&','*','=','?','+','–');
        $s = str_replace($d, '', $s); // Hilangkan karakter yang telah disebutkan di array $d
        $s = strtolower(str_replace($c, '_', $s)); // Ganti spasi dengan tanda - dan ubah hurufnya menjadi kecil semua
        return $s;
    }

    //merk mobil start
	public function merk_mobil()
	{
        $data['merk'] = $this->model_app->view('cr_merk');
		$this->template->load('template_admin','admin/mobil_merk',$data);
	}

    public function merk_mobil_add()
    {
        $merk_name = $this->input->post('merk_name');
        
        $data = array(
            'merk_name' => $merk_name,
            'merk_seo'  => $this->model_app->view_seo('cr_merk','merk_seo',$this->seo($merk_name))
        );

        $this->model_app->insert('cr_merk',$data);
        $this->session->set_flashdata('success','Merk Mobil Berhasil Dihapus');

        redirect('admin/master/mobil/merk_mobil');
    }

    public function merk_mobil_edit()
    {
        $merk_id   = $this->input->post('merk_id');
        $merk_name = $this->input->post('merk_name');
        
        $data = array(
            'merk_name' => $merk_name,
            'merk_seo'  => $this->model_app->view_seo_updated('cr_merk','merk_seo',$this->seo($merk_name),'merk_id',$merk_id)
        );

        $where = array(
            'merk_id' => $merk_id
        );

        $this->model_app->update('cr_merk',$data,$where);
        $this->session->set_flashdata('success','Merk Mobil Berhasil Diubah');

        redirect('admin/master/mobil/merk_mobil');
    }

    public function merk_mobil_hapus()
    {
        $merk_id   = $this->input->get('id');
        
        $where = array(
            'merk_id' => $merk_id
        );

        $this->model_app->delete('cr_merk',$where);
        $this->session->set_flashdata('success','Merk Mobil Berhasil Dihapus');
        redirect('admin/master/mobil/merk_mobil');
    }
    //merk mobil end


    //jenis mobil start
    public function jenis_mobil()
    {
        // $data['mobil'] = $this->model_app->view('cr_mobil');
        $data['mobil'] = $this->model_app->join_order2('cr_mobil','cr_merk','mobil_merk','merk_id','mobil_id','DESC');

        $this->template->load('template_admin','admin/mobil_jenis',$data);
    }

    public function jenis_mobil_add()
    {
        $data['merk'] = $this->model_app->view('cr_merk');
        $this->template->load('template_admin','admin/mobil_jenis_add',$data);
    }

    public function jenis_mobil_add_proses()
    {
        $config['upload_path']          = './upload/mobil/';
        $config['encrypt_name']         = TRUE;
        $config['allowed_types']        = 'gif|jpg|png|jpeg';
        $config['max_size']             = 3000;
            
        $this->load->library('upload', $config,'main');
        if ($this->main->do_upload('file')){
        $upload_data    = $this->main->data();
        $main           = $upload_data['file_name'];
        $mobil_name     = $this->input->post('mobil_name');
        $mobil_merk     = $this->input->post('mobil_merk');
        $mobil_desc     = $this->input->post('mobil_desc');
        $mobil_fuel     = $this->input->post('mobil_fuel');
        $mobil_year     = $this->input->post('mobil_year');
        $mobil_color    = $this->input->post('mobil_color');
        $mobil_seat     = $this->input->post('mobil_seat');
        $mobil_transmisi = $this->input->post('mobil_transmisi');
        $mobil_avaliable = $this->input->post('mobil_avaliable');
        $mobil_qty      = $this->input->post('mobil_qty');

        $data = array(
            'mobil_name'        => $mobil_name,
            'mobil_seo'         => $this->model_app->view_seo('cr_mobil','mobil_seo',$this->seo($mobil_name)),
            'mobil_merk'        => $mobil_merk,
            'mobil_desc'        => $mobil_desc,
            'mobil_fuel'        => $mobil_fuel,
            'mobil_color'       => $mobil_color,
            'mobil_year'        => $mobil_year,
            'mobil_seat'        => $mobil_seat,
            'mobil_transmisi'   => $mobil_transmisi,
            'mobil_qty'         => $mobil_qty,
            'mobil_available'   => $mobil_avaliable
        );

        $mobil_id = $this->model_app->insert_id('cr_mobil',$data);

        $dataHeader = array(
            'mgal_mobil_id'=>$mobil_id,
            'mgal_url'=>$main,
            'mgal_main'=>'y',
            'mgal_filename' => $_FILES['file']['name']
        );
        $this->model_app->insert('cr_mobil_gallery',$dataHeader);

        $count = count($_FILES['files']['name']);
            for($x=0;$x<$count;$x++){
                if(!empty($_FILES['files']['name'][$x])){
                    $_FILES['file']['name'] = $_FILES['files']['name'][$x];
                    $_FILES['file']['type'] = $_FILES['files']['type'][$x];
                    $_FILES['file']['tmp_name'] = $_FILES['files']['tmp_name'][$x];
                    $_FILES['file']['error'] = $_FILES['files']['error'][$x];
                    $_FILES['file']['size'] = $_FILES['files']['size'][$x];
            
                    $config2['upload_path']          = './upload/mobil/';
                    $config2['encrypt_name']         = TRUE;
                    $config2['allowed_types']        = 'gif|jpg|png|jpeg';
                    $config2['max_size']             = 20000;
                        
                            
                    $this->load->library('upload', $config2,'gallery');
                    $this->gallery->initialize($config2);
                    $this->gallery->do_upload('file');
                    
                    
                    $uploadData = $this->gallery->data();
                    $images = $uploadData['file_name'];
                    $dataP = array(
                        'mgal_mobil_id'=>$mobil_id,
                        'mgal_url'=>$images,
                        'mgal_main'=>'n',
                        'mgal_filename' => $_FILES['file']['name']
                        );
                    $this->model_app->insert('cr_mobil_gallery',$dataP);
                }
            }
        }
        $this->session->set_flashdata('success','Mobil Berhasil Ditambah');
        redirect('admin/master/mobil/jenis_mobil');
    }

    public function jenis_mobil_edit()
    {
        $seo = $this->input->get('seo');
        
        $cek = $this->model_app->view_where('cr_mobil',array('mobil_seo'=>$seo));
        if($cek->num_rows() > 0){
            $data['merk'] = $this->model_app->view('cr_merk');
            $data['mobil'] = $this->model_app->view_where('cr_mobil',array('mobil_seo'=>$seo))->row_array();
            $this->template->load('template_admin','admin/mobil_jenis_edit',$data);
        }else{
            $this->session->userdata('success','Mobil Berhasil tidak ditemukan');
    
            redirect('admin/master/mobil/jenis_mobil');
        }
    }
    function jenis_mobil_hapus(){
        $seo   = $this->input->get('seo');
        $cek = $this->model_app->view_where('cr_mobil',array('mobil_seo'=>$seo));
        if($cek->num_rows() > 0){
            $where = array(
                'mobil_seo' => $seo
            );
    
            $this->model_app->delete('cr_mobil',$where);
            $this->session->set_flashdata('success','Mobil Berhasil Dihapus');
    
            redirect('admin/master/mobil/jenis_mobil');
        }else{
            $this->session->set_flashdata('success','Mobil Berhasil tidak ditemukan');
    
            redirect('admin/master/mobil/jenis_mobil');
        }
        
        
    }
    public function jenis_mobil_edit_proses()
    {
        $mobil_id       = $this->input->post('mobil_id');
        $mobil_name     = $this->input->post('mobil_name');
        $mobil_merk     = $this->input->post('mobil_merk');
        $mobil_desc     = $this->input->post('mobil_desc');
        $mobil_fuel     = $this->input->post('mobil_fuel');
        $mobil_year     = $this->input->post('mobil_year');
        $mobil_color    = $this->input->post('mobil_color');
        $mobil_seat     = $this->input->post('mobil_seat');
        $mobil_transmisi = $this->input->post('mobil_transmisi');
        $mobil_qty      = $this->input->post('mobil_qty');
        $mobil_avaliable = $this->input->post('mobil_avaliable');
        $cek = $this->model_app->view_where('cr_mobil',array('mobil_id'=>$mobil_id));
        if($cek->num_rows() > 0){
            $data = array(
                'mobil_name'        => $mobil_name,
                'mobil_seo'         => $this->model_app->view_seo('cr_mobil','mobil_seo',$this->seo($mobil_name)),
                'mobil_merk'        => $mobil_merk,
                'mobil_desc'        => $mobil_desc,
                'mobil_fuel'        => $mobil_fuel,
                'mobil_color'       => $mobil_color,
                'mobil_year'        => $mobil_year,
                'mobil_seat'        => $mobil_seat,
                'mobil_transmisi'   => $mobil_transmisi,
                'mobil_qty'         => $mobil_qty,
                'mobil_available'   => $mobil_avaliable
            );
    
            $where = array(
                'mobil_id' => $mobil_id
            );
    
            $this->model_app->update('cr_mobil',$data,$where);
            $this->session->set_flashdata('success','Mobil Berhasil Diubah');
            redirect('admin/master/mobil/jenis_mobil');
        }else{
            $this->session->set_flashdata('success','Mobil tidak ditemukan');
    
            redirect('admin/master/mobil/jenis_mobil');
        }
        
    }

    public function jenis_mobil_gambar_utama_update()
    {
        $config['upload_path']          = './upload/mobil/';
        $config['encrypt_name']         = TRUE;
        $config['allowed_types']        = 'gif|jpg|png|jpeg';
        $config['max_size']             = 3000;
            
        $this->load->library('upload', $config,'main');
        if ($this->main->do_upload('file')){
        $upload_data    = $this->main->data();
        $main           = $upload_data['file_name'];
        $mgal_id        = $this->input->post('mgal_id');
        $link           = $this->input->post('link');

        $data = array(
            'mgal_url'       => $main,
            'mgal_filename' => $_FILES['file']['name']
        );

        $where = array(
            'mgal_id' => $mgal_id
        );

        $this->model_app->update('cr_mobil_gallery',$data,$where);
        }   
        redirect($link);
    }
    
    public function jenis_mobil_gambar_detail_add()
    {
        $mobil_id        = $this->input->post('mobil_id');
        $link           = $this->input->post('link');

        $count = count($_FILES['files']['name']);
            for($x=0;$x<$count;$x++){
                if(!empty($_FILES['files']['name'][$x])){
                    $_FILES['file']['name'] = $_FILES['files']['name'][$x];
                    $_FILES['file']['type'] = $_FILES['files']['type'][$x];
                    $_FILES['file']['tmp_name'] = $_FILES['files']['tmp_name'][$x];
                    $_FILES['file']['error'] = $_FILES['files']['error'][$x];
                    $_FILES['file']['size'] = $_FILES['files']['size'][$x];
            
                    $config2['upload_path']          = './upload/mobil/';
                    $config2['encrypt_name']         = TRUE;
                    $config2['allowed_types']        = 'gif|jpg|png|jpeg';
                    $config2['max_size']             = 20000;
                        
                            
                    $this->load->library('upload', $config2,'gallery');
                    $this->gallery->initialize($config2);
                    $this->gallery->do_upload('file');
                    
                    
                    $uploadData = $this->gallery->data();
                    $images = $uploadData['file_name'];
                    $dataP = array(
                        'mgal_mobil_id'=>$mobil_id,
                        'mgal_url'=>$images,
                        'mgal_main'=>'n',
                        'mgal_filename' => $_FILES['file']['name']
                        );
                    $this->model_app->insert('cr_mobil_gallery',$dataP);
                }
            }
        redirect($link);
    }

    public function jenis_mobil_gambar_detail_hapus()
    {
        $mgal_id    = $this->input->get('id');
        $link       = $this->input->get('link');
        $where = array('mgal_id'=>$mgal_id);
        $row = $this->db->where('mgal_id',$mgal_id)->get('cr_mobil_gallery')->row();
        unlink('./upload/mobil/'.$row->mgal_url);
        
        $this->model_app->delete('cr_mobil_gallery',$where);
        redirect($link);
    }
    

    //jenis mobil end
}
