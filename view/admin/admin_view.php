<?php 
	require 'header_view.php';
	require 'menu_view.php'; 

	$q_row	= mysql_query("SELECT * FROM admin WHERE level!='1'");
	$row 	= mysql_num_rows($q_row);
	$cari 	= $_GET['cari'];

	if(isset($_GET['status'])){
		if($_GET['status'] == '1'){
			echo "<div style='margin-bottom:-55px' class='alert alert-danger' role='alert'><span class='glyphicon glyphicon-warning-sign'></span>  Input Gagal!! Admin sudah ada!! <a class='close' data-dismiss='alert' aria-hidden='true' href='admin_view.php?cari='>&times</a></div></br></br>";
		} elseif($_GET['status'] == '2'){
			echo "<div style='margin-bottom:-55px' class='alert alert-danger' role='alert'><span class='glyphicon glyphicon-warning-sign'></span>  Input Gagal!! Isi data dengan benar!! <a class='close' data-dismiss='alert' aria-hidden='true' href='admin_view.php?cari='>&times</a></div></br></br>";
		} elseif($_GET['status'] == '3'){
			echo "<div style='margin-bottom:-55px' class='alert alert-danger' role='alert'><span class='glyphicon glyphicon-warning-sign'></span>  Input Gagal!! Ulangi password tidak sesuai!! <a class='close' data-dismiss='alert' aria-hidden='true' href='admin_view.php?cari='>&times</a></div></br></br>";
		} elseif($_GET['status'] == '4') {
			echo "<div style='margin-bottom:-55px' class='alert alert-danger' role='alert'><span class='glyphicon glyphicon-warning-sign'></span>  Input Gagal!! Password minimal 5 karakter!! <a class='close' data-dismiss='alert' aria-hidden='true' href='admin_view.php?cari='>&times</a></div></br></br>";
		}
	}

	$per_hal= 5;
	$t_hal	= ceil($row/$per_hal);

	if (isset($_GET['page'])) {
		$page	= $_GET['page'];
	} else {
		$page	= 1;
	}

	$offset 	= ($page - 1) * $per_hal;
?>

			<h3><span class="glyphicon glyphicon-lock"></span>&nbsp;Admin</h3>
			<button style="margin-bottom:20px" data-toggle="modal" data-target="#modalFormTambah" class="btn btn-success col-md-2"><span class="glyphicon glyphicon-plus"></span> Tambah Admin </button>
			</br>
			</br>
			</br>

			<div class="col-md-12">
				<table class="col-md-2">
					<tr>
						<td>Jumlah Admin</td>
						<td>:</td>
						<td><?=$row?></td>
					</tr>
				</table>
			</div>

			</br>
			</br>

			<form action="../../model/cari_act.php" method="POST">
				<div class="input-group col-md-4 col-md-offset-8">
					<span class="input-group-addon"><span class="glyphicon glyphicon-search"></span></span>
					<input autocomplete="off" type="text" class="form-control" placeholder="Masukan nama admin atau username .." aria-describedby="basic-addon1" name="cari_admin" value="<?=$cari?>">
				</div>
			</form>

			<?php
				if (isset($_GET['cari'])) {
					
					$cari 	= mysql_real_escape_string($_GET['cari']);

					if ($cari != '') {
						$q_admin = mysql_query("SELECT * FROM admin WHERE level!='1' AND admin_nama LIKE '%$cari%' OR admin_username LIKE '%$cari%' LIMIT $offset, $per_hal");
					} else {
						$q_admin = mysql_query("SELECT * FROM admin WHERE level!='1' LIMIT $offset, $per_hal");
					}
				} else {

					$q_admin = mysql_query("SELECT * FROM admin WHERE level!='1' LIMIT $offset, $per_hal");

				}
			?>

			</br>

			<table class="table table-hover table-condensed table-striped">
				<tr>
					<th>No&nbsp;&nbsp;&nbsp;</th>
					<th class="col-md-3">Nama</th>
					<th class="col-md-3">Username</th>
					<th class="col-md-3">Password</th>
					<th class="col-md-3">Aksi</th>
				</tr>

				<?php
					if ($page == 1) {
						$i = 1;
					} elseif ($page > 1) {
						$i = ($per_hal*($page-1))+1;
					} 
					
					$p = $per_hal * $page;
					
					$row2 = mysql_num_rows($q_admin);

					if ($row2 == 0) {

					?>

				<tr>
					<td colspan="5" align="center">Tidak Ada Data</td>
				</tr>

				<?php 
					} else {
						for ($i; $i <= $p ; $i++) {

							$a_admin = mysql_fetch_object($q_admin);

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
					<td><?php echo ucwords($a_admin->admin_nama); ?></td>
					<td><?php echo $a_admin->admin_username; ?></td>
					<td><?php echo $a_admin->admin_password; ?></td>
					<td>
						<a href="edit_admin_form.php?id=<?=$a_admin->admin_id?>&page=<?=$page?>" class="btn btn-info"> Ubah </a>
						<a href="../../model/admin_act.php?tombol=hapus&id=<?=$a_admin->admin_id?>&page=<?=$page?>" class="btn btn-danger" onclick="return confirm('Yakin data akan dihapus?')">Hapus</a>
					</td>
				</tr>

				<?php

						}
					}					
				?>

			</table>

			<ul class="pagination">
			<?php 
				if ($row > 5){
					// Menampilkan link 'Sebelum'   
				    if ($page > 1) 

						echo  "<li><a href='".$_SERVER['PHP_SELF']."?page=".($page-1)."&cari=".$cari."'>Sebelumnya</a></li>";
				 		
				 		if ($cari!='') {
				 			$c_cari = ceil((mysql_num_rows($q_admin)/$per_hal));
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
							<h4 class="modal-title">Tambah Admin Baru</h4>
						</div>
						<div class="modal-body">
							<form action="../../model/admin_act.php?tombol=tambah&page=<?=$page?>" method="POST">
								<div class="form-group">
									<label>Nama</label>
									<input autocomplete="off" id="nama" name="nama" type="text" class="form-control" placeholder="Nama asli ..">
								</div>
								<div class="form-group">
									<label>Username</label>
									<input autocomplete="off" id="username" name="username" type="text" class="form-control" placeholder="Username ..">
								</div>
								<div class="form-group">
									<label>Password</label>
									<input autocomplete="off" id="password" name="password" type="password" class="form-control" placeholder="Password ..">
								</div>
								<div class="form-group">
									<label>Ulangi Password</label>
									<input autocomplete="off" id="ulang" name="ulang" type="password" class="form-control" placeholder="Ulangi password ..">
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