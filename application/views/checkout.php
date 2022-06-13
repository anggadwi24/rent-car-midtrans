    <?php error_reporting(0); ?>
    <br>

     <!-- Page Header Start -->
    <div class="container-fluid page-header">
        <h1 class="display-3 text-uppercase text-white mb-3">Checkout</h1>
        <div class="d-inline-flex text-white">
            <h6 class="text-uppercase text-body m-0">Checkout</h6>
        </div>
    </div>
    <!-- Page Header Start -->
    <?php 
        $mobil = $this->model_app->view_where('cr_mobil',array('mobil_id'=>$checkout['trans_mobil_id']))->row_array();
        $paket = $this->model_app->view_where('cr_package',array('pack_id'=>$checkout['trans_pack_id']))->row_array();
    ?>

     <!-- Contact Start -->
    <div class="container-fluid">
        <div class="container">
            <!-- <h1 class="display-4 text-uppercase text-center mb-5">Contact Us</h1> -->
            <div class="row">
                <div class="col-lg-7 mb-2">
                    <h3 class="text-primary">No Transaksi : <?= $checkout['trans_no'] ?></h3>
                    <div class="contact-form bg-light mb-4" style="padding: 30px;">
                        <h5 class="text-primary">Detail Penyewa</h5>
                        <hr>
                        <p>Nama : <span class="kanan"><?= $checkout['trans_cus_name'] ?> ( <?= $checkout['trans_cus_phone'] ?> )</span></p>
                        <p>Email : <span class="kanan"><?= $checkout['trans_cus_email'] ?></span></p>

                        <br>
                        <h5 class="text-primary">Detail Mobil</h5>
                        <hr>
                        <p>Mobil : <span class="kanan"><?= $mobil['mobil_name'] ?> - <?= $mobil['mobil_transmisi'] ?> </span></p>
                        <p>Paket : <span class="kanan"><?= $paket['pack_name'] ?></span></p>
                        <p>Tgl Mulai Sewa : <span class="kanan"><?= date('d-m-Y', strtotime($checkout['trans_date_start'])) ?></span></p>
                        <p>Tgl Selesai Sewa : <span class="kanan"><?= date('d-m-Y', strtotime($checkout['trans_date_end'])) ?></span></p>
                        <p>Durasi Sewa : <span class="kanan"><?= daysDifference($checkout['trans_date_start'],$checkout['trans_date_end']) ?> Hari</span></p>
                        <p>Jam Ambil : <span class="kanan"><?= date('H:i',strtotime($checkout['trans_time'])) ?> WITA</span></p>

                        <?php if ($checkout['trans_sp_id']==null) {?>
                            <p>Delivery : <span class="kanan">Tidak Ada</span></p>
                        <?php 
                            }else{ 
                            $sp = $this->db->query('SELECT * FROM cr_shuttle_price INNER JOIN cr_kabupaten on cr_shuttle_price.sp_kab_id = cr_kabupaten.kab_id WHERE cr_shuttle_price.sp_id ='. $checkout['trans_sp_id'])->row_array();
                        ?>
                            <p>Delivery : <span class="kanan">Ada</span></p>
                            <p>Lokasi Antar/Jemput : <span class="kanan"><?= $sp['kab_name'] ?></span></p>
                            <p>Alamat : <span class="kanan"><?= $checkout['trans_address'] ?></span></p>
                        <?php } ?>

                        
                    </div>
                </div>
                <div class="col-lg-5 mb-2">
                    
                        <h3 class="text-white">-</h3>
                        <div class="bg-light p-5 mb-5">
                        <!-- <h4 class="text-primary mb-4">Detail Order</h4> -->
                        <p>Status Pembayaran : <span class="kanan"><?= ucfirst($checkout['trans_status']) ?></span></p>
                        <p>Harga Sewa : <span class="kanan"><?= rp($paket['pack_price']) ?></span></p>
                        <p>Durasi : <span class="kanan"><?=daysDifference($checkout['trans_date_start'],$checkout['trans_date_end']) ?> Hari</span></p>

                        <?php if ($checkout['trans_sp_id']==null){}else{ ?>
                        <p>Harga Delivery : <span class="kanan"><?= rp($sp['sp_price']) ?></span></p>
                        <?php } ?>
                        <hr>
                        <h4 class="text-primary">Total : <span class="kanan"><?= rp($checkout['trans_total']) ?></span></h4>
                        <br><br>
                        <form id="formAct">
                        <input type="hidden" name="no" value="<?= $checkout['trans_no'] ?>">
                        <button class="btn btn-block btn-primary py-3" id="btnPayment">Bayar</button>
                        </form>

                    </div>

                </div>
            </div>
        </div>
    </div>
    <!-- Contact End -->