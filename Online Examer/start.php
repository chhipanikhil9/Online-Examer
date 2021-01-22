<?php
session_start();
	if(!isset($_SESSION['isloggedin'])){
			header('location:login.php');
	}
?>