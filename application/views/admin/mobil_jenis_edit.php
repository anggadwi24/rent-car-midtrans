<?php $link = base_url('admin/master/mobil/jenis_mobil_edit?seo='.$mobil['mobil_seo']); ?>
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Edit Jenis Mobil</h1>
</div>

<div class="row">
  <div class="col-md-5">

    <div class="card shadow mb-4">
      <div class="card-header py-3">
          <h6 class="m-0 font-weight-bold text-primary">Gambar Utama</h6>
      </div>
      <div class="card-body">
          <?php $gheader = $this->model_app->view_where('cr_mobil_gallery',array('mgal_mobil_id'=>$mobil['mobil_id'],'mgal_main ='=>'y'))->row_array() ?>
          <center>
          <img src="<?= base_url('upload/mobil/'.$gheader['mgal_url']) ?>" alt="<?= $gheader['mgal_filename'] ?>" width="40%">
          </center>
          <br>
          <form action="<?= base_url('admin/master/mobil/jenis_mobil_gambar_utama_update') ?>" method="post" enctype="multipart/form-data" accept="image/*">
            <input type="hidden" name="link" value="<?= $link ?>">
            <input type="hidden" name="mgal_id" value="<?= $gheader['mgal_id'] ?>">
            <input type="file" name="file" class="form-control">
            <br>
            <button type="submit" class="btn btn-primary btn-sm kanan">Update Gambar</button>
          </form>
      </div>
    </div>
    
  </div>
  <div class="col-md-7">
    
    <div class="card shadow mb-4">
      <div class="card-header py-3">
          <h6 class="m-0 font-weight-bold text-primary">Form Edit Jenis Mobil</h6>
      </div>
      <div class="card-body">
          <form action="<?= base_url('admin/master/mobil/jenis_mobil_edit_proses') ?>" method="post" enctype="multipart/form-data" accept="image/*">
            <input type="hidden" name="mobil_id" value="<?= $mobil['mobil_id'] ?>">
            <div class="form-row">
              <div class="form-group col-md-6">
                <label>Nama Mobil</label>
                <input type="text" class="form-control" name="mobil_name" value="<?= $mobil['mobil_name'] ?>">
              </div>
              <div class="form-group col-md-6">
                <label>Merk</label>
                <select class="form-control" name="mobil_merk">
                  <option disabled selected>Pilih Merk...</option>
                   <?php foreach($merk->result_array() as $mrk){?>
                  <option value="<?= $mrk['merk_id'] ?>" <?php if ($mobil['mobil_merk'] == $mrk['merk_id']){echo "selected";} ?>><?= $mrk['merk_name'] ?></option>
                  <?php } ?>
                </select>
              </div>
            </div>
            <div class="form-group">
              <label>Deskripsi</label>
              <textarea class="form-control" name="mobil_desc"><?= $mobil['mobil_desc'] ?></textarea>
            </div>
            <div class="form-row">
              <div class="form-group col-md-3">
                <label>Bahan Bakar</label>
                <input type="text" class="form-control" name="mobil_fuel" value="<?= $mobil['mobil_fuel'] ?>">
              </div>
              <div class="form-group col-md-3">
                <label>Transmisi</label>
                <select class="form-control" name="mobil_transmisi">
                    <option <?php if ($mobil['mobil_transmisi'] == 'Manual'){echo "selected";} ?>>Manual</option>
                    <option <?php if ($mobil['mobil_transmisi'] == 'Matic'){echo "selected";} ?>>Matic</option>
                </select>
              </div>
              <div class="form-group col-md-3">
                <label>Status</label>
                <select class="form-control" name="mobil_avaliable">
                    <option value="y" <?php if ($mobil['mobil_available'] == 'y'){echo "selected";} ?>>Tersedia</option>
                    <option value="n" <?php if ($mobil['mobil_available'] == 'n'){echo "selected";} ?>>Tidak Tersedia</option>
                </select>
              </div>
              <div class="form-group col-md-3">
              <label>Qty</label>
              <input type="number" class="form-control" name="mobil_qty" value="<?= $mobil['mobil_qty'] ?>">
            </div>
            </div>
            <button type="submit" class="btn btn-primary kanan">Update</button>
          </form>
      </div>
  </div>

  </div>
</div>


<div class="card shadow mb-4">
      <div class="card-header py-3">
          <h6 class="m-0 font-weight-bold text-primary">Gambar Detail</h6>

          <a href="javascript:void(0);" class="d-sm-inline-block btn btn-sm btn-primary shadow-sm kanan" data-toggle="modal" data-target="#modaltambahgdetail" style="margin-top: -20px;"><i class="fas fa-plus fa-sm text-white-50"></i> Tambah Data</a>

          <!-- Modal -->
          <div class="modal fade" id="modaltambahgdetail" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel">Tambah Gambar Detail</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <form action="<?= base_url('admin/master/mobil/jenis_mobil_gambar_detail_add') ?>" method="post" enctype="multipart/form-data" accept="image/*">
                <div class="modal-body">
                  <div class="form-group">
                      <label>Tambah Gambar</label>
                      <input type="hidden" name="link" value="<?= $link ?>">
                      <input type="hidden" name="mobil_id" value="<?= $mobil['mobil_id'] ?>">
                      <input type="file" class="form-control" required="" multiple="" accept="image/*" name="files[]" required />
                    </div>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                  <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
                </form>
              </div>
            </div>
          </div>

      </div>
      <div class="card-body">
          <div class="row">
          <?php $gdetail = $this->model_app->view_where('cr_mobil_gallery',array('mgal_mobil_id'=>$mobil['mobil_id'],'mgal_main ='=>'n'));
          foreach ($gdetail->result_array() as $gd) {?>
            <div class="card" style="width: 10rem;">
              <img src="<?= base_url('upload/mobil/'.$gd['mgal_url']) ?>" class="card-img-top" alt="<?= $gd['mgal_filename'] ?>">
              <div class="card-body">
                <center>
                  <a href="<?= base_url('admin/master/mobil/jenis_mobil_gambar_detail_hapus?id='.$gd['mgal_id'].'&link='.$link) ?>" class="btn btn-danger btn-circle btn-sm"><i class="fas fa-trash"></i></a>
                </center>
              </div>
            </div>
            &nbsp;
          <?php } ?>
          </div>
      </div>
    </div>

