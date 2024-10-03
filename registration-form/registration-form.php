<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Register</title>

    <!-- Jquery link -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

    <!--Script.js link -->
    <script src="js/script.js"></script>

    <!-- Font awesome icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />


    <!-- Linking to style.css -->
    <link rel="stylesheet" href="css/style.css" />
  </head>

  <body>
    <div class="wrapper">
      <div class="inner">
        <form action="proceed-registration.php" method="post" enctype="multipart/form-data" name="registration-form" autocomplete="off">
          <div class="inside_form-wrapper">
              <h1 class="login-title">Create a new account</h1>
              <div class="f_name-wrapper">
                <label for="f_name">First name:</label>
                <input type="text" name="f_name" id="f_name" title="Please, enter a valid first name." pattern="[a-zA-Z ]+" required />
              </div>
              <div class="l_name-wrapper">
                <label for="l_name">Last name:</label>
                <input type="text" name="l_name" id="l_name" title="Please, enter a valid last name." pattern="[a-zA-Z ]+" required/>
              </div>
              <div class="username-wrapper">
                <label for="username">Username:</label> <!-- ^[a-z0-9_@]{5,16}$--> <!--^[a-z0-9_]{5,15}$|^[a-z0-9_]{5,15}@[a-z0-9_]{1,15}$-->
                <input type="text" name="username" id="username" pattern="^(?=.*[a-z_@])[a-z0-9_@]{5,16}$" title="User name can be 5 to 16 characters long. It can only contain lowercase letters, numbers, @ and _(underscore).it must contain atleast on lowercase letter." minlength="5" maxlength="16" required/>
                <p class="invalid_message-text" id="invalid_username-text"></p>
                <p id="username-status"></p>
              </div>
              <div class="email_id-wrapper">
                <label for="email_id">Email:</label>
                <input type="email" name="email_id" id="email_id" required/>
                <p id="email-result"></p>
                <!--<p id="#email_id_exists-text" class="invalid_message-text">Email is already registered!!</p>-->
              </div>
              <div class="phone_no-wrapper">
                <label for="phone_no">Phone no. : </label>
                <input type="tel" name="phone_no" id="phone_no" pattern="^\d{10}$" minlength="10" maxlength="10" title="Please enter a 10-digit phone no." required/>
                <p id="phone-result"></p>
                <!-- <p id="#phone_no_exists-text" class="invalid_message-text">Phone no. is already registered!!</p> -->
              </div>
              <div class="dob-wrapper">
                <label for="dob">Date of Birth:</label>
                <input type="date" id="dob" name="dob" required/>
              </div>
              <fieldset>
                <legend>Gender:</legend>
                <input type="radio" id="male" name="gender" class="gender-input" value="M"/>
                <label for="male">Male</label>
                <input type="radio" id="female" name="gender" class="gender-input" value="F"/>
                <label for="female">Female</label>
                <input type="radio" id="other" name="gender" class="gender-input" value="O"/>
                <label for="other">Other</label>
              </fieldset>
              <div class="password-wrapper">
                <label for="password">Set password:</label>
                <input type="password" name="password" id="password" required/>
                <p class="invalid_message-text" id="invalid_password-text"></p>
              </div>
              <div class="conf_password-wrapper">
                <label for="confirm_password">Confirm password:</label>
                <input
                  type="password"
                  name="confirm_password"
                  id="confirm_password"
                  required
                />
              </div>
              <div class="driving_lic-wrapper">
                <label for="driving_lic">Upload Your Driving License:</label>
                <input type="file" id="driving_lic" name="driving_lic" accept="image/" required/>
              </div>
              <div class="register_btn-wrapper">
                <input type="submit" value="Register" id="register_btn"/>
              </div>
              <div class="log_in_line-wrapper">
                <p id="log_in-line">Already have an account? <a href="../login-form/login-form.php" id="log_in-link">Log in.</a></p>
              </div>
          </div>
        </form>
      </div>
    </div>


  </body>
</html>

<!--
background-image registration
<a href="https://www.freepik.com/free-ai-image/motorcycle-safety-helmet_201010053.htm#page=3&query=road%20bike%20wallpaper&position=13&from_view=keyword&track=ais_hybrid&uuid=78f46d36-579e-49e0-8b4d-6996c413ce55">Image by freepik</a>
-->