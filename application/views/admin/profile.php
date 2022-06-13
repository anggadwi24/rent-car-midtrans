<?php 
    if(file_exists('upload/user/'.$row['users_photo'])){
        $img = base_url('upload/user/'.$row['users_photo']);
    }else{
        $img = base_url('upload/user/not_found.jpg');
    }
    $customer = $this->model_app->view_order('cr_customer','cus_name','ASC');
?>
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Profile</h1>
</div>
<div class="row my-3">
    <div class="col-lg-4 col-sm-12 mb-3 ">
        <div class="card shadow">
            <div class="card-header">
                Data Pribadi
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-12 mx-auto text-center">
                        <img src="<?= $img ?>" class="img-fluid rounded-circle" style="width: 100px;px;height:100px;" alt="">
                    </div>
                    <div class="col-12 my-3 text-center">
                        <h4><?= $row['users_name'] ?></h4>
                       
                    </div>
                    <div class="col-12 text-center">
                        
                        <h6><?= $row['users_email'] ?></h6>
                    </div>
                    <div class="col-12  text-center">
                       
                        <h6><?= $row['users_level'] ?></h6>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-8 col-sm-12 mb-3 ">
        <div class="card shadow">
            <div class="card-header">
                Edit Profile
            </div>
            <div class="card-body">
               <form action="<?= base_url('admin/profile/update') ?>" method="post" enctype="multipart/form-data">
                    <div class="row">
                        <div class="col-7 form-group">
                            <label for="">Nama</label>
                            <input type="text" name="name" class="form-control" requried value="<?= $row['users_name']?>">
                        </div>
                        <div class="col-5  form-group">
                            <label for="">Email</label>
                            <input type="email" name="email" class="form-control" requried value="<?= $row['users_email']?>">
                        </div>
                        <div class="col-12 form-group">
                            <label for="">Password</label>
                            <input type="password" class="form-control" name="password">
                            <small>* Isi jika ingin mengganti</small>
                        </div>
                        <div class="col-12 form-group">
                            <label for="">Foto Profile</label>
                            <input type="file" class="form-control" name="file" accept="image/*">
                            <small>* Isi jika ingin mengganti</small>
                        </div>
                        <div class="col-12 form-group">
                            <button class="btn btn-primary float-right">Simpan</button>
                        </div>
                    </div> 
               </form>
            </div>
        </div>
    </div>

</div>