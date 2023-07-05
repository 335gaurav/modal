<?php
// include "./conn.php";      

$name = null;
$class = null;
$gender = null;
$admission_no = null;
$subject = null;
$hobbies = null;
$image = null;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $admission_no = htmlspecialchars($_POST['admission_no']);
  $name = htmlspecialchars($_POST['name']);
  $class = htmlspecialchars($_POST['class']);
  $subject = isset($_POST["subject"]) ? implode(', ', $_POST['subject']) : null;
  $gender = htmlspecialchars($_POST['gender']);
  $hobbies = htmlspecialchars($_POST['hobbies']);
  $image = $_FILES['image']['name'];

  $allowed_extension = array('png', 'jpg', 'jpeg');
  $filename = $_FILES['image']['name'];
  $file_extension = pathinfo($filename, PATHINFO_EXTENSION);
  if (!in_array($file_extension, $allowed_extension)) {
    $ext_validation = "<p class='text-danger' id='ext'> *You are allowed with only jpg png and jpeg </p>";
  } else {

    if (file_exists("./images/". $_FILES['image']['name'])) {
      $filename = $_FILES['image']['name'];
      $existed_image = '<p class="text-danger" id="exist"> Image already exists </p>' . $filename;
    } else {

      if (!empty($image) && !empty($admission_no) && !empty($name) && !empty($class) && !empty($hobbies) && !empty($gender) && !empty($subject)) {
        $sql = "INSERT INTO `employee` (`image`, `admission_no`, `name`,`class`, `subject`, `gender`, `hobbies`) VALUES ( '$image', $admission_no, '$name', '$class', '$subject', '$gender','$hobbies');";

        if (mysqli_query($conn, $sql)) {
          echo "<p class = 'text-success'>Form submitted succesfully !!</p><br>";
          // header('Location: ./table.php');
          move_uploaded_file($_FILES['image']['tmp_name'], "./images/$image");
        } else {
          echo "not inserted";
        }
      }
    }
  }
}
?>

<div class="modal fade" id="insertModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"><b>Insert Form</b></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form class="container" method="post" enctype="multipart/form-data">

          <!-- <label class="h3" for="image"> Upload your image: </label><br>
        <input type="file" name="image" > -->

          <label class="h3" for="image"> Upload your image: </label><br>
          <div class="input-group input-group-lg">
            <div class="input-group-prepend">
            </div>
            <input type="file" id="img" name="image"  value="<?php echo $image; ?>">
          </div><br>
          <p id="imgErr" class = "text-danger"></p>
          <?php //echo isset($ext_validation) ? $ext_validation : null; ?>
          <!-- <p id="admErr" class="text-danger"></p> -->

          <label class="h3" for="admission_no"> Admission no: </label><br>
          <div class="input-group input-group-lg">
            <div class="input-group-prepend">
            </div>
            <input type="text" id="admission_no" class="form-control" name="admission_no"
              placeholder="Enter admission no." value="<?php echo $admission_no; ?>">
          </div><br>
          <p id="admErr" class="text-danger"></p>

          <label class="h3" for="name"> Name: </label><br>
          <div class="input-group input-group-lg">
            <div class="input-group-prepend">
            </div>
            <input type="text" id="name" class="form-control" name="name" placeholder="Enter name"
              value="<?php echo $name; ?>">
          </div><br>
          <p id="nameErr" class='text-danger '><b></b></p>

          <label class="h3" for="class"> Class: </label><br>
          <div class="input-group input-group-lg">
            <div class="input-group-prepend">
            </div>
            <input type="text" id="class" class="form-control" name="class" placeholder="Enter class"
              value="<?php echo $class; ?>"><br>
          </div><br>
          <p id="classErr" class='text-danger'></p>

          <label class="mt-1 h3" for="subject"> Subjects: </label><br>
          <!-- <input type = "hidden" name="subject[]"> -->
          <div class="form-check form-check-inline">
            <input class="check form-check-input" type="checkbox" name="subject[]" id="English" value="English" <?php if
              ($subject=="English" ) { echo "checked" ; } ?>>
            <label class="form-check-label" for="English">English</label>
          </div>
          <div class="form-check form-check-inline">
            <input class="check form-check-input" type="checkbox" name="subject[]" id="Hindi" value="Hindi" <?php if
              ($subject=="Hindi" ) { echo "checked" ; } ?>>
            <label class="form-check-label" for="Hindi">Hindi</label>
          </div>
          <div class="form-check form-check-inline">
            <input class="check form-check-input" type="checkbox" name="subject[]" id="Science" value="Science" <?php if
              ($subject=="Science" ) { echo "checked" ; } ?>>
            <label class="form-check-label" for="Science">Science</label>
          </div>
          <div class="form-check form-check-inline">
            <input class="check form-check-input" type="checkbox" name="subject[]" id="Maths" value="Maths" <?php if
              ($subject=="Maths" ) { echo "checked" ; } ?>>
            <label class="form-check-label" for="Maths">Maths</label>
          </div><br>
          <p id="subErr" class='text-danger'></p>

          <label class="h3 mt-4" for="hobbies"> Hobbies: </label><br>
          <select class="form-control" id="hobbies" name="hobbies">
            <option value="">select a hobbie !!</option>
            <option <?php if ($hobbies=="reading books" ) { echo "selected" ; } ?> value="reading books">reading books
            </option>
            <option <?php if ($hobbies=="listening music" ) { echo "selected" ; } ?> value="listening music">listening
              music</option>
            <option <?php if ($hobbies=="swimming" ) { echo "selected" ; } ?> value="swimming"> swimming</option>
            <option <?php if ($hobbies=="playing cricket" ) { echo "selected" ; } ?> value="playing cricket">playing
              cricket</option>
          </select>
          <p class='text-danger' id="hobErr"></p>


          <div class="mt-4">
            <label for="gender" class="mt-1 h3">Gender:</label><br>
            <input type="hidden" name="gender">
            <input type="radio" id="Male" class="gender" name="gender" value="Male" <?php if ($gender=="Male" ) {
              echo "checked" ; } ?>>
            <label for="Male">Male</label>

            <input type="radio" id="Female" class="gender" name="gender" value="Female" <?php if ($gender=="Female" ) {
              echo "checked" ; } ?>>
            <label for="Female">Female</label><br>
            <p id="genErr" class='text-danger'></p>

            <input type="submit" id="submit-btn" value="submit" class="btn btn-primary btn-lg mt-4" name="submit">
          </div>
      </div>
      </form>
    </div>
  </div>
</div>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="./script.js"></script>