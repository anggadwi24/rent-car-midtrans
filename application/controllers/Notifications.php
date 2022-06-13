<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Notifications extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -  
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in 
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see http://codeigniter.com/user_guide/general/urls.html
	 */


	public function __construct()
    {
        parent::__construct();
        $params = array('server_key' => 'SB-Mid-server-qmIfhYvgAOG3RA0495D81dWv', 'production' => false);
		$this->load->library('veritrans');
		$this->veritrans->config($params);
		$this->load->helper('url');
		
    }
	private function mail($no){
        $cek = $this->model_app->view_where('cr_transaksi',array('trans_no'=>$no));
        if($cek->num_rows() > 0){
            $row = $cek->row_array();
            $data['row'] = $row;
            $data['mobil'] = $this->model_app->view_where('cr_mobil',array('mobil_id'=>$row['trans_mobil_id']))->row_array();
            $data['package'] = $this->model_app->view_where('cr_package',array('pack_id'=>$row['trans_pack_id']))->row_array();
            $html = $this->load->view('admin/email',$data,true);
            $title = '[ PT MAS DIANI CHANDRA ] - #'.$row['trans_no'];
            pushEmail($row['trans_cus_email'],$title,$html);
        }
    }
	public function index()
	{
        if($this->input->method() == 'post'){
            $json_result = file_get_contents('php://input');
		    $result = json_decode($json_result);

		if($result){
		    $notif = $this->veritrans->status($result->order_id);
            $status_code = $result->status_code;
            if($status_code == 200){
                $invoice = $result->order_id;
                $cek = $this->model_app->view_where('cr_transaksi',array('trans_no'=>$invoice));
                if($cek->num_rows() > 0 ){
                    $row = $cek->row_array();
                    if($row['trans_status'] == 'waiting'){
                        $this->model_app->update('cr_transaksi',array('trans_status'=>'paid'),array('trans_no'=>$invoice));
                        $this->model_app->update('cr_mobil',array('mobil_available'=>'n'),array('mobil_id'=>$row['trans_mobil_id']));
                        $dataPaym = array('pay_trans_no'=>$invoice,'pay_method'=>$result->payment_type,'pay_amount'=>$result->gross_amount,'pay_date'=>date('Y-m-d H:i:s'));
                        $this->model_app->insert('cr_payment',$dataPaym);
						$data['row'] = $row;
						$data['mobil'] = $this->model_app->view_where('cr_mobil',array('mobil_id'=>$row['trans_mobil_id']))->row_array();
						$data['package'] = $this->model_app->view_where('cr_package',array('pack_id'=>$row['trans_pack_id']))->row_array();
						$html = $this->load->view('admin/email',$data,true);
						$title = '[ PT MAS DIANI CHANDRA ] - #'.$row['trans_no'];
						pushEmail($row['trans_cus_email'],$title,$html);
                    }
                }
            }
		}

		
        }
		

		//notification handler sample

		/*
		$transaction = $notif->transaction_status;
		$type = $notif->payment_type;
		$order_id = $notif->order_id;
		$fraud = $notif->fraud_status;

		if ($transaction == 'capture') {
		  // For credit card transaction, we need to check whether transaction is challenge by FDS or not
		  if ($type == 'credit_card'){
		    if($fraud == 'challenge'){
		      // TODO set payment status in merchant's database to 'Challenge by FDS'
		      // TODO merchant should decide whether this transaction is authorized or not in MAP
		      echo "Transaction order_id: " . $order_id ." is challenged by FDS";
		      } 
		      else {
		      // TODO set payment status in merchant's database to 'Success'
		      echo "Transaction order_id: " . $order_id ." successfully captured using " . $type;
		      }
		    }
		  }
		else if ($transaction == 'settlement'){
		  // TODO set payment status in merchant's database to 'Settlement'
		  echo "Transaction order_id: " . $order_id ." successfully transfered using " . $type;
		  } 
		  else if($transaction == 'pending'){
		  // TODO set payment status in merchant's database to 'Pending'
		  echo "Waiting customer to finish transaction order_id: " . $order_id . " using " . $type;
		  } 
		  else if ($transaction == 'deny') {
		  // TODO set payment status in merchant's database to 'Denied'
		  echo "Payment using " . $type . " for transaction order_id: " . $order_id . " is denied.";
		}*/

	}
}
