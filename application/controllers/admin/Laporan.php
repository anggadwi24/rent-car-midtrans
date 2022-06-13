<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Laporan extends CI_Controller 
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
		$start = date('Y-m-01');
		$end = date('Y-m-d');
		$status = 'all';
		redirect('admin/laporan/data?start='.$start.'&end='.$end.'&status='.$status);
	}
	function data(){
		$start = $this->input->get('start');
		$end = $this->input->get('end');
		$status = $this->input->get('status');
		$data['start'] = $start;
		$data['end'] = $end;
		$data['status'] = $status;
		if($status == 'all'){
			$data['record'] = $this->model_app->join_where_order2('cr_payment','cr_transaksi','pay_trans_no','trans_no',array('trans_date_start >='=>$start,'trans_date_end <='=>$end),'pay_date','DESC');

		}else{
			$data['record'] = $this->model_app->join_where_order2('cr_payment','cr_transaksi','pay_trans_no','trans_no',array('trans_date_start >='=>$start,'trans_date_end <='=>$end,'trans_status'=>$status),'pay_date','DESC');
			
		}

		$this->template->load('template_admin','admin/laporan',$data);

	}
	function download(){
		$no = $this->uri->segment('4');
		$cek = $this->model_app->join_where_order2('cr_payment','cr_transaksi','pay_trans_no','trans_no',array('trans_no'=>$no),'pay_date','DESC');
		if($cek->num_rows() > 0){
			$row = $cek->row_array();
			$data['row'] = $row;
			$data['mobil'] = $this->model_app->view_where('cr_mobil',array('mobil_id'=>$row['trans_mobil_id']))->row_array();
			$data['paket'] = $this->model_app->view_where('cr_package',array('pack_id'=>$row['trans_pack_id']))->row_array();
			
			// $this->load->view('admin/pdf_transaksi',$data);
			$html = $this->load->view('admin/pdf_transaksi',$data,true);
			$title = '#'.$row['trans_no'];
			pdf_create($html,$title,'A4','potrait');


		}else{
			echo "<script >window.close();</script>";
		}

	}
	function excel(){
		$start = $this->input->get('start');
		$end = $this->input->get('end');
		$status = $this->input->get('status');

		if($start == '' OR $start == NULL ){
			$start = date('Y-m-01');
		}

		if($end == '' OR $end == NULL ){
			$end = date('Y-m-d');
		}

		if($status == 'all' OR $status == 'done' OR $status == 'paid' OR $status == 'cancel'){
			$status = $status;
		}else{
			$status = 'all';
		}
		if($status == 'all'){
			$record = $this->model_app->join_where_order2('cr_payment','cr_transaksi','pay_trans_no','trans_no',array('trans_date_start >='=>$start,'trans_date_end <='=>$end),'pay_date','DESC');

		}else{
			$record = $this->model_app->join_where_order2('cr_payment','cr_transaksi','pay_trans_no','trans_no',array('trans_date_start >='=>$start,'trans_date_end <='=>$end,'trans_status'=>$status),'pay_date','DESC');
			
		}
		include APPPATH.'third_party/PHPExcel/PHPExcel.php';
        
        // Panggil class PHPExcel nya
        $excel = new PHPExcel();
        // Settingan awal fil excel
        $excel->getProperties()->setCreator('My Notes Code')
                     ->setLastModifiedBy('My Notes Code')
                     ->setTitle("Data Siswa")
                     ->setSubject("Siswa")
                     ->setDescription("Laporan Semua Data Siswa")
                     ->setKeywords("Data Siswa");
        // Buat sebuah variabel untuk menampung pengaturan style dari header tabel
        $style_col = array(
          'font' => array('bold' => true, 'color' => array('rgb' => 'FFFFFF'),),
          'fill' => array(
                'type' => PHPExcel_Style_Fill::FILL_SOLID,
                'color' => array('rgb' => '1857fa')
            ), // Set font nya jadi bold
          'alignment' => array(
            'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER, // Set text jadi ditengah secara horizontal (center)
            'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER // Set text jadi di tengah secara vertical (middle)
          ),
          'borders' => array(
            'top' => array('style'  => PHPExcel_Style_Border::BORDER_THIN), // Set border top dengan garis tipis
            'right' => array('style'  => PHPExcel_Style_Border::BORDER_THIN),  // Set border right dengan garis tipis
            'bottom' => array('style'  => PHPExcel_Style_Border::BORDER_THIN), // Set border bottom dengan garis tipis
            'left' => array('style'  => PHPExcel_Style_Border::BORDER_THIN) // Set border left dengan garis tipis
          )
        );
        // Buat sebuah variabel untuk menampung pengaturan style dari isi tabel
        $style_row = array(
          'alignment' => array(
            'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER,
             'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER // Set text jadi di tengah secara vertical (middle)
          ),
          'borders' => array(
            'top' => array('style'  => PHPExcel_Style_Border::BORDER_THIN), // Set border top dengan garis tipis
            'right' => array('style'  => PHPExcel_Style_Border::BORDER_THIN),  // Set border right dengan garis tipis
            'bottom' => array('style'  => PHPExcel_Style_Border::BORDER_THIN), // Set border bottom dengan garis tipis
            'left' => array('style'  => PHPExcel_Style_Border::BORDER_THIN) // Set border left dengan garis tipis
          )
        );

		$style_row1 = array(
			'alignment' => array(
			  'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER,
			   'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER // Set text jadi di tengah secara vertical (middle)
			),
			
		  );
		

		$excel->setActiveSheetIndex(0)->setCellValue('A1', "DATA LAPORAN PT MAS DIANI CHANDRA"); // Set kolom A1 dengan tulisan "DATA SISWA"
        $excel->getActiveSheet()->mergeCells('A1:L1'); // Set Merge Cell pada kolom A1 sampai E1
        $excel->getActiveSheet()->getStyle('A1')->getFont()->setBold(TRUE); // Set bold kolom A1
        $excel->getActiveSheet()->getStyle('A1')->getFont()->setSize(15); // Set font size 15 untuk kolom A1
        $excel->getActiveSheet()->getStyle('A1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER); // Set text center untuk kolom A1
		
		$title = strtoupper(format_indo($start).' - '.format_indo($end));

        $excel->setActiveSheetIndex(0)->setCellValue('A2', $title); // Set kolom A1 dengan tulisan "DATA SISWA"
        $excel->getActiveSheet()->mergeCells('A2:L2'); // Set Merge Cell pada kolom A1 sampai E1
        $excel->getActiveSheet()->getStyle('A2')->getFont()->setBold(TRUE); // Set bold kolom A1
        $excel->getActiveSheet()->getStyle('A2')->getFont()->setSize(15); // Set font size 15 untuk kolom A1
        $excel->getActiveSheet()->getStyle('A2')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		
		$title2 = 'STATUS : '.strtoupper($status);
        $excel->setActiveSheetIndex(0)->setCellValue('A3', $title2); // Set kolom A1 dengan tulisan "DATA SISWA"
        $excel->getActiveSheet()->mergeCells('A3:L3'); // Set Merge Cell pada kolom A1 sampai E1
        $excel->getActiveSheet()->getStyle('A3')->getFont()->setBold(TRUE); // Set bold kolom A1
        $excel->getActiveSheet()->getStyle('A3')->getFont()->setSize(15); // Set font size 15 untuk kolom A1
        $excel->getActiveSheet()->getStyle('A3')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        // Buat header tabel nya pada baris ke 3
        $excel->setActiveSheetIndex(0)->setCellValue('A5', "NO"); // Set kolom A3 dengan tulisan "NO"
        
        $excel->setActiveSheetIndex(0)->setCellValue('B5', "NO. INVOICE"); // Set kolom B3 dengan tulisan "NIS"
       
        $excel->setActiveSheetIndex(0)->setCellValue('C5', "PENYEWA"); // Set kolom C3 dengan tulisan "NAMA"
       
        $excel->setActiveSheetIndex(0)->setCellValue('D5', "MOBIL"); // Set kolom D3 dengan tulisan "JENIS KELAMIN"
     
        $excel->setActiveSheetIndex(0)->setCellValue('E5', "PAKET"); // Set kolom E3 dengan tulisan "ALAMAT"
      
        $excel->setActiveSheetIndex(0)->setCellValue('F5', "TANGGAL SEWA");
        $excel->setActiveSheetIndex(0)->setCellValue('G5', "DELIVERY");
        $excel->setActiveSheetIndex(0)->setCellValue('H5', "ALAMAT");
        $excel->setActiveSheetIndex(0)->setCellValue('I5', "STATUS");
    
        $excel->setActiveSheetIndex(0)->setCellValue('J5', "BIAYA DELIVERY"); // Set kolom E3 dengan tulisan "ALAMAT"
     
        $excel->setActiveSheetIndex(0)->setCellValue('K5', "BIAYA SEWA");
        $excel->setActiveSheetIndex(0)->setCellValue('L5', "SUB TOTAL");

       
    
    
    
    
        // Apply style header yang telah kita buat tadi ke masing-masing kolom header
        $excel->getActiveSheet()->getStyle('A5')->applyFromArray($style_col);
        $excel->getActiveSheet()->getStyle('B5')->applyFromArray($style_col);
        $excel->getActiveSheet()->getStyle('C5')->applyFromArray($style_col);
        $excel->getActiveSheet()->getStyle('D5')->applyFromArray($style_col);
        $excel->getActiveSheet()->getStyle('E5')->applyFromArray($style_col);
      
        $excel->getActiveSheet()->getStyle('F5')->applyFromArray($style_col);
        $excel->getActiveSheet()->getStyle('G5')->applyFromArray($style_col);
        $excel->getActiveSheet()->getStyle('H5')->applyFromArray($style_col);
        $excel->getActiveSheet()->getStyle('K5')->applyFromArray($style_col);
        $excel->getActiveSheet()->getStyle('H5')->applyFromArray($style_col);
        $excel->getActiveSheet()->getStyle('I5')->applyFromArray($style_col);
        $excel->getActiveSheet()->getStyle('J5')->applyFromArray($style_col);
        $excel->getActiveSheet()->getStyle('K5')->applyFromArray($style_col);
        $excel->getActiveSheet()->getStyle('L5')->applyFromArray($style_col);

		$no = 1; // Untuk penomoran tabel, di awal set dengan 1
        $numrow = 6; // Set baris pertama untuk isi tabel adalah baris ke 4
		$total = 0;
        foreach($record->result_array() as $row){
			$mobil = $this->model_app->view_where('cr_mobil',array('mobil_id'=>$row['trans_mobil_id']))->row_array();
			$pack = $this->model_app->view_where('cr_package',array('pack_id'=>$row['trans_pack_id']))->row_array();
			$tglSewa = $title;
			if($row['trans_sp_id'] == NULL){
				$delivery = 'TIDAK';
				$alamat = '-';
				$spPrice =0;
			}else{
				$delivery = 'YA';
				$sp = $this->model_app->view_where('cr_shuttle_price',array('sp_id'=>$row['trans_sp_id']))->row_array();
                $spPrice = $sp['sp_price'];
                $hasPrice = true;
                $kab = $this->model_app->view_where('cr_kabupaten',array('kab_id'=>$sp['sp_kab_id']))->row_array();
                if($sp['sp_kec_id'] != NULL){
                    $kec = $this->model_app->view_where('cr_kecamatan',array('kec_id'=>$sp['sp_kec_id']))->row_array();
                    $kecamatan = ', '.$kec['kec_name'];
                }else{
                    $kecamatan = '';
                }
                $alamat = $row['trans_address'].'. '.$kab['kab_name'].$kecamatan;

			}
			$total = $total+$row['trans_total'];
			$hari = daysDifference($row['trans_date_start'],$row['trans_date_end']);

			$excel->setActiveSheetIndex(0)->setCellValue('A'.$numrow, $no);
			$excel->setActiveSheetIndex(0)->setCellValue('B'.$numrow, $row['trans_no']);
			$excel->setActiveSheetIndex(0)->setCellValue('C'.$numrow, $row['trans_cus_name']);
			$excel->setActiveSheetIndex(0)->setCellValue('D'.$numrow, $mobil['mobil_name']);
			$excel->setActiveSheetIndex(0)->setCellValue('E'.$numrow, $pack['pack_name']);
			$excel->setActiveSheetIndex(0)->setCellValue('F'.$numrow, $tglSewa);
			$excel->setActiveSheetIndex(0)->setCellValue('G'.$numrow, $delivery);
			$excel->setActiveSheetIndex(0)->setCellValue('H'.$numrow, $alamat);
			$excel->setActiveSheetIndex(0)->setCellValue('I'.$numrow, ucfirst($row['trans_status']));
			$excel->setActiveSheetIndex(0)->setCellValue('J'.$numrow, rp($spPrice));
			$excel->setActiveSheetIndex(0)->setCellValue('K'.$numrow, rp($pack['pack_price']*$hari));
			$excel->setActiveSheetIndex(0)->setCellValue('L'.$numrow, rp($row['trans_total']));

			$excel->getActiveSheet()->getStyle('A'.$numrow)->applyFromArray($style_row);
			$excel->getActiveSheet()->getStyle('B'.$numrow)->applyFromArray($style_row);
			$excel->getActiveSheet()->getStyle('C'.$numrow)->applyFromArray($style_row);
			$excel->getActiveSheet()->getStyle('D'.$numrow)->applyFromArray($style_row);
			$excel->getActiveSheet()->getStyle('E'.$numrow)->applyFromArray($style_row);
			$excel->getActiveSheet()->getStyle('F'.$numrow)->applyFromArray($style_row);
			$excel->getActiveSheet()->getStyle('G'.$numrow)->applyFromArray($style_row);
			$excel->getActiveSheet()->getStyle('H'.$numrow)->applyFromArray($style_row);
			$excel->getActiveSheet()->getStyle('I'.$numrow)->applyFromArray($style_row);
			$excel->getActiveSheet()->getStyle('J'.$numrow)->applyFromArray($style_row);
			$excel->getActiveSheet()->getStyle('K'.$numrow)->applyFromArray($style_row);
			$excel->getActiveSheet()->getStyle('L'.$numrow)->applyFromArray($style_row);

			$no++;
			$numrow++;

		
		}
		

		$numrow1= $numrow+2;
		$numrow2= $numrow+3;

		$excel->setActiveSheetIndex(0)->setCellValue('L'.$numrow1, 'TOTAL');
		$excel->setActiveSheetIndex(0)->setCellValue('L'.$numrow2, rp($total));
		$excel->getActiveSheet()->getStyle('L'.$numrow1)->applyFromArray($style_row1);
		$excel->getActiveSheet()->getStyle('L'.$numrow2)->applyFromArray($style_row1);




		$excel->getActiveSheet()->getColumnDimension('A')->setWidth(5); // Set width kolom A
        $excel->getActiveSheet()->getColumnDimension('B')->setWidth(15); // Set width kolom B
        $excel->getActiveSheet()->getColumnDimension('C')->setWidth(20); // Set width kolom C
        $excel->getActiveSheet()->getColumnDimension('D')->setWidth(20); // Set width kolom D
        $excel->getActiveSheet()->getColumnDimension('E')->setWidth(20); // Set width kolom E

        $excel->getActiveSheet()->getColumnDimension('F')->setWidth(30);
        $excel->getActiveSheet()->getColumnDimension('G')->setWidth(15);
        $excel->getActiveSheet()->getColumnDimension('H')->setWidth(40);
        $excel->getActiveSheet()->getColumnDimension('I')->setWidth(15);
        $excel->getActiveSheet()->getColumnDimension('J')->setWidth(20);
        $excel->getActiveSheet()->getColumnDimension('K')->setWidth(20);
        $excel->getActiveSheet()->getColumnDimension('L')->setWidth(20);

		$excel->getActiveSheet()->getDefaultRowDimension()->setRowHeight(-1);
        // Set orientasi kertas jadi LANDSCAPE
        $excel->getActiveSheet()->getPageSetup()->setOrientation(PHPExcel_Worksheet_PageSetup::ORIENTATION_LANDSCAPE);
        // Set judul file excel nya
        $excel->getActiveSheet(0)->setTitle('LAPORAN');
        $excel->setActiveSheetIndex(0);
        // Proses file excel
    
        $name =  'LAPORAN-'.date('d-m-Y',strtotime($start)).'-'.date('d-m-Y',strtotime($end));
		ob_end_clean();
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment; filename="'.$name.'".xlsx"'); // Set nama file excel nya
        header('Cache-Control: max-age=0');
        $write = PHPExcel_IOFactory::createWriter($excel, 'Excel2007');
        $write->save('php://output');

	}

}
