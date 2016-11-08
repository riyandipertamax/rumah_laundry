<?php
	require_once ('../config/database.php');

	$page		= $_GET['page'];
	$aksi		= $_GET['tombol'];

	if ($page == '') {
		$page = 1;
	}

	if ($aksi == 'tambah') {
		$nama		= $_POST['nama'];
		$username 	= $_POST['username'];
		$password	= $_POST['password'];
		$ulang		= $_POST['ulang'];
		$pl			= strlen($password);


		$validasi	= mysql_query("SELECT * FROM admin WHERE admin_username = '$username' ");
		$c_validasi	= mysql_num_rows($validasi);

		if ($c_validasi != 1) {
			if ($nama == '') {
				header('location:../view/admin/admin_view.php?status=2&cari=');
			} elseif ($username == '') {
				header('location:../view/admin/admin_view.php?status=2&cari=');
			} elseif ($password == '') {
				header('location:../view/admin/admin_view.php?status=2&cari=');
			} elseif ($ulang == '') {
				header('location:../view/admin/admin_view.php?status=2&cari=');
			} elseif ($nama == '' || $username == '' || $password == '' || $ulang == '') {
				header('location:../view/admin/admin_view.php?status=2&cari=');
			} elseif ($password != $ulang) {
				header('location:../view/admin/admin_view.php?status=3&cari=');
			} elseif ($pl <= 5) {
				header('location:../view/admin/admin_view.php?status=4&cari=');
			} else {
				$pass = md5($password);
				$sql = "INSERT INTO admin(admin_nama,admin_username,admin_password,level) VALUES('$nama','$username','$pass','2')";
			}
		} else {
			header('location:../view/admin/admin_view.php?status=1&cari=');
		}

	} elseif ($aksi == 'ubah') {
		$id			= $_POST['id'];
		$nama		= $_POST['nama'];
		$username 	= $_POST['username'];
		$password	= $_POST['password'];
		$ulang		= $_POST['ulang'];
		$pl			= strlen($password);

		$validasi	= mysql_query("SELECT * FROM admin WHERE admin_id != '$id' AND admin_username = '$username' ");
		$c_validasi	= mysql_num_rows($validasi);

		if ($c_validasi != 1) {
			if ($nama == '' || $username == '' || $password == '' || $ulang == '') {
?>	
			<script type="text/javascript">
				window.location.href="http://localhost/rumah_laundry/view/admin/edit_admin_form.php?id=<?php echo $id; ?>&status=2&page=<?=$page?>";
			</script>			
<?php
			} elseif ($password != $ulang) {
?>	
			<script type="text/javascript">
				window.location.href="http://localhost/rumah_laundry/view/admin/edit_admin_form.php?id=<?php echo $id; ?>&status=3&page=<?=$page?>";
			</script>			
<?php
			} elseif ($pl <= 5) {
?>	
			<script type="text/javascript">
				window.location.href="http://localhost/rumah_laundry/view/admin/edit_admin_form.php?id=<?php echo $id; ?>&status=4&page=<?=$page?>";
			</script>			
<?php
			} else {
				$pass = md5($password);
				$sql = "UPDATE admin SET admin_nama='$nama', admin_username='$username', admin_password='$pass' WHERE admin_id='$id'";
			}
		} else {
?>
			<script type="text/javascript">
				window.location.href="http://localhost/rumah_laundry/view/admin/edit_admin_form.php?id=<?php echo $id; ?>&status=1&page=<?=$page?>";
			</script>
<?php
		}
	} else {
		$id2		= $_REQUEST['id'];
		$sql = "DELETE FROM admin WHERE admin_id='$id2'";
	}

	$result = mysql_query($sql) or die(mysql_error());

	if ($result) {
		?>
		<script type="text/javascript">
			window.location.href="http://localhost/rumah_laundry/view/admin/admin_view.php?status=0&page=<?=$page?>&cari=";
		</script>
		<?php
	} else {
		header('location:../view/admin/admin_view.php?status=1&cari=');
	}
?>