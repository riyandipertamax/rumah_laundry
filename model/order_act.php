<?php
	require_once ('../config/database.php');

	if (!isset($_POST['ukuran']) && isset($_POST['nama'])) {
		$nama 		= $_POST['nama'];

		$q_ukuran	= mysql_query("SELECT DISTINCT tarif_ukuran FROM tarif WHERE tarif_nama='$nama' ORDER BY tarif_harga ASC");
		$r_ukuran = mysql_num_rows($q_ukuran);

		if ($r_ukuran != 0) {
			echo "<option value='0'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</option>";

			while ($f_ukuran	= mysql_fetch_object($q_ukuran)) {
				echo "<option maxlength='13' value='".$f_ukuran->tarif_ukuran."'>".ucwords($f_ukuran->tarif_ukuran)."</option>";				
			}	
		}else{
			echo "<option value='0'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</option>";
		}

	} elseif (isset($_POST['ukuran']) && isset($_POST['nama'])) {
		$nama 		= $_POST['nama'];
		$ukuran 	= $_POST['ukuran'];

		$q_harga 	= mysql_query("SELECT * FROM tarif WHERE tarif_nama='$nama' AND tarif_ukuran='$ukuran' ORDER BY tarif_ukuran ASC");
		$f_harga	= mysql_fetch_array($q_harga);
		$r_harga	= mysql_num_rows($q_harga);
		$harga 		= $f_harga['tarif_harga'];
?>
			<script type="text/javascript">
				if (<?=$r_harga?>==0) {
					document.formTambah.harga.value=0;
				}else{
					document.formTambah.harga.value=<?=$harga?>;
				}
			</script>
<?php
		
	} elseif (isset($_POST['sortir'])) {
		$sortir		= $_POST['sortir'];

		if ($sortir == 'harian') {
			echo "<label class='control-label'>&nbsp;&nbsp;Pilih Tanggal &nbsp;&nbsp;&nbsp;:&nbsp;&nbsp;</label>
			      <input onchange='cari()' class='form-control inline' style='width: 100px' type='text' name='tanggal' id='tanggal' />";
		} elseif ($sortir == 'mingguan') {
			echo "<label class='control-label'>&nbsp;&nbsp;Dari &nbsp;:&nbsp;&nbsp;</label>
			      <input class='form-control inline' style='width: 100px' type='text' name='tanggal' id='tanggal' />
			      <label class='control-label'>&nbsp;&nbsp;Sampai &nbsp;:&nbsp;&nbsp;</label>
			      <input class='form-control inline' style='width: 100px' type='text' name='tanggal1' id='tanggal1' />";
		} elseif ($sortir == 'bulanan') {
			echo "<label class='control-label'>&nbsp;&nbsp;Pilih Bulan &nbsp;:&nbsp;&nbsp;</label>
					<select class='form-control inline' id='bulan' name='bulan'>
						<option>--------</option>
						<option value='1'>Januari</option>
						<option value='2'>Februari</option>
						<option value='3'>Maret</option>
						<option value='4'>April</option>
						<option value='5'>Mei</option>
						<option value='6'>Juni</option>
						<option value='7'>Juli</option>
						<option value='8'>Agustus</option>
						<option value='9'>September</option>
						<option value='10'>Oktober</option>
						<option value='11'>November</option>
						<option value='12'>Desember</option>
					</select>
				  <label class='control-label'>&nbsp;&nbsp;Tahun &nbsp;:&nbsp;&nbsp;</label>
				  <input maxlength='4' style='width: 60px' class='form-control inline' type='text' name='tahun' id='tahun' />";
		} elseif ($sortir == 'tahunan') {
			echo "<label class='control-label'>&nbsp;&nbsp;Masukan Tahun &nbsp;:&nbsp;&nbsp;</label>
			      <input maxlength='4' style='width: 60px' class='form-control inline' type='text' name='tahun' id='tahun' />";
		} 
	}
?>

<script type="text/javascript">
	$(document).ready(function () {
		$('#tanggal').datepicker({
			format: "dd-mm-yyyy",
		    autoclose:true
		});
		$('#tanggal1').datepicker({
		    format: "dd-mm-yyyy",
		    autoclose:true
		});
	});
</script>