<?php 

include "koneksi.php";

 

    

    if (isset($_GET['input'])) {

        @$input = $_GET['input'];
		
        $query = mysqli_query($koneksi,"SELECT id_siswa,nis,nama_siswa,nama_kelas from siswa,kelas
		WHERE siswa.id_kelas=kelas.id_kelas and siswa.nis LIKE '%$input%'"); //query mencari hasil search

        if ($query === FALSE) {

    die(mysqli_error());

}

        $hasil = mysqli_num_rows($query);

        if ($hasil > 0)

        {
            ?> 
            <table class="table">
                <tr>
                    <th>No</th>
                    <th>NIS</th>
                    <th>Nama Siswa</th>
                    <th>Nama Kelas</th>
                    <th>Pilih</th>
                </tr>
             <?php
			 $no = 1;
            while ($data = mysqli_fetch_row($query)) {

            ?>
            <tr>
                <td><?=$no++?></td>
                <td><?=$data[1]?></td>
                <td><?=$data[2]?></td>
                <td><?=$data[3]?></td>
                <td><a href="javascript:autoInsert('<?=$data[0]?>','<?=$data[1]?>','<?=$data[2]?>','<?=$data[3]?>');"><button class="btn btn-primary">Pilih</button></a></td>
            </tr>

            
             

            <?php

            }  
            ?> 
            </table>
             <?php  

        }

    } 

?>