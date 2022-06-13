    <br>

     <!-- Page Header Start -->
    <div class="container-fluid page-header">
        <h1 class="display-3 text-uppercase text-white mb-3">Detail Mobil</h1>
        <div class="d-inline-flex text-white">
            <h6 class="text-uppercase m-0"><a class="text-white" href="">Beranda</a></h6>
            <h6 class="text-body m-0 px-3">/</h6>
            <h6 class="text-uppercase text-body m-0">Detail Mobil</h6>
        </div>
    </div>
    <!-- Page Header Start -->
    
   <!-- Detail Start -->
    <div class="container-fluid">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 mb-5">
                    <h1 class="display-4 text-uppercase mb-5 text-primary"><?= $mobil['mobil_name'] ?></h1>
                    <div class="row mx-n2 mb-3">
                        <?php $gambar = $this->model_app->view_where('cr_mobil_gallery',array('mgal_mobil_id'=>$mobil['mobil_id']));
                        foreach ($gambar->result_array() as $gmbr) {?>
                        <div class="col-md-4 col-6 px-2 pb-2">
                            <img class="img-fluid w-100" src="<?= base_url('upload/mobil/'.$gmbr['mgal_url']) ?>" alt="<?= $gmbr['mgal_filename'] ?>">
                        </div>
                        <?php } ?>
                    </div>
                    <p><?= $mobil['mobil_desc'] ?></p>
                    
               </div>

                <div class="col-lg-4 mb-5">
                    <div class="bg-light p-5">
                        <h3 class="text-primary text-center mb-4">Detail Mobil</h3>
                        <div class="row pt-2">
                            <div class="col-md-6 col-6 mb-2">
                                <i class="fa fa-car text-primary mr-2"></i>
                                <span>
                                    <?php if ($mobil['mobil_available']=='y') {
                                        echo "Tersedia";
                                    }else{
                                        echo "Tidak Tersedia";
                                    } ?>
                                </span>
                            </div>
                            <div class="col-md-6 col-6 mb-2">
                                <i class="fa fa-cogs text-primary mr-2"></i>
                                <span><?= $mobil['mobil_transmisi'] ?></span>
                            </div>
                            <div class="col-md-6 col-6 mb-2">
                                <i class="fa fa-road text-primary mr-2"></i>
                                <span><?= $mobil['mobil_fuel'] ?></span>
                            </div>
                            <div class="col-md-6 col-6 mb-2">
                                <i class="fa fa-circle text-primary mr-2"></i>
                                <span>
                                    <?php $merk = $this->model_app->view_where('cr_merk',array('merk_id'=>$mobil['mobil_merk']))->row_array();
                                    echo $merk['merk_name']; ?>
                                </span>
                            </div>
                        </div>
                        <br>
                        <?php if($mobil['mobil_available'] == 'y'){ ?>
                        <div class="form-group mb-0">
                            <a href="<?= base_url('transaksi/booking?seo='.$mobil['mobil_seo']) ?>" class="btn btn-primary btn-block pb-4" style="height: 50px;">Pesan Sekarang</a>
                        </div>
                        <?php }?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Detail End -->

     <!-- Related Car Start -->
    <div class="container-fluid pb-5">
        <div class="container pb-5">
            <h2 class="mb-4">Related Cars</h2>
            <div class="owl-carousel related-carousel position-relative" style="padding: 0 30px;">

                <?php 
                $data1 = $this->model_app->view('cr_mobil');
                foreach ($data1->result_array() as $mbl) {
                $gd = $this->model_app->view_where('cr_mobil_gallery',array('mgal_mobil_id'=>$mbl['mobil_id'],'mgal_main ='=>'y'))->row_array();
                $mrk = $this->model_app->view_where('cr_merk',array('merk_id'=>$mbl['mobil_merk']))->row_array();?>
                
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
                
                <?php } ?>
            </div>
        </div>
    </div>
    <!-- Related Car End -->
