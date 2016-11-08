<?php 
	require 'header_view.php';
	require 'menu_view.php';
	
	$nama 	= $_SESSION['admin_nama'];
	$q_id	= mysql_query("SELECT * FROM admin WHERE admin_nama ='$nama'");
	$q =  mysql_fetch_object($q_id);

	if(isset($_GET['status'])){
		if($_GET['status'] == '1'){
			echo "<div style='margin-bottom:-55px' class='alert alert-danger' role='alert'><span class='glyphicon glyphicon-warning-sign'></span>  Ganti Password Gagal!! Harap isi password lama!! <a class='close' data-dismiss='alert' aria-hidden='true' href='ch_password_view.php?'>&times</a></div></br></br>";
		} elseif($_GET['status'] == '2'){
			echo "<div style='margin-bottom:-55px' class='alert alert-danger' role='alert'><span class='glyphicon glyphicon-warning-sign'></span>  Ganti Password Gagal!! Password lama tidak sesuai!! <a class='close' data-dismiss='alert' aria-hidden='true' href='ch_password_view.php?'>&times</a></div></br></br>";
		} elseif($_GET['status'] == '3'){
			echo "<div style='margin-bottom:-55px' class='alert alert-danger' role='alert'><span class='glyphicon glyphicon-warning-sign'></span>  Ganti Password Gagal!! Password baru dan password ulang tidak sesuai!! <a class='close' data-dismiss='alert' aria-hidden='true' href='ch_password_view.php?'>&times</a></div></br></br>";
		} elseif($_GET['status'] == '4'){
			echo "<div style='margin-bottom:-55px' class='alert alert-danger' role='alert'><span class='glyphicon glyphicon-warning-sign'></span>  Ganti Password Gagal!! Password minimal 5 karakter!! <a class='close' data-dismiss='alert' aria-hidden='true' href='ch_password_view.php?'>&times</a></div></br></br>";
		}
	}

?>

			<h3><span class="glyphicon glyphicon-lock"></span>&nbsp;Ganti Password</h3>
			</br>
			</br>
			</br>
			</br>
			<div class='col-md-4 col-md-offset-3'>
			<form action="../../model/ch_password_act.php?id=<?php echo $q->admin_id; ?>" method="post">
				<div class="form-group">
					<label>Password Lama</label>
					<input id="lama" name="lama" type="password" class="form-control" placeholder="Password lama ..">
				</div>
				<div class="form-group">
					<label>Password Baru</label>
					<input id="baru" name="baru" type="password" class="form-control" placeholder="Password baru ..">
				</div>
				<div class="form-group">
					<label>Ulangi Password Baru</label>
					<input id="ulang" name="ulang" type="password" class="form-control" placeholder="Ulangi password baru ..">
				</div>
					<input type="submit" class="btn btn-success" value="Simpan">
					<input type="reset" class="btn btn-danger" value="Reset">
			</form>
			</div>
		</div>
	</body>
</html>