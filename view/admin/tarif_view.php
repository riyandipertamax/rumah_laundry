<?php 
	require 'header_view.php';
	require 'menu_view.php';


	$q_row 	= mysql_query("SELECT * FROM tarif");
	$row 	= mysql_num_rows($q_row);
	$cari = $_GET['cari'];
	
	if(isset($_GET['status'])){
		if($_GET['status'] == '1'){
			echo "<div style='margin-bottom:-55px' class='alert alert-danger' role='alert'><span class='glyphicon glyphicon-warning-sign'></span>  Input Gagal!! Tarif sudah ada!! <a class='close' data-dismiss='alert' aria-hidden='true' href='tarif_view.php?cari='>&times</a></div></br></br>";
		} elseif($_GET['status'] == '2'){
			echo "<div style='margin-bottom:-55px' class='alert alert-danger' role='alert'><span class='glyphicon glyphicon-warning-sign'></span>  Input Gagal!! Isi harga dengan benar!! <a class='close' data-dismiss='alert' aria-hidden='true' href='tarif_view.php?cari='>&times</a></div></br></br>";
		} elseif($_GET['status'] == '3'){
			echo "<div style='margin-bottom:-55px' class='alert alert-danger' role='alert'><span class='glyphicon glyphicon-warning-sign'></span>  Input Gagal!! Jenis Laundry atau ukuran harap di isi!! <a class='close' data-dismiss='alert' aria-hidden='true' href='tarif_view.php?cari='>&times</a></div></br></br>";
		}
	}

	$per_hal = 10;
	$t_hal	 = ceil($row/$per_hal);

	if (isset($_GET['page'])) {
		$page = $_GET['page'];
	}else{
		$page = 1;
	}

	$offset   = ($page - 1) * $per_hal; 
?>

			<h3><span class="glyphicon glyphicon-briefcase"></span>&nbsp;Tarif Laundry</h3>
			<button style="margin-bottom:20px" data-toggle="modal" data-target="#modalFormTambah" class="btn btn-success col-md-2"><span class="glyphicon glyphicon-plus"></span> Tambah Tarif </button>
			</br>

			<div class="col-md-12">
				<table class="col-md-2">
					<tr>
						<td>Jumlah Tarif</td>
						<td>:</td>
						<td>&nbsp;<?=$row?></td>
					</tr>
					<tr>
						<td>Halaman</td>
						<td>:</td>
						<td>&nbsp;<?=$page?></td>
					</tr>
				</table>
				<a href="" class="btn btn-default pull-right"><span class='glyphicon glyphicon-print'></span> Cetak Katalog</a>

			</div>
			</br>
			<form action="../../model/cari_act.php" method="POST">
				<div class="input-group col-md-4 col-md-offset-8">
					<span class="input-group-addon"><span class="glyphicon glyphicon-search"></span></span>
					<input autocomplete="off" type="text" class="form-control" placeholder="Masukan jenis tarif .." aria-describedby="basic-addon1" name="cari_tarif" value="<?=$cari?>">
				</div>
			</form>

			<?php
				if (isset($_GET['cari'])) {
					
					$cari	 = mysql_real_escape_string($_GET['cari']);

					if ($cari != '') {
						$q_tarif = mysql_query("SELECT * FROM tarif WHERE tarif_nama LIKE '%$cari%' LIMIT $offset, $per_hal");
					} else {
						$q_tarif = mysql_query("SELECT * FROM tarif LIMIT $offset, $per_hal");
					}

				} else {

					$q_tarif = mysql_query("SELECT * FROM tarif LIMIT $offset, $per_hal");

				}
			?>

			</br>

			<table class="table table-hover table-condensed table-striped">
				<tr>
					<th class="col-md-1">No</th>
					<th class="col-md-5">Jenis Laundry</th>
					<th class="col-md-2">Ukuran</th>
					<th class="col-md-2">Harga</th>
					<th class="col-md-3">Aksi</th>
				</tr>

				<?php
					if ($page == 1) {
						$i = 1;
					} elseif ($page > 1) {
						$i = ($per_hal*($page-1))+1;
					} 
					
					$p = $per_hal * $page;
					$row2 	 = mysql_num_rows($q_tarif);

					if ($row2 == 0) {

				?>
					<tr>
						<td colspan="5" align="center">Tidak Ada Data</td>
					</tr>
				<?php 
					} else {
						for ($i; $i <= $p ; $i++) {

							$a_tarif = mysql_fetch_object($q_tarif);


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
					<td><?php echo ucwords($a_tarif->tarif_nama); ?></td>
					<td><?php echo ucwords($a_tarif->tarif_ukuran); ?></td>
					<td>Rp <?php echo number_format($a_tarif->tarif_harga); ?>,-</td>
					<td>
						<a href="edit_tarif_form.php?id=<?=$a_tarif->tarif_id?>&page=<?=$page?>" class="btn btn-info"> Ubah </a>
						<a href="../../model/tarif_act.php?tombol=hapus&id=<?=$a_tarif->tarif_id?>&page=<?=$page?>" class="btn btn-danger" onclick="return confirm('Yakin data akan dihapus?')">Hapus</a>
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
				 			$c_cari = ceil((mysql_num_rows($q_tarif)/$per_hal));
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
			
			<div id='modalFormTambah' class="modal fade">
				<div class="modal-dialog">
					<div class="modal-content">
						<div class="modal-header">
							<h4 class="modal-title">Tambah Tarif Baru</h4>
						</div>
						<div class="modal-body">
							<form action="../../model/tarif_act.php?tombol=tambah&page=<?=$page?>" method="post">
								<div class="form-group">
									<label>Jenis Tarif</label>
									<input autocomplete="off" id="nama" name="nama" type="text" class="form-control" placeholder="Jenis Tarif ..">
								</div>
								<div class="form-group">
									<label>Ukuran</label>
									<select class="form-control" id="ukuran" name="ukuran">
										<option>--------</option>
								    	<option value="besar" >besar</option>
							          	<option value="sedang" >sedang</option>
							          	<option value="kecil" >kecil</option>
							          	<option value="per kg" >per kg</option>
							         	<option value="per pcs" >per pcs</option>
							      	</select>
								</div>
								<div class="form-group">
									<label>Harga</label>
									<input autocomplete="off" id="harga" name="harga" type="text" class="form-control" placeholder="Harga ..">
								</div>									
						</div>
							<div class="modal-footer">
								<button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
								<input type="reset" class="btn btn-danger" value="Reset">
								<button id="tombol" name="tombol" type="submit" class="btn btn-success" value="tambah">Tambah</button>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</body>
</html>