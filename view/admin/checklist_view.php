<?php 
	require 'header_view.php';
	require 'menu_view.php';

	$q_row 	= mysql_query("SELECT * FROM rumah_laundry.order"); 
	$row 	= mysql_num_rows($q_row);
	$cari = $_GET['cari'];
	

	$per_hal = 10;
	$t_hal	 = ceil($row/$per_hal);

	if (isset($_GET['page'])) {
		$page = $_GET['page'];
	}else{
		$page = 1;
	}

	$offset   = ($page - 1) * $per_hal; 

?>

			<h3><span class="glyphicon glyphicon-list"></span>&nbsp;Checklist Order Laundry</h3>
			</br></br>

			<div class="col-md-12">
				<table class="col-md-2">
					<tr>
						<td>Jumlah Order</td>
						<td><?=$row?></td>
					</tr>
				</table>
			</div>

			<a href="" class="btn btn-default pull-right"><span class='glyphicon glyphicon-print'></span> Cetak Laporan</a>

			</br>
			</br>
			</br>

			<form action="../../model/cari_act.php?p=checklist" method="POST">
				<div class="input-group col-md-4 col-md-offset-8">
					<span class="input-group-addon"><span class="glyphicon glyphicon-search"></span></span>
					<input autocmplete="off" type="text" class="form-control" placeholder="Masukan order ID .." aria-describedby="basic-addon1" name="cari_order" value="<?=$cari?>">
				</div>
			</form>

			<?php
				if (isset($_GET['cari'])) {
					$cari 	= mysql_real_escape_string($_GET['cari']);

					if ($cari != '') {
						$q_order = mysql_query("SELECT * FROM rumah_laundry.order WHERE order_id LIKE '%$cari%' ORDER BY order_tanggal_transaksi DESC LIMIT $offset, $per_hal");
					} else {
						$q_order = mysql_query("SELECT * FROM rumah_laundry.order ORDER BY order_tanggal_transaksi DESC LIMIT $offset, $per_hal");
					}
				} else {
					$q_order = mysql_query("SELECT * FROM rumah_laundry.order ORDER BY order_tanggal_transaksi DESC LIMIT $offset, $per_hal");
				}

			?>

			</br>

			<table class="table table-hover table-condensed table-striped">
				<tr>
					<th>No</th>
					<th>Order ID</th>
					<th>Admin</th>
					<th>Tanggal</th>
					<th>Total Harga</th>
					<th>Aksi</th>
				</tr>

				<?php
					if ($page == 1) {
						$i = 1;
					} elseif ($page > 1) {
						$i = ($per_hal*($page-1))+1;
					} 
					
					$p = $per_hal * $page;
					$row2 	 = mysql_num_rows($q_order);

					if ($row2 == 0) {

				?>
					<tr>
						<td colspan="6" align="center">Tidak Ada Data</td>
					</tr>
				<?php 
					} else {
						for ($i; $i <= $p ; $i++) {

							$f_order = mysql_fetch_object($q_order);
							$q_admin = mysql_query("SELECT * FROM admin WHERE admin_id='$f_order->admin_id'");
							$f_admin = mysql_fetch_object($q_admin);
							
							$q 		 = mysql_query("SELECT order_tanggal_transaksi FROM rumah_laundry.order");
							$f 		 = mysql_fetch_array($q);
							$date 	 = date_create($q['order_tanggal_transaksi']);


							if ($page == $t_hal) {
								$p = ($per_hal * $page)-($per_hal-$row2);
							}elseif ($cari != '') {
								if ($row2!=0) {
									$p = $row2;
								} else {
									$i=1;
									$p=1;
								}
								
							} else {
								$p = $per_hal * $page;
							}

							if ($page == '') {
								$page =1;
							}
				?>

				<tr>
					<td><?php echo $i; ?></td>
					<td><?php echo $f_order->order_id; ?></td>
					<td><?php echo ucwords($f_admin->admin_nama); ?></td>
					<td><?php echo date_format($date,'d/m/Y'); ?></td>
					<td><?php echo $f_order->order_total_bayar; ?></td>

				<?php

				?>
					<td>
						<a href="detail_order_form.php?cari=<?=$cari?>&p=checklist&id=<?=$f_order->order_id?>&tgl=<?php echo date_format($date,'d/m/Y'); ?>" class="btn btn-info">Detail</a>
						<a href="../../model/order_act2.php?cari=<?=$cari?>&ok=&aksi=batal2&id=<?=$f_order->order_id?>" onclick="return confirm('Yakin data akan dihapus?')" class="btn btn-danger">Batal</a>
					</td>
				</tr>
				<?php
						}
					}				
				?>

			</table>

			<ul class="pagination">
				<?php 
				if ($row > 10){
					// Menampilkan link 'Sebelum'   
				    if ($page > 1) 

						echo  "<li><a href='".$_SERVER['PHP_SELF']."?page=".($page-1)."&cari=".$cari."'>Sebelumnya</a></li>";
				 		
				 		if ($cari!='') {
				 			$c_cari = ceil((mysql_num_rows($q_order)/$per_hal));
				 			$t_hal  = $c_cari;

				 		}
				        
				        // Menampilkan nomor halaman dan linknya
				        for($i = 1; $i <= $t_hal; $i++){
				 
							if ((($i >= $page - 3) && ($i <= $page + 3)) || ($i == 1) || ($i == $t_hal)){                 
								if ($i == $page) {
									echo " <li><a href='#'>".$page."</a></li>";
								} else {
									echo " <li><a href='".$_SERVER['PHP_SELF']."?page=".$i."&cari=".$cari."'>".$i."</a></li> ";
								}
				            }
						}

					// Menampilkan link 'Sesudah'
				    if ($page < $t_hal) {
						echo "<li><a href='".$_SERVER['PHP_SELF']."?page=".($page+1)."&cari=".$cari."'>Selanjutnya</a></li>";
					}
				}

			?>
			</ul>
			
		</div>
	</body>
</html>