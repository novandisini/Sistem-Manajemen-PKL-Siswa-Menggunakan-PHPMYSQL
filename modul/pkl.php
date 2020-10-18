<?php
//if(empty($_SESSION['pklname'])){
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
            <li class="breadcrumb-item active" aria-current="page">Data pkl</li>
          </ol>
        </nav>



  <div class="card shadow mb-4">
     <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Data pkl</h6>
      </div>
      <div class="card-body">
                    <a href="#"> <button type="button" data-toggle="modal" data-target="#tambahpkl" class="btn btn-sm btn-primary mb-2"><i class = "fa fa-plus"> Tambah Data </i></button> </a>
                 
          <div class="table-responsive">
                  <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                      <tr>
                        <th>No</th>
                        <th>NIS</th>
                        <th>Nama Siswa</th>
                        <th>Kelas</th>
                        <th>Tahun Ajaran</th>
                        <th>Tanggal Mulai</th>
                        <th>Tempat PKL</th>
                        <th>Alamat</th>
                        <th>Aksi</th>
                      </tr>
                    </thead>
                    <tbody>
                    <?php
                    $tampil=mysqli_query($koneksi,"SELECT * FROM `pkl`,`tahun`,`siswa`,`kelas` where pkl.id_siswa=siswa.id_siswa and tahun.id_tahun=siswa.id_tahun and siswa.id_kelas=kelas.id_kelas order by pkl.id_pkl desc");
                    $no = 1;
                      while ($r=mysqli_fetch_array($tampil)){
                    ?>
                        <tr>
                        <td><?php echo $no++ ;?></td>
                        <td><?php echo "$r[nis]"?></td>
                        <td><?php echo "$r[nama_siswa]"?></td>
                        <td><?php echo "$r[nama_kelas]"?></td>
                        <td><?php echo "$r[nama_tahun]"?></td>
                        <td><?php echo "$r[tanggal_mulai]"?></td>
                        <td><?php echo "$r[tempat_pkl]"?></td>
                        <td><?php echo "$r[alamat_pkl]"?></td>
                       
                        <td><a href="?module=pkl&act=edit&id=<?php echo $r['id_pkl']?>"><button type="button" class="btn btn-sm bg-warning"><i class="fa fa-edit"></i></button></a>
                        <a href="?module=pkl&act=delete&id=<?php echo $r['id_pkl']?>"><button type="button" class="btn btn-sm btn-danger" onclick="return confirm('Apakah anda yakin akan menghapusnya?');"><i class = "fa fa-trash"></i></button></a></td>
                        </tr>

                    <?php
                    }
                    ?>
                    </tbody>
                  </table>
            </div><!-- /.responsive -->
      </div>
    </div><!-- /.box -->
    

    <script language="JavaScript">

    var ajaxRequest;

    function getAjax() { //fungsi untuk mengecek AJAX pada browser

        try {

            ajaxRequest = new XMLHttpRequest();

        } catch (e) {

            try {

                ajaxRequest = new ActiveXObject("Msxml2.XMLHTTP");

            }

            catch (e) {

                try {

                    ajaxRequest = new ActiveXObject("Microsoft.XMLHTTP");

                } catch (e) {

                    alert("Your browser broke!");

                    return false;

                }

            }

        }

    }

    function autoComplete() { //fungsi menangkap input search dan menampilkan hasil search

        getAjax();

        input = document.getElementById('inputan').value;if (input == "") {

            document.getElementById("hasil").innerHTML = "";

        }

        else {

            ajaxRequest.open("GET","cari.php?input="+input);

            ajaxRequest.onreadystatechange = function() {

                document.getElementById("hasil").innerHTML = ajaxRequest.responseText;

            }

            ajaxRequest.send(null);

        }

    }

    function autoInsert(id_siswa,nis,nama_siswa,nama_kelas) { //fungsi mengisi input text dengan hasil pencarian yang dipilih

      document.getElementById("inputan").value = nis;
    document.getElementById("id").value = id_siswa;
    document.getElementById("nama_siswa").value = nama_siswa;
    document.getElementById("nama_kelas").value = nama_kelas;
        document.getElementById("hasil").innerHTML = "";

    }

