<?php
  mysqli_report(MYSQLI_REPORT_OFF);

  $servername = "localhost";
  $username = "root";
  $password = "";
  $dbname = "user";

  // Create connection
  $conn = mysqli_connect($servername, $username, $password, $dbname);

  // Check connection
  if (!$conn) {
    echo "Connection failed: " . mysqli_connect_error();
    die;
  }
?>