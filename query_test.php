<?php 
	include 'config/database.php';
	

	
	
	$t_hal 	= 10;
	$page	= 2;

	if ($page == 1) {
		$i=1;
	}else{
		$i=($t_hal*($page-1))+1;
	}

	$p 		= $t_hal * $page;

	for ($i; $i <= $p ; $i++) { 
		
		echo $i." ";
	}
	
	
?>
