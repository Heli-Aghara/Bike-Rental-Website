<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Login Form</title>

  <!--Bootstrap CSS-->
  <link
    href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
    rel="stylesheet"
    integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH"
    crossorigin="anonymous" />

  <!--linking to style.css-->
  <link rel="stylesheet" href="css/style.css" />

  <!-- Jquery link -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>


</head>

<body>

  <div class="container">
    <div class="form-wrapper mx-auto p-4">

      <!-- Display error message if any -->
      <?php

      session_start();

      if (isset($_SESSION['login_message'])) {
        echo $_SESSION['login_message'];
        unset($_SESSION['login_message']);
      }
      //if(!empty($message)) echo $message; 

      ?>

      <form method="POST" action="proceed-login.php" autocomplete="off">
        <h1 class="text-center fs-2 log_in-title">Login</h1>
        <div class="mb-3">
          <label for="username" class="form-label username-label mb-0">Username:</label>
          <input
            type="text"
            class="form-control username-input"
            id="username"
            name="username"
            aria-describedby="emailHelp" />
          <!--
            <div id="emailHelp" class="form-text">
              We'll never share your email with anyone else.
            </div>
            -->
        </div>
        <div class="mb-3">
          <label for="password" class="form-label password-label mb-0">Password:</label>
          <input
            type="password"
            class="form-control password-input"
            id="password"
            name="password" />
        </div>

    <!--Login as admin checkbox-->
        <div class="mb-3 form-check">
          <input type="checkbox" class="form-check-input" id="login-as-admin-checkbox" name="is_admin">
          <label class="form-check-label" for="login-as-admin-checkbox">Login As 
            An Admin</label>
        </div>

        <div class="register_btn-wrapper text-center">
          <button type="submit" class="btn btn-primary w-50" id="login-btn">Login</button>
        </div>

        <div class="register_line-wrapper mt-3">
          <p class="form-text text-center register-line">
            Don't have an account? <br /><a href="../registration-form/registration-form.php">Register now.</a>
          </p>
        </div>
      </form>
    </div>
  </div>

  <!--Bootstrap JS-->
  <script
    src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
    integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r"
    crossorigin="anonymous"></script>
  <script
    src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"
    integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy"
    crossorigin="anonymous"></script>

  <!--Linking to script.js (JS)-->
  <script src="js/script.js"></script>
</body>

</html>