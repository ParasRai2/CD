<?php
	include ("conn.php");

	$uname=$_POST['uname'];
	$email=$_POST['email'];
	$dtype=$_POST['dtype'];
	$name=$_POST['name'];
	$detail=$_POST['detail'];
	$type=$_POST['type'];

	$path = "downloads/".$type."/";
	$path = $path . basename($_FILES["fileToUpload"]["name"]);
	$fi =$_FILES["fileToUpload"]["name"];
	$i=move_uploaded_file($_FILES['fileToUpload']['tmp_name'], $path);
	if($i)
	{
		$query="INSERT INTO `downloads` (`Name`, `file`, `Type`, `Detail`) VALUES ('$name','$fi','$type','$detail')";
		mysqli_query($conn,$query);
		mysqli_close($conn);
	}
?>

<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
	<form action="download.php" method="post" id="d">
		<input type="hidden" name="uname" value="<?php echo $uname; ?>">
		<input type="hidden" name="email" value="<?php echo $email; ?>">
		<input type="hidden" name="dtype" value="<?php echo $dtype; ?>">
	</form>

	<script type="text/javascript">
		document.getElementById("d").submit();
	</script>
</body>
</html>