<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Pelanggan</h1>
</div>

<div class="card shadow mb-4">
    <!-- Card Header - Dropdown -->
    <div
        class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
        <h6 class="m-0 font-weight-bold text-primary">Data Pelanggan</h6>
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
                        <th>Telp</th>
                        <th>Alamat</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>#</th>
                        <th>Nama</th>
                        <th>Email</th>
                        <th>Telp</th>
                        <th>Alamat</th>
                        <th>Status</th>
                    </tr>
                </tfoot>
                <tbody>
                    <?php foreach($customer->result_array() as $cs){ 
                            if(file_exists('upload/user/'.$cs['cus_photo'])){
                                $img = base_url('upload/user/').$cs['cus_photo'];
                            }else{
                                $img = base_url('upload/user/not_found.jpg');
                            }
                        ?>
                    <tr>
                        <td><img src="<?= $img ?>" alt="avatar-<?=$cs['cus_name']?>" class="img-fluid rounded-circle" style="width:80px;height:80px;"></td>
                        <td><?= $cs['cus_name'] ?></td>
                        <td><?= $cs['cus_email'] ?></td>
                        <td><?= $cs['cus_phone'] ?></td>
                        <td><?= $cs['cus_address'] ?></td>
                        <td>
                          <?php if ($cs['cus_active']=='y') {
                              echo "Aktif";
                          }else{
                                echo "Tidak Aktif";
                          } ?>
                        </td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>

    </div>
</div>
