<?php
session_start();

if (isset($_POST["flag"]) ) { 
	$status=false;
	if (isset($_SESSION['uname']) && isset($_SESSION['pass'])) {
		$status=true;
	}	
	if ($status==true) {
		$data=array('status'=>'1');	
	}else{
		$data=array('status'=>'0');	
	}
	echo json_encode($data);
}else{
	echo "ERROR!";
	exit;
}

?>