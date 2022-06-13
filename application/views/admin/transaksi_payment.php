<style>
.switch {
  position: relative;
  display: inline-block;
  width: 52px;
  height: 26px;
}

.switch input { 
  opacity: 0;
  width: 0;
  height: 0;
}

.slider {
  position: absolute;
  cursor: pointer;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  background-color: #ccc;
  -webkit-transition: .4s;
  transition: .4s;
}

.slider:before {
  position: absolute;
  content: "";
  height: 18px;
  width: 19px;
  left: 4px;
  bottom: 4px;
  background-color: white;
  -webkit-transition: .4s;
  transition: .4s;
}

input:checked + .slider {
  background-color: #2196F3;
}

input:focus + .slider {
  box-shadow: 0 0 1px #2196F3;
}

input:checked + .slider:before {
  -webkit-transform: translateX(26px);
  -ms-transform: translateX(26px);
  transform: translateX(26px);
}

/* Rounded sliders */
.slider.round {
  border-radius: 34px;
}

.slider.round:before {
  border-radius: 50%;
}
</style>
<h1 class="h3 mb-0 text-gray-800 py-3">Pembayaran</h1>
<a href="<?= base_url('admin/transaksi/sewa') ?>" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm" > Kembali</a>
<form id="formAct">
<div class="row my-3">
    <div class="col-4">
        <div class="card shadow">
            <div class="card-header">
                <h6 class="card-title">Detail</h6>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-12 form-group">
                            <label for="">No Transaksi</label>
                            <h6><a href="<?= base_url('admin/transaksi/sewa/detail?no='.$row['trans_no'])?>">#<?= $row['trans_no']?></a></h6>
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
                    <div class="col-12 form-group">
                   
                        <?php 
                            $merk = $this->model_app->view_where('cr_merk',array('merk_id'=>$mobil['mobil_merk']))->row_array();
                        ?>
                        <label for="">Mobil / Paket</label>
                        <h6><?= $merk['merk_name']?> - <?= $mobil['mobil_name'] ?> / <?= $package['pack_name'] ?></h6>
                   
                    </div>
                    <div class="col-12 form-group">
                        <label for="">Tanggal Sewa</label>
                    
                        <h6><?= date('d/m/Y',strtotime($row['trans_date_start']))?> - <?= date('d/m/Y',strtotime($row['trans_date_end']))?> (<?= daysDifference($row['trans_date_start'],$row['trans_date_end']) ?> Hari)</h6>
                    
                    </div>
                    <div class="col-12 form-group">
                        <label for="">Tanggal Transaksi</label>
                        <h6><?= date('d/m/Y H:i',strtotime($row['trans_date']))?></h6>
                    </div>
                </div>
            </div>
            
        </div>
    </div>
    <div class="col-8">
        <div class="card shadow">
            <div class="card-header">
                <h6 class="card-title">Pembayaran</h6>
            </div>
            <div class="card-body">
                <form id="formAct">
                <div class="row">
                    
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
                      
                    <?php }else{ $spPrice = 0;$hasPrice = false;}?>
                    <div class="col-12 form-group  text-right">

                        <label for="">Status Pembayaran </label>
                        <h6 class='mb-3'><?= ucfirst($row['trans_status']) ?></h6>
                      
                        <label for="">Harga Sewa</label>
                        <h6><?= rp($package['pack_price'])?></h6>
                        <?php if($hasPrice == true){
                            echo "<label>Harga Delivery</label>";
                            echo "<h6>".rp($spPrice)."</h6>";
                        }?>
                        <?php 
                            $total = $package['pack_price']+$spPrice;
                            echo "<label>Total Harga</label>";
                            echo "<h6>".rp($total)."</h6>";
                        ?>
                       
                    </div>
                    <div class="col-12 text-right form-group">
                        <span class="p-3">Cash</span>
                        <label class="switch">
                            <input type="checkbox" name="payment" id="paymentSelect">
                            <span class="slider round"></span>
                        </label>
                        <span class="p-3">E-Payment</span>
                    </div>
                    <input type="hidden" name="no" value="<?= $row['trans_no'] ?>">
                    <div class="col-12 form-group mt-4">
                        <button class="btn btn-primary float-right" id="btnPayment">Bayar</button>
                    </div>
                  
                </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script>
$(document).on('submit','#formAct',function(e){
        
        e.preventDefault();
        var formData = new FormData(this);
        // formData.append('s', getUrlParameter('s'));
        $.ajax({
             type:'POST',
             url:'<?= base_url('admin/transaksi/sewa/doPay')?>',
             data: formData,
             contentType: false,
             cache: false,
             processData:false,
             dataType :'json',
             beforeSend:function(){
              
             },success:function(resp){
                // console.log(resp);
                 if(resp.status == true){
                    if(resp.payment == true){
                        window.open(resp.msg, '_blank');
                        swal('Berhasil',resp.msg,'success');

                    }else{
                        swal({
                        title: 'Berhasil',
                        text: resp.msg,
                        icon: 'success',
                       
                    }) .then((willDelete) => {
                        window.location = resp.redirect;
                    });
                       
                        
                    
                    }
                 }else{
                     swal('Peringatan',resp.msg,'warning');
                    
                 }
             },error:function(e){
                 console.log(e.responseText);
             }
        })
    })

</script>
