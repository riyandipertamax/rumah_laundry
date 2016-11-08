<html>
	<head>
		<title>RUMAH LAUNDRY</title>
		<link rel="stylesheet" type="text/css" href="assets/css/bootstrap.css">
		<link rel="stylesheet" type="text/css" href="assets/js/jquery-ui/jquery-ui.css">
		<link rel="stylesheet" type="text/css" href="assets/css/font-awesome.min.css">
		<link rel="stylesheet" type="text/css" href="assets/css/style.css">		
		<script type="text/javascript" src="assets/js/jquery.js"></script>
		<script type="text/javascript" src="assets/js/jquery.js"></script>
		<script type="text/javascript" src="assets/js/bootstrap.js"></script>
		<script type="text/javascript" src="assets/js/jquery-ui/jquery-ui.js"></script>

		
	</head>
	<body background="assets/img/bag.jpg">
	<?php 
				if(isset($_GET['pesan'])){
					if($_GET['pesan'] == "gagal"){
						echo "<div style='margin-bottom:-55px' class='alert alert-danger' role='alert'><span class='glyphicon glyphicon-warning-sign'></span>  Login Gagal !! User Level, Username, dan Password Tidak Sesuai !!<a class='close' data-dismiss='alert' aria-hidden='true' href='index.php?'>&times</a></div>";
					}
				}
				?>
		<div class="col-md-8" style="padding-top:10%; padding-left:10%">
			<img src="assets/img/spanduk.jpg" height="50%"></br></br></br>
			<a href="#" data-toggle="modal" data-target="#modalLogin" class="button">Login</a>
		</div>

		<div class="modal fade" id="modalLogin" aria-hidden="true" >
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times</button>
						<h2 class="modal-title">Login</h2>
					</div>
					<div class="modal-body">
						<form method="POST" class="form-group" action="model/login_act.php">
							<div class="form-group">
						      	<label class="control-label">User Level</label>
						        <select class="form-control" id="level" name="level">
						        	<option value="0" >-- Pilih User Level --</option>
						         	<option value="1" >Admin</option>
						          	<option value="2" >Pegawai</option>
						        </select>
						    </div>
							<div class="form-group">
								<label class="control-label" for="inputDefault">Username</label>
								<div class="input-group">	                        	
									<input autocomplete="off" class="form-control" id="admin_username" name="admin_username" type="text" placeholder="Masukan username">
									<span class="input-group-addon"><b class="glyphicon glyphicon-user"></b></span>
								</div>
							</div>
							<div class="form-group">
								<label class="control-label" for="inputDefault">Password</label>
								<div class="input-group">
									<input autocomplete="off" class="form-control" id="admin_password" name="admin_password" type="password" placeholder="Masukan Password">
									<span class="input-group-addon"><b class="glyphicon glyphicon-lock"></b></span>
								</div>
							</div>

						</div>
						<div class="modal-footer">
							<button type="submit" class="btn btn-info">Login</button>
						</div>
					</form>
				</div>
			</div>
		</div>

	</body>
</html>