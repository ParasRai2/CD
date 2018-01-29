<?php
	$server="localhost";
	$dbname="proo";
	$password="";
	$root="root";

    $conn=mysqli_connect($server,$root,$password,$dbname);

	if(!$conn){
		$conn = new mysqli($server, $root, $password);
		$sql = "CREATE DATABASE ".$dbname;
		mysqli_query($conn,$sql);


    	$conn=mysqli_connect($server,$root,$password,$dbname);

		$sql = "CREATE TABLE `account` (Id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY, Name VARCHAR(50) NOT NULL, Password VARCHAR(50) NOT NULL, Email VARCHAR(100))";
		$conn->query($sql);

		$sql = "CREATE TABLE `blog` (Sn INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY, title VARCHAR(50) NOT NULL, blog VARCHAR(500) NOT NULL, p1 VARCHAR(100), p2 VARCHAR(100), p3 VARCHAR(100))";
		$conn->query($sql);

		$sql = "CREATE TABLE `contacts` (Sn INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY, type VARCHAR(50) NOT NULL, contacts VARCHAR(100) NOT NULL)";
		$conn->query($sql);

		$sql = "CREATE TABLE `detail` (Id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY, Name VARCHAR(50) NOT NULL, Info text NOT NULL, P1 VARCHAR(100), P2 VARCHAR(100), P3 VARCHAR(100))";
		$conn->query($sql);

		$sql = "CREATE TABLE `downloads` (Sn INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY, Name VARCHAR(100) NOT NULL, file VARCHAR(100) NOT NULL, Type VARCHAR(20), Detail VARCHAR(200))";
		$conn->query($sql);

		$sql = "CREATE TABLE `gallery` (SN INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY, title VARCHAR(50) NOT NULL, detail VARCHAR(100) NOT NULL, photo VARCHAR(100))";
		$conn->query($sql);
	}

    if(!$conn)
    {
        die("Connection failed");
    }
?>