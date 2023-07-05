$(document).ready(function () {

  // $("#ext").hide();
  // let Error = true;
  // $("#img").change(function() {
  //   validateImg();
  // });
  // function validateImg() {
  //   let imgValue = $("#img").val();
  // }
  $("#imgErr").hide();
  let imageError = true;
  $("#img").change(function () {
    validateImg();
  });

  // const val = $("#img").val();
  // var file = $(this).get(val);
  // const fileType = file['tmp_name'];
  // const validImageTypes = ['image/gif', 'image/jpeg', 'image/png'];
  // if (!validImageTypes.includes(fileType)) {
  //   // invalid file type code goes here.
  //   $("#imgErr").show();
  //   $("#imgErr").text("*Image is not valid");
  // }
  // const fileSize = this.files[0].size / 1024;

  // var ext = this.value.split(".");
  // ext = ext[ext.length - 1].tolowerCase();
  // var arrayExtensions = ["jpg", "jpeg", "png"];

  // if(arrayExtensions.lastIndexof(ext) == -1){
  //   $("#imgErr").show();
  //   $("#imgErr").text("Invalid image format, Only .jpeg, .jpg and .png format allowed");
  //   $(this).val('');
  // } else if (fileSize > 200) {
  //   $("#imgErr").show();
  //   $("#imgErr").text("file is too large. Maximum 200kb is allowed !!");
  //   $(this).val('');
  //   imageErr = false;
  // }  
  function validateImg() {
    var val = $("#img").val();
    switch (val.substring(val.lastIndexOf('.') + 1).toLowerCase()) {
      case 'jpeg': case 'jpg': case 'png':
        imageError = false;
        $("#imgErr").hide();
        // $("#imgErr").text("*Image is valid")
        break;
        console.log(val);
      default:
        // $(this).va l('');
        // error message here
        imageError = true;
        $("#imgErr").show();
        $("#imgErr").text("*Image is not valid");
        break;
    }
  }



  // Validate Admission No.
  $("#admErr").hide();
  let admError = true;
  $("#admission_no").keyup(function () {
    validateAdm_no();
  });
  function validateAdm_no() {
    let admValue = $("#admission_no").val();
    if (admValue == "") {
      $("#admErr").show();
      $("#admErr").text('*Field is Required !!');
    } else if (admValue.length < 3 || admValue.length > 10) {
      $("#admErr").show();
      $("#admErr").text("**length of Admission No. must be between 3 and 10");
    } else {
      $("#admErr").hide();
      admError = false;
    }
  }

  // name validation
  $("#nameErr").hide();
  let nameError = true;
  $("#name").keyup(function () {
    validateName();
  });
  function validateName() {
    let nameValue = $("#name").val();
    if (nameValue == "") {
      $("#nameErr").show();
      $("#nameErr").text('*Field is Required !!');
    } else if (nameValue.length < 3 || nameValue.length > 15) {
      $("#nameErr").show();
      $("#nameErr").text("*length of Name must be between 3 and 15");
    } else {
      $("#nameErr").hide();
      nameError = false;
    }
  }

  //class validation
  $("#classErr").hide();
  let classError = true;
  $("#class").keyup(function () {
    validateClass();
  });
  function validateClass() {
    let classValue = $("#class").val();
    if (classValue == "") {
      $("#classErr").show();
      $("#classErr").text("*Field is required !!");
    } else if (classValue.length < 2 || classValue.length > 10) {
      $("#classErr").show();
      $("#classErr").text("*length of Class must be between 0 to 10");
    } else {
      $("#classErr").hide();
      classError = false;
    }
  }

  //subject validation
  $("#subErr").hide();
  let subError = true;
  $(".check").change(function () {
    validateSub();
  });
  function validateSub() {
    let subValue = $("input[type='checkbox']:checked");
    if (subValue.length === 0) {
      $("#subErr").show();
      $("#subErr").text('*Field is required !!');
    } else {
      $("#subErr").hide();
      subError = false;
    }
  }

  //hobbies validation
  $("#hobErr").hide();
  let hobError = true;
  $("#hobbies").change(function () {
    validateHob();
  });
  function validateHob() {
    let hobValue = $("#hobbies").val();
    if (hobValue.length == "") {
      $("#hobErr").show();
      $("#hobErr").text('*Field is required !!');
    } else {
      $("#hobErr").hide();
      hobError = false;
    }
  }

  //gender validation 
  $("#genErr").hide();
  let genError = true;
  $(".gender").change(function () {
    validateGen();
  });
  function validateGen() {
    let genValue = $("input[name='gender']:checked");
    if (genValue.length == "") {
      $("#genErr").show();
      $("#genErr").text('*Field is required !!');
    } else {
      $("#genErr").hide();
      genError = false;
    }
  }
});

//submit button query
$("#submit-btn").click(function (event) {
  validateImg();
  validateAdm_no();
  validateName();
  validateClass();
  validateSub();
  validateGen();
  validateHob();

  if (
    imageError == true &&
    admError == true &&
    nameError == true &&
    classError == true &&
    subError == true &&
    genError == true &&
    hobError == true

  ) {
    event.preventDefault();
  }
});

// $('#submitbtn').submit(function(event) {
//   event.preventDefault(); // prevent form submission
//   // form validation code here
//   Swal.fire({
//     icon: 'success',
//     title: 'Success!',
//     text: 'Your form has been submitted.',
//   });
  // if form is valid, show Sweet Alert confirmation dialog

// });