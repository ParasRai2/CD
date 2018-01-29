<?php
	include ("connect.php");
	$name=$_POST['uname'];
	$email=$_POST['email'];
	$namee=$_POST['name'];
	$con=$_POST['content'];
	$path = "image/";
	$fi1 =$_FILES["g1"]["name"];
	$fi2 =$_FILES["g2"]["name"];
	$fi3 =$_FILES["g3"]["name"];

	$sn=1;
	$query="SELECT * FROM `detail` WHERE `Id`=$sn";
	$value=mysqli_query($conn,$query);
	$row=mysqli_fetch_array($value);

	unlink($path.$row['P1']);
	unlink($path.$row['P2']);
	unlink($path.$row['P3']);


	$query="UPDATE `detail` SET `Name`='$namee' , `Info`='$con', `P1`='$fi1', `P2`='$fi2', `P3`='$fi3' WHERE `Id` = $sn";

	mysqli_query($conn,$query);
	
	mysqli_close($conn);
	$p1 = $path . basename($_FILES["g1"]["name"]);
	move_uploaded_file($_FILES['g1']['tmp_name'], $p1);
	$p2 = $path . basename($_FILES["g2"]["name"]);
	move_uploaded_file($_FILES['g2']['tmp_name'], $p2);
	$p3 = $path . basename($_FILES["g3"]["name"]);
	move_uploaded_file($_FILES['g3']['tmp_name'], $p3);

	echo "<form id='d' action='about.php' method='post'>";
	echo "<input type='hidden' name='uname' value='".$name."'>";
	echo "<input type='hidden' name='email' value='".$email."'>";
	echo "</form>";
	echo "<script> document.getElementById('d').submit(); </script>";
	exit();
?>