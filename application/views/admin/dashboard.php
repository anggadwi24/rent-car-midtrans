<?php 
    if(file_exists('upload/user/'.$row['users_photo'])){
        $img = base_url('upload/user/'.$row['users_photo']);
    }else{
        $img = base_url('upload/user/not_found.jpg');
    }
    $customer = $this->model_app->view_order('cr_customer','cus_name','ASC');
?>

<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
   
</div>
<div class="row my-3">
    <div class="col-lg-4 col-xs-12">
        <div class="card mb-3">
            <div class="card-header text-center">
                <?= $row['users_level'] ?>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-12 mx-auto text-center">
                        <img src="<?= $img ?>" class="img-fluid rounded-circle" style="width: 200px;px;height:200px;" alt="">
                    </div>
                    <div class="col-12 my-3 text-center">
                        <h3><?= $row['users_name'] ?></h3>
                        <h6><?= $row['users_email'] ?></h6>
                    </div>
                </div>
            </div>
            <div class="card-footer text-right">
                <a href="<?= base_url('admin/profile/') ?>" class="btn btn-outline-success "><i class="fas fa-edit"></i></a>
            </div>
        </div>
        <div class="card">
            <div class="card-header">Pelanggan</div>
            <div class="card-body">
                
                    <table class="thisTable table table-bordered" data-ordering="false" data-page-length=5 data-searching=false> 
                        <thead>
                           
                            <th>Nama</th>
                            <th>Tanggal Bergabung</th>
                        </thead>
                        <tbody>
                            <?php 
                                if($customer->num_rows() > 0){
                                    foreach($customer->result_array() as $cus){
                                        echo "<tr>
                                                <td>".$cus['cus_name']."</td>
                                                <td>".date('d/m/Y H:i',strtotime($cus['cus_created_on']))."</td>
                                             </tr>";
                                    }
                                }

                            ?>
                         
                        </tbody>
                    </table>
                
            </div>
            <div class="card-footer text-right">
            
                <a href="<?= base_url('admin/master/user/pelanggan') ?>">Lihat selengkapnya</a>
            
            </div>
        </div>
    </div>
    <div class="col-lg-8 col-xs-12">
        <div class="card mb-3">
            <div class="card-header">Data Mobil</div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0" data-ordering="false" data-page-length=5>
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Mobil</th>
                        
                                <th>Status</th>
                              
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no = 1; ?>
                            <?php 
                            $mobil = $this->model_app->view_order('cr_mobil','mobil_name','ASC');
                            if($mobil->num_rows() > 0){
                                foreach ($mobil->result_array() as $m) { 
                                        if($m['mobil_available'] == 'y'){
                                            $status = '<span class="badge badge-success">Tersedia</span>';
                                        }else{
                                            $status = '<span class="badge badge-danger">Tidak Tersedia</span>';
                                        }
                                    ?>
                                <tr class='__okClick' href='<?= base_url('admin/master/mobil/jenis_mobil_edit?seo='.$m['mobil_seo']) ?>'>
                                    <td><?= $no++ ?></td>
                                    <td><?= $m['mobil_name'] ?></td>
                                   
                                    <td><?= $status ?></td>
                                    
                                </tr>
                            <?php } } ?>
                        </tbody>
                    </table>
                </div>
                <div class="card-footer text-right">
                    <a href="<?= base_url('admin/master/mobil/jenis_mobil') ?>">Lihat selengkapnya</a>
                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-header">Transaksi</div>
            <div class="card-body">
                <div class="table-responsive">
                <table class="table table-bordered thisTable" data-ordering="false" data-page-length=5>
                        <thead>
                            <tr>
                            <th>No</th>
                            <th scope="col">Penyewa</th>
                            <th>Tanggal</th>
                            <th scope="col">Mobil</th>
                        
                            <th>Status</th>
                            <th>Return</th>
                           
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                // $record = $this->model_app->view_order('cr_transaksi','trans_no','DESC'); 
                                $record = $this->db->query("SELECT * FROM cr_transaksi a JOIN cr_mobil b ON a.trans_mobil_id = b.mobil_id JOIN cr_package c ON c.pack_id = a.trans_pack_id ORDER BY trans_no DESC");
                                if($record->num_rows() > 0){
                                foreach($record->result_array() as $rows){
                                    // $mobil = $this->model_app->view_where('cr_mobil',array('mobil_id'=>$rows['trans_mobil_id']))->row_array();
                                    // $pack = $this->model_app->view_where('cr_package',array('pack_id'=>$rows['trans_pack_id']))->row_array();
                                    if($rows['trans_return'] == 'y'){
                                        $return = '<small>Mobil Kembali</small>';
                                    }else{
                                        $return  = '<small>Mobil Belum Kembali</small>';
                                    }
                                
                                    echo "<tr class='__okClick' href='".base_url('admin/transaksi/sewa/detail?no='.$rows['trans_no']) ."'>
                                        <td>".$rows['trans_no']."</td>
                                        <td>".$rows['trans_cus_name']."</td>
                                        <td>".date('d/m/Y',strtotime($rows['trans_date_start']))." - ".date('d/m/Y',strtotime($rows['trans_date_end']))."</td>
                                        <td>".$rows['mobil_name']." <small class='d-block'>".$rows['pack_name']."</small></td>
                                        <td>".ucfirst($rows['trans_status'])."</td>
                                        <td>".$return."</td>
                                      

                                    </tr>";
                                }
                                
                            }
                                ?>
                        </tbody>
                </table>
                </div>
            </div>
            <div class="card-footer text-right">
                <a href="<?= base_url('admin/transaksi/sewa') ?>">Lihat selengkapnya</a>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).on('click','.__okClick',function(e){
        e.preventDefault();
        var url = $(this).attr('href');
        window.location = url;
    });
</script>