<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Pembayaran</h1>
</div>

<div class="card shadow mb-4">
    <!-- Card Header - Dropdown -->
    <div
        class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
        <h6 class="m-0 font-weight-bold text-primary">Pembayaran</h6>
    </div>
    <!-- Card Body -->
    <div class="card-body">
      <div class="row">
        <div class="table-responsive">
            <table class="table table-bordered dataTable" id="dataTable">
                <thead>
                    <tr>
                    <th>No</th>
                    <th scope="col">No. Transaksi</th>
                    <th>Tanggal</th>
                    <th scope="col">Payment Method</th>

                    <th>Amount</th>
                  
                   
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
                        <td>".date('d/m/Y H:i',strtotime($row['pay_date']))."</td>
                        <td>".$row['pay_method']."</td>
                        <td>".rp($row['pay_amount'])."</td>

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