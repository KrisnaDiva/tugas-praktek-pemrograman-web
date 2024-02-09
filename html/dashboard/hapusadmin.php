<?php
include("koneksi.php");

$username = $_GET['x'];

// Mendapatkan informasi gambar sebelum dihapus
$query = mysqli_query($koneksi, "SELECT foto FROM admin WHERE username = '$username'");
$row = mysqli_fetch_assoc($query);
$gambar = $row['foto'];

// Menghapus data dari database
mysqli_query($koneksi, "DELETE FROM admin WHERE username = '$username'");

// Menghapus gambar dari folder
if (file_exists('gambar/' . $gambar)) {
    unlink('gambar/' . $gambar);
}

header("location: ../dashboard/admin.php");
?>
