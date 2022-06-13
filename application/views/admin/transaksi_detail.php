<style>
    label{
        font-weight: bold;
    }
    td{
        font-size:14px;
    }
</style>
<?php $hari = daysDifference($row['trans_date_start'],$row['trans_date_end']);?>
<h1 class="h3 mb-0 text-gray-800 py-3">Detail Penyewaan</h1>
<a href="<?= base_url('admin/transaksi/sewa') ?>" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm" > Kembali</a>
<form id="formAct">
<div class="row my-3">
    <div class="col-lg-4 col-sm-12 mb-3">
        <div class="card shadow">
            <div class="card-header">
                <h6 class="card-title">Penyewa</h6>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-12 form-group">
                            <label for="">No Transaksi</label>
                            <h6>#<?= $row['trans_no']?></h6>
                    </div>
                    <div class="col-12 form-group">
                            <label for="">Nama Penyewa</label>
                            <h6><?= $row['trans_cus_name']?></h6>
                    </div>
                    <div class="col-12 form-group">
                            <label for="">Email Penyewa</label>
                            <h6><?= $row['trans_cus_email']?></h6>
                    </div>
                    <div class="col-12 form-group">
                            <label for="">No. Hp Penyewa</label>
                            <h6><?= $row['trans_cus_phone']?></h6>
                    </div>
                </div>
            </div>
            <?php  if(__thisOwner() == true){?>
            <div class="card-footer">
                <div class="row justify-content-between">
                    <?php if($row['trans_status'] == 'paid' OR $row['trans_status'] == 'waiting'){ ?>
                    <div class="col">
                        <?php 
                            
                                echo "<a  onclick='cancelTrans()' class='btn btn-danger btn-xs' ><i class='fas fa-window-close'></i></a>";
                            
                        ?>
                    </div>
                    <?php } ?>
                    <?php if($row['trans_status'] == 'paid'){?>
                    <div class="col">
                         <?php echo "<a  onclick='done()' class='btn btn-success btn-xs float-right' >Selesai</a>";?>
                    </div>
                    <?php }?>

                    <?php if($row['trans_status'] == 'waiting'){?>
                    <div class="col">
                         <?php echo "<a href='".base_url('admin/transaksi/sewa/payment?no='.$row['trans_no'])."' class='btn btn-info btn-xs float-right' ><i class='far fa-credit-card'></i></a>";?>
                    </div>
                    <?php }?>
                </div>
            </div>
            <?php } ?>
        </div>
    </div>
    <div class="col-lg-8 col-sm-12">
        <div class="card shadow">
            <div class="card-header">
                <h6 class="card-title">Detail Sewa</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-borderless ">
                        <thead>
                            <tr>
                                <th >Periode Pemesanan</th>
                                <th>Mobil</th>
                                <th>Jam</th>
                                <th>Delivery</th>
                                <th>Alamat  </th>
                            </tr>
                            
                        </thead>
                        <tbody>
                        <?php 
                            $merk = $this->model_app->view_where('cr_merk',array('merk_id'=>$mobil['mobil_merk']))->row_array();
                        ?>
                            <tr>
                                <td><?= date('d/m/Y',strtotime($row['trans_date_start']))?> - <?= date('d/m/Y',strtotime($row['trans_date_end']))?> <br>( <?= $hari ?> Hari )</td>
                                <td><?= $merk['merk_name']?> <?= $mobil['mobil_name'] ?> <br> <?= $package['pack_name'] ?></td>
                                <td><?= date('H:i',strtotime($row['trans_time']))?> WITA </td>
                                <td><?php if($row['trans_sp_id'] == NULL){ echo "Tidak Diantar";}else{ echo "Diantar";}?></td>
                                <?php if($row['trans_sp_id'] != NULL){
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
                                    ?>
                                    
                            <td><?= $row['trans_address'] ?><br><?= $kab['kab_name'] ?> <?=$kecamatan ?></td>
                        </div>
                    <?php }else{ $spPrice = 0;$hasPrice = false; echo "<td>-</td>";}?>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="row">
                   
                    <div class="col-12 form-group mt-3 text-left">

                        <label for="">Status Pembayaran </label>
                        <h6 class=''><?= ucfirst($row['trans_status']) ?></h6>
                        <?php 
                            $cekPembayaran = $this->model_app->view_where('cr_payment',array('pay_trans_no'=>$row['trans_no']));
                            if($cekPembayaran->num_rows() > 0){
                                $rowP = $cekPembayaran->row_array();
                                echo "<label>Pembayaran </label>";
                                echo "<h6>".strtoupper($rowP['pay_method'])."</h6>";
                                echo "<label>Tanggal Pembayaran </label>";
                                echo "<h6>".date('d/m/Y H:i',strtotime($rowP['pay_date']))."</h6>";
                            }
                        ?>
                        <label for="">Harga Sewa</label>
                        <h6><?= rp($package['pack_price'])?></h6>
                        <?php if($hasPrice == true){
                            echo "<label>Harga Delivery</label>";
                            echo "<h6>".rp($spPrice)."</h6>";
                        }?>
                        </div>
                        <div class="col-12  form-group  text-right" >
                        
                        <?php 
                            
                            echo "<label>Total Harga</label>";
                            echo "<h6 class='text-right'>".rp($row['trans_total'])."</h6>";
                        ?>
                       
                    </div>
                  
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function cancelTrans(){
       
      
        let text = "Anda yakin membatalkan transaksi ini?";
        if (confirm(text) == true) {
           window.location = '<?= base_url('admin/transaksi/sewa/cancel?no='.$row['trans_no'])?>';
        } 
  
    }
    function done(){
       
      
       let text = "Anda yakin menyelesaikan transaksi ini?";
       if (confirm(text) == true) {
          window.location = '<?= base_url('admin/transaksi/sewa/done?no='.$row['trans_no'])?>';
       } 
 
   }
</script>