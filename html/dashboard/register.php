<!doctype html>
<?php
session_start();
include("koneksi.php");
if (isset($_POST['username'])) {
  $username = $_POST['username'];
  $password = $_POST['password'];
  $jenkel = $_POST['txtjenkel'];
  $lahir = $_POST['txtlahir'];
  $hp = $_POST['txthp'];
  $email = $_POST['txtemail'];

  $rand = rand();
  $ekstensi =  array('png', 'jpg', 'jpeg', 'gif');
  $filename = $_FILES['foto']['name'];
  $ukuran = $_FILES['foto']['size'];
  $ext = pathinfo($filename, PATHINFO_EXTENSION);

  if (!in_array($ext, $ekstensi)) {
    header("location:register.php?alert=gagal_ekstensi");
  } else {
    if ($ukuran < 1044070) {
      $xx = $rand . '_' . $filename;
      move_uploaded_file($_FILES['foto']['tmp_name'], 'gambar/' . $rand . '_' . $filename);
      mysqli_query($koneksi, "INSERT INTO admin VALUES('$username','$password','$jenkel','$lahir','$hp','$email','$xx')");
      header("location:login.php?alert=berhasil");
    } else {
      header("location:register.php?alert=gagal_ukuran");
    }
  }
}

?>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
      <title>Register</title>
      
      <!-- Favicon -->
      <link rel="shortcut icon" href="../assets/images/favicon.ico" />
      
      <!-- Library / Plugin Css Build -->
      <link rel="stylesheet" href="../assets/css/core/libs.min.css" />
      
      
      <!-- Hope Ui Design System Css -->
      <link rel="stylesheet" href="../assets/css/hope-ui.min.css?v=2.0.0" />
      
      <!-- Custom Css -->
      <link rel="stylesheet" href="../assets/css/custom.min.css?v=2.0.0" />
      
      <!-- Dark Css -->
      <link rel="stylesheet" href="../assets/css/dark.min.css"/>
      
      <!-- Customizer Css -->
      <link rel="stylesheet" href="../assets/css/customizer.min.css" />
      
      <!-- RTL Css -->
      <link rel="stylesheet" href="../assets/css/rtl.min.css"/>
      
      
  </head>
  <body class=" " data-bs-spy="scroll" data-bs-target="#elements-section" data-bs-offset="0" tabindex="0">
    <!-- loader Start -->
    <div id="loading">
      <div class="loader simple-loader">
          <div class="loader-body"></div>
      </div>    </div>
    <!-- loader END -->
    
      <div class="wrapper">
      <section class="login-content">
         <div class="row m-0 align-items-center bg-white vh-100">            
               <div class="col-md-6 d-md-block d-none bg-primary p-0 mt-n1 vh-100 overflow-hidden">
               <img src="../assets/images/auth/05.png" class="img-fluid gradient-main animated-scaleX" alt="images">
            </div>
            <div class="col-md-6">               
               <div class="row justify-content-center">
                  <div class="col-md-10">
                     <div class="card card-transparent auth-card shadow-none d-flex justify-content-center mb-0">
                        <div class="card-body">
                           <a href="../dashboard/index.html" class="navbar-brand d-flex align-items-center mb-3">
                              <!--Logo start-->
                              <!--logo End-->
                              
                              <!--Logo start-->
                              <div class="logo-main">
                                  <div class="logo-normal">
                                      <svg class="text-primary icon-30" viewBox="0 0 30 30" fill="none" xmlns="http://www.w3.org/2000/svg">
                                          <rect x="-0.757324" y="19.2427" width="28" height="4" rx="2" transform="rotate(-45 -0.757324 19.2427)" fill="currentColor"/>
                                          <rect x="7.72803" y="27.728" width="28" height="4" rx="2" transform="rotate(-45 7.72803 27.728)" fill="currentColor"/>
                                          <rect x="10.5366" y="16.3945" width="16" height="4" rx="2" transform="rotate(45 10.5366 16.3945)" fill="currentColor"/>
                                          <rect x="10.5562" y="-0.556152" width="28" height="4" rx="2" transform="rotate(45 10.5562 -0.556152)" fill="currentColor"/>
                                      </svg>
                                  </div>
                                  <div class="logo-mini">
                                      <svg class="text-primary icon-30" viewBox="0 0 30 30" fill="none" xmlns="http://www.w3.org/2000/svg">
                                          <rect x="-0.757324" y="19.2427" width="28" height="4" rx="2" transform="rotate(-45 -0.757324 19.2427)" fill="currentColor"/>
                                          <rect x="7.72803" y="27.728" width="28" height="4" rx="2" transform="rotate(-45 7.72803 27.728)" fill="currentColor"/>
                                          <rect x="10.5366" y="16.3945" width="16" height="4" rx="2" transform="rotate(45 10.5366 16.3945)" fill="currentColor"/>
                                          <rect x="10.5562" y="-0.556152" width="28" height="4" rx="2" transform="rotate(45 10.5562 -0.556152)" fill="currentColor"/>
                                      </svg>
                                  </div>
                              </div>
                              <!--logo End-->
                              
                              
                              
                              
                              <h4 class="logo-title ms-3">Admin</h4>
                           </a>
                           <h2 class="mb-2 text-center">Register</h2>
                           
                           <form action=" " method="post" enctype="multipart/form-data">
                              <div class="row">
                                 <div class="col-lg-6">
                                 <div class="form-group">
                  <label for="usr" class="form-label">Username</label>
                  <input type="text" class="form-control" name="username" required="required" id="usr">
                </div>

                                 </div>
                                 <div class="col-lg-6">
                                 <div class="form-group">
                  <label for="pw" class="form-label">Password</label>
                  <input type="password" class="form-control" name="password" required="required" id="pw">
                </div>

                                 </div>
                                 <div class="col-lg-6">
                                 <div class="form-group">
                  <label for="jenkel" class="form-label">Jenis Kelamin</label>
                  <select class="form-select" aria-label="Default select example" name="txtjenkel" id="jenkel">
                    <option selected>Pilih Jenis Kelamin</option>
                    <option value="Laki-Laki">Laki-Laki</option>
                    <option value="Perempuan">Perempuan</option>
                  </select>
                </div>
                                 </div>
                                 <div class="col-lg-6">
                                 <div class="form-group">
                  <label for="tgl" class="form-label">Tanggal Lahir</label>
                  <input type="date" class="form-control" name="txtlahir" id="tgl">
                </div>
                                 </div>
                                 <div class="col-lg-6">
                                 <div class="form-group">
                  <label for="hp" class="form-label">Nomor Hp</label>
                  <input type="text" class="form-control" name="txthp" id="hp">
                </div>
                                 </div>
                                 <div class="col-lg-6">
                                 <div class="form-group">
                  <label for="email" class="form-label">Email</label>
                  <input type="text" class="form-control" name="txtemail" id="email">
                </div>
                                 </div>
                                 <div class="col-lg-12 d-flex justify-content-center">
                                    <div class="form-group">
                  <label for="fot" class="form-label">Foto</label>
                  <input type="file" class="form-control" name="foto" required="required" id="fot">
                  <p style="color: red;font-size: 14px;">Ekstensi yang diperbolehkan .png | .jpg | .jpeg | .gif</p>
                </div>
                                 </div>
                              </div>
                              <div class="d-flex justify-content-center">
                                 <button type="submit" class="btn btn-primary">Daftar</button>
                              </div>
                             
                              
                              <p class="mt-3 text-center">
                                 Sudah Punya Akun? <a href="login.php" class="text-underline">Login</a>
                              </p>
                           </form>
                        </div>
                     </div>    
                  </div>
               </div>           
               <div class="sign-bg sign-bg-right">
                  <svg width="280" height="230" viewBox="0 0 421 359" fill="none" xmlns="http://www.w3.org/2000/svg">
                     <g opacity="0.05">
                        <rect x="-15.0845" y="154.773" width="543" height="77.5714" rx="38.7857" transform="rotate(-45 -15.0845 154.773)" fill="#3A57E8"/>
                        <rect x="149.47" y="319.328" width="543" height="77.5714" rx="38.7857" transform="rotate(-45 149.47 319.328)" fill="#3A57E8"/>
                        <rect x="203.936" y="99.543" width="310.286" height="77.5714" rx="38.7857" transform="rotate(45 203.936 99.543)" fill="#3A57E8"/>
                        <rect x="204.316" y="-229.172" width="543" height="77.5714" rx="38.7857" transform="rotate(45 204.316 -229.172)" fill="#3A57E8"/>
                     </g>
                  </svg>
               </div>
            </div>   
         </div>
      </section>
      </div>
    
    <!-- Library Bundle Script -->
    <script src="../assets/js/core/libs.min.js"></script>
    
    <!-- External Library Bundle Script -->
    <script src="../assets/js/core/external.min.js"></script>
    
    <!-- Widgetchart Script -->
    <script src="../assets/js/charts/widgetcharts.js"></script>
    
    <!-- mapchart Script -->
    <script src="../assets/js/charts/vectore-chart.js"></script>
    <script src="../assets/js/charts/dashboard.js" ></script>
    
    <!-- fslightbox Script -->
    <script src="../assets/js/plugins/fslightbox.js"></script>
    
    <!-- Settings Script -->
    <script src="../assets/js/plugins/setting.js"></script>
    
    <!-- Slider-tab Script -->
    <script src="../assets/js/plugins/slider-tabs.js"></script>
    
    <!-- Form Wizard Script -->
    <script src="../assets/js/plugins/form-wizard.js"></script>
    
    <!-- AOS Animation Plugin-->
    
    <!-- App Script -->
    <script src="../assets/js/hope-ui.js" defer></script>
    
  </body>
</html>