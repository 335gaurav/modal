<?php 
  session_start();
  if(!isset($_SESSION['username'])){
    header("Location: ./sign_in_out.php/login.php");
    exit;
  }
?>
<?php 
include "./conn.php";
if(isset($_POST['update-btn'])){
  $subject = isset($_POST["subject"]) ? implode(', ',$_POST['subject']) : null;
  $sr = htmlspecialchars($_POST['id']);
  $admission_no = trim($_POST['admission_no'], " ");
  $name = htmlspecialchars($_POST['name']);
  $class = htmlspecialchars($_POST['class']);
  $gender = htmlspecialchars($_POST['gender']);
  $hobbies = htmlspecialchars($_POST['hobbies']);

  if(empty($admission_no)){
    $err0 = true;

  }
  if(empty($name)){
    $err1 = true;
  }
  if(empty($class)){
    $err2 = true; 

  }
  if(empty($subject)){
    $err5 = true;
  }
  if(empty($hobbies)){
    $err3 = true;
  }
  if(empty($gender)){
    $err4 = true;
  }
  if(!empty($admission_no) && !empty($name) && !empty($class) && !empty($hobbies) && !empty($gender)  && !empty($subject)){
    $sql = "UPDATE `employee` SET `admission_no` = '$admission_no', `name` = '$name', `class` = '$class', `subject` = '$subject', `gender` = '$gender', `hobbies` = '$hobbies' WHERE `employee`.`sr_no` = '$sr';";
    if(mysqli_query($conn, $sql)){
      echo "Record updated successfully!";
      header("Location: ./table.php");
      die;
    }else{
      echo "Error updating record : " . mysqli_error($conn);
    }
  }
}
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/bootstrap.css">
    <title> data table</title>
    <style>
      table {
        font-family: arial, sans-serif;
        border-collapse: collapse;    
        width: 100%;
        border-radius: 3;
      }

      body {
        background-image: url(https://images.pexels.com/photos/614117/pexels-photo-614117.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1);
        background-repeat: no-repeat;
        background-size: cover;
      }

      th {
        font-weight: 900;
        font-size: 20px;
        background-color: rgba(0, 0, 0, 0.5);
        border: 1px solid;
        text-align: center;
        padding: 8px;
        color: #CCC;
      }

      td {
        background-color: rgba(0, 0, 0, 0.5);
        border: 1px solid;
        text-align: center;
        padding: 8px;
        color: white;
      }

      tr:nth-child(even) {
        background-color: black;
      }

      h1 {
        text-align: center;
      }

      strong {
        color: white;
      }
    </style>
  </head>
  <body>
    <?php
      

      $search = null;
      $sort = 'NOR';

      if(isset($_GET['del'])){
        $del = $_GET['del'];
        foreach($del as $sr){
          $sql = "DELETE FROM `employee` WHERE `employee`.`sr_no` = '$sr';";
          mysqli_query($conn, $sql);
        }
      }

      $sql = "SELECT * FROM `employee`";
      $result = mysqli_query($conn, $sql);
      $total_records = mysqli_num_rows($result);

      $num_per_page=10;

      if(isset($_GET["page"])){
        $page=$_GET["page"];
      }
      else{
        $page=1;
      }

      $start_from=($page-1)*10;

      $sql="SELECT * from employee limit $start_from,$num_per_page";
      $result = mysqli_query($conn, $sql);
      $rows = mysqli_num_rows($result);
      $total_page = ceil($total_records/$num_per_page);
      
      if(isset($_GET['sorting'])){
        $sort = $_GET['sorting'];
        if($sort == 'NOR'){
        $sql = "SELECT * FROM `employee` limit $start_from,$num_per_page";
        }else{
          $sql = "SELECT * FROM `employee` ORDER BY `employee`.`name` $sort limit $start_from,$num_per_page";
        }
        $result = mysqli_query($conn, $sql);
        $rows = mysqli_num_rows($result);
      }

      if(isset($_GET['search'])){
        $search = $_GET['search'];
        if(!empty($search)){
          $sql = "SELECT * FROM `employee` WHERE `name` like '%$search%'";
          $result = mysqli_query($conn, $sql);
          $rows = mysqli_num_rows($result);
        }
      }
    ?>

    <nav class="navbar navbar-expand-lg navbar-light bg-light navbar navbar-dark bg-dark">
      <a class="navbar-brand btn btn-outline-danger my-2 my-sm-0" href="./insert_form.php" data-toggle="modal"
              data-target="#insertModal">Form</a>
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav">
          <li class="nav-item active">
            <a class="navbar-brand btn btn-outline-danger my-2 my-sm-0" href="./table.php">Data table</a>
          </li>
          <li style="margin-left:1100px" ; class="nav-item active">
            <button type="button" class="btn btn-outline-danger mx-3 my-sm-0" data-toggle="modal"
              data-target="#insertModal">Form</button>
          </li>
          <li class="nav-item active">
            <a class="btn btn-outline-danger mx-3 my-sm-0" href="./sign_in_out.php/logout.php">Logout</a>
          </li>
        </ul>
        <form class="form-inline my-2 my-lg-0">
          <input class="form-control mr-sm-2" type="search" placeholder="search" name="search"
            value="<?php echo $search; ?>">
          <button class="btn btn-outline-danger my-2 my-sm-0" type="submit">Search</button>
        </form>
      </div>
    </nav>

    <h1 style="padding:20px; color:white;"> Table with MySQL data </h1>
    <form action="./table.php" method="get">
      <div class="container">
        <table>
          <thead>
            <tr>
              <th>Select</th>
              <th>Sr. No.</th>
              <th>Image</th>
              <th>Admission no.</th>
              <th>
                <a style='color:white;' href="
                  <?php
                    if ($sort == "NOR") {
                      echo "./table.php?sorting=ASC&page=$page";
                    } elseif($sort=="ASC" ) {
                      echo "./table.php?sorting=DESC&page=$page";
                    } else { 
                      echo "./table.php"; 
                    } 
                  ?>">
                  Name
                </a>
              </th>
              <th>Class</th>
              <th>Subject</th>
              <th>Gender</th>
              <th>Hobbies</th>
              <th>Created_at</th>
              <th>Updated_at</th>
              <th> Operations</th>
            </tr>
          </thead>
          <tbody>
            <?php
              if ($rows > 0) {
                $sr = $start_from;
                for ($i = 0; $i < $rows; $i++) {
                  $row = mysqli_fetch_assoc($result);
                  $sr++;
                  echo 
                  "<tr>
                    <td>" . "<input type = 'checkbox' name ='del[]' value = $row[sr_no]>" . "</td>
                    <td class = 'serial-no'>" . $sr . "</td>
                    <td><img style ='width:70px' src='./images/" .$row["image"] . "'></td>
                    <td>" . $row["admission_no"] . "</td>
                    <td>" . $row["name"] . "</td>
                    <td>" . $row["class"] . "</td>
                    <td>" . $row["subject"] . "</td>
                    <td>" . $row["gender"] . "</td>
                    <td>" . $row["hobbies"] . "</td>
                    <td>" . $row["created_at"] . "</td>
                    <td>" . $row["updated_at"] . "</td>
                    <td>"."<a stud-id=$row[sr_no] class='edit_btn' data-toggle='modal' data-target='#updateModal'>Edit</a> 
                    <a href = './del.php?sr=$row[sr_no]' class='del'>Delete</a> "."</td>
                  </tr>";
                }
              }else{
                echo "<h1>Data not found !!</h1>";
              }
            ?>
          </tbody>
        </table>
        <button class="btn btn-outline-danger my-4" type="submit"> delete </button>

        <?php
          if(empty($search)){ 
        ?>
        <div style="float:right; padding-top:10px;">
          <div style='padding: 10px 20px 0px; border-top: dotted 1px #CCC;'>
            <strong> Page
              <?php echo $page . " of " . $total_page; ?>
            </strong>
          </div>
          <?php 

              $disabled = null;
              if($page <=1){
                $disabled = "disabled";
              }
              echo "<a href='./table.php?page=".($page-1)."&sorting=$sort' class='$disabled btn btn-danger mr-1'>Previous</a>";


              if($total_page <= 10){
                for($i=1;$i<=$total_page;$i++)
                {
                  if($i == $page){
                    echo "<a class='btn btn-danger mr-1'>$i</a>";
                  }else{
                    echo "<a href='./table.php?page=".$i."&sorting=$sort' class='btn btn-primary mr-1'>$i</a>";
                  }
                }
              }

              $disabled = null;
              if(($page+1) >= $i){
                $disabled = "disabled";
              }
              echo "<a href='./table.php?page=".($page+1)."&sorting=$sort' class='$disabled btn btn-danger mr-1'>Next</a>";
              if ($page < $total_page) {
                echo "<a href='./table.php?page=".$total_page."' class='btn btn-danger'>Last &rsaquo;&rsaquo;</a>";
              }
            }
          ?>
        </div>
      </div>
    </form>
    <?php include './insert_form.php'; ?>
    <?php include './update.php'; ?>
    <?php include './sweetalert/delete.php'; ?>
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js"
      integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj"
      crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct"
      crossorigin="anonymous"></script>
      <script src="./script.js"></script>
  </body>
</html>