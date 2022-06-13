<!DOCTYPE html>

 <html lang="en">
 <head>
  <meta charset='UTF-8'>

 </head>
 <body>
  <style>
      #customers {
  font-family: Arial, Helvetica, sans-serif;
  border-collapse: collapse;
  width: 100%;

}

#customers td, #customers th {
  border: 1px solid #ddd;
  padding: 8px;
  
}




#customers th {
    
  padding-top: 12px;
  padding-bottom: 12px;
  text-align: center;
  background-color: #1857fa;
  color: white;
}
  </style>
  <div id="page-wrap">
 
  
   <div style="clear:both"></div>
   <div id="customer">
    
    <table id="meta" width="100%" >
     <tr>
      <td class="meta-head" width="15%">Invoice </td>
      <td align="left">#<?= $row['trans_no'] ?></td>

      <td class="meta-head" align="right">Nama </td>
      <td style="padding-left:10px;" width="30%"><?= $row['trans_cus_name'] ?></td>
    </tr>
     <tr>

      <td class="meta-head">Tanggal</td>
      <td><?= date('d/m/Y H:i',strtotime($row['trans_date']))?></td>
      <td class="meta-head" align="right">Email </td>
      <td style="padding-left:10px;"><?= $row['trans_cus_email'] ?></td>
     
     </tr>
     <tr>
      <?php 
        if($row['trans_sp_id'] == NULL){
            $ket = 'Waktu Ambil';
        }else{
            $ket = 'Waktu Antar';
        }
      ?>
      <td class="meta-head"><?= $ket ?></td>
      <td><div class="due"><?= date('H:i',strtotime($row['trans_time'])) ?></div></td>
      <td class="meta-head" align="right">Hp </td>
      <td style="padding-left:10px;"><?= $row['trans_cus_phone'] ?></td>
     </tr>
     <tr>
         <td colspan="2"></td>
         <td class="meta-head" align="right">Status </td>
        <td style="padding-left:10px;"><?=ucfirst($row['trans_status']) ?></td>
         
     </tr>
     <tr height="80px">
        <td class="meta-head" colspan="2"></td>
         <td align="right" style>Delivery</td>
         <td style="padding-left:10px;">
            <?php 
            if($row['trans_sp_id'] == NULL){
                echo "Tidak";
                $spPrice =0;
            }else{
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
                echo  $row['trans_address'].'. '.$kab['kab_name'].$kecamatan;
            }
                ?>

         </td>
     </tr>
    
     

    </table>
   </div>
   <table id="customers" width="100%" style="margin-top:30px" id="">

    <tr>
     <th>Mobil</th>
     <th>Paket</th>
     <th>Harga</th>
     <th>Hari</th>
     <th>Sub Total</th>
    </tr>
    <?php
        $hari = daysDifference($row['trans_date_start'],$row['trans_date_end']);
    ?>
    <tr class="item-row" align="center">
     <td class="item-name"><?= $mobil['mobil_name'] ?></td>

     <td class="description"><?= $paket['pack_name']?></td>
     <td><?= rp($paket['pack_price'])?></td>
     <td><?= $hari ?> Hari</td>
     <td><?= rp($hari*$paket['pack_price'])?></td>
    </tr>

    
   <tr>
       <td colspan="5" style="border:none">&nbsp;</td>
   </tr>
   <tr>
       <td colspan="5" style="border:none">&nbsp;</td>
   </tr>
    <tr>
     <td colspan="2" class="blank" style="border:none"> </td>
     <td colspan="2" class="total-line" align="right" style="border:none">Subtotal</td>
     <td class="total-value" style="border:none"><div id="subtotal" align="center"><?= rp($hari*$paket['pack_price'])?></div></td>
    </tr>
    <?php if($row['trans_sp_id'] != NULL){
        echo ' <tr >
        <td colspan="2" class="blank" style="border:none"> </td>
        <td colspan="2" class="total-line" align="right" style="border:none">Delivery</td>
        <td class="total-value" style="border:none"><div id="subtotal" align="center" style="border:none">'.rp($spPrice).'</div></td>
       </tr>';
    }
        ?>
    <tr>

     <td colspan="2" class="blank" style="border:none"> </td>
     <td colspan="2" class="total-line" align="right" style="border:none">Total</td>
     <td class="total-value" style="border:none"><div id="total" align="center" ><?= rp($row['trans_total']) ?></div></td>
    </tr>
   
   </table>
  
  </div>
 </body>
 </html>

</body>
</html>