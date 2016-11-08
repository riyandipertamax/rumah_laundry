<?php 
	require_once ('../config/database.php');

	$id		 = $_REQUEST['id'];
	$paslama = md5($_POST['lama']);
	$pasbar	 = $_POST['baru'];
	$pasul	 = $_POST['ulang'];
	$barlen  = strlen($pasbar);
	$ulen	 = strlen($pasul);



	$q_validasi	= mysql_query("SELECT * FROM admin WHERE admin_id=$id");
	$f_validasi = mysql_fetch_object($q_validasi);
	$r_validasi = mysql_num_rows($q_validasi);
	
	$id2 = $f_validasi->admin_id;
	$pass= $f_validasi->admin_password;

	if ($paslama == '') {
		header('location:../view/petugas/ch_password_view.php?status=1');
	} elseif ($paslama != $pass) {
		header('location:../view/petugas/ch_password_view.php?status=2');
	} elseif ($pasbar != $pasul) {
		header('location:../view/petugas/ch_password_view.php?status=3');
	} elseif ($barlen <= 5 && $ulen <= 5) {
		header('location:../view/petugas/ch_password_view.php?status=4');
	} else {
		$password = md5($pasbar);
		$sql	  = "UPDATE admin SET admin_password='$password' WHERE admin_id=$id";
	}

	$result = mysql_query($sql) or die (mysql_error());

	if ($result) {
		header('location:../view/petugas/ch_password_view.php?status=0');
	} else {
		header('location:../view/petugas/ch_password_view.php?status=5');
	}
?>