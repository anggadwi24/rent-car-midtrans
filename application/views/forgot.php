<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>PT Mas Dhiani Chandra </title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta name="description" content="PT. Mas Diani Chandra Trans (Car Rental & Tour Service) merupakan perusahaan yang bergerak di bidang jasa rental mobil yang berada di Bali. PT. Mas Diani Chandra Trans memiliki prinsip memberikan pelayanan yang terbaik untuk kenyaman klien serta menjadi perusahaan transportasi yang menyediakan jasa penyewaan mobil yang dapat diandalkan.">
    <meta name="keywords" content="PT. Mas Diani Chandra Trans (Car Rental & Tour Service)">
    <meta name="author" content="Themesbox">

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="<?= base_url('upload/icon/') ?>favicon.ico">


    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Oswald:wght@400;500;600;700&family=Rubik&display=swap" rel="stylesheet"> 

    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.0/css/all.min.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="<?= base_url() ?>assets/lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
    <link href="<?= base_url() ?>assets/lib/tempusdominus/css/tempusdominus-bootstrap-4.min.css" rel="stylesheet" />

    <!-- Customized Bootstrap Stylesheet -->
    <link href="<?= base_url() ?>assets/css/bootstrap.min.css" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="<?= base_url() ?>assets/css/style.css" rel="stylesheet">

    <style type="text/css">
        .kanan{
            float: right;
        }
    </style>
</head>

<body>
    <!-- Topbar Start -->
    <div class="container-fluid bg-dark py-3 px-lg-5 d-none d-lg-block">
       
    </div>
    <!-- Topbar End -->

    <!-- Contact Start -->
    <div class="container-fluid ">
        <div class="container pt-5">
            <h1 class="display-4 text-uppercase text-center mb-5 text-primary">Lupa Password</h1>
            <center>
           
            <?php 
                if ($this->session->flashdata('error')) {?>
                    <div class="alert alert-danger">
                    <?= $this->session->flashdata('error') ?>
                    </div>
                    <br>
            <?php } ?>
            <?php 
                if ($this->session->flashdata('success')) {?>
                    <div class="alert alert-success">
                    <?= $this->session->flashdata('success') ?>
                    </div>
                    <br>
            <?php } ?>
            </center>
            <div class="row">
                <div class="col-lg-9 mb-2">
                    <div class="contact-form bg-light mb-4" style="padding: 30px;">
                        <form action="<?= base_url('forgot/do') ?>" method="post">
                            <div class="form-group">
                                <label>Email</label>
                                <input type="email" class="form-control p-4" placeholder="Masukkan Email" required="required" name="email">
                            </div>
                           
                          
                            <div align="right">
                                <a class="btn btn-dark py-3 px-5"  href="<?= base_url('auth') ?>">Kembali</a>
                                <button class="btn btn-primary py-3 px-5"  type="submit">Kirim</button>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-lg-3 mb-2 d-none d-sm-inline-block">
                    <img src="<?= base_url('upload/icon/bannerR.png') ?>" class="img-fluid">
                </div>
            </div>
        </div>
    </div>
    <!-- Contact End -->


    <!-- Footer Start -->
    <div class="container-fluid bg-secondary  px-sm-3 px-md-5" style="margin-top: 90px;">
        
    </div>
    
    <!-- Footer End -->


    <!-- Back to Top -->
    <a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top"><i class="fa fa-angle-double-up"></i></a>


    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js"></script>
    <script src="<?= base_url() ?>assets/lib/easing/easing.min.js"></script>
    <script src="<?= base_url() ?>assets/lib/waypoints/waypoints.min.js"></script>
    <script src="<?= base_url() ?>assets/lib/owlcarousel/owl.carousel.min.js"></script>
    <script src="<?= base_url() ?>assets/lib/tempusdominus/js/moment.min.js"></script>
    <script src="<?= base_url() ?>assets/lib/tempusdominus/js/moment-timezone.min.js"></script>
    <script src="<?= base_url() ?>assets/lib/tempusdominus/js/tempusdominus-bootstrap-4.min.js"></script>

    <!-- Template Javascript -->
    <script src="js/main.js"></script>
</body>

</html>