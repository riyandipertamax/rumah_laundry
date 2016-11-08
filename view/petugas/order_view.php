

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

		<div class="col-md-2" >
			<img src="../../assets/img/logo1.png" height="20%">	
			
			<ul class="nav nav-pills nav-stacked">
				<ul class="nav nav-pills nav-stacked">
				<!--<li><a href="checklist_view.php?cari=" class="btn <?=$x?>" style="text-align: left"><span class="glyphicon glyphicon-th-list"></span> Checklist Order</a></li>-->
				<li><a href="dashboard_view.php?cari=" class="btn <?=$x?>" style="text-align: left"><span class="glyphicon glyphicon-home"></span> Dashboard</a></li>
				<li><a href="order_view.php" class="btn <?=$x?>" style="text-align: left"><span class="glyphicon glyphicon-list-alt"></span> Order</a></li>
				<li><a href="ch_password_view.php" class="btn <?=$x?>" style="text-align: left"><span class="glyphicon glyphicon-lock"></span> Ganti Password</a></li>
			</ul>
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
			    
			    	<a style="margin-bottom:20px" class="btn btn-success <?=$ob?>" href="order_view.php?ok=baru" ><span class="glyphicon glyphicon-plus"></span>&nbsp;&nbsp;Order Baru&nbsp;</a>
					<a style="margin-bottom:20px" class="btn btn-danger <?=$bo?>" href="../../model/order_act2.php?ok=batal&aksi=batal&id=<?=$kode?>&p=petugas" ><span class="glyphicon glyphicon-minus"></span>&nbsp;&nbsp;Batal Order&nbsp;</a>
				
					</br>

					<table class="col-md-2">
						<tr>
							<td>Jumlah Order :</td>
							<td><?=$r_row1?></td>
						</tr>
					</table>

					</br>
					<table>
					<form action="" method="post">
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
					</form>
					</table>
					<hr>
					<script>
						$(function () {
					    	$("#nama").autocomplete({
					        	source: "../../model/search.php",
					            minLength: 1
					        });
					    });

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
					    				$('#out').html(response);
					    				harga2 = document.formTambah.harga2.value;
								    	document.formTambah.harga.value=harga2;
					    			}
					    		});
					    	}
					    }

					    function subTotal(){
							jumlah = document.formTambah.jumlah.value;
							harga = document.formTambah.harga2.value;

							document.formTambah.subtotal.value = (jumlah*1)*(harga*1);
						}
					</script>
					<form name="formTambah" class="form-inline" action="../../model/order_act2.php?ok=<?=$_GET['ok']?>&aksi=tambah" method="post"> 
				 	  	<div class="form-group">
				 	  		<input id="ord_id2" name="ord_id2" type="text" class="form-control hidden" placeholder="Order ID .." value="<?=$kode?>" readonly>
				 	  		<label for="nama">Jenis&nbsp;</label>
                			<select onchange="tampilHarga();" class="form-control" id="nama" name="nama" <?=$i?>>
					      			<option>--------</option>
					      	<?php
					      		$q_nama = mysql_query("SELECT DISTINCT tarif_nama FROM tarif ORDER BY tarif_harga DESC");
					      		while ($o_nama = mysql_fetch_object($q_nama)) {

					      		$nama=$o_nama->tarif_nama;
					      	?>
								<option value="<?=$nama?>"><?=$nama?></option>	
							<?php
								}
							?>
							</select>
					      	<label class="control-label ">&nbsp;Ukuran&nbsp;</label> 
					      	<select onchange="tampilHarga();" class="form-control" id="ukuran" name="ukuran" <?=$i?>>
					      		<option>--------</option>
					      	<?php
					      		$q_ukuran = mysql_query("SELECT DISTINCT tarif_ukuran FROM tarif ORDER BY tarif_harga ASC");
					      		while ($o_ukuran = mysql_fetch_object($q_ukuran)) {

					      		$ukuran=$o_ukuran->tarif_ukuran;
					      	?>
								<option value="<?=$ukuran?>"><?=$ukuran?></option>	
							<?php
								}
							?>
							</select>	

					        <label class="control-label ">&nbsp;Jumlah&nbsp;</label>
					      	<div class="input-group col-md-1">
								<input maxlength="3" autocomplete='off' onkeyup="subTotal()"type="text" class="form-control " name="jumlah" id="jumlah" placeholder="0" <?=$i?>>
							</div>		
							
							<label class="control-label ">&nbsp;Harga&nbsp;</label> 
					      	<div class="input-group col-md-2">
					      	<span class="input-group-addon"><label class="control-label ">Rp</label></span>
						      	<input onchange="subTotal()" type="text" class="form-control" name="harga" id="harga" placeholder="0" readonly>
						    </div>
						    <label class="control-label ">&nbsp;Sub-total&nbsp;</label>
							<div class="input-group col-md-2">		
								<span class="input-group-addon"><label class="control-label ">Rp</label></span>
						      	<input type="text" class="form-control" name="subtotal" id="subtotal" placeholder="0" readonly>
						    </div>
					        <button id="button" name="tombol" value="tambah" type="submit" class="btn btn-success" <?=$i?>><span class="glyphicon glyphicon-plus"></span></button>
					        <div id="out"></div>
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
							<td><?php echo $f_cekid->tarif_nama; ?></td>
							<td><?php echo $f_cekid->tarif_ukuran; ?></td>
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

				</br>

				<form class="form-inline" action="" method="post"> 
					<div>
						<label class="control-label">Status Order&nbsp;&nbsp;&nbsp;&nbsp;:&nbsp;&nbsp;</label> 
					   	<label> 
					      	<input type="radio" name="radioJumlah" id="jumlahSemua" value="" checked> Semua Order&nbsp;&nbsp;
					   </label>
					   <label> 
					      	<input type="radio" name="radioJumlah" id="jumlahTerkirim" value=""> Order Ambil&nbsp;&nbsp; 
					   </label>
					   <label> 
					      	<input type="radio" name="radioJumlah" id="jumlahBelum" value=""> Order Belum Ambil&nbsp;&nbsp; 
					   </label>
					</div>			
				</form>
				<a href="" class="btn btn-default pull-right"><span class='glyphicon glyphicon-print'></span> Cetak Laporan</a>
			
				</br>
				</br>
		
		    	<table class="table table-hover table-condensed table-striped">
					<tr>
						<th>No&nbsp;&nbsp;&nbsp;</th>
						<th class="col-md-2">Order ID</th>
						<th class="col-md-2">Admin</th>
						<th class="col-md-2">Tanggal</th>
						<th class="col-md-2">Total Harga</th>
						<th class="col-md-3">Status</th>
						<th class="col-md-3">Aksi</th>
					</tr>
					<tr>
						<td>1</td>
						<td>10160001</td>
						<td>Admin</td>
						<td>28/10/2016</td>
						<td>Rp. 10.000,-</td>
						<td>Sudah ambil</td>
						<td>
							<a href="detail_order_form.php?p=order" class="btn btn-info">Detail</a>
						</td>
					</tr>
				</table>
				<ul class="pagination">
					<li><a href="">Previous</a></li>
					<li><a href="">1</a></li>
					<li><a href="">Next</a></li>
				</ul>
		    </div>
		</div>
	</body>
</html>