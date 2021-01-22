<?php
	$host='localhost:3306';
	$user='root';
	$pass='';
	$db='project';
	$con=mysqli_connect($host,$user,$pass,$db);
	if(!$con){
		die('could not connect'.mysqli_connect_error());
	}
?>