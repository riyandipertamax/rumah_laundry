<?php
	require_once ('../config/database.php');

	$page	= $_GET['page'];
	$aksi	= $_GET['tombol'];

	if ($page == '') {
		$page =1;
	}

	if ($aksi == 'tambah') {
		$nama 	= $_POST['nama'];
		$ukuran	= $_POST['ukuran'];
		$harga	= $_POST['harga'];


		$validasi 	= mysql_query("SELECT * FROM tarif WHERE tarif_nama='$nama' AND tarif_ukuran='$ukuran' ");
		$c_validasi	= mysql_num_rows($validasi);

		if ($c_validasi != 1) {
			if ($harga == '' || $harga == 0) {
				header('location:../view/admin/tarif_view.php?status=2&cari=');
			} elseif ($nama == '' || $ukuran == '--------') {
				header('location:../view/admin/tarif_view.php?status=3&cari=');
			} else {
				$sql = "INSERT INTO tarif(tarif_nama,tarif_ukuran,tarif_harga) VALUES('$nama','$ukuran','$harga')";	
			}
		} else {
			header('location:../view/admin/tarif_view.php?status=1&cari=');
		}

	} elseif ($aksi == 'ubah') {
		$id 	= $_GET['id'];
		$nama 	= $_POST['nama'];
		$ukuran	= $_POST['ukuran'];
		$harga	= $_POST['harga'];

		$validasi 	= mysql_query("SELECT * FROM tarif WHERE tarif_id!='$id' AND tarif_nama='$nama' AND tarif_ukuran='$ukuran' ");
		$c_validasi	= mysql_num_rows($validasi);

		if ($c_validasi != 1) {
			if ($harga == '' || $harga == 0) {
?>	
			<script type="text/javascript">
				window.location.href="http://localhost/rumah_laundry/view/admin/edit_tarif_form.php?id=<?php echo $id; ?>&status=2&page=<?=$page?>";
			</script>			
<?php
			} elseif ($nama == '') {
?>	
			<script type="text/javascript">
				window.location.href="http://localhost/rumah_laundry/view/admin/edit_tarif_form.php?id=<?php echo $id; ?>&status=3&page=<?=$page?>";
			</script>			
<?php
			} else {
				$sql = "UPDATE tarif SET tarif_nama='$nama', tarif_ukuran='$ukuran', tarif_harga='$harga' WHERE tarif_id='$id'";
			}
		} else {
?>
			<script type="text/javascript">
				window.location.href="http://localhost/rumah_laundry/view/admin/edit_tarif_form.php?id=<?php echo $id; ?>&status=1&page=<?=$page?>";
			</script>
<?php
		}
	} elseif ($aksi == 'hapus')  {
		$id2	= $_REQUEST['id'];

		$sql = "DELETE FROM tarif WHERE tarif_id='$id2'";

	}

	$result = mysql_query($sql) or die(mysql_error());

	if ($result) {
		?>
		<script type="text/javascript">
			window.location.href="http://localhost/rumah_laundry/view/admin/tarif_view.php?status=0&page=<?=$page?>&cari=";
		</script>
		<?php
	} else {
		header('location:../view/admin/tarif_view.php?status=1&cari=');
	}
?>