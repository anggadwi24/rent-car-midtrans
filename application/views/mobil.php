    <br>
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
     <!-- Page Header Start -->
    <div class="container-fluid page-header">
        <h1 class="display-3 text-uppercase text-white mb-3">Daftar Mobil</h1>
        <div class="d-inline-flex text-white">
            <h6 class="text-uppercase m-0"><a class="text-white" href="">Beranda</a></h6>
            <h6 class="text-body m-0 px-3">/</h6>
            <h6 class="text-uppercase text-body m-0">Daftar Mobil</h6>
        </div>
    </div>
    <!-- Page Header Start -->
    
    <!-- Rent A Car Start -->
    <div class="container-fluid">
        <div class="container ">
            <h1 class="display-4 text-uppercase text-center mb-5">Pilih Mobil terbaik Anda</h1>
            <p class="text-center"><?= $label ?></p>
            <br>
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
