
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>PT Mas Diani Chandra</title>

    <!-- Custom fonts for this template-->
    <link href="<?= base_url() ?>assets_admin/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="<?= base_url() ?>assets_admin/css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body class="bg-gradient-primary">

    <div class="container">

        <!-- Outer Row -->
        <div class="row justify-content-center">

            <div class="col-xl-10 col-lg-12 col-md-9">

                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            <div class="col-lg-6 d-none d-lg-block ">
                                <img src="<?= base_url('upload/icon/logo.jpg')?>" class="img-fluid" alt="">
                            </div>
                            <div class="col-lg-6">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4">Login !</h1>
                                    </div>
                                    <?php 
                                        if ($this->session->flashdata('salah_login')) {?>
                                            <div class="alert alert-danger">
                                            <?= $this->session->flashdata('salah_login') ?>
                                            </div>
                                            <br>
                                    <?php } ?>
                                    <form class="user" method="post" action="<?= base_url('admin/auth_admin/proseslogin') ?>">
                                        <div class="form-group">
                                            <input type="email" class="form-control form-control-user" placeholder="Masukkan Email" name="email">
                                        </div>
                                        <div class="form-group">
                                            <input type="password" class="form-control form-control-user" placeholder="Masukkan Password" name="password">
                                        </div>
                                        <button class="btn btn-primary btn-user btn-block" type="submit">Login</button>
                                    </form>
                                    <hr>
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>

    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="<?= base_url() ?>assets_admin/vendor/jquery/jquery.min.js"></script>
    <script src="<?= base_url() ?>assets_admin/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="<?= base_url() ?>assets_admin/vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="<?= base_url() ?>assets_admin/js/sb-admin-2.min.js"></script>

</body>

</html>