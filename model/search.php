<?php 
	require_once ('../config/database.php');

	if (isset($_POST['tanggal1'])) {
		if (!isset($_POST['tanggal2'])) {
			$tanggal1 = $_POST['tanggal1'];

			$query = "SELECT * FROM rumah_laundry.order WHERE date(order_tanggal_transaksi)='$tanggal1'";

		} elseif (isset($_POST['tanggal2'])) {
			$tanggal1 = $_POST['tanggal1'];
			$tanggal2 = $_POST['tanggal2'];

			$query = "SELECT * FROM rumah_laundry.order WHERE date(order_tanggal_transaksi) BETWEEN 'tanggal1' AND 'tanggal2'";
		}
	} elseif (isset($_POST['tahun'])) {
		if (!isset($_POST['bulan'])) {
			$tahun = $_POST['tahun'];

			$query = "SELECT * FROM rumah_laundry.order WHERE year(order_tanggal_transaksi) = 'tahun'";
		} elseif (isset($_POST['bulan'])) {
			$bulan = $_POST['bulan'];
			$tahun = $_POST['tahun'];
			
			$query = "SELECT * FROM rumah_laundry.order WHERE year(order_tanggal_transaksi)='tahun' AND month(order_tanggal_transaksi)='bulan'";
		}
	}

	$rs = mysql_query($query);

	$i = 0;
	while ($row = mysql_fetch_array($rs)) {
		$rs2 = mysql_query("SELECT * FROM admin WHERE admin_id='$row['admin_id']'");
		$row2=mysql_fetch_array($rs2);

		$data[$i]['order_id']		= $row['order_id'];
		$data[$i]['admin_id']		= $row2['admin_id'];
		$data[$i]['order_tanggal']	= $row['order_tanggal_transaksi'];
		$data[$i]['order_total']	= $row['order_total_bayar'];

		$i++;
	}
?>