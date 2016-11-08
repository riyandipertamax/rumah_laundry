<?php
	require_once ('../config/database.php');
	$ok			= $_GET['ok'];
	$aksi		= $_GET['aksi'];
		
	if ($aksi == 'tambah') {
		$ok			= $_GET['ok'];
		$order_id	= $_POST['ord_id2'];
		$nama		= $_POST['nama'];
		$ukuran 	= $_POST['ukuran'];
		$jumlah		= $_POST['jumlah'];
		$subtotal	= $_POST['subtotal'];
		$harga 		= $_POST['harga'];


		if ($nama == '--------' ){
			header('location:../view/admin/order_view.php?status=1&cari=&ok=baru');
		} elseif ($ukuran == '--------' ){
			header('location:../view/admin/order_view.php?status=2&cari=&ok=baru');
		} elseif ($jumlah == '' || $jumlah == 0 ){
			header('location:../view/admin/order_view.php?status=3&cari=&ok=baru');
		} elseif ($harga == '' || $harga == 0 ){
			header('location:../view/admin/order_view.php?status=4&cari=&ok=baru');
		} else {
			$sql = "INSERT INTO order_detail(order_id,tarif_id,order_detail_jumlah,order_detail_subtotal) VALUES ('$order_id',(SELECT tarif_id FROM tarif WHERE tarif_nama='$nama' AND tarif_ukuran='$ukuran'),$jumlah,$subtotal)";
		}
	} elseif ($aksi == 'hapus') {
		$id 		= $_GET['id'];

		$sql 		= "DELETE FROM order_detail WHERE order_detail_id='$id'";
	} elseif ($aksi == 'print') {
		$kode		= $_GET['kode'];
		$admin 		= $_GET['admin'];
		$level		= $_GET['level'];
		$date 		= gmdate("Y-m-d H:i:s", time()+60*60*7);
		$total 		= $_GET['total'];

		$cek_detail = mysql_query("SELECT * FROM order_detail WHERE order_id='$kode'");
		$r_cek		= mysql_num_rows($cek_detail);

		if ($r_cek == 0) {
			header('location:../view/admin/order_view.php?status=1&cari=&ok=baru');
		} else {
			$sql = "INSERT INTO `rumah_laundry`.`order` (`order_id`, `admin_id`, `order_tanggal_transaksi`, `order_total_bayar`) VALUES ('$kode', (SELECT admin_id FROM admin WHERE admin_nama='$admin' AND level='$level'), '$date', '$total')";
		}
	} elseif ($aksi == 'batal') {
		$id 		= $_GET['id'];

		$cek_detail = mysql_query("SELECT * FROM order_detail WHERE order_id='$id'");
		$r_cek		= mysql_num_rows($cek_detail);

		if ($r_cek != 0) {
			$sql 		= "DELETE FROM order_detail WHERE order_id='$id'";
		} else {
			header('location:../view/admin/order_view.php?status=1&cari=&ok=batal');
		}
	} elseif ($aksi == 'batal2') {
		$id 		= $_GET['id'];
		$cari  		= $_GET['cari'];

		$sql 		= "DELETE FROM  `order` WHERE `order_id`='$id'";

		$result = mysql_query($sql) or die(mysql_error());

		if ($result) {
			$sql 		= "DELETE FROM  `order_detail` WHERE `order_id`='$id'";

			$result = mysql_query($sql) or die(mysql_error());

			if ($result) {
				?>
				<script type="text/javascript">
					window.location.href="http://localhost/rumah_laundry/view/admin/checklist_view.php?status=0&cari=";
				</script>
				<?php
			} else {
				header('location:../view/admin/checklist_view.php?status=0&cari=');
			}
			?>
			<script type="text/javascript">
				window.location.href="http://localhost/rumah_laundry/view/admin/checklist_view.php?status=0&cari=";
			</script>
			<?php
		} else {
			header('location:../view/admin/checklist_view.php?status=0&cari=');
		}
	}

	$result = mysql_query($sql) or die(mysql_error());

	if ($result) {
		?>
		<script type="text/javascript">
			window.location.href="http://localhost/rumah_laundry/view/admin/order_view.php?status=0&cari=&ok=<?php echo $ok; ?>";
		</script>
		<?php
	} else {
		header('location:../view/admin/order_view.php?status=1&cari=');
	}
?>