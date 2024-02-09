<?php
session_start();
include("koneksi.php");
$username = $_GET['x'];
if (isset($_POST['foto'])) {
  if ($_FILES['foto']['size'] > 0) {
    $rand = rand();
    $ekstensi =  array('png', 'jpg', 'jpeg', 'gif');
    $filename = $_FILES['foto']['name'];
    $ukuran = $_FILES['foto']['size'];
    $ext = pathinfo($filename, PATHINFO_EXTENSION);

    if (!in_array($ext, $ekstensi)) {
      header("location:profil.php?alert=gagal_ekstensi");
      exit();
    }

    if ($ukuran > 1044070) {
      header("location:profil.php?alert=gagal_ukuran");
      exit();
    }

    $xx = $rand . '_' . $filename;
    move_uploaded_file($_FILES['foto']['tmp_name'], 'gambar/' . $rand . '_' . $filename);

    // Update data with the new image
   
    $prosesfoto= mysqli_query($koneksi, "UPDATE admin SET foto='$xx' WHERE username='$username'");
if($prosesfoto){
  header('location:profil.php?alert=berhasil');
}
  }
}
?>