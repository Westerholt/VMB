<?php

if (isset($_POST["name"]) && isset($_POST["appId"]) && isset($_POST["issue"])) { 

	$connect = mysqli_connect('localhost', 'id8936075_maxim', '132435qwerty','id8936075_db');
	// Попытка установить соединение с MySQL:
	if (!$connect) {
		echo "Упс, походу чёт сломалось :C Ща всё буит <br>";
		exit;
	}
	$name=$_POST['name'];
	$apId=$_POST['appId'];
	$issue=$_POST['issue'];
	mysqli_query($connect,"INSERT INTO Contact (`name`, `apartId`, `issue`) VALUES ('$name','$apId','$issue')") or die(mysqli_error($connect)); 
	mysqli_close($connect);
}else{
	echo "ERROR!";
	exit;
}

?>