<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>PT.Mas Diani Chandra Trans</title>
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
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js" integrity="sha512-AA1Bzp5Q0K1KanKKmvN/4d3IRKVlv9PYgwFPvm32nPO6QS8yH1HO7LbgB1pgiOxPtfeg5zEn2ba64MUcqJx6CA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js"></script>
    <style type="text/css">
        .kanan{
            float: right;
        }
    </style>
</head>

<body>
    <!-- Topbar Start -->
    <div class="container-fluid bg-dark py-3 px-lg-5">
        <div class="row">
            <div class="col-md-6 text-center text-lg-left mb-2 mb-lg-0 d-none d-lg-block">
                <div class="d-inline-flex align-items-center">
                    <a class="text-body pr-3" href=""><i class="fa fa-phone-alt mr-2"></i>+62 813-3899-9729</a>
                    <span class="text-body">|</span>
                    <a class="text-body px-3" href=""><i class="fa fa-envelope mr-2"></i>ptmasdianichandra@gmail.com</a>
                </div>
            </div>
            <div class="col-md-6 text-lg-right text-right">
                <div class="d-inline-flex align-items-center">
                    <?php if (!isset($this->session->userdata['login_cus']['status'])) {?>
                    <span class="text-body">|</span>
                    <a class="text-body px-3" href="<?= base_url('auth') ?>"><i class="fa fa-user mr-2"></i>Login</a>
                    <?php }else{ ?>
                    <a class="text-body px-3" href="<?= base_url('main/profil') ?>"><i class="fa fa-user mr-2"></i><?= $this->session->userdata['login_cus']['cus_name'] ?></a>
                    <span class="text-body">|</span>
                    <a href="<?= base_url('auth/logout') ?>" class="text-body px-3">Logout</a>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
    <!-- Topbar End -->


    <!-- Navbar Start -->
    <div class="container-fluid position-relative nav-bar p-0">
        <div class="position-relative px-lg-5" style="z-index: 9;">
            <nav class="navbar navbar-expand-lg bg-secondary navbar-dark py-3 py-lg-0 pl-3 pl-lg-5">
                <a href="" class="navbar-brand">
                    <h1 class="text-uppercase text-primary mb-1">PT.Mas Diani Chandra Trans</h1>
                </a>
                <button type="button" class="navbar-toggler bg-primary" data-toggle="collapse" data-target="#navbarCollapse">
                    <span class="navbar-toggler-icon text-secondary"></span>
                </button>
                <div class="collapse navbar-collapse justify-content-between px-3" id="navbarCollapse">
                    <div class="navbar-nav ml-auto py-0 kanan">
                        <a href="<?= base_url() ?>" class="nav-item nav-link text-primary">Beranda</a>
                        <a href="<?= base_url('mobil') ?>" class="nav-item nav-link text-primary">Mobil</a>
                    </div>
                </div>
            </nav>
        </div>
    </div>
    <!-- Navbar End -->



    <?= $contents ?>




        <!-- Footer Start -->
    <div class="container-fluid bg-dark py-5 px-sm-3 px-md-5" style="margin-top: 90px;">
        <div class="row pt-5">
            <div class="col-lg-3 col-md-6 mb-5">
                <h4 class="text-uppercase text-light mb-4">Informasi</h4>
                <p class="mb-2"><i class="fa fa-map-marker-alt text-white mr-3"></i>Jalan Taman Geriya V/20 Tuban - Bali</p>
                <p class="mb-2"><i class="fa fa-phone-alt text-white mr-3"></i>+62 813-3899-9729</p>
                <p><i class="fa fa-envelope text-white mr-3"></i>ptmasdianichandra@gmail.com</p>
                <h6 class="text-uppercase text-white py-2">Follow Us</h6>
                <div class="d-flex justify-content-start">
                    <a class="btn btn-lg btn-light btn-lg-square mr-2" href="#"><i class="fab fa-twitter"></i></a>
                    <a class="btn btn-lg btn-light btn-lg-square mr-2" href="#"><i class="fab fa-facebook-f"></i></a>
                    <a class="btn btn-lg btn-light btn-lg-square mr-2" href="#"><i class="fab fa-linkedin-in"></i></a>
                    <a class="btn btn-lg btn-light btn-lg-square" href="#"><i class="fab fa-instagram"></i></a>
                </div>
            </div>
            <div class="col-lg-9 col-md-6 mb-5">
                <h4 class="text-uppercase text-light mb-4">Lokasi Kami</h4>
                <div class="row mx-n1">
                    <div class="col-12 px-1 mb-2">
                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3943.4825210305366!2d115.17108821438731!3d-8.74058709159552!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2dd2441bbc9395df%3A0x6d3f7e8025d161ba!2sJl.%20Taman%20Griya%20V%20No.20%2C%20Tuban%2C%20Kec.%20Kuta%2C%20Kabupaten%20Badung%2C%20Bali%2080361!5e0!3m2!1sid!2sid!4v1653036806617!5m2!1sid!2sid" width="100%" height="250" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                    </div>
                    
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid py-4 px-sm-3 px-md-5" style="background-color: #350202;">
        <p class="mb-2 text-center text-body">&copy; <a href="<?= base_url() ?>">PT.Mas Diani Chandra Trans</a>. All Rights Reserved.</p>
        
        <!--/*** This template is free as long as you keep the footer author’s credit link/attribution link/backlink. If you'd like to use the template without the footer author’s credit link/attribution link/backlink, you can purchase the Credit Removal License from "https://htmlcodex.com/credit-removal". Thank you for your support. ***/-->                 
       
    </div>
    <!-- Footer End -->


    <!-- Back to Top -->
    <a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top"><i class="fa fa-angle-double-up"></i></a>


    <!-- JavaScript Libraries -->
 
    <script src="<?= base_url() ?>assets/lib/easing/easing.min.js"></script>
    <script src="<?= base_url() ?>assets/lib/waypoints/waypoints.min.js"></script>
    <script src="<?= base_url() ?>assets/lib/owlcarousel/owl.carousel.min.js"></script>
    <script src="<?= base_url() ?>assets/lib/tempusdominus/js/moment.min.js"></script>
    <script src="<?= base_url() ?>assets/lib/tempusdominus/js/moment-timezone.min.js"></script>
    <script src="<?= base_url() ?>assets/lib/tempusdominus/js/tempusdominus-bootstrap-4.min.js"></script>
    <script src="<?= base_url() ?>assets/lib/sweetalert/js/sweetalert.min.js"></script>


    <!-- Template Javascript -->
    <script src="<?= base_url() ?>assets/js/main.js"></script>

    <script type="text/javascript">
        $(document).ready(function(){
        //start

        //ambil paket dari mobil di form booking
        $('.mobil_id').change(function(){
            var mobil_id = $('.mobil_id').val();
            $.ajax({
                url : "<?= base_url('transaksi/cek_paket')?>",
                method : "POST",
                data : {mobil_id: mobil_id},
                success: function(data){
                    $('#paket_id').html(data);
                }
            });
        });

        //ambil hargapaket dari paket yang dipilih di form booking
        // $('.paket_id').change(function(){
        //     var paket_id = $('.paket_id').val();
        //     $.ajax({
        //         url : "<?= base_url('transaksi/cek_harga_paket')?>",
        //         method : "POST",
        //         data : {paket_id: paket_id},
        //         success: function(data){
        //             $('#harga_paket').html(data);
        //         }
        //     });
        // });

        //tampil form antar jemput
        $('#delivery').change(function(){
            
            if($('input[name="delivery"]').is(':checked'))  {
                var delivery = $('input[name="delivery"]:checked').val();
                 $.ajax({
                    url : "<?= base_url('transaksi/form_delivery')?>",
                    method : "POST",
                    data : {delivery: delivery},
                    success: function(data){
                        $('#tampil_form').html(data);
                    },complete:function(){
                        $('#sp_id').change(function(){
                            var sp_id = $('#sp_id').val();
                            $.ajax({
                                url : "<?= base_url('transaksi/cek_harga_delivery')?>",
                                method : "POST",
                                data : {sp_id: sp_id},
                                success: function(data){
                                    $('#harga_delivery').html(data);
                                }
                            });
                        });
                    }
                });
            }else{
                $('#tampil_form').html('');
            }
           
        });

        //tampil kecamatan di form booking
        $(document).on('change','#kabupaten',function(){
            var kab = $(this).val();
            $.ajax({
            
                type:'POST',
                url:'<?= base_url('transaksi/kecamatan') ?>',
                data:{kab:kab},
                dataType:'json',
                success:function(resp){
                  if(resp.status == true){
                      $('#kecamatan').html(resp.html);
                  }else{
                      swal('Peringatan!','Tidak ada kecamatan pada kabupaten yang dipilih','warning');
                  }
                }
            });
          })
        $('#date_start').on('change',function(){
            var val = $(this).val();
            $('#date_end').attr('min',val);
        })

        $('#date_end').on('change',function(){
            var val = $(this).val();
            $('#date_start').attr('max',val);
        })

        
        //booking proses1
        $(".proses1").click(function(){
            var paket_id = $('.paket_id').val();
            var date_start = $('#date_start').val();
            var date_end = $('#date_end').val();
            var kab = $('#kabupaten').val();
            var kec = $('#kecamatan').val();
            var time = $('#trans_time').val();
            if($('input[name="delivery"]').is(':checked'))  {
                var delivery = 'y';
            }else{
                var delivery = 'n';
            }
            $.ajax({
              type: 'POST',
              url: "<?= base_url('transaksi/proses1') ?>",
              data : {paket_id: paket_id, date_end: date_end, date_start:date_start, delivery: delivery, kab: kab, kec: kec,time:time},
              dataType : 'json',
              success: function(resp) {
                if (resp.status==true) {
                    $('.formDetail').css('display','');
                    $('html, body').animate({
                        scrollTop: $('.formDetail').offset().top - 20 //#DIV_ID is an example. Use the id of your destination on the page
                    }, 'slow');
                    $('#tampil_detail').html(resp.output);
                }else{
                    $('.formDetail').css('display','none');

                    $('#tampil_detail').html('');
                    swal('Peringatan!',resp.msg,'warning');

                   
                }
              }
            });
          });

        //checkout
        $(document).on('submit','#formAct',function(e){
        
            e.preventDefault();
            var formData = new FormData(this);
            // formData.append('s', getUrlParameter('s'));
            $.ajax({
                 type:'POST',
                 url:'<?= base_url('payment/doPay')?>',
                 data: formData,
                 contentType: false,
                 cache: false,
                 processData:false,
                 dataType :'json',
                 beforeSend:function(){
                  
                 },success:function(resp){
                    // console.log(resp);
                     if(resp.status == true){
                        
                            window.open(resp.msg, '_blank');
                            window.location = resp.redirect;
                        
                     }else{
                        swal('Peringatan!',resp.msg,'warning');
                     }
                 },error:function(e){
                     console.log(e.responseText);
                 }
            })
        })
        

        //end
        });
    </script>
</body>

</html>