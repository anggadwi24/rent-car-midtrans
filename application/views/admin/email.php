<!DOCTYPE html>
<html lang='en'>
<head>
    <meta charset='UTF-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
    <title>PT Mas Diani Chandra - Invoice</title>
    <link href='https://fonts.googleapis.com/css?family=Nunito:400,600,700,800,900&display=swap' rel='stylesheet'>
    <style>
        body{
            background-color: #F6F6F6; 
            margin: 0;
            padding: 0;
        }
        h1,h2,h3,h4,h5,h6{
            margin: 0;
            padding: 0;
        }
        p{
            margin: 0;
            padding: 0;
        }
        .container{
            width: 100%;
            margin-right: auto;
            margin-left: auto;
        }
        .brand-section{
           background-color: #012F50;
           padding: 10px 40px;
        }
        .logo{
            width: 50%;
        }

        .row{
            display: flex;
            flex-wrap: wrap;
        }
        .col-6{
            width: 50%;
            flex: 0 0 auto;
        }
        .text-white{
            color: #fff;
        }
        .company-details{
            float: right;
            text-align: right;
        }
        .body-section{
            padding: 16px;
            border: 1px solid gray;
        }
        .heading{
            font-size: 20px;
            margin-bottom: 08px;
        }
        .sub-heading{
            color: #262626;
            margin-bottom: 05px;
        }
        table{
            background-color: #fff;
            width: 100%;
            border-collapse: collapse;
        }
        table thead tr{
            border: 1px solid #111;
            background-color: #f2f2f2;
        }
        table td {
            vertical-align: middle !important;
            text-align: center;
        }
        table th, table td {
            padding-top: 08px;
            padding-bottom: 08px;
        }
        .table-bordered{
            box-shadow: 0px 0px 5px 0.5px gray;
        }
        .table-bordered td, .table-bordered th {
            border: 1px solid #dee2e6;
        }
        .text-right{
            text-align: end;
        }
        .w-20{
            width: 20%;
        }
        .float-right{
            float: right;
        }
    </style>
</head>
<body>

    <div class='container'>
        <div class='brand-section'>
            <div class='row'>
                <div class='col-6'>
                    <h1 class='text-white'>PT Mas DIani Chandra</h1>
                </div>
                <div class='col-6'>
                    <div class='company-details'>
                        <p class='text-white'>Jalan Taman Geriya V/20 Tuban - Bali</p>
                        <p class='text-white'>+62 813-3899-9729</p>
                    </div>
                </div>
            </div>
        </div>

        <div class='body-section'>
            <div class='row'>
                <div class='col-6'>
                    <h2 class='heading'>Invoice : #<?= $row['trans_no'] ?></h2>
                    <p class='sub-heading'>Tanggal: <?= format_indo($row['trans_date'])?> </p>
                    <p class='sub-heading'>Alamat Email: ptmasdianichandra@gmail.com </p>
                </div>
                <div class='col-6'>
                    <p class='sub-heading'>Nama: <strong><?= $row['trans_cus_name'] ?></strong> - <?= $row['trans_cus_phone'] ?> </p>
                    <p class='sub-heading'>Email: <strong><?= $row['trans_cus_email'] ?></strong>  </p>
                </div>
            </div>
        </div>
        <?php
            $hari = daysDifference($row['trans_date_start'],$row['trans_date_end']);
        ?>
        <div class='body-section'>
            <h3 class='heading'>Ordered Items</h3>
            <br>
                <p class='sub-heading'>Tanggal Sewa : <?= format_indo($row['trans_date_start']) ?>  s/d <?= format_indo($row['trans_date_end']) ?> </p>
                <p class='sub-heading'>Durasi Sewa :  <?= $hari ?> Hari </p>
                <p class='sub-heading'>Jam <?php if($row['trans_sp_id'] == NULL){ echo "Ambil"; }else{ echo  "Antar"; } ?> : <?= date('H:i',strtotime($row['trans_time'])) ?>  WITA  </p>
                <!-- klo delivery true -->
                <?php if($row['trans_sp_id'] != NULL){
                    $sp = $this->model_app->view_where('cr_shuttle_price',array('sp_id'=>$row['trans_sp_id']))->row_array();
                    $spPrice = $sp['sp_price'];
                    $hasPrice = true;
                    $kab = $this->model_app->view_where('cr_kabupaten',array('kab_id'=>$sp['sp_kab_id']))->row_array();
                    if($sp['sp_kec_id'] != NULL){
                        $kec = $this->model_app->view_where('cr_kecamatan',array('kec_id'=>$sp['sp_kec_id']))->row_array();
                        $kecamatan = ', '.$kec['kec_name'];
                    }else{
                        $kecamatan = '';
                    }
                    $address =   $row['trans_address'].'. '.$kab['kab_name'].$kecamatan;
                    ?>
                <p class='sub-heading'>Alamat Antar/Jemput :  <?= $address ?>  </p>
                <?php }else{

                    $spPrice = 0;
                }?>

            <br>
            <table class='table-bordered'>
                <thead>
                    <tr>
                        <th>Mobil</th>
                        <th class='w-20'>Paket</th>
                        <th class='w-20'>Delivery</th>
                        <th class='w-20'>Sub total</th>
                    </tr>
                </thead>
                <tbody>
                    
                    <tr>
                        <td><?= $mobil['mobil_name'] ?></td>
                        <td><?= $package['pack_name'] ?></td>
                        <td><?php 
                                if($row['trans_sp_id'] == NULL){echo "-";}else{ echo "Yes"; }
                            ?></td>
                        <td>  <?= rp($package['pack_price'])?> </td>
                    </tr>
                    
                    <tr>
                        <td colspan='3' class='text-right'>Sub Total &nbsp;</td>
                        <td> <?= rp($package['pack_price']*$hari)?></td>
                    </tr>
                    <?php if($row['trans_sp_id'] != NULL){?>
                    <tr>
                        <td colspan='3' class='text-right'>Delivery &nbsp;</td>
                        <td><?= rp($spPrice)?></td>
                    </tr>
                    <?php }?>
                    <tr>
                        <td colspan='3' class='text-right'>Grand Total &nbsp;</td>
                        <td><?= rp($row['trans_total'])?></td>
                    </tr>
                </tbody>
            </table>
            <br>
        </div>

        <div class='body-section'>
            <p><center>&copy; Copyright <?= date('Y') ?> - PT Mas Diani Chandra. All rights reserved.</center></p>
        </div>      
    </div>      

</body>
</html>