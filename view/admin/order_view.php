<?php 
	require 'header_view.php';

	//query untuk mengambil id terahir di database
	$q_kode = mysql_query("SELECT `order_id` FROM `order` ORDER BY `order_tanggal_transaksi` DESC LIMIT 1");
	$f_kode	= mysql_fetch_array($q_kode);
	$r_kode	= mysql_num_rows($q_kode);

	//generator kode otomatis
	$n_bulan = date("m");
	$k_bulan = substr($f_kode['order_id'], 3,2);
	$n_tahun = date("y");
	$k_tahun = substr($f_kode['order_id'], 3,2);

	if ($r_kode != 0) {
		if ($n_bulan == $k_bulan || $n_tahun == $k_tahun) {
			$no_urut = substr($f_kode['order_id'], 9)+1;
		} else{
			$no_urut = 1;
		}				
	} else {
			$no_urut = 1;
	}

	$hitung_no = strlen($no_urut);
			
	if ($hitung_no == 1) {
		$p = '000';
	} elseif ($hitung_no == 2) {
		$p = '00';
	} elseif ($hitung_no == 3) {
		$p = '0';
	} elseif ($hitung_no == 4) {
		$p = '';
	} 		

	$ob='';
	$bo='hidden';

	if (!isset($_GET['ok'])) {
		$i='disabled';
		$ob='';
		$bo='hidden';
		$x='';
		$kode='';
		$tgl='';
	}else {
		if ($_GET['ok'] == 'batal') {
			$i='disabled';
			$ob='';
			$bo='hidden';
			$x='';
			$kode='';
			$tgl='';
		}elseif ($_GET['ok'] == 'baru') {
			$i='';
			$ob='hidden';
			$bo='';
			$x='disabled';
			$kode="RL/".$n_bulan."/".$n_tahun."/".$p.$no_urut;
			$tgl=date("d/m/20y");
		}
	}

	$q_row1 = mysql_query("SELECT * FROM order_detail WHERE order_id='$kode'");
	$r_row1 = mysql_num_rows($q_row1);
?>

<script>
	$(function () {
		$("#nama").autocomplete({
			source: "../../model/search.php",
			minLength: 1
		});
	});

	function tampilUkuran(){
		var nama 	= document.formTambah.nama.value;

		if (nama) {
			$.ajax({
				type: 'post',
				url: '../../model/order_act.php',
				data: {
					nama:nama,
				},
				success: function(response){
					$('#out2').html(response);
				}
			});
		}
	} 

	function tampilHarga(){
		var nama 	= document.formTambah.nama.value;
		var ukuran	= document.formTambah.ukuran.value;

		if (ukuran) {
			$.ajax({
				type: 'post',
				url: '../../model/order_act.php',
				data: {
					nama:nama, ukuran:ukuran,
				},
				success: function(response){
					$('#harga').html(response);
				}
			});
		}
	}

	function subTotal(){
		jumlah = document.formTambah.jumlah.value;
		harga = document.formTambah.harga.value;

		document.formTambah.subtotal.value = (jumlah*1)*(harga*1);
	}

	function setZero(){
		document.formTambah.subtotal.value = (0*1);
		document.formTambah.harga.value = (0*1);
		document.formTambah.jumlah.value = '';
	}
