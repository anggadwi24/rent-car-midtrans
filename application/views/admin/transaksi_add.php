<style>
    .error{
        color: #fb034a;
        font-size: 1rem;
        position: relative;
        line-height: 1;
        width:100%;
    }
    
</style>
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
<h1 class="h3 mb-0 text-gray-800 py-3">Tambah Penyewaan</h1>
<a href="<?= base_url('admin/transaksi/sewa') ?>" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm" > Kembali</a>
<form id="formAct">
<div class="row my-3">
    
    
    <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-xs-12 mb-2">
        <div class="card shadow ">
            <div class="card-header"><h5 class="card-title">Data Customer</h5></div>
            <div class="card-body">
                <div class="row">
                    <div class="col-12 form-group">
                        <label for="">Customer</label>
                        <select name="customer" id="customer" class="form-control" requried>
                            <option value='no'>Tidak Memiliki Akun</option>
                            <?php 
                                if($customer->num_rows() > 0){
                                    foreach($customer->result_array() as $cus){
                                        echo "<option value='".$cus['cus_id']."'>".$cus['cus_name']."</option>";
                                    }
                                }
                            ?>
                        </select>
                    </div>
                    <div class="col-12 form-group">
                        <label for="">Nama Customer</label>
                        <input type="text" class="form-control" id="name" name="name" required>
                    </div>
                    <div class="col-12 form-group">
                        <label for="">Email Customer</label>
                        <input type="email" class="form-control" id="email" name="email" required>
                    </div>
                    <div class="col-12 form-group">
                        <label for="">Phone Customer</label>
                        <input type="text" class="form-control" id="phone" name="phone" required>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-8 col-lg-8 col-md-8 col-sm-12 col-xs-12">
        <div class="card shadow mb-3">
            <div class="card-header"><h5 class="card-title">Data Sewa</h5></div>
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-5 col-sm-12 form-group">
                        <label for="">Tanggal Mulai Sewa</label>
                        <input type="date" class="form-control" name="startDate" id="startDate" required value="<?= date('Y-m-d')?>">
                    </div>
                    <div class="col-lg-5 col-sm-12 form-group">
                        <label for="">Tanggal Selesai Sewa</label>
                        <input type="date" class="form-control" name="endDate" id="endDate" required value="<?= date('Y-m-d',strtotime('+1 Days'))?>">
                    </div>
                    <div class="col-lg-2 col-sm-12 form-group">
                        <label for="">Jam Ambil</label>
                        <input type="time" class="form-control" name="time" required value="<?= date('H:i') ?>">
                    </div>
                    <div class="col-lg-5  col-sm-12 form-group">
                        <label for="">Merk Mobil</label>
                        <select name="merkMobil" id="merkMobil" class="form-control" required>
                            <option disabled selected>Pilih Merk Mobil</option>
                            <?php 
                                if($merk->num_rows() > 0){
                                    foreach($merk->result_array() as $mrk){
                                        echo "<option value='".$mrk['merk_id']."'>".$mrk['merk_name']."</option>";
                                    }
                                }
                            ?>
                        </select>
                    </div>
                    <div class="col-lg-7 col-sm-12 form-group">
                        <label for="">Mobil</label>
                        <select name="mobil" id="mobil" class="form-control" required>
                            <option disabled selected>Pilih Mobil</option>
                            <option disabled>Pilih Merk Terlebih Dahulu</option>

                            
                        </select>
                    </div>
                    <div class="col-sm-6 col-sm-12 form-group">
                        <label for="">Paket</label>
                        <select name="package" id="package" class="form-control" required>
                            <option disabled selected>Pilih Paket</option>
                            <option disabled>Pilih Mobil Terlebih Dahulu</option>
                        </select>
                    </div>
                    <div class="col-sm-6 col-sm-12 form-group">
                        <label for="">Delivery</label>
                        <select name="delivery" id="delivery" class="form-control" required>
                            <option value="y">Antar & Jemput</option>
                            <option value="n" selected>Tidak</option>

                        </select>
                    </div>
                    <div class="col-6 form-group formSel">
                        <label for="">Kabupaten</label>
                        <select name="kabupaten" id="kabupaten" class="form-control">
                            <?php if($kabupaten->num_rows() > 0){
                                foreach($kabupaten->result_array() as $kab){
                                echo "<option value='".$kab['kab_id']."'>".$kab['kab_name']."</option>";
                                }
                            }
                            ?>
                        </select>
                    </div>
                    <div class="col-6 form-group formSel">
                        <label for="">Kecamatan</label>
                        <select name="kecamatan" id="kecamatan" class="form-control">
                            <option disabled selected></option>
                        </select>
                    </div>
                    <div class="col-12 form-group formSel">
                        <label for="">Alamat Antar / Jemput</label>
                        <textarea name="address" id="alamat" class="form-control" cols="5" rows="5"></textarea>
                    </div>
                    <div class="col-12 form-group">
                        <button class="btn btn-primary float-right btn-xs" id="btnProcess" type="button">Proses</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="card shadow" id="cardPaym" style="display:none">
            <div class="card-header">
                <h5 class="card-title">Pembayaran</h5>
            </div>
            <div class="card-body">
                <div class="row" id="payment"></div>
            </div>
        </div>
    </div>
    
