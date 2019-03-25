<?php
session_start();
if (isset($_POST["uname"]) && isset($_POST["pass"]) ) { 
	$login=$_POST["uname"];
	$pass=$_POST["pass"];
	$connect = mysqli_connect('localhost', 'id8936075_maxim', '132435qwerty','id8936075_db');
	// Попытка установить соединение с MySQL:
	if (!$connect) {
		echo "Упс, походу чёт сломалось :C Ща всё буит <br>";
		exit;
	}
	$status=false;
	$q=mysqli_query($connect,"SELECT * FROM Users") or die(mysqli_error($connect)); 
	while ($result=mysqli_fetch_assoc($q)) {
		if ($result['uname']==$login && password_verify($pass, $result['pass'])) {
			$_SESSION['uname']=$login;
			$_SESSION['pass']=$pass;
			$status=true;
			break;
		}
	}
	if ($status==true) {
		$data=array('status'=>'1', 'uname'=>$_SESSION['uname'],'pass'=>$_SESSION['pass']);	
	}else{
		$data=array('status'=>'0');	
	}
	echo json_encode($data);
	mysqli_close($connect);
}else{
	echo "ERROR!";
	exit;
}

?>