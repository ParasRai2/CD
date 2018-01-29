<?php
	include ('connect.php');
	$name=$_POST['uname'];
	$email=$_POST['email'];

	$sn=$_POST['sn'];
	$query="DELETE FROM `contacts` WHERE `Sn`=$sn";
	mysqli_query($conn,$query);
	mysqli_close($conn);
	echo '<form action="contact.php" method="post" id="cf">',
			'<input type="hidden" name="uname" value="'.$name.'">',
			'<input type="hidden" name="email" value="'.$email.'">',
			'</form>';
	echo "<script> document.getElementById('cf').submit(); </script>";
	exit();
?>