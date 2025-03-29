<?php

include "includes/db.php";

$login = isset($_SESSION['user_id']);

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>Index - Medilab Bootstrap Template</title>
  <meta name="description" content="">
  <meta name="keywords" content="">

  <!-- Favicons -->
  <link href="/rm/assets/img/favicon.png" rel="icon">
  <link href="/rm/assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Fonts -->
  <link href="https://fonts.googleapis.com" rel="preconnect">
  <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Raleway:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="/rm/assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="/rm/assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="/rm/assets/vendor/aos/aos.css" rel="stylesheet">
  <link href="/rm/assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet">
  <link href="/rm/assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
  <link href="/rm/assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">
  <link href="/rm/assets/css/toastr.min.css" rel="stylesheet">

  <!-- Main CSS File -->
  <link href="/rm/assets/css/main.css" rel="stylesheet">

  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">

  <!-- jQuery -->
  <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

  <!-- Flatpickr JS -->
  <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>

</head>

<body class="index-page">

  <header id="header" class="header sticky-top">

    <div class="topbar d-flex align-items-center">
      <div class="container d-flex justify-content-center justify-content-md-between">
        <div class="contact-info d-flex align-items-center">
          <i class="bi bi-envelope d-flex align-items-center"><a href="mailto:contact@example.com">contact@example.com</a></i>
          <i class="bi bi-phone d-flex align-items-center ms-4"><span>+1 5589 55488 55</span></i>
        </div>
        <div class="social-links d-none d-md-flex align-items-center">
          <a href="#" class="twitter"><i class="bi bi-twitter-x"></i></a>
          <a href="#" class="facebook"><i class="bi bi-facebook"></i></a>
          <a href="#" class="instagram"><i class="bi bi-instagram"></i></a>
          <a href="#" class="linkedin"><i class="bi bi-linkedin"></i></a>
        </div>
      </div>
    </div><!-- End Top Bar -->

    <div class="branding d-flex align-items-center">

      <div class="container position-relative d-flex align-items-center justify-content-between">
        <a href="index.php" class="logo d-flex align-items-center me-auto">
          <!-- Uncomment the line below if you also wish to use an image logo -->
          <!-- <img src="assets/img/logo.png" alt=""> -->
          <h1 class="sitename">RoyMedical</h1>
        </a>

        <nav id="navmenu" class="navmenu">
          <ul>
            <li><a href="index.php" class="active">Home<br></a></li>
            <li><a href="doctors.php">Doctors</a></li>
            <li><a href="products.php">Products</a></li>
            <?php if ($login): ?>

              <li class="dropdown">
                <span>Welcome, <?php echo $_SESSION['user_name']; ?></span>
                <i class="bi bi-chevron-down toggle-dropdown"></i>
                <ul>
                  <li><a href="profile.php">Profile</a></li>
                  <li><a href="my_orders.php">Orders</a></li>
                  <li><a href="my_appointments.php">My Appointments</a></li>
                  <li><a href="cart_items.php">Cart</a></li>
                  <li><a href="auth/logout.php">Logout</a></li>
                </ul>
              </li>
            <?php else: ?>
              <li><a href="auth/login.php">Login</a></li>
            <?php endif; ?>
          </ul>

          <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
        </nav>

        <a class="cta-btn d-none d-sm-block" href="#appointment">Make an Appointment</a>

      </div>

    </div>

  </header>
</body>

</html>