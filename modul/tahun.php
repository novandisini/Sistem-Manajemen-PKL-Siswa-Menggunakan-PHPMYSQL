<?php
//if(empty($_SESSION['tahunname'])){
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
            <li class="breadcrumb-item active" aria-current="page">Data tahun</li>
          </ol>
        </nav>



  <div class="card shadow mb-4">
     <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Data tahun</h6>
      </div>
      <div class="card-body">
                    <a href="#"> <button type="button" data-toggle="modal" data-target="#tambahtahun" class="btn btn-sm btn-primary mb-2"><i class = "fa fa-plus"> Tambah Data </i></button> </a>
                 
          <div class="table-responsive">
                  <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                      <tr>
                        <th>No</th>
                        <th>Nama tahun</th>
                        <th>Aksi</th>
                      </tr>
                    </thead>
                    <tbody>
                    <?php
                    $tampil=mysqli_query($koneksi,"SELECT * FROM `tahun` order by tahun.id_tahun desc");
                    $no = 1;
                      while ($r=mysqli_fetch_array($tampil)){
                    ?>
                        <tr>
                        <td><?php echo $no++ ;?></td>
                        <td><?php echo "$r[nama_tahun]"?></td>
                       
                        <td><a href="?module=tahun&act=edit&id=<?php echo $r['id_tahun']?>"><button type="button" class="btn btn-sm bg-warning"><i class="fa fa-edit"></i></button></a>
                        <a href="?module=tahun&act=delete&id=<?php echo $r['id_tahun']?>"><button type="button" class="btn btn-sm btn-danger" onclick="return confirm('Apakah anda yakin akan menghapusnya?');"><i class = "fa fa-trash"></i></button></a></td>
                        </tr>

                    <?php
                    }
                    ?>
                    </tbody>
                  </table>
            </div><!-- /.responsive -->
      </div>
    </div><!-- /.box -->
             

    <div class="modal fade" id="tambahtahun" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Form Tambah tahun</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <form action="media.php?module=tahun&act=add" method="post">
                  <div class="form-group">
                                <label for="exampleInputEmail1">Nama tahun</label>
                                <input type="text" class="form-control" id="nama" name="nama_tahun" placeholder="Nama tahun" required data-fv-notempty-message="Tidak boleh kosong">
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
      
                $query = mysqli_query($koneksi,"INSERT INTO tahun VALUES (null,'$_POST[nama_tahun]')");
                 ?> 
                <script type="text/javascript">
                    
                    alert ("Data Berhasil Disimpan");
                    window.location.href="media.php?module=tahun&act=view";
                </script>
            <?php
            
      break;
      // PROSES EDIT DATA kasmasuk //
      case 'edit':
      $d = mysqli_fetch_array(mysqli_query($koneksi,"SELECT * FROM `tahun` WHERE id_tahun='$_GET[id]'"));
            if (isset($_POST['update'])) {

                mysqli_query($koneksi,"UPDATE tahun SET nama_tahun='$_POST[nama_tahun]' WHERE id_tahun='$_GET[id]'");
                ?> 
                <script type="text/javascript">
                    
                    alert ("Data Berhasil Diubah");
                    window.location.href="media.php?module=tahun&act=view";
                </script>
            <?php
                
          }
              ?>

<div class="content-wrapper">
        <!-- Content Header (Page header) -->
       
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="?module=home">Home</a></li>
            <li class="breadcrumb-item"><a href="?module=tahun&act=view">Data tahun</a></li>
            <li class="breadcrumb-item active" aria-current="page">Edit Data tahun</li>
          </ol>
        </nav>

<!-- Main content -->
 <div class="card shadow mb-4">
      <div class="card-header py-3">
          <h6 class="m-0 font-weight-bold text-primary">Edit Data tahun</h6>
      </div>
      <div class="card-body">
                  <!-- form start -->
                <form role="form" method = "POST" action="">
                 <div class="form-group">
                      <label for="exampleInputEmail1">Nama tahun</label>
                      <input type="text" class="form-control" id="nama" value="<?php echo $d['nama_tahun'] ?>" name="nama_tahun" placeholder="Nama tahun" required data-fv-notempty-message="Tidak boleh kosong">
                  </div>
                  
                 
                    
                      <button type="submit" name = 'update' class="btn btn-primary">Ubah Data</button>


      </div><!-- /.card box -->
  </div> <!-- /.card -->

</div> <!-- /.wrapper -->

     


    <?php
    break;

    // PROSES HAPUS DATA PENGGUNA //
      case 'delete':
      mysqli_query($koneksi,"DELETE FROM tahun WHERE id_tahun='$_GET[id]'");
      echo "<script>window.location='media.php?module=tahun&act=view'</script>";
      break;

    }
    ?>