<?php 
	

	if (isset($_POST['cari_tarif'])) {
		$page=$_GET['page'];
		$cari=$_POST['cari_tarif'];

		if ($page == '') {
			$page = 1;
		}
		
		header("location:../view/admin/tarif_view.php?cari=$cari&page=$page");
	} 
	if (isset($_POST['cari_admin'])) {
		$page=$_GET['page'];
		$cari=$_POST['cari_admin'];

		if ($page == '') {
			$page = 1;
		}

		header("location:../view/admin/admin_view.php?cari=$cari&page=$page");
	} 
	if (isset($_POST['cari_order'])) {
		$page = $_GET['page'];
		$p 	  = $_GET['p'];
		$cari = $_POST['cari_order'];

		if ($page == '') {
			$page = 1;
		}

		if ($p == 'checklist') {
			header("location:../view/admin/checklist_view.php?cari=$cari&page=$page&p=$p");	
		} else{
			header("location:../view/admin/order_view.php?cari=$cari&page=$page&p=$p");
		}	
	}

?>