</script>



    <div class="modal fade" id="tambahpkl" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Form Tambah PKL</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <div class="row">
                <div class="col-md-6">
                  <form action="media.php?module=pkl&act=add" method="post">
                              <input type="hidden" name="module" value="pkl">
                              <input type="hidden" name="act" value="add">
                              <input type="hidden" name="id" id="id">
                              <div class="form-group">
                                <label for="exampleInputEmail1">NIS Siswa</label>
                                <input type="text" class="form-control" id="inputan" name="nis" placeholder="NIS Siswa..." required data-fv-notempty-message="Tidak boleh kosong" onkeyup='autoComplete();'>
                              </div>
                    <div class="form-group">
                                <label for="exampleInputEmail1">Nama Siswa</label>
                                <input type="text" class="form-control" id="nama_siswa" name="nama_siswa" placeholder="Nama Siswa" readonly="" required data-fv-notempty-message="Tidak boleh kosong">
                              </div>
                    <div class="form-group">
                                <label for="exampleInputEmail1">Tempat PKL</label>
                                <input type="text" class="form-control" name="tempat_pkl" placeholder="Tempat PKL..." required data-fv-notempty-message="Tidak boleh kosong">
                              </div>
                    <div class="form-group">
                                <label for="exampleInputEmail1">Alamat PKL</label>
                                <textarea name="alamat_pkl" class="form-control" placeholder="Alamat PKL"></textarea>
                              </div>
                    <div class="form-group">
                                <label for="exampleInputEmail1">Tanggal Mulai</label>
                                <input type="date" class="form-control" name="tanggal_mulai" required data-fv-notempty-message="Tidak boleh kosong">
                              </div>
                   <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Simpan Data</button>
      </div>
                  </form>
                 
                </div>
            
            
            
                <div class="col-md-6">
                   <center><h3>Hasil Pencarian</h3></center>
                            <div id='hasil'></div>
                </div>
              </div>
              
          </div>
        </div>
    </div>
  </div>

      <?php
      break;
      // PROSES TAMBAH DATA kasmasuk //
      case 'add':
     $cek = mysqli_query($koneksi,"SELECT * FROM pkl where id_siswa='$_POST[id]'");
     $ok = mysqli_num_rows($cek);
     if ($ok==1) {
       ?> 
       <script type="text/javascript">
                    
                    alert ("Data tersebut dengan NIS sama");
                    window.location.href="media.php?module=pkl&act=view";
                </script>
        <?php
     }else{
      mysqli_query($koneksi,"INSERT INTO pkl VALUES (null,'$_POST[id]','$_POST[tempat_pkl]','$_POST[alamat_pkl]','$_POST[tanggal_mulai]')");
                 ?> 
                <script type="text/javascript">
                    
                    alert ("Data Berhasil Disimpan");
                    window.location.href="media.php?module=pkl&act=view";
                </script>
            

            <?php
     }

        
     

                
            
      break;
      // PROSES EDIT DATA kasmasuk //
      case 'edit':
      $d = mysqli_fetch_array(mysqli_query($koneksi,"SELECT * FROM `pkl`,`siswa` WHERE siswa.id_siswa=pkl.id_siswa and pkl.id_pkl='$_GET[id]'"));
            if (isset($_POST['update'])) {

                mysqli_query($koneksi,"UPDATE pkl SET alamat_pkl='$_POST[alamat_pkl]',tempat_pkl='$_POST[tempat_pkl]',tanggal_mulai='$_POST[tanggal_mulai]' WHERE id_pkl='$_GET[id]'");
                ?> 
                <script type="text/javascript">
                    
                    alert ("Data Berhasil Diubah");
                    window.location.href="media.php?module=pkl&act=view";
                </script>
            <?php
                
          }
              ?>

<div class="content-wrapper">
        <!-- Content Header (Page header) -->
       
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="?module=home">Home</a></li>
            <li class="breadcrumb-item"><a href="?module=pkl&act=view">Data pkl</a></li>
            <li class="breadcrumb-item active" aria-current="page">Edit Data pkl</li>
          </ol>
        </nav>

<!-- Main content -->
 <div class="card shadow mb-4">
      <div class="card-header py-3">
          <h6 class="m-0 font-weight-bold text-primary">Edit Data pkl</h6>
      </div>
      <div class="card-body">
                  <!-- form start -->
                <form role="form" method = "POST" action="">
                 <div class="form-group">
                                <label for="exampleInputEmail1">NIS</label>
                                <input type="text" class="form-control" id="nama_siswa" name="nama_siswa" value="<?php echo $d['nis'] ?>" readonly="" required data-fv-notempty-message="Tidak boleh kosong">
                              </div>
                    <div class="form-group">
                                <label for="exampleInputEmail1">Nama Siswa</label>
                                <input type="text" class="form-control" id="nama_siswa" name="nama_siswa" value="<?php echo $d['nama_siswa'] ?>" readonly="" required data-fv-notempty-message="Tidak boleh kosong">
                              </div>
                    <div class="form-group">
                                <label for="exampleInputEmail1">Tempat PKL</label>
                                <input type="text" class="form-control" name="tempat_pkl" value="<?php echo $d['tempat_pkl'] ?>" required data-fv-notempty-message="Tidak boleh kosong">
                              </div>
                    <div class="form-group">
                                <label for="exampleInputEmail1">Alamat PKL</label>
                                <textarea name="alamat_pkl" class="form-control" placeholder="Alamat PKL"><?php echo $d['alamat_pkl'] ?></textarea>
                              </div>
                    <div class="form-group">
                                <label for="exampleInputEmail1">Tanggal Mulai</label>
                                <input type="date" class="form-control" name="tanggal_mulai" required data-fv-notempty-message="Tidak boleh kosong" value="<?php echo $d['tanggal_mulai'] ?>">
                              </div>
                  
                 
                    
                      <button type="submit" name = 'update' class="btn btn-primary">Ubah Data</button>


      </div><!-- /.card box -->
  </div> <!-- /.card -->

</div> <!-- /.wrapper -->

     


    <?php
    break;

    // PROSES HAPUS DATA PENGGUNA //
      case 'delete':
      mysqli_query($koneksi,"DELETE FROM pkl WHERE id_pkl='$_GET[id]'");
      echo "<script>window.location='media.php?module=pkl&act=view'</script>";
      break;

    }
    ?>