<!-- Search Start -->
    <div class="container-fluid bg-white pt-3 px-lg-5">
        <div class="row mx-n2">
            <div class="col-xl-9 col-lg-9 col-md-6 px-2">
                <div class="date mb-3" id="date" data-target-input="nearest">
                    <form action="<?= base_url('mobil') ?>" method="get">
                    <input type="text" class="form-control p-4 " placeholder="Cari Mobil" value="<?= @$_GET['cari_mobil'] ?>" name="cari_mobil"/>
                </div>
            </div>
            <div class="col-xl-3 col-lg-3 col-md-6 px-2">
                <button class="btn btn-primary btn-block mb-3" type="submit" style="height: 50px;">Cari</button>
                </form>
            </div>
        </div>
    </div>
    <!-- Search End -->


    <!-- Carousel Start -->
    <div class="container-fluid p-0" style="margin-bottom: 90px;">
        <div id="header-carousel" class="carousel slide" data-ride="carousel">
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img class="w-100" src="<?= base_url() ?>assets/img/karosel-1.jpg" alt="Image">
                    <div class="carousel-caption d-flex flex-column align-items-end justify-content-center">
                        <div class="p-3 text-left d-none d-sm-inline-block" style="max-width: 700px;">
                            <h4 class=" text-white text-uppercase mb-md-3">PT.Mas Diani Chandra Trans</h4>
                            <h1 class=" display-4 text-white mb-md-4">MAKE YOUR JOURNEY EASIER AND COMFORTABLE <br> WITH US !</h1>
                            <a href="<?= base_url('mobil') ?>" class="btn btn-primary py-md-3 px-md-5 mt-2">Pesan Sekarang</a>
                        </div>
                        <div class="p-3 text-center d-lg-none" style="max-width: 700px;">
                            <h4 class=" text-white text-uppercase mb-md-3">PT.Mas Diani Chandra Trans</h4>
                            <h1 class=" display-4 text-white mb-md-4">MAKE YOUR JOURNEY EASIER AND COMFORTABLE <br> WITH US !</h1>
                            <a href="<?= base_url('mobil') ?>" class="btn btn-primary py-md-3 px-md-5 mt-2">Pesan Sekarang</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Carousel End -->


    <!-- About Start -->
    <div class="container-fluid">
        <div class="container">
            <h1 class="display-4 text-uppercase text-center mb-5" style="color: #9c9c9c;">Selamat Datang di <br><span class="text-primary">PT.Mas Diani Chandra Trans</span></h1>
            <div class="row justify-content-center">
                <div class="col-lg-10 text-center">
                    <img class="w-75 mb-4" src="img/about.png" alt="">
                    <p><strong>PT. Mas Diani Chandra Trans</strong> (Car Rental & Tour Service) merupakan perusahaan yang bergerak di bidang jasa rental mobil yang berada di Bali. <strong>PT. Mas Diani Chandra Trans</strong> memiliki prinsip memberikan pelayanan yang terbaik untuk kenyaman klien serta menjadi perusahaan transportasi yang menyediakan jasa penyewaan mobil yang dapat diandalkan.</p>
                </div>
            </div>
            <div class="row mt-3">
                <div class="col-lg-4 mb-2">
                    <div class="d-flex align-items-center bg-light p-4 mb-4" style="height: 150px;">
                        <div class="d-flex align-items-center justify-content-center flex-shrink-0 bg-primary ml-n4 mr-4" style="width: 100px; height: 100px;">
                            <i class="fa fa-2x fa-headset text-secondary"></i>
                        </div>
                        <h4 class="text-primary text-uppercase m-0">24/7 Siap Untuk Melayani</h4>
                    </div>
                </div>
                <div class="col-lg-4 mb-2">
                    <div class="d-flex align-items-center bg-dark p-4 mb-4" style="height: 150px;">
                        <div class="d-flex align-items-center justify-content-center flex-shrink-0 bg-primary ml-n4 mr-4" style="width: 100px; height: 100px;">
                            <i class="fa fa-2x fa-car text-secondary"></i>
                        </div>
                        <h4 class="text-secondary text-uppercase m-0">Pesan Mobil Kapan Saja</h4>
                    </div>
                </div>
                <div class="col-lg-4 mb-2">
                    <div class="d-flex align-items-center bg-light p-4 mb-4" style="height: 150px;">
                        <div class="d-flex align-items-center justify-content-center flex-shrink-0 bg-primary ml-n4 mr-4" style="width: 100px; height: 100px;">
                            <i class="fa fa-2x fa-map-marker-alt text-secondary"></i>
                        </div>
                        <h4 class="text-primary text-uppercase m-0">Banyak Tersedia Lokasi Penjemputan</h4>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- About End -->
    
    <!-- Rent A Car Start -->
    <div class="container-fluid py-5">
        <div class="container pt-5 pb-3">
            <h1 class="display-4 text-uppercase text-center mb-5">Pilih Mobil</h1>
            <div class="row">

                <?php foreach ($mobil->result_array() as $mbl) {
                $gd = $this->model_app->view_where('cr_mobil_gallery',array('mgal_mobil_id'=>$mbl['mobil_id'],'mgal_main ='=>'y'))->row_array();
                $mrk = $this->model_app->view_where('cr_merk',array('merk_id'=>$mbl['mobil_merk']))->row_array();?>
                <div class="col-lg-4 col-md-6 mb-2">
                    <div class="rent-item mb-4">
                        <img class="img-fluid mb-4" src="<?= base_url('upload/mobil/'.$gd['mgal_url']) ?>" alt="<?= $gd['mgal_filename'] ?>" width="100%">
                        <h4 class="text-uppercase mb-4 text-primary"><?= $mbl['mobil_name'] ?></h4>
                        <div class="d-flex justify-content-center mb-4">
                            <div class="px-2">
                                <i class="fa fa-car text-primary mr-1"></i>
                                <span>
                                    <?php if ($mbl['mobil_available']=='y') {
                                        echo "Tersedia";
                                    }else{
                                        echo "Tidak Tersedia";
                                    } ?>
                                </span>
                            </div>
                            <div class="px-2 border-left border-right">
                                <i class="fa fa-cogs text-primary mr-1"></i>
                                <span><?= $mbl['mobil_transmisi'] ?></span>
                            </div>
                            <div class="px-2">
                                <i class="fa fa-road text-primary mr-1"></i>
                                <span><?= $mbl['mobil_fuel'] ?></span>
                            </div>
                        </div>
                        <?php 
                            if($mbl['mobil_available'] == 'y'){
                        ?>
                        <a class="btn btn-primary px-3" href="<?= base_url('mobil/detail_mobil?seo='.$mbl['mobil_seo']) ?>">Pesan Sekarang</a>

                        <?php
                            }else{
                        ?>
                         <a class="btn btn-primary px-3" href="<?= base_url('mobil/detail_mobil?seo='.$mbl['mobil_seo']) ?>">Detail</a>

                        <?php
                            }
                        ?>
                    </div>
                </div>
                <?php } ?>
                
            </div>
        </div>
    </div>
    <!-- Rent A Car End -->

   <!-- Banner Start -->
    <div class="container-fluid py-5">
        <div class="container py-5">
            <div class="row mx-0">
                <div class="col-lg-12 px-0">
                    <div class="px-5 bg-dark d-flex align-items-center justify-content-between" style="height: 350px;">
                        <div class="text-left">
                            <h3 class="text-uppercase text-light mb-3">Mencari Mobil Untuk di Sewa?</h3>
                            <p class="mb-4">Layanan Jasa sewa mobil Diani Chandra Trans buka 24 jam, memudahkan Anda untuk booking kami dimanapun dan kapanpun. Kami selalu on time.</p>
                            <a class="btn btn-primary py-2 px-4" href="<?= base_url('mobil') ?>">Pesan Sekarang</a>
                        </div>
                        <img class="img-fluid flex-shrink-0 mr-n5 w-50 ml-4" src="<?= base_url('assets/img/swift3.png') ?>" alt="" style="width: 60px;">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Banner End -->