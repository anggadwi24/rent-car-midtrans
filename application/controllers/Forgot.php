<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Forgot extends CI_Controller 
{
	public function index()
	{
		$this->load->view('forgot');
	}
    function do(){
        if($this->input->method() == 'post'){
            $email = $this->input->post('email');
            $cek = $this->model_app->view_where('cr_customer',array('cus_email' => $email));
            if($cek->num_rows() > 0){
                $row = $cek->row_array();
                $html = '<h1>Halo, '.$row['cus_name'].'</h1> Silahkan atur ulang kata sandi melalui link berikut : <a href="'.base_url().'forgot/reset?cus='.encode($row['cus_id'].'|'.date('Y-m-d H:i:s',strtotime('+30 Minutes'))).'">'.base_url('forgot/reset/'.encode($row['cus_id'])).'</a>';
                $title = '[ PT MAS DIANI CHANDRA ] - LUPA PASSWORD ';
                pushEmail($row['cus_email'],$title,$html);

                $this->session->set_flashdata('success','Email telah dikirimkan ke '.$row['cus_email']);
                
                redirect('forgot');
            }else{
                $this->session->set_flashdata('error','Email yang anda masukkan tidak terdaftar..!');
                redirect('forgot');
            }
        }else{
            redirect('forgot');
        }
    }
    function reset(){
        $cus = decode($this->input->get('cus'));
        $ex = explode('|',$cus);
        $id = $ex[0];
        $time = $ex[1];
        // echo $cus;
        if($time > date('Y-m-d H:i:s')){
            $cek = $this->model_app->view_where('cr_customer',array('cus_id' => $id));
            if($cek->num_rows() > 0){
                $row = $cek->row_array();   
                $data['cus'] = $this->input->get('cus');
                $data['row'] = $row;
                $this->load->view('reset',$data);
            }else{
                $this->session->set_flashdata('error','Akun tidak ditemukan');

                redirect('forgot');
            }
        }else{
            $this->session->set_flashdata('salah_login_cus','Link sudah tidak berlaku..!');
            redirect('auth');
        }
          
    }
    function doreset(){
        if($this->input->method() == 'post'){
            $id = decode($this->input->post('id'));
            $pass = $this->input->post('password');
            $re = $this->input->post('repass');
            $this->form_validation->set_rules('password','Password','required');

            $this->form_validation->set_rules('repass', 'Password Confirmation', 'required|matches[password]');
            
            if($this->form_validation->run() === FALSE){
                $msg = str_replace(array('</p>'),'<br>',validation_errors());

                $ree = str_replace(array('<p>'),'',$msg);
                $this->session->set_flashdata('error',$ree);

                    redirect('forgot/reset?cus='.$this->input->post('cus')); 
             
                
            }else{
                $cek = $this->model_app->view_where('cr_customer',array('cus_id' => $id));
                if($cek->num_rows() > 0){
                    $data = array('cus_password' => sha1($pass));
                    $where = array('cus_id'=>$id);
                    $this->model_app->update('cr_customer',$data,$where);
                    $this->session->set_flashdata('new_register','Kata sandi berhasil diubah..!');

                    redirect('auth'); 

                }else{
                    $this->session->set_flashdata('error','Akun tidak ditemukan');

                    redirect('forgot/reset?cus='.$this->input->post('cus')); 

                }
            }
        }
    }
    
}