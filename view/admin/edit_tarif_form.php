<?php 
	require 'header_view.php';
	require 'menu_view.php';

	if (isset($_GET['id'])) {
		$id 	= $_GET['id'];
		$page	= $_GET['page'];
		$q_edit	= mysql_query("SELECT * FROM tarif WHERE tarif_id='$id'");
		$f_edit	= mysql_fetch_object($q_edit);
		$id 	= $f_edit->tarif_id;
		$nama	= $f_edit->tarif_nama;
		$ukuran	= $f_edit->tarif_ukuran;
		$harga	= $f_edit->tarif_harga;

		if ($ukuran == 'besar') {
			$b = 'selected';
			$s = '';
			$k = '';
			$pk = '';
			$pp = '';
		}elseif ($ukuran == 'sedang') {
			$b = '';
			$s = 'selected';
			$k = '';
			$pk = '';
			$pp = '';
		}elseif ($ukuran == 'kecil') {
			$b = '';
			$s = '';
			$k = 'selected';
			$pk = '';
			$pp = '';
		}elseif ($ukuran == 'per kg') {
			$b = '';
			$s = '';
			$k = '';
			$pk = 'selected';
			$pp = '';
		}else{
			$b = '';
			$s = '';
			$k = '';
			$pk = '';
			$pp = 'selected';
		}
	} else {
		header('location:../edit_tarif_view.php?status=1&cari=&page=1');
	}

	if(isset($_GET['status'])){
		if($_GET['status'] == '1'){
			echo "<div style='margin-bottom:-55px' class='alert alert-danger' role='alert'><span class='glyphicon glyphicon-warning-sign'></span>  Gagal Ubah!! Tarif sudah ada!! <a class='close' data-dismiss='alert' aria-hidden='true' href='edit_tarif_form.php?id=".$id."&page=".$page."'>&times</a></div></br></br>";
		} elseif($_GET['status'] == '2'){
			echo "<div style='margin-bottom:-55px' class='alert alert-danger' role='alert'><span class='glyphicon glyphicon-warning-sign'></span>  Gagal Ubah!! Isi harga dengan benar!! <a class='close' data-dismiss='alert' aria-hidden='true' href='edit_tarif_form.php?id=".$id."&page=".$page."'>&times</a></div></br></br>";
		} elseif($_GET['status'] == '3'){
			echo "<div style='margin-bottom:-55px' class='alert alert-danger' role='alert'><span class='glyphicon glyphicon-warning-sign'></span>  Gagal Ubah!! Isi jenis laundry dengan benar!! <a class='close' data-dismiss='alert' aria-hidden='true' href='edit_tarif_form.php?id=".$id."&page=".$page."'>&times</a></div></br></br>";
		} 
	}
?>

<h3><span class="glyphicon glyphicon-briefcase"></span>  Ubah Tarif</h3>
<a class="btn" href="tarif_view.php?cari=&page=<?=$page?>"><span class="glyphicon glyphicon-arrow-left"></span>  Kembali</a>
	<form action="../../model/tarif_act.php?tombol=ubah&cari=&page=<?=$page?>&id=<?=$id?>" method="post">
		<input type="text" class="hidden" id="id" name="id" value="<?=$id?>">
		<table class="table">
			<tr>
				<td>Jenis Laundry</td>
				<td><input autocomplete="off" type="text" class="form-control" id="nama" name="nama" value="<?= ucwords($nama)?>"></td>
			</tr>
			<tr>
				<td>Ukuran</td>
				<td>
					<select class="form-control" id="ukuran" name="ukuran">
						<option value="besar" <?=$b?>>Besar</option>
						<option value="sedang" <?=$s?>>Sedang</option>
						<option value="kecil" <?=$k?>>Kecil</option>
						<option value="per kg" <?=$pk?>>Per Kg</option>
						<option value="per pcs" <?=$pp?>>Per Pcs</option>
					</select>
				</td>
			</tr>
			<tr>
				<td>Harga</td>
				<td><input autocomplete="off" type="text" class="form-control" id="harga" name="harga" value="<?=ucwords($harga)?>"></td>
			</tr>
			<tr>
				<td></td>
				<td><button id="tombol" name="tombol" type="submit" class="btn btn-success" value="ubah">Ubah</button></td>
			</tr>
		</table>
	</form>
	</div>
	</body>
</html>