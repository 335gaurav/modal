<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/11.0.18/sweetalert2.min.css">
		<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/11.0.18/sweetalert2.min.js"></script>
    <title>Document</title>

</head>
<body >
<?php
include "./conn.php";

if(isset($_GET['sr'])){
	$sr = $_GET['sr'];
	$sql = "DELETE FROM `employee` WHERE `employee`.`sr_no` = '$sr';";
	if(mysqli_query($conn, $sql)){
			echo "record delete successfully !";
			header("Location: ./table.php");
	} else {
			echo "record not deleted: " . mysqli_error($conn);
	}
}

?>
<script>
	// $('.del').on('click', function() {
	// 		Swal.fire('data is being deleted');
	// });

	$('.del').on('click', function(event) {
		event.preventDefault();
		let url = $(this).attr('href');
	Swal.fire({
			title: 'Confirmation',
			text: 'Are you sure you want to delete this data?',
			icon: 'warning',
			showCancelButton: true,
			confirmButtonColor: '#3085d6',
			cancelButtonColor: '#d33',                   
			confirmButtonText: 'Delete',
	}).then((result) => {
			if (result.isConfirmed) {
				window.location.href = url;
			}
	});
	});
	 


// Create a Swal object with a delete button
// Swal.fire({
//   title: 'Are you sure?',
//   text: "You won't be able to revert this!",
//   icon: 'warning',
//   showCancelButton: true,
//   confirmButtonColor: '#3085d6',
//   cancelButtonColor: '#d33',
//   confirmButtonText: 'Yes, delete it!'
// }).then((result) => {
//   // If the user clicks the Delete button
//   if (result.isConfirmed) {
//     // Redirect to the URL specified in the anchor tag
//     window.location.href = $('.del').attr('href');
//   }
// });

// // Specify the URL in the anchor tag
// $('.del').attr('href', './del.php?sr=$row[sr_no]');


</script>
</body>
</html>
