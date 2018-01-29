<?php
	include ("connect.php");
	$name=$_POST['uname'];
	$email=$_POST['email'];
	$type=$_POST['type'];
	$sn=$_POST['Sn'];
	$query="SELECT `file` FROM `downloads` WHERE `Sn`=$sn";

	
	$result = mysqli_query($conn, $query) or die($query."<br/><br/>".mysql_error());
	$value= mysqli_fetch_array($result);

    $file= "downloads/".$type."/".$value['file'];
    unlink($file);

    $query="DELETE FROM `downloads` WHERE `Sn`=$sn";
    $values=mysqli_query($conn,$query);
    mysqli_close($conn);
    echo '<form action="download.php" method="post" id="s">',
			'<input type="hidden" name="uname" value="'.$name.'">',
			'<input type="hidden" name="email" value="'.$email.'">',
			'<input type="hidden" name="dtype" value="'.$type.'">',
		'</form>';
	echo "<script> document.getElementById('s').submit(); </script>";
    exit();
?>