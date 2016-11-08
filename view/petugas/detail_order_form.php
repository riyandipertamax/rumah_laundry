<?php 
	require 'header_view.php';
	require 'menu_view.php';
?>

			<h3>
				<span class="glyphicon glyphicon-briefcase">
				</span>&nbsp;Detail Order
			</h3>

<?php
	$id = $_GET['id'];
	$tgl= $_GET['tgl'];


	$p=$_GET['p'];

	if ($p == 'order') {
		$page='order_view.php';
	}else {
		$page='checklist_view.php';
	}
?>

			<a class="btn" href="<?=$page?>?cari="><span class="glyphicon glyphicon-arrow-left"></span>  Kembali</a>
			
			</br>
			</br>
			
			<div class="form-inline form-group">
				<label class="control-label">Order ID&nbsp;&nbsp;&nbsp;:</label>
				<label class="control-label">&nbsp;<?=$id?></label>
			</div>

			<div class="form-inline form-group">
				<label class="control-label">Tanggal&nbsp;&nbsp;&nbsp;:</label>
				<label class="control-label">&nbsp;<?=$tgl?></label>
			</div>

			</br>
			</br>

			<table class="table table-hover table-condensed table-striped">
				<tr>
					<th>No&nbsp;&nbsp;&nbsp;</th>
					<th class="col-md-4">Jenis</th>
					<th class="col-md-1">Ukuran</th>
					<th class="col-md-2">Harga</th>
					<th class="col-md-1">Jumlah</th>
					<th class="col-md-2">Sub-total</th>
				</tr>
				<?php

					$q_kart = mysql_query("SELECT * FROM order_detail WHERE order_id='$id'");
					$r_row2 = mysql_num_rows($q_kart);
					$no=1;
					$total = 0;

					if ($r_row2 == 0) {
				?>
						<tr>
							<td colspan="7" align="center">Belum Ada Transaksi</td>
						</tr>
				<?php
					} else {
						while ($f_kart	= mysql_fetch_object($q_kart)) {
											
							$tarif_id1 = $f_kart->tarif_id;
							$q_cekid= mysql_query("SELECT tarif_nama, tarif_ukuran, tarif_harga FROM tarif WHERE tarif_id='$tarif_id1'");
							$f_cekid = mysql_fetch_object($q_cekid);
				?>
						

				<tr>
					<td><?php echo $no; ?></td>
					<td><?php echo $f_cekid->tarif_nama; ?></td>
					<td><?php echo $f_cekid->tarif_ukuran; ?></td>
					<td>Rp <?php echo number_format($f_cekid->tarif_harga); ?>,-</td>
					<td><?php echo $f_kart->order_detail_jumlah; ?></td>
					<td>Rp <?php echo number_format($f_kart->order_detail_subtotal); ?>,-</td>
				</tr>	
				<?php
						$subtotal = $f_kart->order_detail_subtotal;

							if ($no == 1) {
								$total = $subtotal;
							} else {
								$total = $total + $subtotal;
							}

							$no++;
							}	
						}				
					?>
			</table>

			<table class="table table-hover table-condensed table-striped">
						<tr>
							<th>&nbsp;&nbsp;&nbsp;&nbsp;</th>
							<td class="col-md-8">
								<label class="control-label pull-right" for="name">TOTAL HARGA&nbsp;&nbsp;</label>
							</td>
							<td class="col-md-2">
								<label class="control-label" for="name"><span id="total_harga"> Rp <?php echo number_format($total); ?>,- </span></label>
							</td>
						</tr>
					</table>			