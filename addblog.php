<?php
	include ("connect.php");
	$name=$_POST['uname'];
	$email=$_POST['email'];
	$title=$_POST['title'];
	$blog=$_POST['content'];
	$path = "blog/".$title."/";
	mkdir($path); 
	$p1 = $path . basename($_FILES["g1"]["name"]);
	$fi1 =$_FILES["g1"]["name"];
	move_uploaded_file($_FILES['g1']['tmp_name'], $p1);
	$p2 = $path . basename($_FILES["g2"]["name"]);
	$fi2 =$_FILES["g2"]["name"];
	move_uploaded_file($_FILES['g2']['tmp_name'], $p2);
	$p3 = $path . basename($_FILES["g3"]["name"]);
	$fi3 =$_FILES["g3"]["name"];
	move_uploaded_file($_FILES['g3']['tmp_name'], $p3);
	$query="INSERT INTO `blog`(`title`, `blog`, `p1`, `p2`, `p3`) VALUES ('$title','$blog','$fi1','$fi2','$fi3')";
	mysqli_query($conn,$query);
	mysqli_close($conn);

	echo "<form id='d' action='index.php' method='post'>";
	echo "<input type='hidden' name='uname' value='".$name."'>";
	echo "<input type='hidden' name='email' value='".$email."'>";
	echo "</form>";
	echo "<script> document.getElementById('d').submit(); </script>";
	exit();
?>