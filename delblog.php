<?php
	$name=$_POST['uname'];
	$email=$_POST['email'];
	$sn=$_POST['Sn'];

	include ("conn.php");
	$query="SELECT * FROM `blog`";

	$value=mysqli_query($conn,$query);
	while ($row=mysqli_fetch_array($value))
	{
		if($row['Sn']==$sn)
		{
			$title=$row['title'];
			break;
		}
	}

	$query="DELETE FROM `blog` WHERE `Sn`=$sn";
	mysqli_query($conn,$query);

	//The name of the folder.
	$folder = "blog/".$title;
	 
	//Get a list of all of the file names in the folder.
	$files = glob($folder . '/*');
	 
	//Loop through the file list.
	foreach($files as $file){
	    //Make sure that this is a file and not a directory.
	    if(is_file($file)){
	        //Use the unlink function to delete the file.
	        unlink($file);
	    }
	}
	rmdir($folder);
	mysqli_close($conn);

?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
	<form action="index.php" method="post" id="q">
		<input type="hidden" name="uname" value="<?php echo $name; ?>">
		<input type="hidden" name="email" value="<?php echo $email; ?>">
	</form>
	<script type="text/javascript">
		document.getElementById("q").submit();
	</script>

</body>
</html>