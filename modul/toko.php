<?php
//if(empty($_SESSION['tokoname'])){
//    echo "Not found!";
//} else {
    switch ($_GET['act']) {
    // PROSES VIEW DATA kasmasuk //      
      case 'view':
      ?>

<div class="content-wrapper">
        <!-- Content Header (Page header) -->
        
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="?module=home">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Data toko</li>
          </ol>
        </nav>

<!-- Main content -->

    
      <div class="card shadow mb-4">
                    <div class="card-header py-3">
                      <h6 class="m-0 font-weight-bold text-primary">Data toko</h6>
                    </div>
            <div class="card-body">
                    <a href="#"> <button type="button" data-toggle="modal" data-target="#tambahtoko" class="btn btn-sm btn-primary mb-2"><i class = "fa fa-plus"> Tambah Data </i></button> </a>
                  <div class="table-responsive">
                   <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>No</th>
                        <th>Nama Toko</th>
                        <th>Promotor</th>
                        <th>Area</th>
                        <th><center>Aksi</center></th>
                    </tr>
                  </thead>
                 
                  <tbody>
                    <?php
                    $tampil=mysqli_query($koneksi,"SELECT * FROM `user`,`toko`,`area` where user.id_user=toko.id_toko and area.id_area=toko.id_area order by toko.id_toko desc");
                    $no = 1;
                      while ($r=mysqli_fetch_array($tampil)){
                    ?>
                    <tr>
                       <td><?php echo $no++ ;?></td>
                        <td><?php echo "$r[nama_toko]"?></td>
                        <td><?php echo "$r[nama_lengkap]"?></td>
                        <td><?php echo $r[nama_area];?></td>
                        <td>
                              <a href="#"><button class="btn btn-warning btn-sm" data-toggle="modal" data-target="#detailtoko<?php echo $r['id_toko'] ?>">
                                        <i class="fas fa-search-plus"></i>
                                      </button></a> 
                              <a href="?module=toko&act=edit&id=<?php echo $r['id_toko'] ?>"><button class="btn btn-primary btn-sm">
                                <i class="fas fa-edit"></i>
                              </button></a> 

                              <a href="?module=toko&act=edit&id=<?php echo $r['id_toko']?>"><button  class="btn btn-danger btn-sm" onclick="return confirm('Apakah anda yakin?');">
                                <i class="fas fa-trash"></i>
                              </button></a> 

                                       <div class="modal fade" id="detailtoko<?php echo $r['id_user'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                  <div class="modal-content">
                                    <div class="modal-header">
                                      <h5 class="modal-title" id="exampleModalLabel">Detail Data toko</h5>
                                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                      </button>
                                    </div>
                                    <div class="modal-body">
                                     
                                      <table class="table">
                                        <tr>
                                          <th colspan="3">
                                              <center>Detail Toko</center>
                                          </th>
                                        </tr>
                                        <tr>
                                          <td>Nama Toko</td>
                                          <td>:</td>
                                          <td><?php echo $r['nama_toko'] ?></td>
                                        </tr>
                                         <tr>
                                          <td>No Handphone</td>
                                          <td>:</td>
                                          <td>+62<?php echo $r['no_hp'] ?></td>
                                        </tr>
                                         <tr>
                                          <td>Promotor</td>
                                          <td>:</td>
                                          <td><?php echo $r['nama_lengkap'] ?></td>
                                        </tr>
                                         <tr>
                                          <td>Area</td>
                                          <td>:</td>
                                          <td><?php echo $r['nama_area'] ?></td>
                                        </tr>
                                         <tr>
                                          <td>Tutor</td>
                                          <td>:</td>
                                          <td><?php echo $r['tutor'] ?></td>
                                        </tr>
                                        <tr>
                                          <td>Supervisor</td>
                                          <td>:</td>
                                          <td><?php echo $r['srv'] ?></td>
                                        </tr>
                                      </table>

                                      
                                    <div class="modal-footer">
                                      <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                    </div>
                                    
                                  </div>
                                </div>
                              </div>

                              

                        </td>
                    </tr>
                  <?php } ?>
                   
                  </tbody>
                </table>

                  </div><!-- /.box-body -->
              </div>
            </div>
          </div>
             

            <div class="modal fade" id="tambahtoko" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Form Tambah toko</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body">
                    <form action="media.php?module=toko&act=add" method="post">
                        <div class="form-group">
                                      <label for="exampleInputEmail1">Nama Toko</label>
                                      <input type="text" class="form-control" id="nip" name="nama" placeholder="Nama toko" required data-fv-notempty-message="Tidak boleh kosong">
                        </div>
                        <div class="form-group">
                                      <label for="exampleInputEmail1">Area</label>
                                      <select name="area" class="form-control" required="">
                                        <option value="">-Pilih Area-</option>
                                        <?php 
                                        $sql = mysqli_query($koneksi,"select * from area");
                                        while ($da = mysqli_fetch_array($sql)) {
                                          ?> 
                                          <option value="<?php echo $da['id_area'] ?>"><?php echo $da['nama_area'] ?></option>
                                           <?php
                                        }
                                         ?>
                                      </select>
                        </div>
                        <div class="form-group">
                                      <label for="exampleInputEmail1">No Telpon Toko</label>
                                      <input type="number" class="form-control" id="nama" name="no_hp" placeholder="Nomor Telpon Toko" required data-fv-notempty-message="Tidak boleh kosong">
                        </div>
                        <div class="form-group">
                                      <label for="exampleInputEmail1">Alamat</label>
                                      <textarea name="alamat" placeholder="Alamat Toko" required="" class="form-control"></textarea>
                        </div>
                       
                        <div class="form-group">
                                      <label for="exampleInputEmail1">Promotor</label>
                                      <select name="promotor" class="form-control" required="">
                                        <option value="">-Pilih Promotor-</option>
                                        <?php 
                                        $sql = mysqli_query($koneksi,"select * from user where id_jabatan='1'");
                                        while ($da = mysqli_fetch_array($sql)) {
                                          ?> 
                                          <option value="<?php echo $da['id_user'] ?>"><?php echo $da['nama_lengkap'] ?></option>
                                           <?php
                                        }
                                         ?>
                                      </select>
                        </div>
                        <div class="form-group">
                                      <label for="exampleInputEmail1">Tutor</label>
                                      <select name="tutor" class="form-control" required="">
                                        <option value="">-Pilih Tutor-</option>
                                        <?php 
                                        $sql = mysqli_query($koneksi,"select * from user where id_jabatan='2'");
                                        while ($da = mysqli_fetch_array($sql)) {
                                          ?> 
                                          <option value="<?php echo $da['nama_lengkap'] ?>"><?php echo $da['nama_lengkap'] ?></option>
                                           <?php
                                        }
                                         ?>
                                      </select>
                        </div>
                        <div class="form-group">
                                      <label for="exampleInputEmail1">Supervisor</label>
                                      <select name="srv" class="form-control" required="">
                                        <option value="">-Pilih Supervisor-</option>
                                        <?php 
                                        $sql = mysqli_query($koneksi,"select * from user where id_jabatan='4'");
                                        while ($da = mysqli_fetch_array($sql)) {
                                          ?> 
                                          <option value="<?php echo $da['nama_lengkap'] ?>"><?php echo $da['nama_lengkap'] ?></option>
                                           <?php
                                        }
                                         ?>
                                      </select>
                        </div>
                        
                      </div>
                  
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Simpan Data</button>
                  </div>
                  </form>
                </div>
              </div>
            </div>





      <?php
      break;
      // PROSES TAMBAH DATA kasmasuk //
      case 'add':
      
               
                  mysqli_query($koneksi,"INSERT INTO toko VALUES (NULL,'$_POST[nama]','$_POST[area]','$_POST[srv]','$_POST[tutor]','$_POST[alamat]','$_POST[no_hp]','$_POST[promotor]')");
                  
              
                 ?> 
                <script type="text/javascript">
                    alert ("Data Berhasil Disimpan");
                    window.location.href="media.php?module=toko&act=view";
                </script>
            <?php
          
            
      break;
      // PROSES EDIT DATA kasmasuk //
      case 'edit':
     
      $d = mysqli_fetch_array(mysqli_query($koneksi,"SELECT * FROM `user`,`toko`,`area` where user.id_user=toko.id_toko and area.id_area=toko.id_area and toko.id_toko='$_GET[id]'"));
      if(isset($_POST['ubah'])){
        
                mysqli_query($koneksi,"UPDATE toko SET 
                  nama_toko='$_POST[nama]',
                  no_toko='$_POST[no_hp]',
                  alamat='$_POST[alamat]',
                  tutor='$_POST[tutor]',
                  id_user='$_POST[promotor]',
                  id_area='$_POST[area]',
                  srv='$_POST[srv]' WHERE id_toko='$_GET[id]'");
                ?> 
                <script type="text/javascript">
                    
                    alert ("Data Berhasil Diubah");
                    window.location.href="media.php?module=toko&act=view";
                </script>
                <?php
              
      }
            
              ?>

<div class="content-wrapper">
        <!-- Content Header (Page header) -->
        
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="?module=home">Home</a></li>
            <li class="breadcrumb-item"><a href="?module=toko&act=view">Data toko</a></li>
            <li class="breadcrumb-item active" aria-current="page">Edit Data toko</li>
          </ol>
        </nav>

<!-- Main content -->
<div class="card shadow mb-4">
      <div class="card-header py-3">
          <h6 class="m-0 font-weight-bold text-primary">Edit Data handphone</h6>
      </div>
      <div class="card-body">
         <form role="form" method = "POST" action="">
              <!-- general form elements -->
               <div class="form-group">
                          <label for="exampleInputEmail1">Nama Toko</label>
                          <input type="text" class="form-control" id="nip" name="nama" value="<?php echo $d['nama_toko'] ?>" required data-fv-notempty-message="Tidak boleh kosong">
            </div>
            <div class="form-group">
                          <label for="exampleInputEmail1">Area</label>
                          <select name="area" class="form-control" required="">
                            <?php 
                            $sql = mysqli_query($koneksi,"select * from area");
                            while ($da = mysqli_fetch_array($sql)) {
                              ?> 
                              <option value="<?php echo $da['id_area'] ?>" 
                                <?php 
                                if ($da['id_area']==$d['id_area']) {
                                  echo "checked";
                                }else{

                                }
                                 ?>
                                

                                ><?php echo $da['nama_area'] ?></option>
                               <?php
                            }
                             ?>
                          </select>
            </div>
            <div class="form-group">
                          <label for="exampleInputEmail1">No Telpon Toko</label>
                          <input type="number" class="form-control" id="nama" name="no_hp" value="<?php echo $d['no_toko'] ?>" required data-fv-notempty-message="Tidak boleh kosong">
            </div>
            <div class="form-group">
                          <label for="exampleInputEmail1">Alamat</label>
                          <textarea name="alamat" placeholder="Alamat Toko" required="" class="form-control"><?php echo $d['alamat'] ?></textarea>
            </div>
           
            <div class="form-group">
                          <label for="exampleInputEmail1">Promotor</label>
                          <select name="promotor" class="form-control" required="">
                           
                            <?php 
                            $sql = mysqli_query($koneksi,"select * from user where id_jabatan='1'");
                            while ($da = mysqli_fetch_array($sql)) {
                              ?> 
                              <option value="<?php echo $da['id_user'] ?>" 
                                <?php 
                                if ($da['id_user']==$d['id_user']) {
                                  echo "selected";
                                }else{

                                }
                                 ?>
                                ><?php echo $da['nama_lengkap'] ?></option>
                               <?php
                            }
                             ?>
                          </select>
            </div>
            <div class="form-group">
                          <label for="exampleInputEmail1">Tutor</label>
                          <select name="tutor" class="form-control" required="">
                            <?php 
                            $sql = mysqli_query($koneksi,"select * from user where id_jabatan='2'");
                            while ($da = mysqli_fetch_array($sql)) {
                              ?> 
                              <option value="<?php echo $da['nama_lengkap'] ?>"
                                <?php 
                                if ($da['nama_lengkap']==$d['tutor']) {
                                  echo "selected";
                                }else{

                                }
                                 ?>
                                ><?php echo $da['nama_lengkap'] ?></option>
                               <?php
                            }
                             ?>
                          </select>
            </div>
            <div class="form-group">
                          <label for="exampleInputEmail1">Supervisor</label>
                          <select name="srv" class="form-control" required="">
                            <?php 
                            $sq = mysqli_query($koneksi,"select * from user where id_jabatan='4'");
                            while ($dac = mysqli_fetch_array($sq)) {
                              ?> 
                              <option value="<?php echo $dac['nama_lengkap'] ?>" 
                                 <?php 
                                if ($dac['nama_lengkap']==$d['srv']) {
                                  echo "selected";
                                }else{

                                }
                                 ?>
                                ><?php echo $dac['nama_lengkap'] ?></option>
                               <?php
                            }
                             ?>
                          </select>
            </div>
                  
                 
                    
<button type="submit" name = 'ubah' class="btn btn-primary">Ubah Data</button>


             
              
              
                  
            </form>
                  </div><!-- /.box-body -->
              
         </div>
       </div>



    <?php
    break;

    // PROSES HAPUS DATA PENGGUNA //
      case 'delete':
      mysqli_query($koneksi,"DELETE FROM toko WHERE id_toko='$_GET[id]'");
      echo "<script>window.location='media.php?module=toko&act=view'</script>";
      break;

    }
    ?>