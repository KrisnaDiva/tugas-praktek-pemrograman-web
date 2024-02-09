<!doctype html>
<?php
session_start();
include("koneksi.php");
$data = mysqli_query($koneksi, "SELECT * FROM admin WHERE username='" . $_SESSION['username'] . "'");
              $d = mysqli_fetch_array($data);
              
              if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                // Mendapatkan data file gambar yang diunggah
                $namaFile = $_FILES['foto']['name'];
                $ukuranFile = $_FILES['foto']['size'];
                $error = $_FILES['foto']['error'];
                $tmpFile = $_FILES['foto']['tmp_name'];
            
                // Memeriksa apakah ada file yang diunggah
                if ($error === 4) {
                    // Tidak ada file yang diunggah, lakukan tindakan yang sesuai
                    // misalnya menampilkan pesan error atau mengambil gambar default
                } else {
                    // File gambar diunggah, lakukan tindakan yang sesuai
                    // misalnya memindahkan file ke folder penyimpanan
            
                    // Tentukan folder penyimpanan gambar
                    $folderTujuan = 'gambar/';
            
                    // Hapus file gambar lama jika ada
                    $fileLama = $folderTujuan . $d['foto']; // Ganti $d['foto'] dengan kolom yang sesuai dalam database
                    if (file_exists($fileLama)) {
                        unlink($fileLama);
                    }
            
                    // Pindahkan file gambar baru ke folder penyimpanan
                    move_uploaded_file($tmpFile, $folderTujuan . $namaFile);
            
                    // Lakukan query untuk memperbarui data gambar dalam database
                    $query = "UPDATE admin SET foto = '$namaFile' WHERE username = '" . $_SESSION['username'] . "'";
            
                    // Eksekusi query menggunakan mysqli
                    mysqli_query($koneksi, $query);
            
                    // Arahkan pengguna ke halaman profil.php
                    header("Location: profil.php");
                    exit(); // Penting untuk menghentikan eksekusi skrip setelah mengarahkan pengguna
                }
            }
?>

<html lang="en" dir="ltr">

<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Admin</title>
 <style>
       .overlay {
      position: fixed;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      background-color: rgba(0, 0, 0, 0.5);
      z-index: 999;
      display: none;
    }
    .form-container {
      position: absolute;
      top: 50%;
      left: 50%;
      right: 10%;
      transform: translate(-50%, -50%);
      z-index: 1000;
      background-color: #fff;
      box-shadow: 0 0 0 2000px rgba(0, 0, 0, 0.5);
    }
    
  </style>
  <!-- Favicon -->
  <link rel="shortcut icon" href="../assets/images/favicon.ico" />

  <!-- Library / Plugin Css Build -->
  <link rel="stylesheet" href="../assets/css/core/libs.min.css" />

  <!-- Aos Animation Css -->
  <link rel="stylesheet" href="../assets/vendor/aos/dist/aos.css" />

  <!-- Hope Ui Design System Css -->
  <link rel="stylesheet" href="../assets/css/hope-ui.min.css?v=2.0.0" />

  <!-- Custom Css -->
  <link rel="stylesheet" href="../assets/css/custom.min.css?v=2.0.0" />

  <!-- Dark Css -->
  <link rel="stylesheet" href="../assets/css/dark.min.css" />

  <!-- Customizer Css -->
  <link rel="stylesheet" href="../assets/css/customizer.min.css" />

  <!-- RTL Css -->
  <link rel="stylesheet" href="../assets/css/rtl.min.css" />

  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">

</head>

