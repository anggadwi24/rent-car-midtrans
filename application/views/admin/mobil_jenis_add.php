<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Tambah Jenis Mobil</h1>
   
</div>

<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Form Tambah Jenis Mobil</h6>
    </div>
    <div class="card-body">
        <form action="<?= base_url('admin/master/mobil/jenis_mobil_add_proses') ?>" method="post" enctype="multipart/form-data" accept="image/*">
          <div class="form-row">
            <div class="form-group col-md-6">
              <label>Nama Mobil</label>
              <input type="text" class="form-control" name="mobil_name">
            </div>
            <div class="form-group col-md-6">
              <label>Merk</label>
              <select class="form-control" name="mobil_merk">
                <option disabled selected>Pilih Merk...</option>
                 <?php foreach($merk->result_array() as $mrk){?>
                <option value="<?= $mrk['merk_id'] ?>"><?= $mrk['merk_name'] ?></option>
                <?php } ?>
              </select>
            </div>
          </div>
          <div class="form-group">
            <label>Deskripsi</label>
            <textarea class="form-control" name="mobil_desc"></textarea>
          </div>
          <div class="form-row">
            <div class="form-group col-md-4">
              <label>Bahan Bakar</label>
              <input type="text" class="form-control" name="mobil_fuel">
            </div>
            <div class="form-group col-md-4">
              <label>Transmisi</label>
              <select class="form-control" name="mobil_transmisi">
                  <option>Manual</option>
                  <option>Matic</option>
              </select>
            </div>
            <div class="form-group col-md-4">
              <label>Status</label>
              <select class="form-control" name="mobil_avaliable">
                  <option value="y">Tersedia</option>
                  <option value="n">Tidak Tersedia</option>
              </select>
            </div>
          </div>
          <div class="form-row">
            <div class="form-group col-md-6">
              <label>Gambar Utama</label>
              <input type="file" class="form-control" required="" name="file"  accept="image/*"/>
            </div>
            <div class="form-group col-md-6">
              <label>Gambar Detail</label>
              <input type="file" class="form-control" required="" multiple="" accept="image/*" name="files[]" />
            </div>
          </div>
          <button type="submit" class="btn btn-primary kanan">Simpan</button>
        </form>
    </div>
</div>