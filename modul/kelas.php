<?php
//if(empty($_SESSION['kelasname'])){
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
            <li class="breadcrumb-item active" aria-current="page">Data kelas</li>
          </ol>
        </nav>



  <div class="card shadow mb-4">
     <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Data kelas</h6>
      </div>
      <div class="card-body">
                    <a href="#"> <button type="button" data-toggle="modal" data-target="#tambahkelas" class="btn btn-sm btn-primary mb-2"><i class = "fa fa-plus"> Tambah Data </i></button> </a>
                 
          <div class="table-responsive">
                  <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                      <tr>
                        <th>No</th>
                        <th>Nama kelas</th>
                        <th>Aksi</th>
                      </tr>
                    </thead>
                    <tbody>
                    <?php
                    $tampil=mysqli_query($koneksi,"SELECT * FROM `kelas` order by kelas.id_kelas desc");
                    $no = 1;
                      while ($r=mysqli_fetch_array($tampil)){
                    ?>
                        <tr>
                        <td><?php echo $no++ ;?></td>
                        <td><?php echo "$r[nama_kelas]"?></td>
                       
                        <td><a href="?module=kelas&act=edit&id=<?php echo $r['id_kelas']?>"><button type="button" class="btn btn-sm bg-warning"><i class="fa fa-edit"></i></button></a>
                        <a href="?module=kelas&act=delete&id=<?php echo $r['id_kelas']?>"><button type="button" class="btn btn-sm btn-danger" onclick="return confirm('Apakah anda yakin akan menghapusnya?');"><i class = "fa fa-trash"></i></button></a></td>
                        </tr>

                    <?php
                    }
                    ?>
                    </tbody>
                  </table>
            </div><!-- /.responsive -->
      </div>
    </div><!-- /.box -->
             

    <div class="modal fade" id="tambahkelas" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Form Tambah kelas</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <form action="media.php?module=kelas&act=add" method="post">
                  <div class="form-group">
                                <label for="exampleInputEmail1">Nama kelas</label>
                                <input type="text" class="form-control" id="nama" name="nama_kelas" placeholder="Nama kelas" required data-fv-notempty-message="Tidak boleh kosong">
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
  </div>

      <?php
      break;
      // PROSES TAMBAH DATA kasmasuk //
      case 'add':
      
                $query = mysqli_query($koneksi,"INSERT INTO kelas VALUES (null,'$_POST[nama_kelas]')");
                 ?> 
                <script type="text/javascript">
                    
                    alert ("Data Berhasil Disimpan");
                    window.location.href="media.php?module=kelas&act=view";
                </script>
            <?php
            
      break;
      // PROSES EDIT DATA kasmasuk //
      case 'edit':
      $d = mysqli_fetch_array(mysqli_query($koneksi,"SELECT * FROM `kelas` WHERE id_kelas='$_GET[id]'"));
            if (isset($_POST['update'])) {

                mysqli_query($koneksi,"UPDATE kelas SET nama_kelas='$_POST[nama_kelas]' WHERE id_kelas='$_GET[id]'");
                ?> 
                <script type="text/javascript">
                    
                    alert ("Data Berhasil Diubah");
                    window.location.href="media.php?module=kelas&act=view";
                </script>
            <?php
                
          }
              ?>

<div class="content-wrapper">
        <!-- Content Header (Page header) -->
       
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="?module=home">Home</a></li>
            <li class="breadcrumb-item"><a href="?module=kelas&act=view">Data kelas</a></li>
            <li class="breadcrumb-item active" aria-current="page">Edit Data kelas</li>
          </ol>
        </nav>

<!-- Main content -->
 <div class="card shadow mb-4">
      <div class="card-header py-3">
          <h6 class="m-0 font-weight-bold text-primary">Edit Data kelas</h6>
      </div>
      <div class="card-body">
                  <!-- form start -->
                <form role="form" method = "POST" action="">
                 <div class="form-group">
                      <label for="exampleInputEmail1">Nama kelas</label>
                      <input type="text" class="form-control" id="nama" value="<?php echo $d['nama_kelas'] ?>" name="nama_kelas" placeholder="Nama kelas" required data-fv-notempty-message="Tidak boleh kosong">
                  </div>
                  
                 
                    
                      <button type="submit" name = 'update' class="btn btn-primary">Ubah Data</button>


      </div><!-- /.card box -->
  </div> <!-- /.card -->

</div> <!-- /.wrapper -->

     


    <?php
    break;

    // PROSES HAPUS DATA PENGGUNA //
      case 'delete':
      mysqli_query($koneksi,"DELETE FROM kelas WHERE id_kelas='$_GET[id]'");
      echo "<script>window.location='media.php?module=kelas&act=view'</script>";
      break;

    }
    ?>