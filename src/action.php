<?php

if (isset($_POST["name"]) && isset($_POST["apartType"]) && isset($_POST["checkin"]) && isset($_POST["checkout"]) && isset($_POST["pass"]) { 

	$connect = mysqli_connect('localhost', 'id8566642_trat', '141180','id8566642_rd');
	// Попытка установить соединение с MySQL:
	if (!$connect) {
		echo "Ошибка подключения к серверу MySQL <br>";
		exit;
	}
	$name=$_POST['name'];
	$roomType=$_POST['apartType'];
	$checkIn=$_POST['checkin'];
    $checkOut=$_POST['checkout'];
    $pass=$_POST['pass'];
	$q=mysqli_query("SELECT * FROM
	Apartment WHERE `occupied`=false AND
	`class`='$roomtype'");
	$result=mysqli_fetch_assoc($q);
	mysqli_query("UPDATE Apartment SET
	`occupied`=true WHERE `id`='$result[id]'");
	mysqli_query("INSERT INTO Users (`name`,
	`checkIn`, `checkOut`, `apartID`,`pass`) VALUES
	('$name', '$checkIn', '$checkOut',
	'$result[id]','$pass')");
	mysqli_close($connect);
}else{
	echo "ERROR!";
	exit;
}

?>