<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Staff</h1>
    <?php  if(__thisOwner() == true){?>
    <a href="javascript:void(0);" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm" data-toggle="modal" data-target="#modaltambahstaff"><i class="fas fa-plus fa-sm text-white-50"></i> Tambah Data</a>

    <!-- Modal -->
    <div class="modal fade" id="modaltambahstaff" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Tambah Staff</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <form action="<?= base_url('admin/master/user/staff_add') ?>" method="post" enctype="multipart/form-data">
          <div class="modal-body">

                  <div class="form-row">
                    <div class="form-group col-md-6">
                      <label>Nama</label>
                      <input type="text" class="form-control" name="users_name">
                    </div>
                    <div class="form-group col-md-6">
                      <label>Email</label>
                      <input type="email" class="form-control" name="users_email">
                    </div>
                    <div class="form-group col-md-6">
                      <label>Password</label>
                      <input type="password" class="form-control" name="users_password">
                    </div>
                    <div class="form-group col-md-6">
                      <label>Level</label>
                      <select class="form-control" name="users_level">
                        <option>Admin</option>
                        <option>Owner</option>
                      </select>
                    </div>
                  </div>
                  <div class="form-group">
                    <label>Foto Profile</label>
                      <input type="file" class="form-control" name="file" accept="image/*">
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
        <h6 class="m-0 font-weight-bold text-primary">Data Staff</h6>
    </div>
    <!-- Card Body -->
    <div class="card-body">

        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Nama</th>
                        <th>Email</th>
                        <th>Level</th>
                        <th>Status</th>
                        <th></th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>#</th>
                        <th>Nama</th>
                        <th>Email</th>
                        <th>Level</th>
                        <th>Status</th>
                        <th></th>
                    </tr>
                </tfoot>
                <tbody>
                    <?php foreach($users->result_array() as $us){?>
                    <tr>
                        <td><img src="<?= base_url('upload/user/'.$us['users_photo']) ?>" alt="" width="50"></td>
                        <td><?= $us['users_name'] ?></td>
                        <td><?= $us['users_email'] ?></td>
                        <td><?= $us['users_level'] ?></td>
                        <td>
                          <?php if ($us['users_active']=='y') {
                            echo "<span class='badge badge-info'>Aktif</span>";
                          }else{
                            echo "<span class='badge badge-danger'>Tidak Aktif</span>";
                          } ?>
                        </td>
                        <td>
                        <?php  if(__thisOwner() == true){?>
                          <a href="javascript:void(0);" class="btn btn-primary btn-circle btn-sm" data-toggle="modal" data-target="#modaleditstaff<?=$us['users_id'] ?>"><i class="fas fa-pencil-alt"></i></a>

                          <!-- Modal -->
                          <div class="modal fade" id="modaleditstaff<?=$us['users_id'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-lg">
                              <div class="modal-content">
                                <div class="modal-header">
                                  <h5 class="modal-title" id="exampleModalLabel">Tambah Staff</h5>
                                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                  </button>
                                </div>
                                <form action="<?= base_url('admin/master/user/staff_update') ?>" method="post" enctype="multipart/form-data">
                                  <input type="hidden" name="users_id" value="<?=$us['users_id'] ?>">
                                <div class="modal-body">

                                        <div class="form-row">
                                          <div class="form-group col-md-6">
                                            <label>Nama</label>
                                            <input type="text" class="form-control" name="users_name" value="<?=$us['users_name'] ?>">
                                          </div>
                                          <div class="form-group col-md-6">
                                            <label>Email</label>
                                            <input type="email" class="form-control" name="users_email" value="<?=$us['users_email'] ?>">
                                          </div>
                                          <div class="form-group col-md-6">
                                            <label>Status</label>
                                            <select class="form-control" name="users_active">
                                              <option value="y" <?php if ($us['users_active'] == 'y'){echo "selected";} ?>>Aktif</option>
                                              <option value="n" <?php if ($us['users_active'] == 'n'){echo "selected";} ?>>Tidak Aktif</option>
                                            </select>
                                          </div>
                                          <div class="form-group col-md-6">
                                            <label>Level</label>
                                            <select class="form-control" name="users_level">
                                              <option <?php if ($us['users_level'] == 'Admin'){echo "selected";} ?>>Admin</option>
                                              <option <?php if ($us['users_level'] == 'Owner'){echo "selected";} ?>>Owner</option>
                                            </select>
                                          </div>
                                          <div class="form-group col-md-12">
                                            <label>Foto Profile</label>
                                              <input type="file" class="form-control" name="file" accept="image/*">
                                          </div>
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


                          <a href="<?= base_url('admin/master/user/staff_hapus?id='.$us['users_id']) ?>" class="btn btn-danger btn-circle btn-sm"><i class="fas fa-trash"></i></a>
                        <?php }?>
                        </td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>

    </div>
</div>