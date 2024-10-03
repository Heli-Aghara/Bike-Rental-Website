<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title><?php echo isset($page_title) ? $page_title : 'Riding Tales'; ?></title>

  <!-- Favicon -->
  <link rel="icon" type="image/x-icon" href="images/logos/RT-New.png">

  <!-- Font awesome link -->
  <link
    rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css"
    integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg=="
    crossorigin="anonymous"
    referrerpolicy="no-referrer" />

  <!-- Bootstrap CSS -->
  <?php
  if (!isset($disable_bootstrap)) {
    echo '<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">';
  }
  ?>

  <!-- My CSS -->
  <link rel="stylesheet" href="css/header.css" />
  <link rel="stylesheet" href="css/index.css">
  <link rel="stylesheet" href="css/bike-listings-style.css">

  <!-- Boxicons CSS-->
  <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>

  <!-- flatpicker CSS for date-time input in pickup & dropoff time -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">

  <!-- jquery link-->
  <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>

  <!--Navbar JS-->
  <script src="js/navbar.js" defer></script>



</head>

<body>
  <!-- Session start -->
  <?php session_start(); ?>

  <!-- **********| Navbar |************-->
  <div class="nav_bar flex">
    <div class="nav_bar__logo">
      <img
        src="images/logos/RT-New.png"
        alt="Riding Tales logo"
        height="30"
        width="30" />
    </div>

    <nav>
      <ul id="nav_bar-menu" class="nav_bar__menu flex" data-visible="false">
        <li><a href="index.php" class="nav_bar__link">Home</a></li>
        <li><a href="about_us.php" class="nav_bar__link">About</a></li>
        <?php
        if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true) { ?>
          <li><a href="view_orders.php">Orders</a></li>
        <?php } ?>
        <li><a href="contact-form.php" class="nav_bar__link">Contact</a></li>
      </ul>
    </nav>

    <ul id="nav_bar__icons_container" class="nav_bar__icons_container flex">
      <li class="profile-dropdown-menu">
        <a href=""><i class="fa-solid fa-user user-icon"></i></a>
        <ul class="profile-dropdown-menu-ul">
          <li><a href="registration-form/registration-form.php">Register</a></li>
          <li><a href="login-form/login-form.php">Login</a></li>
          <?php
          if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true) { ?>
            <li><a href="includes/logout.inc.php">Logout</a></li>
          <?php } ?>

        </ul>
      </li>

      <li class="navmenu-toggle-li">
        <button aria-controls="nav_bar-menu" aria-expanded="false" class="mobile-nav-menu-toggle"><span class="sr-only">Menu</span><span class="toggle-icon"><i class="fa-solid fa-bars fa-xl" style="color: #3a3a3a;"></i></span></button>
      </li>
    </ul>
  </div>
  <main class="main-container">