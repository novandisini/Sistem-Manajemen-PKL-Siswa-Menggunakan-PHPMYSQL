<div class="content-wrapper">
        <!-- Content Header (Page header) -->
      
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="?module=home">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Laporan PKL</li>
          </ol>
        </nav>



  <div class="card shadow mb-4">
     <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Laporan PKL</h6>
      </div>
      <div class="card-body">
        <form action="" method="get">
        <table class="table">
            <tr>
              <td>Dari Tanggal</td>
              <td>:</td>
              <td><input type="date" name="dari" class="form-control" required=""></td>
            </tr>
            <tr>
              <td>Sampai Tanggal</td>
              <td>:</td>
              <td><input type="date" name="sampai" class="form-control" required=""></td>
            </tr>
            <tr>
              <td colspan="3"><input type="submit" name="lihat" value="Lihat Laporan" value="Lihat" class="btn btn-primary">
                <input type="hidden" name="module" value="laporan">
              </td>
            </tr>
        
        </table>
        </form>
        <?php 
        if ($_GET['lihat']=='') {
          # code...
        }else{
          ?> 
            <center><h5>Laporan PKL SMKN 1 Terbanggi Besar</h5></center>
            <center><h5>Dari <?php echo tgl_indo($_GET['dari']) ?> Sampai <?php echo tgl_indo($_GET['sampai']) ?></h5></center>
            <p align="right"><a href="cetak.php?dari=<?php echo $_GET[dari] ?>&sampai=<?php echo $_GET[sampai] ?>" target="_blank"><button class="btn btn-sm btn-primary"><i class="fas fa-print"></i> Cetak Laporan</button></a></p>
            <table class="table">
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
           <?php
        }

         ?>
      </div>
  </div>
</div>