<?php
//if(empty($_SESSION['repositoryname'])){
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
            <li class="breadcrumb-item active" aria-current="page">Data repository</li>
          </ol>
        </nav>



  <div class="card shadow mb-4">
     <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Data repository</h6>
      </div>
      <div class="card-body">
        <?php 
        if ($_SESSION['level']=='siswa') {
          ?> 
          <a href="#"> <button type="button" data-toggle="modal" data-target="#tambahrepository" class="btn btn-sm btn-primary mb-2"><i class = "fa fa-plus"> Tambah Data </i></button> </a>
           <?php
        }else{

        }
         ?>
                    
                 
          <div class="table-responsive">
                  <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                      <tr>
                        <th>No</th>
                        <th>NIS</th>
                        <th>Nama Siswa</th>
                        <th>Tahun Ajaran</th>
                        <th>Tanggal Upload</th>
                        <th>Subjek repository</th>
                        <th>Aksi</th>
                      </tr>
                    </thead>
                    <tbody>
                    <?php
                    if ($_SESSION['level']=='siswa') {
                      $tampil=mysqli_query($koneksi,"SELECT * FROM `repository`,`siswa`,`tahun` where repository.nis=siswa.nis and siswa.id_tahun=tahun.id_tahun and siswa.nis='$_SESSION[username]' order by repository.id_repository desc");
                    }else{
                      $tampil=mysqli_query($koneksi,"SELECT * FROM `repository`,`siswa`,`tahun` where repository.nis=siswa.nis and siswa.id_tahun=tahun.id_tahun order by repository.id_repository desc");
                    }
                    
                    $no = 1;
                      while ($r=mysqli_fetch_array($tampil)){
                    ?>
                        <tr>
                        <td><?php echo $no++ ;?></td>
                        <td><?php echo "$r[nis]"?></td>
                        <td><?php echo "$r[nama_siswa]"?></td>
                        <td><?php echo "$r[nama_tahun]"?></td>
                        <td><?php echo tgl_indo($r[tanggal_upload])?></td>
                        <td><?php echo "$r[subjek]"?></td>
                       
                        <td> <a href="#"><button class="btn btn-warning btn-sm" data-toggle="modal" data-target="#detailrepository<?php echo $r['id_repository'] ?>">
                                        <i class="fas fa-search-plus"></i>
                                      </button></a> 
                                      <?php 
                                      if ($_SESSION['level']=='Tata Usaha') {
                                        ?> 
                                      

                              <a href="?module=repository&act=delete&id=<?php echo $r['id_repository']?>"><button  class="btn btn-danger btn-sm" onclick="return confirm('Apakah anda yakin?');">
                                <i class="fas fa-trash"></i>
                              </button></a> 
                                         <?php
                                      }else{

                                      }
                                       ?>
                                      

                             

                                       <div class="modal fade" id="detailrepository<?php echo $r['id_repository'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                  <div class="modal-content">
                                    <div class="modal-header">
                                      <h5 class="modal-title" id="exampleModalLabel">Detail Repository Siswa</h5>
                                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                      </button>
                                    </div>
                                    <div class="modal-body">
                                      
                                      <table class="table">
                                        <tr>
                                          <th colspan="3">
                                              <center>Detail Repository</center>
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
                                          <td>Tanggal Upload</td>
                                          <td>:</td>
                                          <td><?php echo tgl_indo($r['tanggal_upload']) ?></td>
                                        </tr>
                                        <tr>
                                          <td>Subjek</td>
                                          <td>:</td>
                                          <td><?php echo $r['subjek'] ?></td>
                                        </tr>
                                        <tr>
                                          <td colspan="3">Keterangan :
                                            <p><?php echo $r['keterangan'] ?></p>
                                          </td>
                                        </tr>
                                        <tr>
                                          <td>File</td>
                                          <td>:</td>
                                          <td><a href="img/<?php echo $r['file'] ?>">Download file</td>
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

                    <?php
                    }
                    ?>
                    </tbody>
                  </table>
            </div><!-- /.responsive -->
      </div>
    </div><!-- /.box -->
             

    <div class="modal fade" id="tambahrepository" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Form Tambah repository</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <form action="media.php?module=repository&act=add" method="post" enctype="multipart/form-data">
                  <div class="form-group">
                                <label for="exampleInputEmail1">Subjek</label>
                                <input type="text" class="form-control" id="nama" name="subjek" placeholder="Subjek repository" required data-fv-notempty-message="Tidak boleh kosong">
                              </div>
                  <div class="form-group">
                                <label for="exampleInputEmail1">Keterangan</label>
                                <textarea name="keterangan" class="form-control"></textarea>
                              </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">File</label>
                    <input type="file" name="gambar" class="form-control" required="">
                  </div> 
                </div>
            
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              <button type="submit" class="btn btn-primary">Kirim Data</button>
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
      
                

        $sumber = @$_FILES['gambar']['tmp_name'];
        $target ='img/';
        $nama_gambar = @$_FILES['gambar']['name'];

        
          $pindah = move_uploaded_file($sumber, $target.$nama_gambar);
          if ($pindah)
          {
          $date = date('Y-m-d');
                mysqli_query($koneksi,"INSERT INTO repository VALUES (null,'$_SESSION[username]','$_POST[subjek]','$_POST[keterangan]','$nama_gambar','$date')");
                 ?> 
                <script type="text/javascript">
                    
                    alert ("Data Berhasil Dikirim");
                    window.location.href="media.php?module=repository&act=view";
                </script>
            <?php
          }else{
            ?> 
                <script type="text/javascript">
                    alert ("Eror");
                    window.location.href="media.php?module=repository&act=view";
                </script>
            <?php
          }  
        
            
      break;
      // PROSES EDIT DATA kasmasuk //
      case 'edit':
      $d = mysqli_fetch_array(mysqli_query($koneksi,"SELECT * FROM `repository` WHERE id_repository='$_GET[id]'"));
            if (isset($_POST['update'])) {

                mysqli_query($koneksi,"UPDATE repository SET nama_repository='$_POST[nama_repository]' WHERE id_repository='$_GET[id]'");
                ?> 
                <script type="text/javascript">
                    
                    alert ("Data Berhasil Diubah");
                    window.location.href="media.php?module=repository&act=view";
                </script>
            <?php
                
          }
              ?>

