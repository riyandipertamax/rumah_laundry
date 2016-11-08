<?php 
	require 'header_view.php';
	require 'menu_view.php';
?>

<h3><span class="glyphicon glyphicon-briefcase"></span>  Ubah Order</h3>
<a class="btn" href="order_view.php"><span class="glyphicon glyphicon-arrow-left"></span>  Kembali</a>
	<form action="" method="post">
		<table class="table">
			<tr>
				<td>Jenis Laundry</td>
				<td><input type="text" class="form-control" name="" value="<?php ?>"></td>
			</tr>
			<tr>
				<td>Ukuran</td>
				<td><input type="text" class="form-control" name="" value="<?php  ?>"></td>
			</tr>
			<tr>
				<td>Harga</td>
				<td><input type="text" class="form-control" name="" value="<?php  ?>" disabled></td>
			</tr>
			<tr>
				<td>Jumlah</td>
				<td><input type="text" class="form-control" name="" value="<?php  ?>"></td>
			</tr>
			<tr>
				<td>Harga</td>
				<td><input type="text" class="form-control" name="" value="<?php  ?>" disabled></td>
			</tr>
			<tr>
				<td></td>
				<td><input type="submit" class="btn btn-info" value="Ubah"></td>
			</tr>
		</table>
	</form>
	</div>
	</body>
</html>