<?php
	session_start();
	if (isset($_POST["flag"]) ) { 
		
		$data=array('status'=>'1');
		echo json_encode($data);
		session_destroy();
    	unset($_SESSION);
	}
?>