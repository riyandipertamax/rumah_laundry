<?php 
	session_start();
	include '../config/database.php';

	$username 	= $_POST['admin_username'];
	$password 	= $_POST['admin_password'];
	$level 		= $_POST['level'];
	$pass 		= md5($password);

	$query 		= mysql_query("SELECT * FROM `admin` WHERE `level` = '$level' AND `admin_username` = '$username' AND `admin_password` = '$pass'") or die(mysql_error());

	$sess 		= mysql_fetch_array($query);

	if(mysql_num_rows($query) == 1){
		$_SESSION['admin_nama']	= $sess['admin_nama'];
		$_SESSION['level']		= $sess['level'];
		header("location:../view/index.php");
	}else{
		header("location:../index.php?pesan=gagal")or die(mysql_error());
	}
 ?>

