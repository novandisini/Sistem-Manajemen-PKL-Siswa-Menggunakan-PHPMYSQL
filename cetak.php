<?php 
error_reporting(0);
include"koneksi.php" ?>
<script type="text/javascript">
	window.print();
</script>
<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>SMK N 1 Terbanggi Besar.</title>

  <!-- Custom fonts for this template -->
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template -->
  <link href="css/sb-admin-2.min.css" rel="stylesheet">

  <!-- Custom styles for this page -->
  <link href="vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
 
</head>
  <div class="container-fluid">
    <hr width="100%" align="center">
  <?php 
  function tgl_indo($tanggal){
  $bulan = array (
    1 =>   'Januari',
    'Februari',
    'Maret',
    'April',
    'Mei',
    'Juni',
    'Juli',
    'Agustus',
    'September',
    'Oktober',
    'November',
    'Desember'
  );
  $pecahkan = explode('-', $tanggal);
  
  // variabel pecahkan 0 = tanggal
  // variabel pecahkan 1 = bulan
  // variabel pecahkan 2 = tahun
 
  return $pecahkan[2] . ' ' . $bulan[ (int)$pecahkan[1] ] . ' ' . $pecahkan[0];
}

   ?>
   <?php 
  $dari = tgl_indo($_GET['dari']);
  $sampai = tgl_indo($_GET['sampai']);
 ?>
 <center><h5>Laporan PKL SMKN 1 Terbanggi Besar</h5></center>
            <center><h5>Dari <?php echo tgl_indo($_GET['dari']) ?> Sampai <?php echo tgl_indo($_GET['sampai']) ?></h5></center>
<hr>
          <table class="table bordered">
             <tr>
                      <th>No</th>
                        <th>NIS</th>
                        <th>Nama Lengkap</th>
                        <th>Kelas</th>
                        <th>Tahun Ajaran</th>
                        <th>Tanggal Mulai</th>
                        <th>Tempat PKL</th>
                    </tr>
              <?php 
              $no = 1;
               $tampil=mysqli_query($koneksi,"SELECT * FROM `siswa`,`kelas`,`tahun`,`pkl` where siswa.id_siswa=pkl.id_siswa and siswa.id_kelas=kelas.id_kelas and siswa.id_tahun=tahun.id_tahun and pkl.tanggal_mulai between '$_GET[dari]' and '$_GET[sampai]' order by siswa.id_siswa desc");
             
              
              while ($r = mysqli_fetch_array($tampil)) {
                ?> 
                <tr>
                       <td><?php echo $no++ ;?></td>
                        <td><?php echo "$r[nis]"?></td>
                        <td><?php echo "$r[nama_siswa]"?></td>
                        <td><?php echo "$r[nama_kelas]"?></td>
                        <td><?php echo "$r[nama_tahun]"?></td>
                        <td><?php echo tgl_indo($r[tanggal_mulai])?></td>
                        <td><?php echo "$r[tempat_pkl]"?></td>
                </tr>
                 <?php
              }
               ?>
            </table>
<br>
<br>
<br>
<br>
<br>
<br>
<table align="center" width="100%" cellpadding="2">
    <tr>
      <br>
      <td align="center"><br>Kepala Sekolah,
      <br><br><br><br>
      ________________
      </td>
      <td width="20%"></td>
      <td align="center">
        <?php 
  $array_hari = array(1=>'Senin','Selasa','Rabu','Kamis','Jumat','Sabtu','Minggu');
  $hari = $array_hari[date('N')];

  $array_bulan = array(1=>'Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','Novemer','Desember');
  $bulan = $array_bulan[date('n')];

  $tgl = date('j');
  $thn = date('Y');

  echo $hari.", ".$tgl." ".$bulan." ".$thn ;
?>
<br>Mengetahui,
<br><br><br><br>________________<br><br><br></td>
    </tr>
  </table>
</div>

  <!-- Bootstrap core JavaScript-->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="js/sb-admin-2.min.js"></script>

  <!-- Page level plugins -->
  <script src="vendor/datatables/jquery.dataTables.min.js"></script>
  <script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>

  <!-- Page level custom scripts -->
  <script src="js/demo/datatables-demo.js"></script>

</body>

</html>