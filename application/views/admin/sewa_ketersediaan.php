<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Ketersediaan Mobil</h1>
</div>

<div class="card shadow mb-4">
    <!-- Card Header - Dropdown -->
    <div
        class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
        <h6 class="m-0 font-weight-bold text-primary">Data Ketersediaan Mobil</h6>
    </div>
    <!-- Card Body -->
    <div class="card-body">
      <div class="row">
          <?php 
          foreach ($mobil->result_array() as $mbl) {
          $gd = $this->model_app->view_where('cr_mobil_gallery',array('mgal_mobil_id'=>$mbl['mobil_id'],'mgal_main ='=>'y'))->row_array();
          $mrk = $this->model_app->view_where('cr_merk',array('merk_id'=>$mbl['mobil_merk']))->row_array();
          ?>
            <div class="card" style="width: 15rem;">
              <img src="<?= base_url('upload/mobil/'.$gd['mgal_url']) ?>" class="card-img-top" alt="<?= $gd['mgal_filename'] ?>">
              <div class="card-body">
               <hr>
                <center>
                  <p><?= $mrk['merk_name']  ?> | <i class="fas fa-gear"> </i> <?= $mbl['mobil_transmisi'] ?></p>
                  <span class="badge badge-success">Tersedia</span>
                </center>
              </div>
            </div>
            &nbsp;&nbsp;
          <?php } ?>
      </div>

    </div>
</div>