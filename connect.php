<?php
	include ("conn.php");
    $query ="SELECT * FROM `detail`";
    $value=mysqli_query($conn, $query);
    $s=0;
    while ($row=mysqli_fetch_array($value))
    {
    	$s++;
    	break;
    }
    if($s==0)
    {
    	header("location: first.php");
    }


?>