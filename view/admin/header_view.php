<?php 
	session_start();
	include '../../config/session.php';
	include '../../config/database.php';
?>
<html>
	<head>
		<title>RUMAH LAUNDRY</title>
		<link rel="stylesheet" type="text/css" href="../../assets/css/bootstrap.css">
		<link rel="stylesheet" type="text/css" href="../../assets/css/bootstrap-datepicker.css">
		<link rel="stylesheet" type="text/css" href="../../assets/css/bootstrap-datepicker3.css">
		<link rel="stylesheet" type="text/css" href="../../assets/js/jquery-ui/jquery-ui.css">
		
		<script type="text/javascript" src="../../assets/js/jquery.js"></script>
		<script type="text/javascript" src="../../assets/js/bootstrap.js"></script>
		<script type="text/javascript" src="../../assets/js/bootstrap-datepicker.js"></script>
		<script type="text/javascript" src="../../assets/js/jquery-ui/jquery-ui.js"></script>

	</head>
	<body>		
		<div class="header navbar-default" style="font-color: #000">
			<div class="container-fluid">
				<div class="navbar-header">
					<div class="navbar-brand">RUMAH LAUNDRY</div>
					<div class="navbar-brand">Jl. Pluto Raya C.20, Komp. Margahayu Raya </div>
					<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target=".navbar-collapse">
						<span class="sr-only">Toggle navigator</span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
				</div>
				<div class="collapse navbar-collapse">
					<ul class="nav navbar-nav navbar-right">
						<li class="navbar-brand">Hy, <?=ucwords($_SESSION['admin_nama'])?></a></li>
						<li><a id="pesan" href="#" data-toggle="modal" data-target="#modalpesan"><span class="glyphicon glyphicon-inbox"></span> Pesan</a></li>
						<li><a id="logout" href="../../model/logout_act.php">Logout <span class="glyphicon glyphicon-off"></span></a></li>
					</ul>
				</div>
			</div>			
		</div>
		
		<div id="modalpesan" class="modal fade">
			<div class="modal-dialog">
				<div class="codal-content" style="background:#ffffff">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
						<h4 class="modal-title">Pesan</h4>
					</div>
					<div class="modal-body">isi pesan pake query entar mah</div>
				</div>
			</div>
		</div>