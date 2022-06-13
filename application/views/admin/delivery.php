<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Antar/Jemput</h1>
    <?php  if(__thisOwner() == true){?>
    <a href="javascript:void(0);" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm" data-toggle="modal" data-target="#modaltambahdelivery"><i class="fas fa-plus fa-sm text-white-50"></i> Tambah Data</a>

    <!-- Modal -->
    <div class="modal fade" id="modaltambahdelivery" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Tambah delivery</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <form action="<?= base_url('admin/master/delivery/delivery_add') ?>" method="post">
          <div class="modal-body">
            <div class="form-group">
                <label>Kabupaten</label>
                <select name="kabupaten" id="kabupaten" class="form-control" required>
                  <option disabled selected></option>
                  <?php if($kabupaten->num_rows() > 0){
                            foreach($kabupaten->result_array() as $kab){
                              echo "<option value='".$kab['kab_id']."'>".$kab['kab_name']."</option>";
                            }
                        }
                    ?>
                </select>
              </div>
              <div class="form-group">
                <label for="">Kecamatan</label>
                <select name="kecamatan" id="kecamatan" class="form-control">
                  <option disabled selected></option>
                </select>
              </div>
              <div class="form-group">
                <label>Harga</label>
                <input type="text" class="form-control" name="price" required>
              </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Simpan</button>
          </div>
          </form>
        </div>
      </div>
    </div>
<?php }?>
</div>

<div class="card shadow mb-4">
    <!-- Card Header - Dropdown -->
    <div
        class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
        <h6 class="m-0 font-weight-bold text-primary">Data Antar/Jemput</h6>
    </div>
    <!-- Card Body -->
    <div class="card-body">

        <table class="table">
          <thead class="thead-light">
            <tr>
              <th>No</th>
              <th scope="col">Kabupaten</th>
              <th>Kecamatan</th>
              <th scope="col">Harga</th>
              <th scope="col">#</th>
            </tr>
          </thead>
          <tbody>
            <?php
               $no = 1; 
                foreach($delivery->result_array() as $dlv){
                $kb =  $this->model_app->view_where('cr_kabupaten',array('kab_id'=>$dlv['sp_kab_id']))->row_array();
                if($dlv['sp_kec_id'] == NULL){
                  $kecamatan = 'Semua Kecamatan';
                  $kec_id = 'all';
                }else{
                  $kc = $this->model_app->view_where('cr_kecamatan',array('kec_id'=>$dlv['sp_kec_id']))->row_array();
                  $kecamatan = $kc['kec_name'];
                  $kec_id = $kc['kec_id'];
                }
              ?>
            <tr>
              <td><?= $no ?></td>
              <td><?= $kb['kab_name'] ?></td>
              <td><?= $kecamatan?></td>
              <td>Rp<?= number_format($dlv['sp_price'], 0, ",", ".") ?></td>
              <td>
               <?php  if(__thisOwner() == true){?>
                  <a href="javascript:void(0);" class="btn btn-primary btn-circle btn-sm edit"  data-id='<?= $dlv['sp_id'] ?>' data-kab = '<?= $dlv['sp_kab_id']?>' data-kec = '<?= $kec_id ?>' data-price = '<?= $dlv['sp_price']?>'><i class="fas fa-pencil-alt"></i></a>

                  <!-- Modal -->
                    


                  <a href="<?= base_url('admin/master/delivery/delivery_hapus?id='.$dlv['sp_id']) ?>" class="btn btn-danger btn-circle btn-sm"><i class="fas fa-trash"></i></a>
                <?php } ?>
               </td>
            </tr>
            <?php $no++; } ?>
          </tbody>
        </table>

    </div>
</div>
<div class="modal fade" id="modaleditdelivery" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Edit Delivery</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="<?= base_url('admin/master/delivery/delivery_edit') ?>" method="post">
          <input type="hidden" name="sp_id" id="sp_id">
        <div class="modal-body">
          <div class="form-group">
            <label>Kabupaten</label>
            <select name="kabupaten" id="kabSel" class="form-control" required>
              <option disabled selected></option>
              <?php if($kabupaten->num_rows() > 0){
                        foreach($kabupaten->result_array() as $kab){
                          echo "<option value='".$kab['kab_id']."'>".$kab['kab_name']."</option>";
                        }
                    }
                ?>
            </select>
          </div>
          <div class="form-group">
            <label for="">Kecamatan</label>
            <select name="kecamatan" id="kecSel" class="form-control">
              <option disabled selected></option>
            </select>
          </div>
          <div class="form-group">
            <label>Harga</label>
            <input type="text" class="form-control" id="price" name="price" required>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Simpan</button>
        </div>
        </form>
      </div>
    </div>
  </div>
<script>
  $(document).on('click','.edit',function(){
    var id = $(this).attr('data-id');
    var kab = $(this).attr('data-kab');
    var kec = $(this).attr('data-kec');
    var price = $(this).attr('data-price');

    $('#sp_id').val(id);
    $('#kabSel').val(kab).change();
    $('#kecSel').val(kec).change();
    $('#price').val(price);

    $('#modaleditdelivery').modal('show');

  })
  $(document).on('change','#kabSel',function(){
    var kab = $(this).val();
    $.ajax({
    
        type:'POST',
        url:'<?= base_url('admin/master/delivery/kecamatan') ?>',
        data:{kab:kab},
        dataType:'json',
        success:function(resp){
          if(resp.status == true){
              $('#kecSel').html(resp.html);
          }
        }
    });
  })
  $(document).on('change','#kabupaten',function(){
    var kab = $(this).val();
    $.ajax({
    
        type:'POST',
        url:'<?= base_url('admin/master/delivery/kecamatan') ?>',
        data:{kab:kab},
        dataType:'json',
        success:function(resp){
          if(resp.status == true){
              $('#kecamatan').html(resp.html);
          }else{
              alert('Tidak ada kecamatan pada kabupaten yang dipilih');
          }
        }
    });
  })
</script>