<?php 
	session_start();
			
	$level = $_SESSION['level'];

	if ($level=='1') {
		header("location:../view/admin/dashboard_view.php");
	}elseif ($level=='2') {
		header("location:../view/petugas/dashboard_view.php");
	}else{
		include '../config/session.php';
	}
?>