<div class="content-wrapper">
        <!-- Content Header (Page header) -->
       
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="?module=home">Home</a></li>
            <li class="breadcrumb-item"><a href="?module=repository&act=view">Data repository</a></li>
            <li class="breadcrumb-item active" aria-current="page">Edit Data repository</li>
          </ol>
        </nav>

<!-- Main content -->
 <div class="card shadow mb-4">
      <div class="card-header py-3">
          <h6 class="m-0 font-weight-bold text-primary">Edit Data repository</h6>
      </div>
      <div class="card-body">
                  <!-- form start -->
                <form role="form" method = "POST" action="">
                 <div class="form-group">
                      <label for="exampleInputEmail1">Nama repository</label>
                      <input type="text" class="form-control" id="nama" value="<?php echo $d['nama_repository'] ?>" name="nama_repository" placeholder="Nama repository" required data-fv-notempty-message="Tidak boleh kosong">
                  </div>
                  
                 
                    
                      <button type="submit" name = 'update' class="btn btn-primary">Ubah Data</button>


      </div><!-- /.card box -->
  </div> <!-- /.card -->

</div> <!-- /.wrapper -->

     


    <?php
    break;

    // PROSES HAPUS DATA PENGGUNA //
      case 'delete':
      mysqli_query($koneksi,"DELETE FROM repository WHERE id_repository='$_GET[id]'");
      echo "<script>window.location='media.php?module=repository&act=view'</script>";
      break;

    }
    ?>