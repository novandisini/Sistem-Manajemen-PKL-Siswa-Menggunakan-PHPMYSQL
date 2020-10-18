<div class="content-wrapper">
        <!-- Content Header (Page header) -->
        
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="?module=home">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
          </ol>
        </nav>

        <?php 
        if ($_SESSION['level']=='Tata Usaha') {
        	?> 
        	<div class="card shadow mb-4">
                    <div class="card-header py-3">
                      <h6 class="m-0 font-weight-bold text-primary">Dashboard </h6>
                    </div>
                  <div class="card-body">
                    <div class="row">
                    		<div class="col-xl-4 col-md-6 mb-4">
				              <div class="card border-left-success shadow h-100 py-2">
				                <div class="card-body">
				                  <div class="row no-gutters align-items-center">
				                    <div class="col mr-2">
				                      <div class="text-xs font-weight-bold text-primary text-uppercase mb-1"><a href="#">Data User</a></div>
				                      <?php 
				                      $sq = mysqli_num_rows(mysqli_query($koneksi,"select * from user"));
				                       ?>
				                      <div class="h5 mb-0 font-weight-bold text-gray-800">
				                      	<?php echo $sq ?></div>
				                    </div>
				                    <div class="col-auto">
				                      <i class="fas fa-users fa-2x text-gray-300"></i>
				                    </div>
				                  </div>
				                </div>
				              </div>
				            </div>

				            <div class="col-xl-4 col-md-6 mb-4">
				              <div class="card border-left-primary shadow h-100 py-2">
				                <div class="card-body">
				                  <div class="row no-gutters align-items-center">
				                    <div class="col mr-2">
				                      <div class="text-xs font-weight-bold text-primary text-uppercase mb-1"><a href="?module=area&act=view">Data Siswa</a></div>
				                      <?php 
				                      $sq = mysqli_num_rows(mysqli_query($koneksi,"select * from siswa"));
				                       ?>
				                      <div class="h5 mb-0 font-weight-bold text-gray-800">
				                      	<?php echo $sq ?></div>
				                    </div>
				                    <div class="col-auto">
				                      <i class="fas fa-users fa-2x text-gray-300"></i>
				                    </div>
				                  </div>
				                </div>
				              </div>
				            </div>

                    		<div class="col-xl-4 col-md-6 mb-4">
				              <div class="card border-left-danger shadow h-100 py-2">
				                <div class="card-body">
				                  <div class="row no-gutters align-items-center">
				                    <div class="col mr-2">
				                      <div class="text-xs font-weight-bold text-primary text-uppercase mb-1"><a href="?module=kelas&act=view">Data Kelas</a></div>
				                      <?php 
				                      $sq = mysqli_num_rows(mysqli_query($koneksi,"select * from kelas"));
				                       ?>
				                      <div class="h5 mb-0 font-weight-bold text-gray-800">
				                      	<?php echo $sq ?></div>
				                    </div>
				                    <div class="col-auto">
				                      <i class="fas fa-home fa-2x text-gray-300"></i>
				                    </div>
				                  </div>
				                </div>
				              </div>
				            </div>

				            <div class="col-xl-4 col-md-6 mb-4">
				              <div class="card border-left-primary shadow h-100 py-2">
				                <div class="card-body">
				                  <div class="row no-gutters align-items-center">
				                    <div class="col mr-2">
				                      <div class="text-xs font-weight-bold text-primary text-uppercase mb-1"><a href="?module=area&act=view">Tahun Ajaran</a></div>
				                      <?php 
				                      $sq = mysqli_num_rows(mysqli_query($koneksi,"select * from tahun"));
				                       ?>
				                      <div class="h5 mb-0 font-weight-bold text-gray-800">
				                      	<?php echo $sq ?></div>
				                    </div>
				                    <div class="col-auto">
				                      <i class="fas fa-database fa-2x text-gray-300"></i>
				                    </div>
				                  </div>
				                </div>
				              </div>
				            </div>

				            <div class="col-xl-4 col-md-6 mb-4">
				              <div class="card border-left-primary shadow h-100 py-2">
				                <div class="card-body">
				                  <div class="row no-gutters align-items-center">
				                    <div class="col mr-2">
				                      <div class="text-xs font-weight-bold text-primary text-uppercase mb-1"><a href="?module=area&act=view">Data PKL</a></div>
				                      <?php 
				                      $sq = mysqli_num_rows(mysqli_query($koneksi,"select * from pkl"));
				                       ?>
				                      <div class="h5 mb-0 font-weight-bold text-gray-800">
				                      	<?php echo $sq ?></div>
				                    </div>
				                    <div class="col-auto">
				                      <i class="fas fa-home fa-2x text-gray-300"></i>
				                    </div>
				                  </div>
				                </div>
				              </div>
				            </div>

				            <div class="col-xl-4 col-md-6 mb-4">
				              <div class="card border-left-primary shadow h-100 py-2">
				                <div class="card-body">
				                  <div class="row no-gutters align-items-center">
				                    <div class="col mr-2">
				                      <div class="text-xs font-weight-bold text-primary text-uppercase mb-1"><a href="?module=area&act=view">Data Repository</a></div>
				                      <?php 
				                      $sq = mysqli_num_rows(mysqli_query($koneksi,"select * from repository"));
				                       ?>
				                      <div class="h5 mb-0 font-weight-bold text-gray-800">
				                      	<?php echo $sq ?></div>
				                    </div>
				                    <div class="col-auto">
				                      <i class="fas fa-book fa-2x text-gray-300"></i>
				                    </div>
				                  </div>
				                </div>
				              </div>
				            </div>

				            

                    </div>
                   </div>
              </div>
        	 <?php
        } else if ($_SESSION['level']=='siswa') {
        	?> 
        	<?php 
        				$sq = mysqli_query($koneksi,"select * from `user`,`siswa`,`pkl`,`kelas`,`tahun` where siswa.id_kelas=kelas.id_kelas and tahun.id_tahun=siswa.id_tahun and user.username=siswa.nis and pkl.id_siswa=siswa.id_siswa and user.username='$_SESSION[username]'");
        				$d = mysqli_fetch_array($sq);
        				 ?>
        	<div class="row">
        		<div class="col-md-4">
        			<div class="card" style="width: 18rem;">
						  <img src="img/<?php echo $d['foto'] ?>" width="100%" class="card-img-top" alt="...">
						  <div class="card-body">
						  	
						    <h5 class="card-title"><center>SISWA</center></h5>
						    <ul class="list-group list-group-flush">
  							</ul>
						  </div>
						</div>
        		</div>
        		<div class="col-md-8">
        			<div class="card-body">
       					 <h5 class="card-title"><center>BIODATA</center></h5>
        			<table class="table">
        				<table class="table">
        					<tr>
        						<td>NIS</td>
        						<td>:</td>
        						<td><?php echo $d['nis'] ?></td>
        					</tr>
        					<tr>
        						<td>Nama Siswa</td>
        						<td>:</td>
        						<td><?php echo $d['nama_siswa'] ?></td>
        					</tr>
        					<tr>
        						<td>Kelas</td>
        						<td>:</td>
        						<td><?php echo $d['nama_kelas'] ?></td>
        					</tr>
        					<tr>
        						<td>Tahun Ajaran</td>
        						<td>:</td>
        						<td><?php echo $d['nama_tahun'] ?></td>
        					</tr>
        					<tr>
        						<td>No HP</td>
        						<td>:</td>
        						<td>+62<?php echo $d['no_hp'] ?></td>
        					</tr>
        					<tr>
        						<td>Tempat PKL</td>
        						<td>:</td>
        						<td><?php echo $d['tempat_pkl'] ?></td>
        					</tr>
        					<tr>
        						<td>Alamat PKL</td>
        						<td>:</td>
        						<td><?php echo $d['alamat_pkl'] ?></td>
        					</tr>
        					<tr>
        						<td>Tanggal Mulai</td>
        						<td>:</td>
        						<td><?php echo tgl_indo($d['tanggal_mulai']) ?></td>
        					</tr>
        				</table>
        			</table>
        			</div>
        		</div>
        	</div>
        	 <?php
        }else {
        	?> 
        	<img src="img/simpan.jpg">
        	 <?php
        }
         ?>
        

        
</div>