<body class="  ">
  <!-- loader Start -->
  <div id="loading">
    <div class="loader simple-loader">
      <div class="loader-body"></div>
    </div>
  </div>
  <!-- loader END -->

  <aside class="sidebar sidebar-default sidebar-white sidebar-base navs-rounded-all ">
    <div class="sidebar-header d-flex align-items-center justify-content-start">
      <a href="../dashboard/index.php" class="navbar-brand">

        <!--Logo start-->
        <div class="logo-main">
          <div class="logo-normal">
            <svg class=" icon-30" viewBox="0 0 30 30" fill="none" xmlns="http://www.w3.org/2000/svg">
              <rect x="-0.757324" y="19.2427" width="28" height="4" rx="2" transform="rotate(-45 -0.757324 19.2427)" fill="currentColor" />
              <rect x="7.72803" y="27.728" width="28" height="4" rx="2" transform="rotate(-45 7.72803 27.728)" fill="currentColor" />
              <rect x="10.5366" y="16.3945" width="16" height="4" rx="2" transform="rotate(45 10.5366 16.3945)" fill="currentColor" />
              <rect x="10.5562" y="-0.556152" width="28" height="4" rx="2" transform="rotate(45 10.5562 -0.556152)" fill="currentColor" />
            </svg>
          </div>
          <div class="logo-mini">
            <svg class=" icon-30" viewBox="0 0 30 30" fill="none" xmlns="http://www.w3.org/2000/svg">
              <rect x="-0.757324" y="19.2427" width="28" height="4" rx="2" transform="rotate(-45 -0.757324 19.2427)" fill="currentColor" />
              <rect x="7.72803" y="27.728" width="28" height="4" rx="2" transform="rotate(-45 7.72803 27.728)" fill="currentColor" />
              <rect x="10.5366" y="16.3945" width="16" height="4" rx="2" transform="rotate(45 10.5366 16.3945)" fill="currentColor" />
              <rect x="10.5562" y="-0.556152" width="28" height="4" rx="2" transform="rotate(45 10.5562 -0.556152)" fill="currentColor" />
            </svg>
          </div>
        </div>
        <!--logo End-->




        <h4 class="logo-title">Admin</h4>
      </a>
      <div class="sidebar-toggle" data-toggle="sidebar" data-active="true">
        <i class="icon">
          <svg width="20" height="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M4.25 12.2744L19.25 12.2744" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
            <path d="M10.2998 18.2988L4.2498 12.2748L10.2998 6.24976" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
          </svg>
        </i>
      </div>
    </div>
    <div class="sidebar-body pt-0 data-scrollbar">
      <div class="sidebar-list">
        <!-- Sidebar Menu Start -->
        <ul class="navbar-nav iq-main-menu" id="sidebar-menu">
          <li class="nav-item static-item">
            <a class="nav-link static-item disabled" href="#" tabindex="-1">
              <span class="default-icon">Home</span>
              <span class="mini-icon">Home</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" aria-current="page" href="../dashboard/index.php">
              <i class="icon fa fa-house" style="width: 14px;height: 16px;">
              </i>
              <span class="item-name">Dashboard</span>
            </a>
          </li>
          <li>
            <hr class="hr-horizontal">
          </li>
          <li class="nav-item static-item">
            <a class="nav-link static-item disabled" href="#" tabindex="-1">
              <span class="default-icon">Pages</span>
              <span class="mini-icon">Pages</span>
            </a>
          </li>

          <li class="nav-item">
            <a class="nav-link" data-bs-toggle="collapse" href="#sidebar-maha" role="button" aria-expanded="false" aria-controls="sidebar-maha">
              <i class="icon fa fa-user"></i>
              <span class="item-name">Mahasiswa</span>
              <i class="right-icon">
                <svg class="icon-18" xmlns="http://www.w3.org/2000/svg" width="18" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                </svg>
              </i>
            </a>
            <ul class="sub-nav collapse" id="sidebar-maha" data-bs-parent="#sidebar-menu">
              <li class="nav-item">
                <a class="nav-link " href="../dashboard/mahasiswa.php">
                <i class="fa fa-file-lines" style="width: 14px;height: 16px;">
                  </i>
                  <span class="item-name">Data</span>
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link " href="../dashboard/tambahmahasiswa.php">
                <i class="fa fa-plus" style="width: 14px;height: 16px;">
                  </i>
                  <span class="item-name">Tambah Data</span>
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link " href="../dashboard/chartmahasiswa.php">
                <i class="fa fa-chart-line" style="width: 14px;height: 16px;">
                  </i>
                  <span class="item-name">Statistik</span>
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="../dashboard/matkul.php">
                <i class="fa fa-clipboard" style="width: 14px;height: 16px;">
                  </i>
                  <span class="item-name">Mata Kuliah</span>
                </a>
              </li>
            </ul>
          </li>

          <li class="nav-item">
            <a class="nav-link" data-bs-toggle="collapse" href="#sidebar-dose" role="button" aria-expanded="false" aria-controls="sidebar-dose">
            <i class="icon fa fa-person-chalkboard" style="width: 14px;height: 16px;"></i>
              <span class="item-name">Dosen</span>
              <i class="right-icon">
                <svg class="icon-18" xmlns="http://www.w3.org/2000/svg" width="18" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                </svg>
              </i>
            </a>
            <ul class="sub-nav collapse" id="sidebar-dose" data-bs-parent="#sidebar-menu">
              <li class="nav-item">
                <a class="nav-link " href="../dashboard/dosen.php">
                <i class="fa fa-file-lines" style="width: 14px;height: 16px;">
                  </i>
                  <span class="item-name">Data</span>
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link " href="../dashboard/tambahdosen.php">
                <i class="fa fa-plus" style="width: 14px;height: 16px;">
                  </i>
                  <span class="item-name">Tambah Data</span>
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link " href="../dashboard/chartdosen.php">
                <i class="fa fa-chart-line" style="width: 14px;height: 16px;">
                  </i>
                  <span class="item-name">Statistik</span>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item">
            <a class="nav-link" data-bs-toggle="collapse" href="#sidebar-pega" role="button" aria-expanded="false" aria-controls="sidebar-pega">
            <i class="icon fa fa-people-group" style="width: 14px;height: 16px;"></i>
              <span class="item-name">Pegawai</span>
              <i class="right-icon">
                <svg class="icon-18" xmlns="http://www.w3.org/2000/svg" width="18" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                </svg>
              </i>
            </a>
            <ul class="sub-nav collapse" id="sidebar-pega" data-bs-parent="#sidebar-menu">
              <li class="nav-item">
                <a class="nav-link" href="../dashboard/pegawai.php">
                  <i class="fa fa-file-lines" style="width: 14px;height: 16px;">
                  </i>
                  
                  <span class="item-name">Data</span>
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link " href="../dashboard/tambahpegawai.php">
                <i class="fa fa-plus" style="width: 14px;height: 16px;">
                  </i>
                  <span class="item-name">Tambah Data</span>
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link " href="../dashboard/chartpegawai.php">
                  
                  <i class="fa fa-chart-line" style="width: 14px;height: 16px;">
                  </i>
                  <span class="item-name">Statistik</span>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item">
            <a class="nav-link" aria-current="page" href="../dashboard/admin.php">
              <i class="icon fa fa-lock" style="width: 14px;height: 16px;">
              </i>
              <span class="item-name">Admin</span>
            </a>
          </li>
          <li>
            <hr class="hr-horizontal">
          </li>
          <li class="nav-item static-item">
            <a class="nav-link static-item disabled" href="#" tabindex="-1">
              <span class="default-icon">Other</span>
              <span class="mini-icon">Other</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" data-bs-toggle="collapse" href="#sidebar-tema" role="button" aria-expanded="false" aria-controls="sidebar-tema">
              <i class="icon fa fa-palette"></i>
              <span class="item-name">Theme</span>
              <i class="right-icon">
                <svg class="icon-18" xmlns="http://www.w3.org/2000/svg" width="18" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                </svg>
              </i>
            </a>
            <ul class="sub-nav collapse" id="sidebar-tema" data-bs-parent="#sidebar-menu">
              <li class="nav-item">
              <div class="nav-link " data-setting="color-mode" data-name="color" data-value="dark">
              <svg class="icon-20" width="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path fill="currentColor" d="M9,2C7.95,2 6.95,2.16 6,2.46C10.06,3.73 13,7.5 13,12C13,16.5 10.06,20.27 6,21.54C6.95,21.84 7.95,22 9,22A10,10 0 0,0 19,12A10,10 0 0,0 9,2Z" />
              </svg>
              <span class="ms-2 "> Dark </span>
            </div>
              </li>
              <li class="nav-item">
              <div class="nav-link " data-setting="color-mode" data-name="color" data-value="light">
              <svg  class="icon-20" width="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path fill="currentColor" d="M12,8A4,4 0 0,0 8,12A4,4 0 0,0 12,16A4,4 0 0,0 16,12A4,4 0 0,0 12,8M12,18A6,6 0 0,1 6,12A6,6 0 0,1 12,6A6,6 0 0,1 18,12A6,6 0 0,1 12,18M20,8.69V4H15.31L12,0.69L8.69,4H4V8.69L0.69,12L4,15.31V20H8.69L12,23.31L15.31,20H20V15.31L23.31,12L20,8.69Z" />
              </svg>
              <span class="ms-2 "> Light</span>
            </div>
              </li>
            </ul>
          </li>

        </ul>
        <!-- Sidebar Menu End -->
      </div>
    </div>
    <div class="sidebar-footer"></div>
  </aside>
  <main class="main-content">
    <div class="position-relative iq-banner">
      <!--Nav Start-->
      <nav class="nav navbar navbar-expand-lg navbar-light iq-navbar">
        <div class="container-fluid navbar-inner">
          <a href="../dashboard/index.php" class="navbar-brand">
            <!--Logo start-->
            <!--logo End-->

            <!--Logo start-->
            <div class="logo-main">
              <div class="logo-normal">
                <svg class="text-primary icon-30" viewBox="0 0 30 30" fill="none" xmlns="http://www.w3.org/2000/svg">
                  <rect x="-0.757324" y="19.2427" width="28" height="4" rx="2" transform="rotate(-45 -0.757324 19.2427)" fill="currentColor" />
                  <rect x="7.72803" y="27.728" width="28" height="4" rx="2" transform="rotate(-45 7.72803 27.728)" fill="currentColor" />
                  <rect x="10.5366" y="16.3945" width="16" height="4" rx="2" transform="rotate(45 10.5366 16.3945)" fill="currentColor" />
                  <rect x="10.5562" y="-0.556152" width="28" height="4" rx="2" transform="rotate(45 10.5562 -0.556152)" fill="currentColor" />
                </svg>
              </div>
              <div class="logo-mini">
                <svg class="text-primary icon-30" viewBox="0 0 30 30" fill="none" xmlns="http://www.w3.org/2000/svg">
                  <rect x="-0.757324" y="19.2427" width="28" height="4" rx="2" transform="rotate(-45 -0.757324 19.2427)" fill="currentColor" />
                  <rect x="7.72803" y="27.728" width="28" height="4" rx="2" transform="rotate(-45 7.72803 27.728)" fill="currentColor" />
                  <rect x="10.5366" y="16.3945" width="16" height="4" rx="2" transform="rotate(45 10.5366 16.3945)" fill="currentColor" />
                  <rect x="10.5562" y="-0.556152" width="28" height="4" rx="2" transform="rotate(45 10.5562 -0.556152)" fill="currentColor" />
                </svg>
              </div>
            </div>
            <!--logo End-->




            <h4 class="logo-title">Admin</h4>
          </a>
          <div class="sidebar-toggle" data-toggle="sidebar" data-active="true">
            <i class="icon">
              <svg width="20px" class="icon-20" viewBox="0 0 24 24">
                <path fill="currentColor" d="M4,11V13H16L10.5,18.5L11.92,19.92L19.84,12L11.92,4.08L10.5,5.5L16,11H4Z" />
              </svg>
            </i>
          </div>
          <div class="input-group search-input">
              <label style="font-size: 20px;"><h4 style="font-weight: 700;display: inline-block;">Profil</h4></label>
            </div>
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon">
              <span class="mt-2 navbar-toggler-bar bar1"></span>
              <span class="navbar-toggler-bar bar2"></span>
              <span class="navbar-toggler-bar bar3"></span>
            </span>
          </button>
          <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="mb-2 navbar-nav ms-auto align-items-center navbar-list mb-lg-0">
              <li class="nav-item dropdown">
                <a href="#" class="search-toggle nav-link" id="dropdownMenuButton2" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  <img src="../assets/images/Flag/indonesia.png" class="img-fluid rounded-circle border border-dark" alt="user" style="height: 30px; min-width: 30px; width: 30px;">
                  <span class="bg-primary"></span>
                </a>
              </li>
              <?php
              
              ?>
              <li class="nav-item dropdown">
                <a class="py-0 nav-link d-flex align-items-center" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                  <img src="gambar/<?php echo $d['foto'] ?>" class="theme-color-default-img img-fluid avatar avatar-50 avatar-rounded">
                  <img src="gambar/<?php echo $d['foto'] ?>" class="theme-color-purple-img img-fluid avatar avatar-50 avatar-rounded">
                  <img src="gambar/<?php echo $d['foto'] ?>" class="theme-color-blue-img img-fluid avatar avatar-50 avatar-rounded">
                  <img src="gambar/<?php echo $d['foto'] ?>" class="theme-color-green-img img-fluid avatar avatar-50 avatar-rounded">
                  <img src="gambar/<?php echo $d['foto'] ?>" class="theme-color-yellow-img img-fluid avatar avatar-50 avatar-rounded">
                  <img src="gambar/<?php echo $d['foto'] ?>" class="theme-color-pink-img img-fluid avatar avatar-50 avatar-rounded">
                  <div class="caption ms-3 d-none d-md-block ">
                    <h6 class="mb-0 caption-title"> <?php echo $_SESSION["username"]; ?></h6>
                    <p class="mb-0 caption-sub-title">Admin</p>
                  </div>
                </a>
                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                
                <li><a class="dropdown-item active" href="profil.php">Profil</a></li>
                <li>
                    <hr class="dropdown-divider">
                  </li>
                  <li><a class="dropdown-item " href="ubahpassword.php">Ubah Password</a></li>
                  <li>
                    <hr class="dropdown-divider">
                  </li>
                  <li><a class="dropdown-item" href="../dashboard/logout.php">Logout</a></li>
                </ul>
              </li>
            </ul>
          </div>
        </div>
      </nav> <!-- Nav Header Component Start -->
      <!--Nav End-->
      <div class="iq-navbar-header" style="height: 215px;">
              <div class="container-fluid iq-container">
                  <div class="row">
                      <div class="col-md-12">
                          <div class="flex-wrap d-flex justify-content-between align-items-center">
                              <div>
                                  <h1>Halo,
                                   <?php
                                   echo$d['username'];
                                   ?>
                                  </h1>
                                  
                              </div>
                             
                          </div>
                      </div>
                  </div>
              </div>
              <div class="iq-header-img">
                  <img src="../assets/images/dashboard/top-header.png" alt="header" class="theme-color-default-img img-fluid w-100 h-100 animated-scaleX">
                  <img src="../assets/images/dashboard/top-header1.png" alt="header" class="theme-color-purple-img img-fluid w-100 h-100 animated-scaleX">
                  <img src="../assets/images/dashboard/top-header2.png" alt="header" class="theme-color-blue-img img-fluid w-100 h-100 animated-scaleX">
                  <img src="../assets/images/dashboard/top-header3.png" alt="header" class="theme-color-green-img img-fluid w-100 h-100 animated-scaleX">
                  <img src="../assets/images/dashboard/top-header4.png" alt="header" class="theme-color-yellow-img img-fluid w-100 h-100 animated-scaleX">
                  <img src="../assets/images/dashboard/top-header5.png" alt="header" class="theme-color-pink-img img-fluid w-100 h-100 animated-scaleX">
              </div>
          </div> 
    </div>

    <div class="conatiner-fluid content-inner mt-n5 py-0">
    <div class="container mt-5">
    <div class="overlay" id="overlay"></div>
    <div class="mt-3 form-container" id="formContainer" style="display: none;">
      <div class="card">
        <div class="card-header">
          Ubah Profil
          <button class="btn-close float-end" id="closeFormBtn"></button>
        </div>
        <div class="card-body">
          <form method="post" action=" " enctype="multipart/form-data">
            <div class="form-group">
                  <label for="fot" class="form-label">Foto</label>
                  <input type="file" class="form-control" name="foto" id="fot">
                  <p style="color: red">Ekstensi yang diperbolehkan .png | .jpg | .jpeg | .gif</p>
                  <?php
                  if (!empty($d['foto'])) {
                    echo '<p>Foto saat ini: ' . $d['foto'] . '</p>';
                  }
                  ?>
                </div>
                <button type="submit" class="btn btn-primary">Ubah</button>
                <button type="reset" class="btn btn-danger">Batal</button>
          </form>
        </div>
      </div>
    </div>
  </div>
      <div class="row justify-content-center">
      <div class="col-lg-12">
             <div class="card">
                  <div class="card-body">
                     <div class="d-flex flex-wrap align-items-center justify-content-between">
                        <div class="d-flex flex-wrap align-items-center">
                           <div class="profile-img position-relative me-3 mb-3 mb-lg-0 profile-logo profile-logo1 ">
                              <img src="gambar/<?php echo $d['foto'] ?>" alt="User-Profile" class="theme-color-default-img img-fluid rounded-pill avatar-100">
                              <img src="gambar/<?php echo $d['foto'] ?>" alt="User-Profile" class="theme-color-purple-img img-fluid rounded-pill avatar-100">
                              <img src="gambar/<?php echo $d['foto'] ?>" alt="User-Profile" class="theme-color-blue-img img-fluid rounded-pill avatar-100">
                              <img src="gambar/<?php echo $d['foto'] ?>" alt="User-Profile" class="theme-color-green-img img-fluid rounded-pill avatar-100">
                              <img src="gambar/<?php echo $d['foto'] ?>" alt="User-Profile" class="theme-color-yellow-img img-fluid rounded-pill avatar-100">
                              <img src="gambar/<?php echo $d['foto'] ?>" alt="User-Profile" class="theme-color-pink-img img-fluid rounded-pill avatar-100">
                           </div>
                           <div class="d-flex flex-wrap align-items-center mb-3 mb-sm-0">
                              <h4 class="me-2 h4"><?php echo $_SESSION["username"]; ?></h4>
                              <span> - Admin</span>
                           </div>
                        </div>
                        <ul class="d-flex nav nav-pills mb-0 text-center profile-tab" data-toggle="slider-tab" id="profile-pills-tab" role="tablist">
                          
                           <li class="nav-item">
                              <a class="nav-link active" data-bs-toggle="tab" href="#profile-profile" role="tab" aria-selected="false">Profile</a>
                           </li>
                        </ul>
                     </div>
                  </div>
             </div>
          </div>
          
