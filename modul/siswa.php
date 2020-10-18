<?php
//if(empty($_SESSION['siswaname'])){
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
            <li class="breadcrumb-item active" aria-current="page">Data siswa</li>
          </ol>
        </nav>

<!-- Main content -->

    
    </div><!-- /.box-header -->
              <div class="card shadow mb-4">
                    <div class="card-header py-3">
                      <h6 class="m-0 font-weight-bold text-primary">Data siswa</h6>
                    </div>
                  <div class="card-body">
                    <a href="#"> <button type="button" data-toggle="modal" data-target="#tambahsiswa" class="btn btn-sm btn-primary mb-2"><i class = "fa fa-plus"> Tambah Data </i></button> </a>
                  <div class="table-responsive">
                   <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>No</th>
                        <th>NIS</th>
                        <th>Nama Lengkap</th>
                        <th>Kelas</th>
                        <th>Tahun Ajaran</th>
                        <th><center>Aksi</center></th>
                    </tr>
                  </thead>
                 
                  <tbody>
                    <?php
                    $tampil=mysqli_query($koneksi,"SELECT * FROM `siswa`,`kelas`,`tahun` where siswa.id_kelas=kelas.id_kelas and siswa.id_tahun=tahun.id_tahun order by siswa.id_siswa desc");
                    $no = 1;
                      while ($r=mysqli_fetch_array($tampil)){
                    ?>
                    <tr>
                       <td><?php echo $no++ ;?></td>
                        <td><?php echo "$r[nis]"?></td>
                        <td><?php echo "$r[nama_siswa]"?></td>
                        <td><?php echo "$r[nama_kelas]"?></td>
                        <td><?php echo "$r[nama_tahun]"?></td>
                        <td>
                              <a href="#"><button class="btn btn-warning btn-sm" data-toggle="modal" data-target="#detailsiswa<?php echo $r['id_siswa'] ?>">
                                        <i class="fas fa-search-plus"></i>
                                      </button></a> 
                              <a href="?module=siswa&act=edit&id=<?php echo $r['id_siswa'] ?>"><button class="btn btn-primary btn-sm">
                                <i class="fas fa-edit"></i>
                              </button></a> 

                              <a href="?module=siswa&act=delete&id=<?php echo $r['nis']?>"><button  class="btn btn-danger btn-sm" onclick="return confirm('Apakah anda yakin?');">
                                <i class="fas fa-trash"></i>
                              </button></a> 

                                       <div class="modal fade" id="detailsiswa<?php echo $r['id_siswa'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                  <div class="modal-content">
                                    <div class="modal-header">
                                      <h5 class="modal-title" id="exampleModalLabel">Detail Data siswa</h5>
                                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                      </button>
                                    </div>
                                    <div class="modal-body">
                                      <center><img class="img rounded-circle" src="img/<?php echo $r['foto'] ?>" width="100"></center>
                                      <table class="table">
                                        <tr>
                                          <th colspan="3">
                                              <center>Detail Biodata</center>
                                          </th>
                                        </tr>
                                        <tr>
                                          <td>NIS</td>
                                          <td>:</td>
                                          <td><?php echo $r['nis'] ?></td>
                                        </tr>
                                         <tr>
                                          <td>Nama Lengkap</td>
                                          <td>:</td>
                                          <td><?php echo $r['nama_siswa'] ?></td>
                                        </tr>
                                         <tr>
                                          <td>Kelas</td>
                                          <td>:</td>
                                          <td><?php echo $r['nama_kelas'] ?></td>
                                        </tr>
                                         <tr>
                                          <td>Jenis Kelamin</td>
                                          <td>:</td>
                                          <td><?php echo $r['jk'] ?></td>
                                        </tr>
                                         <tr>
                                          <td>No Handphone</td>
                                          <td>:</td>
                                          <td>+62<?php echo $r['no_hp'] ?></td>
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
              
    </div><!-- /.container -->

    <div class="modal fade" id="tambahsiswa" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Form Tambah siswa</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="media.php?module=siswa&act=add" method="post" enctype="multipart/form-data">
            <div class="form-group">
                          <label for="exampleInputEmail1">NIS</label>
                          <input type="text" class="form-control" id="nis" name="nis" placeholder="NIS siswa" required data-fv-notempty-message="Tidak boleh kosong">
            </div>
            <div class="form-group">
                          <label for="exampleInputEmail1">Nama siswa</label>
                          <input type="text" class="form-control" id="nama" name="nama" placeholder="Nama siswa" required data-fv-notempty-message="Tidak boleh kosong">
            </div>
            <div class="form-group">
                          <label for="exampleInputEmail1">No HP</label>
                          <input type="number" class="form-control" id="nama" name="no_hp" placeholder="Nomor Handphone" required data-fv-notempty-message="Tidak boleh kosong">
            </div>
            <div class="form-group">
                          <label for="exampleInputEmail1">Jenis Kelamin</label><br>
                          <input type="radio" name="jk" value="Laki-laki"> Laki-laki
                          <input type="radio" name="jk" value="Perempuan"> Perempuan
            </div>
            <div class="form-group">
                          <label for="exampleInputEmail1">Kelas</label>
                          <select name="kelas" class="form-control" required="">
                            <option value="">-Pilih Kelas-</option>
                            <?php 
                            $sql = mysqli_query($koneksi,"select * from kelas");
                            while ($da = mysqli_fetch_array($sql)) {
                              ?> 
                              <option value="<?php echo $da['id_kelas'] ?>"><?php echo $da['nama_kelas'] ?></option>
                               <?php
                            }
                             ?>
                          </select>
            </div>
            <div class="form-group">
                          <label for="exampleInputEmail1">Tahun Ajaran</label>
                          <select name="tahun" class="form-control" required="">
                            <option value="">-Pilih Tahun-</option>
                            <?php 
                            $sql = mysqli_query($koneksi,"select * from tahun");
                            while ($da = mysqli_fetch_array($sql)) {
                              ?> 
                              <option value="<?php echo $da['id_tahun'] ?>"><?php echo $da['nama_tahun'] ?></option>
                               <?php
                            }
                             ?>
                          </select>
            </div>
            <div class="form-group">
                          <label for="exampleInputEmail1">Foto</label>
                          <input type="file" class="form-control" id="nama" name="gambar" placeholder="Nomor Handphone" required data-fv-notempty-message="Tidak boleh kosong">
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
      
                $sumber = @$_FILES['gambar']['tmp_name'];
                $target ='img/';
                $nama_gambar = @$_FILES['gambar']['name'];


                $cek = mysqli_query($koneksi,"select * from siswa where nis='$_POST[nis]'");
                $gt = mysqli_num_rows($cek);
    if ($gt !='1') 
    {
          $pindah = move_uploaded_file($sumber, $target.$nama_gambar);
          if ($pindah)
          {
                  mysqli_query($koneksi,"INSERT INTO siswa VALUES (NULL,'$_POST[nis]','$_POST[nama]','$_POST[no_hp]','$_POST[jk]','$nama_gambar','$_POST[kelas]','$_POST[tahun]')");
                  mysqli_query($koneksi,"insert into user values(null,'$_POST[nis]','$_POST[nis]','siswa')");
                  
              
                 ?> 
                <script type="text/javascript">
                    alert ("Data Berhasil Disimpan");
                    window.location.href="media.php?module=siswa&act=view";
                </script>
            <?php
          }else{
            ?> 
                <script type="text/javascript">
                    alert ("eror");
                    window.location.href="media.php?module=siswa&act=view";
                </script>
            <?php
          }
      }else{
                  ?> 
                <script type="text/javascript">
                    alert ("NIS sudah ada");
                    window.location.href="media.php?module=siswa&act=view";
                </script>
            <?php
          }
            
      break;
      // PROSES EDIT DATA kasmasuk //
      case 'edit':
      $sumber = @$_FILES['gambar']['tmp_name'];
                 $target ='img/';
                 $nama_gambar = @$_FILES['gambar']['name'];
      $d = mysqli_fetch_array(mysqli_query($koneksi,"SELECT * FROM `siswa`,`kelas`,`tahun` where siswa.id_kelas=kelas.id_kelas and siswa.id_tahun=tahun.id_tahun and siswa.id_siswa='$_GET[id]'"));
      if(isset($_POST['ubah'])){
        if ($nama_gambar=='') 
              {
                mysqli_query($koneksi,"UPDATE siswa SET 
                  nis='$_POST[nis]',
                  nama_siswa='$_POST[nama]',
                  jk='$_POST[jk]',
                  no_hp='$_POST[no_hp]',
                  id_tahun='$_POST[tahun]',
                  id_kelas='$_POST[kelas]' WHERE id_siswa='$_GET[id]'");
                ?> 
                <script type="text/javascript">
                    
                    alert ("Data Berhasil Diubah");
                    window.location.href="media.php?module=siswa&act=view";
                </script>
                <?php
              }else
              {
                 
                 $pindah = move_uploaded_file($sumber, $target.$nama_gambar);
                  if ($pindah)
                  
                  {
                   mysqli_query($koneksi,"UPDATE siswa SET 
                  nis='$_POST[nis]',
                  nama_siswa='$_POST[nama]',
                  jk='$_POST[jk]',
                  no_hp='$_POST[no_hp]',
                  id_tahun='$_POST[tahun]',
                  id_kelas='$_POST[kelas]',foto='$nama_gambar' WHERE id_siswa='$_GET[id]'");
                    ?> 
                    <script type="text/javascript">
                        
                        alert ("Data Berhasil Diubah");
                        window.location.href="media.php?module=siswa&act=view";
                    </script>
                    <?php
                  }
              }
      }
            
              ?>

<div class="content-wrapper">
        <!-- Content Header (Page header) -->
        
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="?module=home">Home</a></li>
            <li class="breadcrumb-item"><a href="?module=siswa&act=view">Data siswa</a></li>
            <li class="breadcrumb-item active" aria-current="page">Edit Data siswa</li>
          </ol>
        </nav>

<!-- Main content -->
<section class="content">
  <div class="row">
    <div class="col-md-12">
              <!-- general form elements -->
              <div class="card shadow mb-4">
                    <div class="card-header py-3">
                      <h6 class="m-0 font-weight-bold text-primary">Edit Data siswa</h6>
                    </div>
                  <div class="card-body">
                  <!-- form start -->
                <form role="form" method = "POST" action="" enctype="multipart/form-data">
                 <div class="form-group">
                      <div class="form-group">
                          <label for="exampleInputEmail1">nis</label>
                          <input type="text" class="form-control" id="nis" name="nis" value="<?php echo $d['nis'] ?>" required data-fv-notempty-message="Tidak boleh kosong">
            </div>
            <div class="form-group">
                          <label for="exampleInputEmail1">Nama siswa</label>
                          <input type="text" class="form-control" id="nama" name="nama" value="<?php echo $d['nama_siswa'] ?>" required data-fv-notempty-message="Tidak boleh kosong">
            </div>
            <div class="form-group">
                          <label for="exampleInputEmail1">No HP</label>
                          <input type="number" class="form-control" id="nama" name="no_hp" value="<?php echo $d['no_hp'] ?>" required data-fv-notempty-message="Tidak boleh kosong">
            </div>
            <div class="form-group">
                          <label for="exampleInputEmail1">Jenis Kelamin</label><br>
                          <input type="radio" name="jk" value="Laki-laki" <?php if($d['jk']=='Laki-laki'){echo"checked";}else{} ?>> Laki-laki
                          <input type="radio" name="jk" value="Perempuan" <?php if($d['jk']=='Perempuan'){echo"checked";}else{} ?>> Perempuan
            </div>
            <div class="form-group">
                          <label for="exampleInputEmail1">Kelas</label>
                          <select name="kelas" class="form-control" required="">
                            <option value="">-Pilih Kelas-</option>
                            <?php 
                            $sql = mysqli_query($koneksi,"select * from kelas");
                            while ($da = mysqli_fetch_array($sql)) {
                              ?> 
                              <option value="<?php echo $da['id_kelas'] ?>" 
                                <?php 
                                if ($da['id_kelas']==$d['id_kelas']) {
                                  echo"selected";
                                }else{

                                }
                                 ?>
                                ><?php echo $da['nama_kelas'] ?></option>
                               <?php
                            }
                             ?>
                          </select>
            </div>
            <div class="form-group">
                          <label for="exampleInputEmail1">Tahun Ajaran</label>
                          <select name="tahun" class="form-control" required="">
                            <option value="">-Pilih Tahun-</option>
                            <?php 
                            $sql = mysqli_query($koneksi,"select * from tahun");
                            while ($da = mysqli_fetch_array($sql)) {
                              ?> 
                              <option value="<?php echo $da['id_tahun'] ?>" 
                                <?php 
                                if ($da['id_tahun']==$d['id_tahun']) {
                                  echo"selected";
                                }else{

                                }
                                 ?>
                                ><?php echo $da['nama_tahun'] ?></option>
                               <?php
                            }
                             ?>
                          </select>
            </div>
           
            <div class="form-group">
                          <label for="exampleInputEmail1">Foto</label>
                          <input type="file" class="form-control" id="nama" name="gambar" placeholder="Nomor Handphone" >
            </div>
                  
                 
                    
<button type="submit" name = 'ubah' class="btn btn-primary">Ubah Data</button>


              </div><!-- /.box -->
              </div> <!-- /.col -->

              </div> <!-- /.row -->

          
            <!-- Tombol Bagian Bawah -->

            <div class="row">
            <!-- left column -->

              
              
                  
            </form>
                  </div><!-- /.box-body -->
              </div><!-- /.box -->
              
</div><!-- /.content-wrapper -->


    <?php
    break;

    case 'update':
      $sumber = @$_FILES['gambar']['tmp_name'];
                 $target ='img/';
                 $nama_gambar = @$_FILES['gambar']['name'];
      $d = mysqli_fetch_array(mysqli_query($koneksi,"SELECT * FROM `siswa`,`kelas`,`tahun` where siswa.id_kelas=kelas.id_kelas and siswa.id_tahun=tahun.id_tahun and siswa.nis='$_SESSION[username]'"));
      if(isset($_POST['ubah'])){
        if ($_POST['password']=='') 
              {
                mysqli_query($koneksi,"UPDATE siswa SET 
                  nis='$_POST[nis]',
                  nama_siswa='$_POST[nama]',
                  no_hp='$_POST[no_hp]' where siswa.nis='$_SESSION[username]'");
                ?> 
                <script type="text/javascript">
                    
                    alert ("Data Berhasil Diubah");
                    window.location.href="media.php?module=home";
                </script>
                <?php
              }else
              {
                 
                 
                   mysqli_query($koneksi,"UPDATE siswa SET 
                  nis='$_POST[nis]',
                  nama_siswa='$_POST[nama]',
                  no_hp='$_POST[no_hp]' where siswa.nis='$_SESSION[username]'");

                   mysqli_query($koneksi,"update user set password='$_POST[passwprd]' where username='$_SESSION[username]'");
                    ?> 
                    <script type="text/javascript">
                        
                        alert ("Data Berhasil Diubah");
                        window.location.href="media.php?module=home";
                    </script>
                    <?php
              }
              
      }
            
              ?>

<div class="content-wrapper">
        <!-- Content Header (Page header) -->
        
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="?module=home">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Edit Profil Saya</li>
          </ol>
        </nav>

<!-- Main content -->
<section class="content">
  <div class="row">
    <div class="col-md-12">
              <!-- general form elements -->
              <div class="card shadow mb-4">
                    <div class="card-header py-3">
                      <h6 class="m-0 font-weight-bold text-primary">Edit Data Profil</h6>
                    </div>
                  <div class="card-body">
                  <!-- form start -->
                <form role="form" method = "POST" action="" enctype="multipart/form-data">
                 <div class="form-group">
                      <div class="form-group">
                          <label for="exampleInputEmail1">nis</label>
                          <input type="text" class="form-control" id="nis" name="nis" value="<?php echo $d['nis'] ?>" readonly required data-fv-notempty-message="Tidak boleh kosong">
            </div>
            <div class="form-group">
                          <label for="exampleInputEmail1">Nama siswa</label>
                          <input type="text" class="form-control" id="nama" name="nama" value="<?php echo $d['nama_siswa'] ?>" readonly required data-fv-notempty-message="Tidak boleh kosong">
            </div>
            <div class="form-group">
                          <label for="exampleInputEmail1">No HP</label>
                          <input type="number" class="form-control" id="nama" name="no_hp" value="<?php echo $d['no_hp'] ?>" required data-fv-notempty-message="Tidak boleh kosong">
            </div>

            <div class="form-group">
                          <label for="exampleInputEmail1">Password</label>
                          <input type="password" class="form-control" id="nama" name="password" placeholder="kosongkan jika tidak perlu...">
            </div>
            
         
                  
                 
                    
<button type="submit" name = 'ubah' class="btn btn-primary">Ubah Data</button>


              </div><!-- /.box -->
              </div> <!-- /.col -->

              </div> <!-- /.row -->

          
            <!-- Tombol Bagian Bawah -->

            <div class="row">
            <!-- left column -->

              
              
                  
            </form>
                  </div><!-- /.box-body -->
              </div><!-- /.box -->
             


    <?php
    break;

    // PROSES HAPUS DATA PENGGUNA //
      case 'delete':
      mysqli_query($koneksi,"DELETE FROM siswa WHERE nis='$_GET[id]'");
      mysqli_query($koneksi,"DELETE FROM user WHERE username='$_GET[id]'");
      echo "<script>window.location='media.php?module=siswa&act=view'</script>";
      break;

    }
    ?>