<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Jenis Mobil</h1>
    <?php  if(__thisOwner() == true){?>  <a href="<?= base_url('admin/master/mobil/jenis_mobil_add') ?>" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm" ><i class="fas fa-plus fa-sm text-white-50"></i> Tambah Data</a> <?php }?>
</div>

<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Data Jenis Mobil</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead class="thead-light">
                    <tr>
                        <th>Mobil</th>
                        <th>Merk</th>
                        <th>Trasmisi</th>
                        <th>Bahan Bakar</th>
                        <th>qty</th>
                        <th>Status</th>
                        <th></th>
                    </tr>
                </thead>
                <!-- <tfoot>
                    <tr>
                        <th>Mobil</th>
                        <th>Merk</th>
                        <th>Trasmisi</th>
                        <th>Bahan Bakar</th>
                        <th>Status</th>
                        <th></th>
                    </tr>
                </tfoot> -->
                <tbody>
                    <?php foreach($mobil->result_array() as $mbl){ ?>
                    <tr>
                        <td><?= $mbl['mobil_name'] ?></td>
                        <td>
                            <?php $merk=$this->model_app->view_where('cr_merk',array('merk_id'=>$mbl['mobil_merk']))->row_array(); ?>
                            <?= $merk['merk_name'] ?>
                        </td>
                        <td><?= $mbl['mobil_transmisi'] ?></td>
                        <td><?= $mbl['mobil_fuel'] ?></td>
                        <td><?= $mbl['mobil_qty'] ?></td>
                        <td>
                            <?php if ($mbl['mobil_available']=='y') {
                                echo "Tersedia";
                            }else{
                                echo "Tidak Tersedia";
                            } ?>
                        </td>
                        <td>
                            <?php  if(__thisOwner() == true){?>
                                <a href="<?= base_url('admin/master/mobil/jenis_mobil_edit?seo='.$mbl['mobil_seo']) ?>" class="btn btn-primary btn-circle btn-sm"><i class="fas fa-pencil-alt"></i></a>
                                <a href="<?= base_url('admin/master/mobil/jenis_mobil_hapus?seo='.$mbl['mobil_seo']) ?>" class="btn btn-danger btn-circle btn-sm"><i class="fas fa-trash"></i></a>
                            <?php }?>
                        </td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>