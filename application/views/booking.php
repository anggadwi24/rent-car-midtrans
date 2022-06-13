<style>
.switch {
  position: relative;
  display: inline-block;
  width: 60px;
  height: 34px;
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
  height: 26px;
  width: 26px;
  left: 4px;
  bottom: 4px;
  background-color: white;
  -webkit-transition: .4s;
  transition: .4s;
}

input:checked + .slider {
  background-color: #aa1801;
}

input:focus + .slider {
  box-shadow: 0 0 1px #aa1801;
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

<br>

 <!-- Page Header Start -->
<div class="container-fluid page-header">
    <h1 class="display-3 text-uppercase text-white mb-3">Booking Mobil</h1>
    <div class="d-inline-flex text-white">
        <h6 class="text-uppercase m-0"><a class="text-white" href="">Beranda</a></h6>
        <h6 class="text-body m-0 px-3">/</h6>
        <h6 class="text-uppercase text-body m-0">Booking Mobil</h6>
    </div>
</div>
<!-- Page Header Start -->


<!-- Contact Start -->
    <div class="container-fluid">
        <div class="container ">
            <h1 class="display-4 text-uppercase text-center mb-5 text-primary">Data Penyewaan</h1>
            <div class="row">
                <div class="col-lg-7 mb-2">
                    <div class="contact-form bg-light mb-4" style="padding: 30px;">
                        <form action="<?= base_url('transaksi/booking_add') ?>" method="post">
                            <h4 class="text-uppercase text-center mb-5 text-primary">Data Customer</h4>
                            <div class="row">
                                <div class="col-md-6 form-group">
                                    <input type="text" class="form-control p-4" name="trans_cus_name" value="<?= $this->session->userdata['login_cus']['cus_name'] ?>" readonly>
                                </div>
                                <div class="col-md-6 form-group">
                                    <input type="email" class="form-control p-4" name="trans_cus_email" value="<?= $this->session->userdata['login_cus']['cus_email'] ?>" readonly>
                                </div>
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control p-4" name="trans_cus_phone" value="<?= $this->session->userdata['login_cus']['cus_phone'] ?>" readonly>
                                <input type="hidden" name="trans_cus_id" value="<?= $this->session->userdata['login_cus']['cus_id'] ?>">
                            </div>
                            <br><hr width="60%">
                            <h4 class="text-uppercase text-center mb-5 text-primary">Data Mobil</h4>
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label>Tanggal Pinjam</label><br>
                                    <input type="date" class="form-control p-4" name="trans_date_start" id="date_start" min="<?= date('Y-m-d') ?>">
                                </div>
                                <div class="form-group col-md-6">
                                    <label>Tanggal Kembali</label>
                                    <input type="date" class="form-control p-4" name="trans_date_end" id="date_end"  min="<?= date('Y-m-d') ?>">
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Jam Ambil/Antar Mobil</label><br>
                                <input type="time" class="form-control p-4" name="trans_time" id="trans_time" value="<?= date('H:i') ?>">
                            </div>
                            <div class="row">
                                <div class="col-md-6 form-group">
                                    <label>Mobil</label>
                                    <select class="custom-select px-4 mb-3 mobil_id" style="height: 50px;" name="trans_mobil_id">
                                        <option disabled selected>Pilih Mobil...</option>
                                        <?php
                                        $mobil2 = $this->model_app->view_where('cr_mobil',array('mobil_available ='=>'y')); 

                                        foreach($mobil2->result_array() as $mbl){
                                            if($seo != '' OR $seo != NULL){
                                            $mobil = $this->model_app->view_where('cr_mobil',array('mobil_seo'=>$seo))->row_array();
                                            if ($mbl['mobil_id'] == $mobil['mobil_id']){$selected = "selected";}else{
                                                $selected = '';
                                            }

                                        }else{
                                            $selected = null;                                        
                                        }
                                        ?>
                                        <option value="<?= $mbl['mobil_id'] ?>" <?= $selected ?>><?= $mbl['mobil_name'] ?> - (<?= $mbl['mobil_transmisi'] ?>)</option>
                                        <?php } ?>
                                    </select>
                                </div>
                                <div class="col-md-6 form-group">
                                    <label>Paket</label>
                                    <select class="custom-select px-4 mb-3 paket_id" style="height: 50px;" id="paket_id" name="trans_pack_id">
                                        <option selected disabled>Pilih Paket..</option>
                                        <?php
                                        $paket = $this->model_app->view_where('cr_package',array('pack_mobil_id'=>$mobil['mobil_id'])); 
                                        foreach($paket->result_array() as $pkt){
                                        ?>
                                        <option value="<?= $pkt['pack_id'] ?>" required><?= $pkt['pack_name'] ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label>Antar/Jemput</label><br>
                                    <label class="switch">
                                      <input type="checkbox" value="y" name="delivery" id="delivery">
                                      <span class="slider round"></span>
                                    </label>
                                </div>
                                <!-- <div class="form-group col-md-6">
                                    <label>Harga Paket</label>
                                    <p id="harga_paket"></p>
                                </div> -->
                            </div>
                            <div class="row" id="tampil_form">
                                
                            </div>
                            <div class="text-right">
                                <button class="btn btn-primary mt-2 py-3 px-5 proses1" type="button">Proses</button>
                            </div>
                    </div>
                </div>
                <div class="col-lg-5 mb-2 formDetail" style="display:none" >
                    <div class="bg-light p-5 mb-5">
                        <h4 class="text-primary mb-4">Detail Order</h4>
                            <div id="tampil_detail">    
                                
                            </div>
                        
                        <button class="btn btn-block btn-primary py-3">Simpan Pesanan</button>
                        </form>    

                    </div>
                    <!-- Banner Start -->
                    <!-- <div class="container-fluid">
                        <div class="container">
                            <div class="bg-banner py-5 px-4 text-center">
                                <div class="py-5" style="height: 320px;">
                                    <h1 class="display-1 text-uppercase text-primary mb-4">50% Disc</h1>
                                    <p class="mb-4">Only for Sunday from 1st Jan to 30th Jan 2045</p>
                                </div>
                            </div>
                        </div>
                    </div> -->
                    <!-- Banner End -->

                </div>
            </div>
        </div>
    </div>
    <!-- Contact End -->