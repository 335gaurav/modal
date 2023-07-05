<?php
include "./conn.php";

if(isset($_FILES['image'])) {
    $file_name = $_FILES['image']['name'];

    $sql = "INSERT INTO `employee` (`image`) VALUES ( '$image')";

    if (mysqli_query($conn, $sql)) {
        echo "<p class = 'text-success'>Image inserted successfully !!</p><br>";
        // header('Location: ./insert_form.php');
        move_uploaded_file($_FILES['image']['tmp_name'], "./images/$image");
      } else {
        echo "not inserted";
      }
    }

?>