<div class="col-lg-4">
<div class="card"style="height:425px;">
                     <div class="card-header">
                        <div class="header-title">
                           <h4 class="card-title">Profile</h4>
                        </div>
                     </div>
                      <div class="card-body" >
                        <div class="text-center">
                           <div class="user-profile">
                              <img src="gambar/<?php echo $d['foto'] ?>" alt="profile-img" class="rounded-pill avatar-130 img-fluid">
                           </div>
                           <div class="mt-3">
                              <h3 class="d-inline-block"><?php echo $d['username'] ?></h3>
                              <p class=" pl-3">Admin</p>
                              <button class="btn btn-primary  " id="showFormBtn" >Ganti Profil</button>
                           </div>
                        </div>
                     </div>
                  </div>
</div>

<div class="col-lg-8">
                  <div class="card">
                     <div class="card-header">
                        <div class="header-title">
                           <h4 class="card-title" style="display: inline-block;">About User</h4>
                           <a style="position: absolute;right: 15px;" type="button" class="btn btn-primary" href="ubahadmin.php?x=<?php echo $d['username'] ?>"><i class='fa fa-edit'></i></a>
                        </div>
                     </div>
                     <div class="card-body">
                        
                        <div class="mt-2">
                        <h6 class="mb-1">Username:</h6>
                        <p><?php echo $d['username'] ?></p>
                        </div>
                        <div class="mt-2">
                        <h6 class="mb-1">Jenis Kelamin:</h6>
                        <p><?php echo $d['jenkel'] ?></p>
                        </div>
                        <div class="mt-2">
                        <h6 class="mb-1">Tanggal Lahir:</h6>
                        <p><?php echo $d['lahir'] ?></p>
                        </div>
                        <div class="mt-2">
                        <h6 class="mb-1">No HP:</h6>
                        <p><?php echo $d['hp'] ?></p>
                        </div>
                        <div class="mt-2">
                        <h6 class="mb-1">Email:</h6>
                        <p><?php echo $d['email'] ?></p>
                        </div>
                     </div>
                  </div>
              
               </div>

        
      </div>
    </div>

    <!-- Footer Section End -->
  </main>

  <!-- Library Bundle Script -->
  <script src="../assets/js/core/libs.min.js"></script>

  <!-- External Library Bundle Script -->
  <script src="../assets/js/core/external.min.js"></script>

  <!-- Widgetchart Script -->
  <script src="../assets/js/charts/widgetcharts.js"></script>

  <!-- mapchart Script -->
  <script src="../assets/js/charts/vectore-chart.js"></script>
  <script src="../assets/js/charts/dashboard.js"></script>

  <!-- fslightbox Script -->
  <script src="../assets/js/plugins/fslightbox.js"></script>

  <!-- Settings Script -->
  <script src="../assets/js/plugins/setting.js"></script>

  <!-- Slider-tab Script -->
  <script src="../assets/js/plugins/slider-tabs.js"></script>

  <!-- Form Wizard Script -->
  <script src="../assets/js/plugins/form-wizard.js"></script>

  <!-- AOS Animation Plugin-->
  <script src="../assets/vendor/aos/dist/aos.js"></script>

  <!-- App Script -->
  <script src="../assets/js/hope-ui.js" defer></script>

  <script>
    const showFormBtn = document.getElementById('showFormBtn');
    const closeFormBtn = document.getElementById('closeFormBtn');
    const formContainer = document.getElementById('formContainer');
    const overlay = document.getElementById('overlay');
    const otherElement = document.querySelector('.container > div:not(#formContainer)');

    showFormBtn.addEventListener('click', function() {
      formContainer.style.display = 'block';
      overlay.style.display = 'block';
      otherElement.addEventListener('click', preventClick);
    });

    closeFormBtn.addEventListener('click', function() {
      formContainer.style.display = 'none';
      overlay.style.display = 'none';
      otherElement.removeEventListener('click', preventClick);
    });

    function preventClick(event) {
      event.stopPropagation();
    }
  </script>
</body>

</html>