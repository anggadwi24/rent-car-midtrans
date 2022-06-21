<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Merk Mobil</h1>
    <?php  if(__thisOwner() == true){?>
    <a href="javascript:void(0);" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm" data-toggle="modal" data-target="#modaltambahmerk"><i class="fas fa-plus fa-sm text-white-50"></i> Tambah Data</a>

    <!-- Modal -->
    <div class="modal fade" id="modaltambahmerk" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Tambah Merk</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <form action="<?= base_url('admin/master/mobil/merk_mobil_add') ?>" method="post">
          <div class="modal-body">
            <div class="form-group">
                <label>Nama Merk</label>
                <input type="text" class="form-control" name="merk_name">
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
        <h6 class="m-0 font-weight-bold text-primary">Data Merk Mobil</h6>
    </div>
    <!-- Card Body -->
    <div class="card-body">

        <table class="table">
          <thead class="thead-light">
            <tr>
              <th scope="col">Merk Mobil</th>
              <th scope="col">#</th>
            </tr>
          </thead>
          <tbody>
            <?php 
            if($merk->num_rows() > 0){
              foreach($merk->result_array() as $mrk){ ?>
            <tr>
              <td><?= $mrk['merk_name'] ?></td>
              <td>
                  <?php  if(__thisOwner() == true){?>
                  <a href="javascript:void(0);" class="btn btn-primary btn-circle btn-sm" data-toggle="modal" data-target="#modaleditmerk<?= $mrk['merk_id'] ?>"><i class="fas fa-pencil-alt"></i></a>

                  <!-- Modal -->
                    <div class="modal fade" id="modaleditmerk<?= $mrk['merk_id'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                      <div class="modal-dialog">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Edit Merk</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                          </div>
                          <form action="<?= base_url('admin/master/mobil/merk_mobil_edit') ?>" method="post">
                            <input type="hidden" name="merk_id" value="<?= $mrk['merk_id'] ?>">
                          <div class="modal-body">
                            <div class="form-group">
                                <label>Nama Merk</label>
                                <input type="text" class="form-control" name="merk_name" value="<?= $mrk['merk_name'] ?>">
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


                  <a href="<?= base_url('admin/master/mobil/merk_mobil_hapus?id='.$mrk['merk_id']) ?>" class="btn btn-danger btn-circle btn-sm"><i class="fas fa-trash"></i></a>
                    <?php }?>
              </td>
            </tr>
            <?php }} ?>
          </tbody>
        </table>

    </div>
</div>