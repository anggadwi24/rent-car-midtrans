<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Profile extends CI_Controller 
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
        $data['title'] = 'Profile - PT Mas Diani Chandra';
        $data['row'] = $this->model_app->view_where('users',array('users_id'=>$this->session->userdata['login_admin']['users_id']))->row_array();
		$this->template->load('template_admin','admin/profile',$data);

	}

    function update(){
        $cek = $this->model_app->view_where('users',array('users_id'=>$this->session->userdata['login_admin']['users_id']));
        if($cek->num_rows() > 0){
            $row = $cek->row_array();
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

            $users_name = $this->input->post('name');
            $users_email = $this->input->post('email');
            $pwd = $this->input->post('password');

            if(trim($pwd) == ''){
                if($row['users_email'] != $users_email){
                    $cekEmail = $this->db->query("SELECT * FROM users WHERE users_email != '$row[users_email]' AND users_email = '$users_email' ");
                    if($cekEmail->num_rows() > 0){
                        $this->session->set_flashdata('error','Email sudah terdaftar');
                        redirect('admin/profile');
                    }else{
                        $this->session->set_flashdata('success','Profile berhasil diubah');
                        $data = array('users_name'=>$users_name,'users_email'=>$users_email,'users_photo'=>$main);
                        $this->model_app->update('users',$data,array('users_id'=>$this->session->userdata['login_admin']['users_id']));
                        $this->session->set_flashdata('success','Profile berhasil diubah');
                        redirect('admin/profile');



                    }
                }else{
                    $this->session->set_flashdata('success','Profile berhasil diubah');
                    $data = array('users_name'=>$users_name,'users_email'=>$users_email,'users_photo'=>$main);
                    $this->model_app->update('users',$data,array('users_id'=>$this->session->userdata['login_admin']['users_id']));
                    $this->session->set_flashdata('success','Profile berhasil diubah');
                    redirect('admin/profile');


                }
            }else{
                $pw = sha1($pwd);
                if($row['users_email'] != $users_email){
                    $cekEmail = $this->db->query("SELECT * FROM users WHERE users_email != '$row[users_email]' AND users_email = '$users_email' ");
                    if($cekEmail->num_rows() > 0){
                        $this->session->set_flashdata('error','Email sudah terdaftar');
                        redirect('admin/profile');
                    }else{
                        $password = sha1($pwd);
                        $data = array('users_name'=>$users_name,'users_email'=>$users_email,'users_photo'=>$main,'users_password'=>$password);
                        $this->session->set_flashdata('success','Profile berhasil diubah');
                        $this->model_app->update('users',$data,array('users_id'=>$this->session->userdata['login_admin']['users_id']));
                        redirect('admin/profile');

                        
                    }
                }else{
                    $password = sha1($pwd);
                    $data = array('users_name'=>$users_name,'users_email'=>$users_email,'users_photo'=>$main,'users_password'=>$password);
                    $this->session->set_flashdata('success','Profile berhasil diubah');
                    $this->model_app->update('users',$data,array('users_id'=>$this->session->userdata['login_admin']['users_id']));
                    redirect('admin/profile');

                }
            }
            
        }else{
            $this->session->set_flashdata('error','Profile tidak ditemukan');
            redirect('admin/auth_admin');
        }
    }
}