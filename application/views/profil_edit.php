    <br>

     <!-- Page Header Start -->
    <div class="container-fluid page-header">
        <h1 class="display-3 text-uppercase text-white mb-3">Edit Profil</h1>
        <div class="d-inline-flex text-white">
            <h6 class="text-uppercase m-0"><a class="text-white" href="<?= base_url('main/profil') ?>">Profil</a></h6>
            <h6 class="text-body m-0 px-3">/</h6>
            <h6 class="text-uppercase text-body m-0">Edit Profil</h6>
        </div>
    </div>
    <!-- Page Header Start -->
    

     <!-- Contact Start -->
    <div class="container-fluid">
        <div class="container">
            <div class="row">
                <div class="col-lg-5 mb-2">
                    <div class="bg-secondary d-flex flex-column justify-content-center px-5 mb-4" style="height: 435px;">
                        <center>
                            <form action="<?= base_url('main/profil_gambar_update') ?>" method="post" enctype="multipart/form-data" accept="image/*">
                                <input type="hidden" name="cus_id" value="<?= $customer['cus_id'] ?>">
                                <img class="rounded mx-auto d-block" width="200px" src="<?= base_url('upload/user/'.$customer['cus_photo']) ?>" alt="Foto Profil" ><br>
                                <input type="file" name="file" class="form-control"><br>
                                <button type="submit" class="btn btn-primary btn-sm kanan">Update foto</button>
                            </form>
                        </center>
                    </div>
                </div>
                <div class="col-lg-7 mb-2">
                    <div class="contact-form bg-light mb-4" style="padding: 30px;">
                        <form action="<?= base_url('main/profil_update') ?>" method="post">
                            <input type="hidden" name="cus_id" value="<?= $customer['cus_id'] ?>">
                            <div class="row">
                                <div class="col-6 form-group">
                                    <label>Nama</label>
                                    <input type="text" class="form-control p-4" name="cus_name" required="required" value="<?= $customer['cus_name'] ?>">
                                </div>
                                <div class="col-6 form-group">
                                    <label>Email</label>
                                    <input type="email" class="form-control p-4" name="cus_email" required="required" value="<?= $customer['cus_email'] ?>">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-6 form-group">
                                    <label>No Telp</label>
                                    <input type="text" class="form-control p-4" name="cus_phone" value="<?= $customer['cus_phone'] ?>" required="required">
                                </div>
                                <div class="col-6 form-group">
                                    <label>Alamat</label>
                                    <textarea class="form-control p-4" name="cus_address"><?= $customer['cus_address'] ?></textarea>
                                </div>
                            </div>
                            <div>
                                <button type="submit" class="btn btn-primary btn-sm kanan">Update profil</button>
                            </div>
                        </form>
                        <br>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Contact End -->
