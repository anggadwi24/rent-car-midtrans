<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Paket</h1>
    <?php  if(__thisOwner() == true){?>
    <a href="javascript:void(0);" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm" data-toggle="modal" data-target="#modaltambahpaket"><i class="fas fa-plus fa-sm text-white-50"></i> Tambah Data</a>

    <!-- Modal -->
    <div class="modal fade" id="modaltambahpaket" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Tambah Paket</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <form action="<?= base_url('admin/master/paket/paket_add') ?>" method="post">
          <div class="modal-body">

                  <div class="form-row">
                    <div class="form-group col-md-6">
                      <label>Nama Paket</label>
                      <input type="text" class="form-control" name="pack_name">
                    </div>
                    <div class="form-group col-md-6">
                      <label>Mobil</label>
                      <select class="form-control" name="pack_mobil_id">
                        <option disabled selected>Pilih Mobil...</option>
                         <?php foreach($mobil->result_array() as $mbl){?>
                        <option value="<?= $mbl['mobil_id'] ?>"><?= $mbl['mobil_name'] ?> - (<?= $mbl['mobil_transmisi'] ?>)</option>
                        <?php } ?>
                      </select>
                    </div>
                  </div>
                  <div class="form-group">
                    <label>Deskripsi</label>
                    <textarea class="form-control" name="pack_desc"></textarea>
                  </div>
                  <div class="form-group">
                    <label>Harga</label>
                      <input type="text" class="form-control" name="pack_price">
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
    <?php }?>
</div>


<div class="card shadow mb-4">
    <!-- Card Header - Dropdown -->
    <div
        class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
        <h6 class="m-0 font-weight-bold text-primary">Data Paket</h6>
    </div>
    <!-- Card Body -->
    <div class="card-body">

        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>Mobil</th>
                        <th>Transmisi</th>
                        <th>Paket</th>
                        <th>Harga</th>
                        <th></th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>Mobil</th>
                        <th>Transmisi</th>
                        <th>Paket</th>
                        <th>Harga</th>
                        <th></th>
                    </tr>
                </tfoot>
                <tbody>
                    <?php foreach($paket->result_array() as $pkt){ 
                    $mobil = $this->model_app->view_where('cr_mobil',array('mobil_id'=>$pkt['pack_mobil_id']))->row_array();
                    ?>
                    <tr>
                        <td><?= $mobil['mobil_name'] ?></td>
                        <td><?= $mobil['mobil_transmisi'] ?></td>
                        <td><?= $pkt['pack_name'] ?></td>
                        <td>Rp<?= number_format($pkt['pack_price'], 0, ",", ".") ?></td>
                        <td>
                          <?php  if(__thisOwner() == true){?>
                          <a href="javascript:void(0);" class="btn btn-primary btn-circle btn-sm" data-toggle="modal" data-target="#modaleditpaket<?= $pkt['pack_id'] ?>"><i class="fas fa-pencil-alt"></i></a>

                          <!-- Modal -->
                            <div class="modal fade" id="modaleditpaket<?= $pkt['pack_id'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                              <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                  <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Tambah Paket</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                      <span aria-hidden="true">&times;</span>
                                    </button>
                                  </div>
                                  <form action="<?= base_url('admin/master/paket/paket_edit') ?>" method="post">
                                    <input type="hidden" name="pack_id" value="<?= $pkt['pack_id'] ?>">
                                  <div class="modal-body">

                                          <div class="form-row">
                                            <div class="form-group col-md-6">
                                              <label>Nama Paket</label>
                                              <input type="text" class="form-control" name="pack_name" value="<?= $pkt['pack_name'] ?>">
                                            </div>
                                            <div class="form-group col-md-6">
                                              <label>Mobil</label>
                                              <select class="form-control" name="pack_mobil_id">
                                                <option disabled selected>Pilih Mobil...</option>
                                                <?php
                                                $mobil2 = $this->model_app->view('cr_mobil'); 
                                                foreach($mobil2->result_array() as $mbl){
                                                ?>
                                                <option value="<?= $mbl['mobil_id'] ?>" <?php if ($mbl['mobil_id'] == $pkt['pack_mobil_id']){echo "selected";} ?>><?= $mbl['mobil_name'] ?> - (<?= $mbl['mobil_transmisi'] ?>)</option>
                                                <?php } ?>
                                              </select>
                                            </div>
                                          </div>
                                          <div class="form-group">
                                            <label>Deskripsi</label>
                                            <textarea class="form-control" name="pack_desc"><?= $pkt['pack_desc'] ?></textarea>
                                          </div>
                                          <div class="form-group">
                                            <label>Harga</label>
                                              <input type="text" class="form-control" name="pack_price" value="<?= $pkt['pack_price'] ?>">
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


                          <a href="<?= base_url('admin/master/paket/paket_hapus?id='.$pkt['pack_id']) ?>" class="btn btn-danger btn-circle btn-sm"><i class="fas fa-trash"></i></a>
                          <?php }?>
                        </td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>

    </div>
</div>