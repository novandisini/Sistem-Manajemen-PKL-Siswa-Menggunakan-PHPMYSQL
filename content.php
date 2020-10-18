<?php
include "koneksi.php";

// Bagian Home
if ($_GET[module]=='home'){
  include"modul/home.php";
}
elseif ($_GET[module]=='profil'){
    include "modul/profil.php";
}
elseif ($_GET[module]=='tahun'){
    include "modul/tahun.php";
}
elseif ($_GET[module]=='kelas'){
    include "modul/kelas.php";
}
elseif ($_GET[module]=='siswa'){
    include "modul/siswa.php";
}
elseif ($_GET[module]=='pkl'){
    include "modul/pkl.php";
}
elseif ($_GET[module]=='laporan'){
    include "modul/laporan.php";
}
elseif ($_GET[module]=='repository'){
    include "modul/repository.php";
}

// Apabila modul tidak ditemukan
else{
  echo "<p><b>MODUL BELUM ADA ATAU BELUM LENGKAP</b></p>";
}
?>
