<?php
	include ("conn.php");

	$name=$_POST['uname'];
	$email=$_POST['email'];

	$title=$_POST['title'];
	$detail=$_POST['detail'];

	$path = "gallery/";
	$pathfull = $path . basename($_FILES["g1"]["name"]);
	$pa = basename($_FILES["g1"]["name"]);
	move_uploaded_file($_FILES['g1']['tmp_name'], $pathfull);
	$query="INSERT INTO `gallery`(`title`, `detail`, `photo`) VALUES ('$title','$detail','$pa')";
	mysqli_query($conn,$query);
	mysqli_close($conn);
	echo '<form action="gallery.php" method="post" id="gf">',
			'<input type="hidden" name="uname" value="'.$name.'">',
			'<input type="hidden" name="email" value="'.$email.'">',
			'</form>';
		echo "<script> document.getElementById('gf').submit(); </script>";
	exit();
?>