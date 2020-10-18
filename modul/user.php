<?php
//if(empty($_SESSION['username'])){
//    echo "Not found!";
//} else {
    switch ($_GET['act']) {
    // PROSES VIEW DATA kasmasuk //      
      case 'view':
      ?>

<div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
        <h1> Data user </h1>
            <ol class="breadcrumb">
            <li><a href="?module=dashboard"><i class="fa fa-dashboard"></i> Beranda</a></li>
            <li class="active"><a href="?module=user&act=view">Data user</a></li>
             </ol>
        </section>

<!-- Main content -->
<section class="content">
	<div class="row">
		<div class="col-md-12">
    <div class="box-header">
    <a href="?module=user&act=add"> <button type="button" class="btn btn-primary"><i class = "fa fa-plus"> Tambah Data </i></button> </a>
    </div><!-- /.box-header -->
              <!-- general form elements -->
              <div class="box box-primary">
                  <div class="box-body">
                  <div class="table-responsive">
                  <table id="example1" class="table table-bordered table-striped">
                    <thead>
                      <tr>
                        <th>No</th>
                        <th>Nama Lengkap</th>
                        <th>Username</th>
						            <th>Level</th>
                        <th>Edit</th>
                        <th>Delete</th>
                      </tr>
                    </thead>
                    <tbody>
                    <?php
                    $tampil=mysqli_query($koneksi,"SELECT * FROM `user` order by user.id_user desc");
                    $no = 1;
                      while ($r=mysqli_fetch_array($tampil)){
                    ?>
                        <tr>
                        <td><?php echo $no++ ;?></td>
                        <td><?php echo "$r[nama_lengkap]"?></td>
                        <td><?php echo "$r[username]"?></td>
						<td><?php echo "$r[level]"?></td>
                       
                        <td><a href="?module=user&act=edit&id=<?php echo $r['id_user']?>"><button type="button" class="btn bg-warning"><i class="fa fa-pencil-square-o"></i> Edit</button></a></td>
                        <td><a href="?module=user&act=delete&id=<?php echo $r['id_user']?>"><button type="button" class="btn btn-danger" onclick="return confirm('Apakah anda yakin akan menghapusnya?');"><i class = "fa fa-trash-o"></i> Hapus</button></a></td>
                        </tr>

                    <?php
                    }
                    ?>
                    </tbody>
                  </table>
                  </div><!-- /.box-body -->
              </div>
              </div><!-- /.box -->
              </div> <!-- /.col -->
	</div>
    <!-- /.row (main row) -->
</section> <!-- /.content -->
    </div><!-- /.container -->

      <?php
      break;
      // PROSES TAMBAH DATA kasmasuk //
      case 'add':
      if (isset($_POST['add'])) {
        $password = md5($_POST['password']);
                $query = mysqli_query($koneksi,"INSERT INTO user VALUES (null,'$_POST[nama_lengkap]','$_POST[username]','$password','$_POST[level]')");
                 ?> 
                <script type="text/javascript">
                    
                    alert ("Data Berhasil Disimpan");
                    window.location.href="media.php?module=user&act=view";
                </script>
            <?php
              }
              ?>

<div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
        <h1> Tambah Data user </h1>
            <ol class="breadcrumb">
            <li><a href="?module=dashboard"><i class="fa fa-dashboard"></i> Beranda</a></li>
            <li class="active"><a href="?module=masuk&act=view">Data user</a></li>
            <li class="active"><a href="#">Tambah Data user</a></li>
             </ol>
        </section>

<!-- Main content -->
<section class="content">
  <div class="row">
    <div class="col-md-12">
              <!-- general form elements -->
              <div class="box box-primary">
                  <div class="box-body">
                  <!-- form start -->
                <form role="form" method = "POST" action="">
                  <div class="box-body">
                    <div class="form-group">
                      <label for="exampleInputEmail1">Nama Lengkap</label>
                      <input type="text" class="form-control" id="nama" name="nama_lengkap" placeholder="Nama Lengkap" required data-fv-notempty-message="Tidak boleh kosong">
                    </div>
                     <div class="form-group">
                      <label for="exampleInputEmail1">Username</label>
                      <input type="text" class="form-control" id="nama" name="username" placeholder="Username" required data-fv-notempty-message="Tidak boleh kosong">
                    </div>
                     <div class="form-group">
                      <label for="exampleInputEmail1">Password</label>
                      <input type="password" class="form-control" id="nama" name="password" placeholder="Password" required data-fv-notempty-message="Tidak boleh kosong">
                    </div>
                    <div class="form-group">
                      <label for="exampleInputEmail1">Level</label>
                      <select name="level" class="form-control" required="">
                        <option value="">-Pilih Level-</option>
                        <option>Admin</option>
                        <option>Pimpinan</option>
                      </select>
                     </div>
					  
                  
                   
                   
                  </div><!-- /.box-body -->

              </div><!-- /.box -->
              </div> <!-- /.col -->

              </div> <!-- /.row -->

          
            <!-- Tombol Bagian Bawah -->

            <div class="row">
            <!-- left column -->
              <div class="col-md-4 col-md-offset-5">

              <button type="submit" name = 'add' class="btn btn-primary">Simpan</button>
              &nbsp;
              <button type="reset" class="btn btn-success">Reset</button>
                  
            </form>
                  </div><!-- /.box-body -->
              </div><!-- /.box -->
              </div> <!-- /.col -->
  </div>
    <!-- /.row (main row) -->
</section> <!-- /.content -->
    </div><!-- /.container -->
</div><!-- /.content-wrapper -->


      <?php
      break;
      // PROSES EDIT DATA kasmasuk //
      case 'edit':
      $d = mysqli_fetch_array(mysqli_query($koneksi,"SELECT * FROM `user` WHERE id_user='$_GET[id]'"));
            if (isset($_POST['update'])) {
              $password = md5($_POST['password']);
              if ($_POST['password']=='') {
                mysqli_query($koneksi,"UPDATE user SET nama_lengkap='$_POST[nama_lengkap]',username='$_POST[username]',level='$_POST[level]' WHERE id_user='$_GET[id]'");
              }else{
                mysqli_query($koneksi,"UPDATE user SET nama_lengkap='$_POST[nama_lengkap]',password='$password',username='$_POST[username]',level='$_POST[level]' WHERE id_user='$_GET[id]'");
              }

                
                ?> 
                <script type="text/javascript">
                    
                    alert ("Data Berhasil Diubah");
                    window.location.href="media.php?module=user&act=view";
                </script>
            <?php
                
          }
              ?>

<div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
        <h1> Data user </h1>
            <ol class="breadcrumb">
            <li><a href="?module=dashboard"><i class="fa fa-dashboard"></i> Beranda</a></li>
            <li class="active"><a href="?module=user&act=view">Data user</a></li>
            <li class="active">Update Data user</li>
             </ol>
        </section>

<!-- Main content -->
<section class="content">
  <div class="row">
    <div class="col-md-12">
              <!-- general form elements -->
              <div class="box box-primary">
                  <div class="box-body">
                  <!-- form start -->
                <form role="form" method = "POST" action="">
                 <div class="box-body">
                    <div class="form-group">
                      <label for="exampleInputEmail1">Nama Lengkap</label>
                      <input type="text" class="form-control" id="nama" name="nama_lengkap" value="<?php echo $d['nama_lengkap'] ?>" required data-fv-notempty-message="Tidak boleh kosong">
                    </div>
                     <div class="form-group">
                      <label for="exampleInputEmail1">Username</label>
                      <input type="text" class="form-control" id="nama" name="username" value="<?php echo $d['username'] ?>" required data-fv-notempty-message="Tidak boleh kosong">
                    </div>
                     <div class="form-group">
                      <label for="exampleInputEmail1">Password</label>
                      <input type="password" class="form-control" id="nama" name="password" placeholder="Password">
                    </div>
                    <div class="form-group">
                      <label for="exampleInputEmail1">Level</label>
                      <select name="level" class="form-control" required="">
                        <option value="<?php echo $d['level'] ?>">-<?php echo $d['level'] ?>-</option>
                        <option>Admin</option>
                        <option>Pimpinan</option>
                      </select>
                     </div>
                 
                    



              </div><!-- /.box -->
              </div> <!-- /.col -->

              </div> <!-- /.row -->

          
            <!-- Tombol Bagian Bawah -->

            <div class="row">
            <!-- left column -->
              <div class="col-md-4 col-md-offset-5">

              <button type="submit" name = 'update' class="btn btn-primary">Update</button>
              &nbsp;
              <button type="reset" class="btn btn-success">Reset</button>
                  
            </form>
                  </div><!-- /.box-body -->
              </div><!-- /.box -->
              </div> <!-- /.col -->
  </div>
    <!-- /.row (main row) -->
</section> <!-- /.content -->
    </div><!-- /.container -->
</div><!-- /.content-wrapper -->


    <?php
    break;

    // PROSES HAPUS DATA PENGGUNA //
      case 'delete':
      mysqli_query($koneksi,"DELETE FROM user WHERE id_user='$_GET[id]'");
      echo "<script>window.location='media.php?module=user&act=view'</script>";
      break;

    }
    ?>