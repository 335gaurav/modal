<?php
include '../conn.php';

if (isset($_POST['login'])) {
  $username = $_POST['username'];
  $password = $_POST['password'];
  $sql = "SELECT * FROM `login` WHERE `username`='$username' AND `password`='$password'";

  $result = mysqli_query($conn, $sql);
  $rows = mysqli_num_rows($result);
  if ($rows > 0) {
    session_start();
    $_SESSION['username'] = $username;
    header("Location: ../table.php");
  } else {
    $error = "<p style='color:red;'> *Insert valid username or password !! </p>";
  }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login</title>
  <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
  <link rel="stylesheet" href="./login.css">
  <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
  <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
  <!------ Include the above in your HEAD tag ---------->
  <style>

    .pass_required{
      display: nonef;
    }
    .pass_required ul{
      padding: 0;
      margin: 0 0 15px;
      list-style: none;
    }

    .pass_required ul li{
      margin-bottom: 8px;
      color: red;
      font-weight: 700;
    }

    .pass_required ul li.active{
      color: #02af02;
    }

    .pass_required ul li span:before{
      content:"X";

    }

    .pass_required ul li.active span:before{
      content:"V";
    }

  </style>
</head>

<body>

  <div class="sidenav">
    <div class="login-main-text">
      <h2>For Student<br> Login</h2>
      <p>Login from here to access >>></p>
    </div>
  </div>

  <div class="main">
    <?php require './navbar/nav.php'; ?>
    <div class="col-md-6 col-sm-12">
      <div class="login-form">
        <form action="./login.php" method='post'>
          <?php echo isset($error) ? $error : null; ?>
          <div class="form-group">
            <label>User Name</label>
            <input type="text" class="user_name form-control" name="username" placeholder="User Name">
          </div>
          <p id="userErr" class= "text-danger"></p>
          <div class="form-group">
            <label>Password</label>
            <input type="password" class="user_pass form-control" name="password" id="pass_validation" placeholder="Password">
          </div>
          <div class="pass_required">
            <ul>
              <li><span> One Lowercase Letter</span></li>
              <li><span> One Capital Letter</span></li>
              <li><span> One Number</span></li>
              <li><span> One Special Character</span></li>
              <li><span> At Least 8 Characters</span></li>
            </ul>
          </div>
          <p id="passErr" class= "text-danger"></p>
          <button type="submit" name='login' id='loginbtn' class="btn btn-black">Login</button>
          <a class="btn btn-secondary" href="./signup.php">Sign up</a>
        </form>
      </div>
    </div>
  </div>
  <script>
    $(document).ready(function() {
      $("#userErr").hide();
      let userError = true;
      $(".user_name").keyup(function() {
        validateUser();
      });

      function validateUser() {
        let userValue = $(".user_name").val();
        if (userValue == "") {
          $("#userErr").show();
          $("#userErr").text('*Field is required !!')
        } else {
          $("#userErr").hide();
          userError = false;
        }
      }

    // $("#passErr").hide();
    // let passError = true;
    // $(".user_pass").keyup(function() {
    //   validatePass();
    // });
    // function validatePass() {
    //   let passValue = $(".user_pass").val();
    //   if (passValue == "") {
    //     $("#passErr").show();
    //     $("#passErr").text('*Field is required !!')
    //   } else {
    //     $("#passErr").hide();
    //     passError = false;
    //   }
    // }



    $('#loginbtn').click(function(event) {
      validateUser();
      validatePass();
      if (userError == true && passError == true) {
        event.preventDefault();
      }
    });
  });

  $('#pass_validation').on('focus', function() {
      $(".pass_required").slideDown();
    });
    $("#pass_validation").on('blur', function(){
      $(".pass_required").slideUp();
    }); 
  </script>


</body>

</html>