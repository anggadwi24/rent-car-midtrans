
<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); {
    function rp($total){
        $num =  number_format($total,0);
        return 'Rp. '.str_replace(',','.',$num);
    }
    function daysDifference($endDate, $beginDate)
    {

        $d1 = new DateTime( $endDate );
        $d2 = new DateTime( $beginDate );
        
        $diff = $d2->diff( $d1 );
        return $diff->d;
    }
    function encode($post){
        $key =  "MASDIANICHANDRA2022##";
        $ci = & get_instance();
        return $ci->encrypt->encode($post,$key);

    }
    function decode($post){
       $key = "MASDIANICHANDRA2022##";
       $ci = & get_instance();
       return $ci->encrypt->decode($post,$key);
       
       
   }
    function pdf_create($html, $filename='', $paper, $orientation, $stream=TRUE)
    {
        require_once("dompdf/dompdf_config.inc.php");

        $dompdf = new DOMPDF();
        $dompdf->set_paper($paper,$orientation);
        $dompdf->load_html($html, 'UTF-8');
        $dompdf->render();
        
        if ($stream) {
            $dompdf->stream($filename.".pdf", array ('Attachment' => 0));
        } else {
            return $dompdf->output();
        }
    }
    function __thisOwner(){
         $ci = & get_instance();
        $id_user = $ci->session->userdata['login_admin']['users_id'];
        $cek = $ci->db->query("SELECT users_level FROM users WHERE users_id = $id_user");
        if($cek->num_rows() > 0){
            $row = $cek->row_array();
            if($row['users_level'] == 'Admin'){
                return TRUE;
            }else{
                return false;
            }
        }else{
            return false;
        }
        
    }
    if (!function_exists('format_indo_w')) {
        function format_indo($date){
          date_default_timezone_set('Asia/Makassar');
          // array hari dan bulan
      
          $Bulan = array("Januari","Februari","Maret","April","Mei","Juni","Juli","Agustus","September","Oktober","November","Desember");
          
          // pemisahan tahun, bulan, hari, dan waktu
          $tahun = substr($date,0,4);
          $bulan = substr($date,5,2);
          $tgl = substr($date,8,2);
        
        
          $result = $tgl." ".$Bulan[(int)$bulan-1]." ".$tahun;
      
          return $result;
        }
      }
      function pushEmail($email,$title,$content){
          
        require_once ('vendor/phpmailer/phpmailer/src/Exception.php');
        require_once ('vendor/phpmailer/phpmailer/src/PHPMailer.php');
        require_once ('vendor/phpmailer/phpmailer/src/SMTP.php');
    
        require 'vendor/autoload.php';
        $mail = new PHPMailer\PHPMailer\PHPMailer();
        $mail->isSMTP();
        $mail->Host     = 'ssl://smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'masdianichandratrans@gmail.com';
        $mail->Password = 'plyb jvcl itwk iear';
        $mail->SMTPSecure = 'ssl';
        $mail->Port     = 465;

        $mail->setFrom('masdianichandratrans@gmail.com', 'PT Mas Diani Chandra');
        $mail->addReplyTo('masdianichandratrans@gmail.com', 'PT Mas Diani Chandra');
        // Add a recipient
        $mail->addAddress($email);

        // Add cc or bcc 
        $mail->addCC($email);
        $mail->addBCC($email);

        // Email subject
        $mail->Subject = $title;

        // Set email format to HTML
        $mail->isHTML(true);

        // Email body content
     
        $mail->Body = $content;
        $mail->AltBody = $title;
      


        // Send email
        if(!$mail->send()){
           return false;
        }else{
          return false;
         

        }
        // print_r($status);

    }
}