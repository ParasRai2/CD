<?php
	include ("conn.php");
	$name=$_POST['uname'];
	$email=$_POST['email'];
	$contact=$_POST['contact'];
	$type=$_POST['type'];
	
	$query="INSERT INTO `contacts`(`type`, `contacts`) VALUES ('$type','$contact')";
	mysqli_query($conn,$query);
	mysqli_close($conn);

	echo "<form id='d' action='contact.php' method='post'>";
	echo "<input type='hidden' name='uname' value='".$name."'>";
	echo "<input type='hidden' name='email' value='".$email."'>";
	echo "</form>";
	echo "<script> document.getElementById('d').submit(); </script>";
	exit();
?>