</script>

		<div class="col-md-2" >
			<img src="../../assets/img/logo1.png" height="20%">	
			
			<ul class="nav nav-pills nav-stacked">
				<li><a href="dashboard_view.php?cari=" class="btn <?=$x?>" style="text-align: left"><span class="glyphicon glyphicon-home"></span> Dashboard</a></li>
				<!--<li><a href="checklist_view.php?cari=" class="btn <?=$x?>" style="text-align: left"><span class="glyphicon glyphicon-th-list"></span> Checklist Order</a></li>-->
				<li><a href="order_view.php?cari=" class="btn <?=$x?>" style="text-align: left"><span class="glyphicon glyphicon-list-alt"></span> Order</a></li>
				<li><a href="tarif_view.php?cari=" class="btn <?=$x?>" style="text-align: left"><span class="glyphicon glyphicon-briefcase"></span> Tarif</a></li>
				<li><a href="admin_view.php?cari=" class="btn <?=$x?>" style="text-align: left"><span class="glyphicon glyphicon-lock"></span> Admin</a></li>
			</ul>
		</div>
		<div class="col-md-10">
			<h3>
				<span class="glyphicon glyphicon-briefcase">
				</span>&nbsp;Order
			</h3>

			<ul class="nav nav-tabs" style="margin-bottom: 15px;">
			    <li class="active"><a href="#orderBaru" data-toggle="tab">Order Baru</a></li>
			    <li><a href="#dataOrder" data-toggle="tab">Laporan Order</a></li>
			</ul>

			<div id="myTabContent" class="tab-content">
			    <div class="tab-pane fade active in" id="orderBaru">
			    
			    	</br>
			    
			    	<a style="margin-bottom:20px" class="btn btn-success <?=$ob?>" href="order_view.php?ok=baru&cari=" ><span class="glyphicon glyphicon-plus"></span>&nbsp;&nbsp;Order Baru&nbsp;</a>
					<a style="margin-bottom:20px" class="btn btn-danger <?=$bo?>" href="../../model/order_act2.php?ok=batal&aksi=batal&id=<?=$kode?>" ><span class="glyphicon glyphicon-minus"></span>&nbsp;&nbsp;Batal Order&nbsp;</a>
				
					</br>

					<table class="col-md-2">
						<tr>
							<td>Jumlah Order :</td>
							<td><?=$r_row1?></td>
						</tr>
					</table>

					</br>
					<table>
						<div class="form-inline form-group">
							<tr>
								<td><label>Order ID&nbsp;</label></td>
								<td><input id="ord_id" name="ord_id" type="text" class="form-control" placeholder="Order ID .." value="<?=$kode?>" readonly></td>
							</tr>
						</div>
						<tr>
							<td><label>&nbsp;</label></td>
						</tr>
						<div class="form-inline form-group">
							<tr>
								<td><label>Tanggal&nbsp;&nbsp;</label></td>
								<td><input id="tgl" name="tgl" type="text" class="form-control" placeholder="Tanggal order .." value="<?=$tgl?>" readonly></td>
							</tr>
						</div>
					</table>

					<hr>
					
					<form name="formTambah" class="form-inline" action="../../model/order_act2.php?ok=baru&aksi=tambah" method="post"> 
				 	  	<div class="form-group">
				 	  		<input id="ord_id2" name="ord_id2" type="text" class="form-control hidden" placeholder="Order ID .." value="<?=$kode?>" readonly>
				 	  		<label for="nama">Jenis&nbsp;</label>
                			<select onclick="setZero()" onchange="tampilUkuran();" class="form-control" id="nama" name="nama" <?=$i?>>
                				<option value="0">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</option>
					      	<?php
					      		$q_nama = mysql_query("SELECT DISTINCT tarif_nama FROM tarif ORDER BY tarif_nama ASC");
					      		while ($o_nama = mysql_fetch_object($q_nama)) {

					      		$nama=$o_nama->tarif_nama;
					      	?>
								<option value="<?=$nama?>"><?=ucwords($nama)?></option>

							<?php
								}
							?>
							
							</select>
					      	<label class="control-label ">Ukuran&nbsp;</label> 
					      	<select onmouseout="subTotal()" onchange="tampilHarga();" class="form-control"  id="out2" name="ukuran" <?=$i?>>
					      		<option value="0">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</option>					      	
							</select>	

					        <label class="control-label ">Jumlah&nbsp;</label>
					      	<div class="input-group col-md-1">
								<input maxlength="3" autocomplete='off' onkeyup="subTotal()" type="text" class="form-control " name="jumlah" id="jumlah" placeholder="0" <?=$i?>>
							</div>		
							
							<label class="control-label ">Harga&nbsp;</label> 
					      	<div class="input-group col-md-2">
					      	<span class="input-group-addon"><label class="control-label ">Rp</label></span>
						      	<input type="text" class="form-control" name="harga" id="harga" placeholder="0"readonly>
						    </div>
						    <label class="control-label ">Sub-total&nbsp;</label>
							<div class="input-group col-md-2">		
								<span class="input-group-addon"><label class="control-label ">Rp</label></span>
						      	<input type="text" class="form-control" name="subtotal" id="subtotal" placeholder="0" readonly>
						    </div>
					        <button id="button" name="tombol" value="tambah" type="submit" class="btn btn-success" <?=$i?>><span class="glyphicon glyphicon-plus"></span></button>
					        <button type="reset" value="refresh" class="btn btn-info" <?=$i?>><span class="glyphicon glyphicon-refresh"></span></button>
					   </div>
					</form>

					</br>

					<table class="table table-hover table-condensed table-striped">
						<tr>
							<th>No&nbsp;&nbsp;&nbsp;</th>
							<th class="col-md-3">Jenis</th>
							<th class="col-md-2">Ukuran</th>
							<th class="col-md-2">Harga</th>
							<th class="col-md-1">Jumlah</th>
							<th class="col-md-2">Sub-total</th>
							<th class="col-md-3">Aksi</th>
						</tr>

				<?php

					$q_kart = mysql_query("SELECT * FROM order_detail WHERE order_id='$kode'");
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
							<td><?php echo ucwords($f_cekid->tarif_nama); ?></td>
							<td><?php echo ucwords($f_cekid->tarif_ukuran); ?></td>
							<td>Rp <?php echo number_format($f_cekid->tarif_harga); ?>,-</td>
							<td><?php echo $f_kart->order_detail_jumlah; ?></td>
							<td>Rp <?php echo number_format($f_kart->order_detail_subtotal); ?>,-</td>
							<td>
								<a id="button" href="../../model/order_act2.php?ok=baru&aksi=hapus&id=<?=$f_kart->order_detail_id ?>" onclick="return confirm('Yakin data akan dihapus?')" class="btn btn-danger">Hapus</a>
							</td>
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
							<td class="col-md-8">
								<label class="control-label pull-right" for="name">TOTAL HARGA&nbsp;&nbsp;</label>
							</td>
							<td class="col-md-2">
								<label class="control-label" for="name"><span id="total_harga">&nbsp;&nbsp; Rp <?php echo number_format($total); ?>,- </span></label>
							</td>
							<td class="col-md-3">
								<label class="control-label" for="name">
									<a href="../../model/order_act2.php?total=<?=$total?>&ok=batal&admin=<?=$_SESSION['admin_nama']?>&level=<?=$_SESSION['level']?>&aksi=print&kode=<?=$kode?>" class="btn btn-default pull-right" <?=$i?>><span class='glyphicon glyphicon-print'></span> Cetak Nota</a>
								</label>
							</td>
						</tr>
					</table>
			    </div>

			    <div class="tab-pane fade" id="dataOrder">

				<?php 
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

			<!--	<form name="formLaporan" class="form-inline" action="" method="post">
					<label class="control-label">Sortir Laporan &nbsp;:&nbsp;&nbsp;</label>
					<select onchange="setTanggal()" class="form-control inline" id="sortir" name="sortir">
						<option value="0">Semua</option>
						<option value="harian">Harian</option>
						<option value="mingguan">Lebih Dari 1 Hari</option>
						<option value="bulanan">Bulanan</option>
						<option value="tahunan">Tahunan</option>
					</select>
					<label id="out3" class="control-label">&nbsp;</label>
					</form>-->

					<a href="" class="btn btn-default pull-right"><span class='glyphicon glyphicon-print'></span> Cetak Laporan</a>
				
			<!--<script type="text/javascript">
					function setTanggal(){
						var sortir = document.formLaporan.sortir.value;

						if (sortir) {
							$.ajax({
								type: 'post',
								url: '../../model/order_act.php',
								data: {
									sortir:sortir,
								},
								success: function(response){
									$('#out3').html(response);
								}
							});
						}
						
					}
				</script>-->
	
				</br>

				<div>
					<table>
						<tr>
							<td>Jumlah Order&nbsp;&nbsp;</td>
							<td>:&nbsp;&nbsp;</td>
							<td><?=$row?></td>
						</tr>
					</table>
				</div>

				<form action="../../model/cari_act.php?p=order" method="POST">
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
							$x = 1;
						} elseif ($page > 1) {
							$x = ($per_hal*($page-1))+1;
						} 
						
						$z = $per_hal * $page;
						$row2 	 = mysql_num_rows($q_order);

						if ($row2 == 0) {

					?>
						<tr>
							<td colspan="6" align="center">Tidak Ada Data</td>
						</tr>
					<?php 
						} else {
							for ($x; $x <= $z ; $x++) {

								$f_order = mysql_fetch_object($q_order);
								$q_admin = mysql_query("SELECT * FROM admin WHERE admin_id='$f_order->admin_id'");
								$f_admin = mysql_fetch_object($q_admin);
								
								$q 		 = mysql_query("SELECT order_tanggal_transaksi FROM rumah_laundry.order");
								$f 		 = mysql_fetch_array($q);
								$date 	 = date_create($q['order_tanggal_transaksi']);


								if ($page == $t_hal) {
									$z = ($per_hal * $page)-($per_hal-$row2);
								}elseif ($cari != '') {
									if ($row2!=0) {
										$z = $row2;
									} else {
										$x=1;
										$z=1;
									}
									
								} else {
									$z = $per_hal * $page;
								}

								if ($page == '') {
									$page =1;
								}
					?>

					<tr>
						<td><?php echo $x; ?></td>
						<td><?php echo $f_order->order_id; ?></td>
						<td><?php echo ucwords($f_admin->admin_nama); ?></td>
						<td><?php echo date_format($date,'d/m/Y'); ?></td>
						<td><?php echo $f_order->order_total_bayar; ?></td>

					<?php

					?>
						<td>
							<a href="detail_order_form.php?cari=<?=$cari?>&p=order&id=<?=$f_order->order_id?>&tgl=<?php echo date_format($date,'d/m/Y'); ?>" class="btn btn-info">Detail</a>
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
					        for($x = 1; $x <= $t_hal; $x++){
					 
								if ((($x >= $page - 3) && ($x <= $page + 3)) || ($x == 1) || ($x == $t_hal)){                 
									if ($x == $page) {
										echo " <li><a href='#'>".$page."</a></li>";
									} else {
										echo " <li><a href='".$_SERVER['PHP_SELF']."?page=".$x."&cari=".$cari."'>".$x."</a></li> ";
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
		</div>
	</body>
</html>