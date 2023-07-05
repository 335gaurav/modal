$(document).ready(function () {
  
  // Validate Admission No.
  $("#admissionErr").hide();
  let admissionError = true;
  $("#adm_no").keyup(function () {
    validateAdm();
  });
  function validateAdm() {
    let admissionValue = $("#adm_no").val();
    if (admissionValue == "") {
      $("#admissionErr").show();
      $("#admissionErr").text('*Field is Required !!')
    } else if (admissionValue.length < 3 || admissionValue.length > 10) {
      $("#admissionErr").show();
      $("#admissionErr").text("**length of Admission No. must be between 3 and 10");
    } else {
      $("#admissionErr").hide();
      admissionError = false;
    }
  }

  $("#namErr").hide();
  let namError = true;
  $("#uname").keyup(function () {
    validateNam();
  });
  function validateNam() {
    let namValue = $("#uname").val();
    if (namValue == "") {
      $("#namErr").show();
      $("#namErr").text('*Field is Required !!')
    } else if (namValue.length < 3 || namValue.length > 15) {
      $("#namErr").show();
      $("#namErr").text("*length of Name must be between 3 and 15");
    } else {
      $("#namErr").hide();
      namError = false;
    }
  }

  $("#clsErr").hide();
  let clsError = true;
  $("#cls").keyup(function () {
    validateCls();
  });
  function validateCls() {
    let clsValue = $("#cls").val();
    if (clsValue == "") {
      $("#clsErr").show();
      $("#clsErr").text("*Field is required !!");
    } else if (clsValue.length < 2 || clsValue.length > 10) {
      $("#clsErr").show();
      $("#clsErr").text("*length of Class must be between 0 to 10");
    } else {
      $("#clsErr").hide();
      clsError = false;
    }
  }

  $("#subjectErr").hide();
  let subjectError = true;
  $(".sub").change(function () {
    validateSubject();
  });
  function validateSubject(){
  let subjectValue = $("input[type='checkbox']:checked");
    if (subjectValue.length === 0) {
      $("#subjectErr").show();
      $("#subjectErr").text('*Field is required !!');
    } else{
      $("#subjectErr").hide();
      subjectError = false;
    }
  }

  $("#hobbiesErr").hide();
  let hobbiesError = true;
  $("#hob").change(function () {
    validateHobbies();
  });
  function validateHobbies(){
  let hobbiesValue = $("#hob").val();
    if (hobbiesValue.length == "") {
      $("#hobbiesErr").show();
      $("#hobbiesErr").text('*Field is required !!');
    } else{
      $("#hobbiesErr").hide();
    hobbiesError = false;
    }
  }

  $("#genderErr").hide();
  let genderError = true;
  $(".gen").change(function () {
    validateGender();
  });
  function validateGender(){
  let genderValue = $("input[name='gender']:checked");
    if (genderValue.length == "") {
      $("#genderErr").show();
      $("#genderErr").text('*Field is required !!');
    } else{
      $("#genderErr").hide();
      genderError = false;
    }
  }

  $("#updatebtn").click(function (event) {
    validateAdm();
    validateNam();
    validateCls();
    validateSubject();
    validateGender();
    validateHobbies();  
    if (
      admissionError == true &&
      namError == true &&
      clsError == true &&
      subjectError == true &&
      genderError == true &&
      hobbiesError == true
    ) {
      event.preventDefault();
    }
  });
});


// $('#updatebtn').submit(function(event) {
//   event.preventDefault(); // prevent form submission
//   // form validation code here
//   Swal.fire({
//     icon: 'success',
//     title: 'Success!',
//     text: 'Your form has been submitted.',
//   });
  // if form is valid, show Sweet Alert confirmation dialog

// });