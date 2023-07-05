
<div class="modal fade" id="updateModal" tabindex="-1" aria-labelledby="updateModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="updateModalLabel">Edit your details:</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="mb-5 bg-white rounded">
          <div class="p-3 mb-2 bg-secondary text-white">
            <form class="container" method="post" action="./table.php">
              <h1 style="text-align:center"> Edit form </h1>

              <input type="hidden" name="sr_no" value="<?php echo $sr; ?> ">

              <label for="adm_no" class="mt-1 h3"> Admission no: </label><br>
              <div class="input-group input-group-lg">
                <div class="input-group-prepend">
                </div>
                <input type="text" id="adm_no" class="form-control" name="admission_no"
                  placeholder="Enter admission no." value="<?php echo $admission_no;?>">
              </div><br>
              <p class = 'text-white' id = "admissionErr"></p>


              <label for="uname" class="mt-1 h3"> Name: </label><br>
              <div class="input-group input-group-lg">
                <div class="input-group-prepend">
                </div>
                <input type="text" id="uname" class="form-control" name="name" placeholder="Enter name" value=<?php echo
                  $name; ?>>
              </div><br>
              <p class = 'text-white' id = "namErr"></p>

              <label for="cls" class="mt-1 h3"> Class: </label><br>
              <div class="input-group input-group-lg">
                <div class="input-group-prepend">
                </div>
                <input type="text" id="cls" class="form-control" name="class" placeholder="Enter class" value=<?php
                  echo $class; ?>><br>
              </div><br>
              <p class = 'text-white' id = "clsErr"></p>


              <label class="mt-1 h3" for="subject"> Subjects: </label><br>
              <div class="form-check form-check-inline">
                <input class="sub form-check-input" type="checkbox" name="subject[]" id="English1" value="English" <?php
                  if(strpos($subject,"English") !==false){ echo "checked" ; } ?>>
                <label class="form-check-label" for="English1">English</label>
              </div>

              <div class="form-check form-check-inline">
                <input class="sub form-check-input" type="checkbox" name="subject[]" id="Hindi1" value="Hindi" <?php
                  if(strpos($subject,"Hindi") !==false){ echo "checked" ; } ?> >
                <label class="form-check-label" for="Hindi1">Hindi</label>
              </div>
              <div class="form-check form-check-inline">
                <input class="sub form-check-input" type="checkbox" name="subject[]" id="Science1" value="Science" <?php
                  if(strpos($subject,"Science") !==false){ echo "checked" ; } ?> >
                <label class="form-check-label" for="Science1">Science</label>
              </div>
              <div class="form-check form-check-inline">
                <input class="sub form-check-input" type="checkbox" name="subject[]" id="Maths1" value="Maths" <?php
                  if(strpos($subject,"Maths") !==false){ echo "checked" ; } ?> >
                <label class="form-check-label" for="Maths1">Maths</label>
              </div><br>
              <p class = 'text-white' id = "subjectErr"></p>

              <label for="hobbies" class="mt-1 h3"> Hobbies: </label><br>
              <select class="form-control" id="hob" name="hobbies">
                <option value="">select a hobbie !!</option>
                <option <?php if($hobbies=="reading books" ){ echo "selected" ; } ?>
                  value = "reading books" >reading books
                </option>

                <option <?php if($hobbies=="listening music" ){ echo "selected" ; } ?>
                  value = "listening music" >listening music
                </option>

                <option <?php if($hobbies=="swimming" ){ echo "selected" ; } ?>
                  value = "swimming"> swimming
                </option>

                <option <?php if($hobbies=="playing cricket" ){ echo "selected" ; } ?>
                  value = "playing cricket" >playing cricket
                </option>
              </select>
              <p class = 'text-white' id = "hobbiesErr"></p>

              <div style="margin-top:10px">
                <label for="gender" class="mt-1 h3">Gender:</label><br>
                <input type="hidden" name="gender">
                <input type="radio" id="Male" class="male" name="gender" value="Male" <?php if($gender=="Male" ){ echo "checked" ; }
                  ?> >
                <label for="Male">Male</label>
                <input type="radio" id="Female" class="female" name="gender" value="Female" <?php if($gender=="Female" ){
                  echo "checked" ; } ?> >
                <label for="Female">Female</label><br>
                <p class = 'text-white' id = "genderErr"></p>
              </div>

              <input type="hidden" name="id" id = "id" >
              <input type="submit" value="update" id ="updatebtn" class="btn btn-dark btn btn-secondary btn-lg active btn-lg" name="update-btn">
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="./update.js"></script>
<script>

$(document).ready(function(){
        $('.edit_btn').click(function(){

          // $('#updateModal').modal('show');

          const studId = $(this).attr('stud-id');
          $("#id").val(studId);
          console.log(studId);
          $tr = $(this).closest('tr');
          console.log($tr);

            var data = $tr.children("td").map(function() {
              return $(this).text();
            }).get();

            console.log(data);

            $("#adm_no").val(data[3]);
            $("#uname").val(data[4]);
            $("#cls").val(data[5]);
            // $('input[id="edit_English"]:checked').val(data[5]);
              // $('.edit_btn').click(function() {
              $('input[name="subject[]"]:checked').val(data[6]);
              if (data[6].indexOf("English") >= 0) {
                $("#English1").click();
              }
               if (data[6].indexOf("Hindi") >= 0) {
                $("#Hindi1").click();
              }
               if (data[6].indexOf("Science") >= 0) {
                $("#Science1").click();
              } 
              if (data[6].indexOf("Maths") >= 0){
                $("#Maths1").click();
              }

              $("input[name='gender']:checked").val(data[7]);
            if(data[7] == 'Male'){
              $(".male").click();
            } else {
              $(".female").click();

            }

            $("#hob").val(data[8]);

              });
            // });
            // $('.sub').val(data[5]);
            // console.log(data[5]);

            // console.log(data[6]);
            // console.log(data[7]); 
          });

          // $("#updatebtn").val(studId);
          // console.log($("#updatebtn"));
</script>
