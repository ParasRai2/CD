
<?php		
	unset($_COOKIE['blogparasemail']);
	unset($_COOKIE['blogparaspass']);
    setcookie('blogparasemail', '', time() - 3600, '/'); // empty value and old timestamp
    setcookie('blogparaspass', '', time() - 3600, '/'); // empty value and old timestamp
	header("location: index.php");
?>