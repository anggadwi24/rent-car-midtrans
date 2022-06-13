<div class="row">
    <div class="col-12">
        <h1 class="h3 mb-0 text-gray-800 py-3">Penyewaan</h1>
        <?php  if(__thisOwner() == true){?>
        <a href="<?= base_url('admin/transaksi/sewa/add') ?>" class=" btn btn-sm btn-primary shadow-sm" ><i class="fas fa-plus fa-sm text-white-50"></i> Tambah Sewa</a>
        <?php }?>
        <div class="card shadow my-4">
        <!-- Card Header - Dropdown -->
            <div  class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">Data Penyewaan</h6>
            </div>
            <!-- Card Body -->
            <div class="card-body">
                <div class="table-responsive">
                        <table class="table table-bordered dataTable" id="dataTable" >
                        <thead>
                            <tr>
                            <th>No</th>
                            <th>Invoice</th>
                            <th scope="col">Penyewa</th>
                            <th>Tanggal</th>
                            <th scope="col">Mobil</th>
                        
                            <th>Status</th>
                            <th>Return</th>
                            <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if($record->num_rows() > 0){
                                $no = 1;
                                foreach($record->result_array() as $row){
                                    $mobil = $this->model_app->view_where('cr_mobil',array('mobil_id'=>$row['trans_mobil_id']))->row_array();
                                    $pack = $this->model_app->view_where('cr_package',array('pack_id'=>$row['trans_pack_id']))->row_array();
                                    if($row['trans_return'] == 'y'){
                                        $return = '<small>Mobil Kembali</small>';
                                    }else{
                                        $return  = '<small>Mobil Belum Kembali</small>';
                                    }
                                    $detail = null;
                                    $payment = null;
                                    if($row['trans_status'] == 'waiting' AND __thisOwner() == true){
                                        $payment = '<a href="'.base_url('admin/transaksi/sewa/payment?no='.$row['trans_no']).'" class="btn btn-info btn-xs ml-3" title="Pembayaran"><i class="fas fa-credit-card"></i></a>';
                                    }

                                    $detail = '<a href="'.base_url('admin/transaksi/sewa/detail?no='.$row['trans_no']).'"  class="btn btn-success btn-xs " title="Detail"><i class="fas fa-eye"></i></i></a>';

                                    echo "<tr>
                                        <td>$no</td>
                                        <td>".$row['trans_no']."</td>
                                        <td>".$row['trans_cus_name']."</td>
                                        <td>".date('d/m/Y',strtotime($row['trans_date_start']))." - ".date('d/m/Y',strtotime($row['trans_date_end']))."</td>
                                        <td>".$mobil['mobil_name']." <small class='d-block'>".$pack['pack_name']."</small></td>
                                        <td>".ucfirst($row['trans_status'])."</td>
                                        <td>".$return."</td>
                                        <td>".$detail.$payment."</td>


                                    </tr>";
                                    $no++;
                                }
                                
                            }
                                ?>
                        
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>