<?php
include("koneksi.php");
$nip = $_GET['x'];
$sql = "delete from pegawai where nip='$nip'";
$aksi = mysqli_query($koneksi, $sql);
if($aksi) {
header("location:../dashboard/pegawai.php");
}