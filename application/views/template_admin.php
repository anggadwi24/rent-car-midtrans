<!DOCTYPE html>
<html lang="en">
<?php if(isset($title)){

    $title = $title;
}else{
    $title = 'PT Mas Diani Chandra';
}
    ?>
<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Administrator PT. Mas Diani Chandra Trans (Car Rental & Tour Service)">
    <meta name="keywords" content="PT. Mas Diani Chandra Trans (Car Rental & Tour Service)">
    <meta name="author" content="Themesbox">

    <title><?= $title ?></title>
    <link rel="icon" type="image/x-icon" href="<?= base_url('upload/icon/') ?>favicon.ico">
    <!-- Custom fonts for this template-->
    <link href="<?= base_url() ?>assets_admin/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="<?= base_url() ?>assets_admin/css/sb-admin-2.min.css" rel="stylesheet">

    <!-- Custom styles for this page -->
    <link href="<?= base_url() ?>assets_admin/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
    <style type="text/css">
        .kanan{
            float: right;
        }
    </style>
    <script src="<?= base_url() ?>assets_admin/vendor/jquery/jquery.min.js"></script>
    <script src="<?= base_url() ?>assets_admin/vendor/sweetalert/js/sweetalert.min.js"></script>

    <script src="https://ajax.aspnetcdn.com/ajax/jquery.validate/1.11.1/jquery.validate.min.js"></script>
</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center my-2" href="index.html">
                <div class="sidebar-brand-icon ">
                    <img src="<?= base_url('upload/icon/logo.png') ?>" class="img-fluid " alt="" style="width:80px;height:auto;">
                </div>
                <div class="sidebar-brand-text mx-3" style="font-size:12px;">PT Mas Diani Chandra</div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item ">
                <a class="nav-link" href="<?= base_url('admin/main_admin')?>">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Dashboard</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                Master Data
            </div>

            <!-- Nav Item - Pages Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo"
                    aria-expanded="true" aria-controls="collapseTwo">
                    <i class="fas fa-fw fa-cog"></i>
                    <span>Mobil</span>
                </a>
                <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <a class="collapse-item" href="<?= base_url('admin/master/mobil/merk_mobil') ?>">Merk Mobil</a>
                        <a class="collapse-item" href="<?= base_url('admin/master/mobil/jenis_mobil') ?>">Jenis Mobil</a>
                    </div>
                </div>
            </li>

            <!-- Nav Item - Charts -->
            <li class="nav-item">
                <a class="nav-link" href="<?= base_url('admin/master/paket') ?>">
                    <i class="fas fa-fw fa-chart-area"></i>
                    <span>Paket</span></a>
            </li>

            <!-- Nav Item - Charts -->
            <li class="nav-item">
                <a class="nav-link" href="<?= base_url('admin/master/delivery') ?>">
                    <i class="fas fa-fw fa-chart-area"></i>
                    <span>Antar/Jemput</span></a>
            </li>

            <!-- Nav Item - Charts -->
            <li class="nav-item">
                <a class="nav-link" href="<?= base_url('admin/master/user/staff') ?>">
                    <i class="fas fa-fw fa-user"></i>
                    <span>Staff</span></a>
            </li>

            <!-- Nav Item - Charts -->
            <li class="nav-item">
                <a class="nav-link" href="<?= base_url('admin/master/user/pelanggan') ?>">
                    <i class="fas fa-fw fa-user"></i>
                    <span>Pelanggan</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                Transaksi
            </div>

            <!-- Nav Item - Pages Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages"
                    aria-expanded="true" aria-controls="collapsePages">
                    <i class="fas fa-fw fa-folder"></i>
                    <span>Sewa</span>
                </a>
                <div id="collapsePages" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <a class="collapse-item" href="<?= base_url('admin/transaksi/ketersediaan') ?>">Ketersediaan Mobil</a>
                        <a class="collapse-item" href="<?= base_url('admin/transaksi/sewa') ?>">Penyewaan</a>
                        <a class="collapse-item" href="<?= base_url('admin/transaksi/pembayaran') ?>">Pembayaran</a>
                    </div>
                </div>
            </li>

            <!-- Nav Item - Charts -->
            <li class="nav-item">
                <a class="nav-link" href="<?= base_url('admin/laporan') ?>">
                    <i class="fas fa-fw fa-chart-area"></i>
                    <span>Laporan</span></a>
            </li>

           
        </ul>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>

                    <!-- Topbar Search -->
                   

                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">

                        <!-- Nav Item - Search Dropdown (Visible Only XS) -->
                       

                        <div class="topbar-divider d-none d-sm-block"></div>

                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small"><?= $this->session->userdata['login_admin']['users_name'] ?></span>
                                <?php $usr = $this->model_app->view_where('users',array('users_id'=>$this->session->userdata['login_admin']['users_id']))->row_array(); 
                                    if(file_exists('upload/user/'.$usr['users_photo'])){
                                        $photo = $usr['users_photo'];
                                    }else{
                                        $photo = 'blank.png';
                                    }
                                ?>
                                <img class="img-profile rounded-circle" src="<?= base_url('upload/user/'.$photo) ?>">
                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="userDropdown">
                                <a class="dropdown-item" href="<?= base_url('admin/profile') ?>">
                                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Profile
                                </a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Logout
                                </a>
                            </div>
                        </li>

                    </ul>

                </nav>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">



            <?= $contents ?>


            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; PT Mas Diani Chandra <?= date('Y') ?></span>
                    </div>
                </div>
            </footer>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Apakah anda akan logout?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Pilih Logout jika anda yakin</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-primary" href="<?= base_url('admin/auth_admin/logout') ?>">Logout</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap core JavaScript-->
    <?php if($this->session->flashdata('error')){
        echo "<script>
            swal({
            title:'Gagal',
            text:'".$this->session->flashdata('error')."',
            icon:'error'
            })</script>";
    } ?>
    <?php if($this->session->flashdata('success')){
        echo "<script>
            swal({
            title:'Berhasil',
            text:'".$this->session->flashdata('success')."',
            icon:'success'
            })</script>";
    } ?>
    <script src="<?= base_url() ?>assets_admin/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="<?= base_url() ?>assets_admin/vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="<?= base_url() ?>assets_admin/js/sb-admin-2.min.js"></script>

    <!-- Page level plugins -->
    <script src="<?= base_url() ?>assets_admin/vendor/chart.js/Chart.min.js"></script>
    <script src="<?= base_url() ?>assets_admin/vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="<?= base_url() ?>assets_admin/vendor/datatables/dataTables.bootstrap4.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="<?= base_url() ?>assets_admin/js/demo/chart-area-demo.js"></script>
    <script src="<?= base_url() ?>assets_admin/js/demo/chart-pie-demo.js"></script>

    <!-- Page level custom scripts -->
    <script src="<?= base_url() ?>assets_admin/js/demo/datatables-demo.js"></script>
    <script>
        $(document).ready( function () {
        $('.thisTable').DataTable();
    } );
</script>
</body>

</html>