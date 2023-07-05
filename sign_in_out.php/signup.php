<?php
include "../conn.php";
if (isset($_POST['signup'])) {
   $username = $_POST['username'];
   $email = $_POST['email'];
   $pass = $_POST['password'];
   $cpass = $_POST['cpassword'];

   $sql = "INSERT INTO `login` (`username`, `email`, `password`, `cpassword`) VALUES ( '$username', '$email', '$pass', '$cpass')";
   if (mysqli_query($conn, $sql)) {
      $success = "<p class='text-success'> data submitted successfully !! </p>";
   } else {
      $error = "not data inserted !!";
   }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
   <link rel="stylesheet" href="./login.css">
   <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
   <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
   <!------ Include the above in your HEAD tag ---------->
   <title>Sign up</title>
</head>

<body>

</body>

</html>
<div class="sidenav">
   <div class="login-main-text">
      <h2>For Student<br> Sign up</h2>
      <p>Sign up from here to access >>></p>
   </div>
</div>
<div class="main">
   <?php require "./navbar/nav.php"; ?>
   <div class="col-md-6">
      <div class="login-form">
         <form method="post" action="./signup.php">
            <div class="form-group">
               <?php echo isset($success) ? $success : null; ?><br>
               <label>User Name</label>
               <input type="text" name="username" class="user_name form-control" placeholder="User Name">
            </div>
            <p id="usernErr" class="text-danger"></p>
            <div class="form-group">
               <label>Email</label>
               <input type="email" name="email" class="user_email form-control" placeholder="Email">
            </div>
            <p id="emailErr" class="text-danger"></p>
            <div class="form-group">
               <label>Password</label>
               <input type="password" name="password" class="user_pass form-control" placeholder="Password">
            </div>
            <p id="passsErr" class="text-danger"></p>
            <div class="form-group">
               <label>Confirm Password</label>
               <input type="password" name="cpassword" class="user_cpass form-control" placeholder="Password">
            </div>
            <p id="cpassErr" class="text-danger"></p>
            <button type="submit" name="signup" class=" signup-btn btn btn-black">Sign up</button>
            <a class="btn btn-secondary" href="./login.php">Login</a>
         </form>
      </div>
   </div>
</div>
<script src="../../jquery.js"></script>
<script>
   $(document).ready(function() {

      $("#usernErr").hide();
      let userError = true;
      $(".user_name").keyup(function() {
         validateUser();
      });

      function validateUser() {
         let userValue = $(".user_name").val();
         if (userValue == "") {
            $("#usernErr").show();
            $("#usernErr").text('*Field is required !!')
         } else {
            $("#usernErr").hide();
            userError = false;
         }
      }

      $("#emailErr").hide();
      let emailError = true;
      $(".user_email").keyup(function() {
         validateEmail();
      });

      function validateEmail() {
         let emailValue = $(".user_email").val();
         if (emailValue == "") {
            $("#emailErr").show();
            $("#emailErr").text('*Field is required !!')
         } else {
            $("#emailErr").hide();
            emailError = false;
         }
      }

      $("#passsErr").hide();
      let passError = true;
      $(".user_pass").keyup(function() {
         validatePass();
      });

      function validatePass() {
         let passValue = $(".user_pass").val();
         if (passValue == "") {
            $("#passsErr").show();
            $("#passsErr").text('*Field is required !!')
         } else {
            $("#passsErr").hide();
            passError = false;
         }
      }

      $("#cpassErr").hide();
      let cpassError = true;
      $(".user_cpass").keyup(function() {
         validateCpass();
      });

      function validateCpass() {
         let passValue = $(".user_cpass").val();
         if (passValue == "") {
            $("#cpassErr").show();
            $("#cpassErr").text('*Field is required !!')
         } else {
            $("#cpassErr").hide();
            cpassError = false;
         }
      }

      $('.signup-btn').click(function(event) {
         validateUser();
         validateEmail();
         validatePass();
         validateCpass();
         if (userError == true &&
            emailError == true &&
            passError == true &&
            cpassError == true) {
            event.preventDefault();
         }
      });
   });
</script>