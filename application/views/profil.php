    <br>

     <!-- Page Header Start -->
    <div class="container-fluid page-header">
        <h1 class="display-3 text-uppercase text-white mb-3">Profil</h1>
        <div class="d-inline-flex text-white">
            <h6 class="text-uppercase m-0"><a class="text-white" href="<?= base_url() ?>">Beranda</a></h6>
            <h6 class="text-body m-0 px-3">/</h6>
            <h6 class="text-uppercase text-body m-0">Profil</h6>
        </div>
    </div>
    <!-- Page Header Start -->
    

    <!-- Detail Start -->
    <div class="container-fluid">
        <div class="container">
            <!-- <h1 class="display-4 text-uppercase mb-5">Mercedes Benz R3</h1> -->
            <div class="row align-items-center pb-2">

                <div class="col-lg-4">
                    <div class="bg-dark d-flex flex-column justify-content-center px-5 mb-4" style="height: 435px;">
                        <img class="img-fluid " src="<?= base_url('upload/user/'.$customer['cus_photo']) ?>" alt="Foto Profil" style="width: 250px;">
                    </div>
                </div>
                <div class="col-lg-8">
                    <div class="contact-form bg-light mb-4" style="padding: 30px;">
                            <h2 class="text-primary"><?= $customer['cus_name'] ?></h2>
                            <hr>
                            <div class="d-flex">
                                <h6 class="mr-2 text-primary">Email :</h6>
                                <p><?= $customer['cus_email'] ?></p>
                            </div>
                            <div class="d-flex">
                                <h6 class="mr-2 text-primary">No Telp :</h6>
                                <p><?= $customer['cus_phone'] ?></p>
                            </div>
                            <div class="d-flex">
                                <h6 class="mr-2 text-primary">Alamat :</h6>
                                <p><?= $customer['cus_address'] ?></p>
                            </div>
                            <div class="d-flex">
                                <h6 class="mr-2 text-primary">Status :</h6>
                                <p>
                                    <?php if ($customer['cus_active']=='y') {
                                    echo "<span class='badge badge-success'>Aktif</span>";
                                  }else{
                                    echo "<span class='badge badge-danger'>Tidak Aktif</span>";
                                  } ?>
                                </p>
                            </div>
                            <div class="d-flex justify-content-end">
                                <a href="<?= base_url('main/edit_profil') ?>" class="btn btn-primary"><i class="fas fa-pencil-alt"></i> Edit Profil</a>
                            </div>
                   </div>
                </div>

            </div>
            <br><br>
            <h4 class="text-center mb-2">Riwayat Pemesanan</h4>
            <div class="row align-items-center pb-2">
                <div class="col-lg-12">
                    <table class="table">
                      <thead class="bg-dark">
                        <tr>
                          <th scope="col">#</th>
                          <th scope="col">Mobil / Paket</th>
                          <th scope="col">Tanggal Sewa</th>
                          <th scope="col">Status</th>
                          <th scope="col"></th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php 
                            $transaksi=$this->model_app->view_where_ordering('cr_transaksi',array('trans_cus_id'=>$customer['cus_id']),'trans_no','DESC');
                            foreach ($transaksi->result_array() as $row){
                            $mobil = $this->model_app->view_where('cr_mobil',array('mobil_id'=>$row['trans_mobil_id']))->row_array();
                            $paket = $this->model_app->view_where('cr_package',array('pack_id'=>$row['trans_pack_id']))->row_array();
                        ?>
                        <tr>
                          <th scope="row"><?= $row['trans_no'] ?></th>
                          <td><?= $mobil['mobil_name'] ." / ". $paket['pack_name']?></td>
                          <td><?= date('d-m-Y', strtotime($row['trans_date_start'])) ?></td>
                          <td><?= ucfirst($row['trans_status']) ?></td>
                          <td>
                              <a href="<?= base_url('transaksi/detail?no='.$row['trans_no']) ?>" class="text-grey"><i class="fas fa-eye"></i></a>
                              &nbsp;
                              <?php if ($row['trans_status']=='waiting') {?>
                              <a href="<?= base_url('transaksi/checkout?no='.$row['trans_no']) ?>" class="btn btn-dark btn-circle btn-sm"><i class="fas fa-wallet"></i></a>
                              <?php } ?>

                          </td>
                        </tr>
                        <?php } ?>
                      </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>
    <!-- Detail End -->
