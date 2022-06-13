<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller 
{

	public function __construct()
	{
        parent::__construct();
    	if(!isset($this->session->userdata['login_admin']['status']))
		{
		redirect(base_url("admin/auth_admin"));
		}
	}

	public function pelanggan()
	{
        $data['customer'] = $this->model_app->view('cr_customer');
		$this->template->load('template_admin','admin/pelanggan',$data);
	}

    public function staff()
    {
        $data['users'] = $this->model_app->view('users');
        $this->template->load('template_admin','admin/staff',$data);
    }

    public function staff_add()
    {
    	$config['upload_path']          = './upload/user/';
        $config['encrypt_name']         = TRUE;
        $config['allowed_types']        = 'gif|jpg|png|jpeg';
        $config['max_size']             = 3000;
            
        $this->load->library('upload', $config,'main');
        if ($this->main->do_upload('file')){
        $upload_data    = $this->main->data();
        $main           = $upload_data['file_name'];
        

        
    	}else{
            $main = '';
        }
        $users_name = $this->input->post('users_name');
        $users_email = $this->input->post('users_email');
        $users_level = $this->input->post('users_level');
        $password = $this->input->post('users_password');
        $pw = sha1($password);
        
        $data = array(
            'users_name' 		=> $users_name,
            'users_email' 		=> $users_email,
            'users_level' 		=> $users_level,
            'users_photo' 		=> $main,
            'users_active' 		=> 'y',
            'users_password' 	=> $pw
        );
        $this->model_app->insert('users',$data);
        $this->session->set_flashdata('success','User berhasil ditambah');
  

        redirect('admin/master/user/staff');
    }

    public function staff_update()
    {
        $users_id = $this->input->post('users_id');
        $cek = $this->model_app->view_where('users',array('users_id'=>$users_id));
        if($cek->num_rows() > 0){
            $row = $cek->row_array();
            $config['upload_path']          = './upload/user/';
            $config['encrypt_name']         = TRUE;
            $config['allowed_types']        = 'gif|jpg|png|jpeg';
            $config['max_size']             = 3000;
                
            $this->load->library('upload', $config,'main');
            if ($this->main->do_upload('file')){
            $upload_data    = $this->main->data();
            $main           = $upload_data['file_name'];
            

            
            }else{
                $main = $row['users_photo'];
            }
            $users_name = $this->input->post('users_name');
            $users_email = $this->input->post('users_email');
            $users_level = $this->input->post('users_level');
            $users_active = $this->input->post('users_active');
            
            $data = array(
                'users_name' 		=> $users_name,
                'users_email' 		=> $users_email,
                'users_level' 		=> $users_level,
                'users_active' 		=> $users_active,
                'users_photo'       =>$main,
            );
            $where = array('users_id'=>$users_id);
            $this->model_app->update('users',$data,$where);
            $this->session->set_flashdata('success','User berhasil diubah');
            redirect('admin/master/user/staff');
        }else{
            $this->session->set_flashdata('error','User tidak ditemukan');
            redirect('admin/master/user/staff');
        }
        
    }

}
