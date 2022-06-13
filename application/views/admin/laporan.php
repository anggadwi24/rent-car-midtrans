<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Laporan</h1>
</div>

<div class="card shadow mb-4">
    <!-- Card Header - Dropdown -->
    <div
        class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
        <h6 class="m-0 font-weight-bold text-primary">Laporan</h6>
    </div>
    <!-- Card Body -->
    <div class="card-body">
      <div class="row">
          <div class="col-12 ">
              <form action="<?= base_url('admin/laporan/data') ?>">
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="">Dari Tanggal</label>
                                <input type="date" name="start" class="form-control" value="<?= $start ?>">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="">Sampai Tanggal</label>
                                <input type="date" name="end" class="form-control" value="<?= $end ?>">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="">Status</label>
                                <select name="status" class="form-control">
                                    <option value="all">Semua</option>
                                    <option value="waiting">Pending</option>
                                    <option value="done">Selesai</option>
                                    <option value="paid">Dibayar</option>
                                    <option value="cancel">Cancel</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="">&nbsp;</label>
                                <button type="submit" class="btn btn-primary btn-block">Cari</button>
                            </div>
                        </div>
                    </div>
              </form>
          </div>
          <div class="col-12 mt-1 mb-3">
              <a href="<?= base_url('admin/laporan/excel?start='.$start.'&end='.$end.'&status='.$status) ?>" class="btn btn-outline-info btn-xs text-right"><i class="fa fa-file-excel"></i> DOWNLOAD</a>
          </div>
        <div class="col-12 table-responsive">
            <table class="table table-bordered dataTable" id="dataTable">
                <thead>
                    <tr>
                    <th>No</th>
                    <th scope="col">No. Transaksi</th>
                    <th>Tanggal Sewa</th>
                    <th scope="col">Status</th>
                   

                    <th>Amount</th>
                    <th>Aksi</th>
                  
                   
                    </tr>
                </thead>
                <tbody>
          <?php 
          if($record->num_rows() > 0){
              $no = 1;
            foreach ($record->result_array() as $row) {
                echo "<tr>
                        <td>".$no."</td>
                        <td><a href='".base_url('admin/transaksi/sewa/detail?no='.$row['trans_no'])."' target='_BLANK'>#".$row['trans_no']."</a></td>
                        <td>".date('d/m/Y',strtotime($row['trans_date_start']))." - ".date('d/m/Y',strtotime($row['trans_date_end']))." </td>
                        <td>".ucfirst($row['trans_status'])."</td>
                        <td>".rp($row['pay_amount'])."</td>
                        <td><a href='".base_url('admin/laporan/download/'.$row['trans_no'])."' target='_BLANK'> <i class='fa fa-file-pdf'></i> Download </a></td>


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