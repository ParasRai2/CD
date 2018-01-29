<?php
	include ("conn.php");

	$name=$_POST['uname'];
	$email=$_POST['email'];

	$sn=$_POST['sn'];

	$query="SELECT * FROM `gallery` WHERE `SN`=$sn";
	$result = mysqli_query($conn, $query) or die($query."<br/><br/>".mysql_error());
	$value= mysqli_fetch_array($result);
    
    $file= "gallery/".$value['photo'];
    unlink($file);
	
	$query="DELETE FROM `gallery` WHERE `SN`=$sn";
	mysqli_query($conn,$query);
	mysqli_close($conn);
	echo '<form action="gallery.php" method="post" id="gf">',
			'<input type="hidden" name="uname" value="'.$name.'">',
			'<input type="hidden" name="email" value="'.$email.'">',
			'</form>';
		echo "<script> document.getElementById('gf').submit(); </script>";
	exit();
?>