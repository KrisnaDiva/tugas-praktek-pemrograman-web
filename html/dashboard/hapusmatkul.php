<?php
include("koneksi.php");
$semester= $_GET['x'];
$sql = "delete from tb_matkul WHERE semester = '$semester'";
$proses = mysqli_query($koneksi,$sql);
if($proses){
    header('location:matkul.php');
}
