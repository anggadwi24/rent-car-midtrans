<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Settlement extends CI_Controller 
{

	public function __construct()
	{
        parent::__construct();
    
	}
    function index(){
       $this->output->set_status_header(404);

    }

    function finish(){
        $status = $this->input->get('transaction_status');
        
        $invoice = $this->input->get('order_id');
        $cek = $this->model_app->view_where('cr_transaksi',array('trans_no'=>$invoice));
        if($cek->num_rows() > 0){
            $row = $cek->row_array();
            $data['title'] = '#'.$invoice;
            $data['row'] = $row;
            $this->load->view('view_finish',$data);
        }else{
             echo "<script>window.close();</script>";
        }
    }
}
?>