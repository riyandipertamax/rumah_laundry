<?php 
	require 'header_view.php';
	require 'menu_view.php'; 

	if (isset($_GET['id'])) {
		$id		= $_GET['id'];
		$page	= $_GET['page'];
		$q_edit	= mysql_query("SELECT * FROM admin WHERE admin_id='$id'");
		$f_edit = mysql_fetch_object($q_edit);
		$id 	= $f_edit->admin_id;
		$nama 	= $f_edit->admin_nama;
		$username 	= $f_edit->admin_username;
	} else {
		header('location:../edit_tarif_view.php?status=1&cari=&page=1');
	}

	if(isset($_GET['status'])){
		if($_GET['status'] == '1'){
			echo "<div style='margin-bottom:-55px' class='alert alert-danger' role='alert'><span class='glyphicon glyphicon-warning-sign'></span>  Input Gagal!! Admin sudah ada!! <a class='close' data-dismiss='alert' aria-hidden='true' href='edit_admin_form.php?id=$id&page=$page'>&times</a></div></br></br>";
		} elseif($_GET['status'] == '2'){
			echo "<div style='margin-bottom:-55px' class='alert alert-danger' role='alert'><span class='glyphicon glyphicon-warning-sign'></span>  Input Gagal!! Isi data dengan benar!! <a class='close' data-dismiss='alert' aria-hidden='true' href='edit_admin_form.php?id=$id&page=$page'>&times</a></div></br></br>";
		} elseif($_GET['status'] == '3'){
			echo "<div style='margin-bottom:-55px' class='alert alert-danger' role='alert'><span class='glyphicon glyphicon-warning-sign'></span>  Input Gagal!! Ulangi password tidak sesuai!! <a class='close' data-dismiss='alert' aria-hidden='true' href='edit_admin_form.php?id=$id&page=$page'>&times</a></div></br></br>";
		} elseif($_GET['status'] == '4') {
			echo "<div style='margin-bottom:-55px' class='alert alert-danger' role='alert'><span class='glyphicon glyphicon-warning-sign'></span>  Input Gagal!! Password minimal 5 karakter!! <a class='close' data-dismiss='alert' aria-hidden='true' href='edit_admin_form.php?id=$id&page=$page'>&times</a></div></br></br>";
		}
	}
	
?>

<h3><span class="glyphicon glyphicon-briefcase"></span>  Ubah Admin</h3>
<a class="btn" href="admin_view.php?cari=&page=<?=$page?>"><span class="glyphicon glyphicon-arrow-left"></span>  Kembali</a>
	<form action="../../model/admin_act.php?tombol=ubah&page=<?=$page?>" method="post">
		<table class="table">
			<input type="text" class="hidden" id="id" name="id" value="<?=$id?>">
			<tr>
				<td>Nama</td>
				<td><input autocomplete="off" type="text" class="form-control" id="nama" name="nama" value="<?php echo $nama; ?>"></td>
			</tr>
			<tr>
				<td>Username</td>
				<td><input autocomplete="off" type="text" class="form-control" id="username" name="username" value="<?php echo $username; ?>"></td>
			</tr>
			<tr>
				<td>Password</td>
				<td><input autocomplete="off" type="password" class="form-control" id="password" name="password" placeholder="Masukan password baru .."></td>
			</tr>
			<tr>
				<td>Ulangi Password</td>
				<td><input autocomplete="off" type="password" class="form-control" id="ulang" name="ulang" placeholder="Ulangi password baru .."></td>
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