</div>
</form>
<script>
    $("#formAct").validate({
                    
        rules: {

            customer: "required", 
            name: "required",
            email: "required",
            phone: "required",
            startDate: "required",
            endDate: "required",
            time: "required",
            merk: "requried",
            mobil: "required",
            package : "required",
            delivery: "required",
            

        },

     });
     $("#btnProcess").on('click', function () {
          
        if($("#formAct").valid())
        {   
            var formData = new FormData($('#formAct').get(0));
            $.ajax({
             type:'POST',
             url:'<?= base_url('admin/transaksi/sewa/checking') ?>',
             data: formData,
             contentType: false,
             cache: false,
             processData:false,
             dataType :'json',
             beforeSend:function(){
                 console.log($('#formAct input'));
                    $('#formAct input').prop('disabled',true);
                    $('#formAct select').prop('disabled',true);
                    $('#formAct textarea').prop('disabled',true);
                    $('#formAct button').prop('disabled',true);



                    $('#btnProcess').html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span><span class="sr-only">Loading...</span>');
             },success:function(resp){
                // console.log(resp);
                 if(resp.status == true){
                    $('#btnProcess').remove();
                    $('#cardPaym').css('display','');
                    $('#payment').html(resp.output);
                 }else{
                    
                    $('#cardPaym').css('display','none');
                    $('#btnProcess').html('Proses');
                     alert(resp.msg);
                 }
             },error:function(e){
                 console.log(e.responseText);
             },complete:function(){
                    $('#formAct input').prop('disabled',false);
                    $('#formAct select').prop('disabled',false);
                    $('#formAct textarea').prop('disabled',false);
                    $('#formAct button').prop('disabled',false);
             }
        })
        }else{
            swal('Peringatan','Lengkapi data','warning');
        }
    });
    $(document).on('submit','#formAct',function(e){
        
        e.preventDefault();
        var formData = new FormData(this);
        // formData.append('s', getUrlParameter('s'));
        $.ajax({
             type:'POST',
             url:'<?= base_url('admin/transaksi/payment')?>',
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
                        window.location = resp.redirect;
                    }else{
                        alert(resp.msg);
                        window.location = resp.redirect;
                    
                    }
                 }else{
                    swal('Peringatan',resp.msg,'warning');

                   
                 }
             },error:function(e){
                 console.log(e.responseText);
             }
        })
    })
    $('.formSel').hide();
    $(document).on('change','#delivery',function(){
        if($(this).val() == 'y'){
            $('.formSel').show();

        }else{
            $('.formSel').hide();

        }
    })
    $(document).on('change','#merkMobil',function(){
        $.ajax({
            
            type:'POST',
            url:'<?= base_url('admin/transaksi/sewa/mobil') ?>',
            data:{id:$(this).val()},
            dataType:'json',
            success:function(resp){
                if(resp.status == true){
                    $('#mobil').html(resp.output)
                }else{
                    swal('Peringatan',resp.msg,'warning');

                }
            }
        })
    })
    $(document).on('change','#mobil',function(){
        $.ajax({
            
            type:'POST',
            url:'<?= base_url('admin/transaksi/sewa/package') ?>',
            data:{id:$(this).val()},
            dataType:'json',
            success:function(resp){
                if(resp.status == true){
                    $('#package').html(resp.output)
                }else{
                    swal('Peringatan',resp.msg,'warning');

                }
            }
        })
    })
    $(document).on('change','#customer',function(){
        if($(this).val() != 'no'){
            $.ajax({
            type:'POST',
            url:'<?= base_url('admin/transaksi/sewa/customer') ?>',
            data:{id:$(this).val()},
            dataType:'json',
            success:function(resp){
                if(resp.status == true){
                    $('#name').val(resp.arr.cus_name);
                    $('#email').val(resp.arr.cus_email);
                    $('#phone').val(resp.arr.cus_phone);

                }else{
                    $('#name').val('');
                    $('#email').val('');
                    $('#phone').val('');
                    swal('Peringatan','Customer tidak ditemukan','warning');

                    
                }
            }
            })
        }else{
            $('#name').val('');
            $('#email').val('');
            $('#phone').val('');
        }   
        
    })
    $(document).on('change','#kabupaten',function(){
    var kab = $(this).val();
    $.ajax({
    
        type:'POST',
        url:'<?= base_url('admin/master/delivery/kecamatan') ?>',
        data:{kab:kab},
        dataType:'json',
        success:function(resp){
          if(resp.status == true){
              $('#kecamatan').html(resp.html);
          }else{
                swal('Peringatan','Tidak ada kecamatan pada kabupaten yang dipilih','warning');

            
          }
        }
    });
  })
</script>