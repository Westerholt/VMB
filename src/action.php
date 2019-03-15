<?php

if (isset($_POST["name"]) && isset($_POST["apartType"]) && isset($_POST["checkin"]) && isset($_POST["checkout"]) && isset($_POST["username"]) && isset($_POST["password"]) && isset($_POST["sleepPlaces"]) && isset($_POST["roomsAmnt"])) { 

	$connect = mysqli_connect('localhost', 'id8936075_maxim', '132435qwerty','id856id8936075_db6642');
	// Попытка установить соединение с MySQL:
	if (!$connect) {
		echo "Упс, походу чёт сломалось :C Ща всё буит <br>";
		exit;
	}
	$name=$_POST['name']; //Имя
	$roomType=$_POST['apartType']; //Тип комнаты
	$checkIn=$_POST['checkin']; // чекин
	$checkOut=$_POST['checkout']; // чекаут
	$username=$_POST['$username']; // юзернейм
	$pass=$_POST['password']; // пароль
	$places=$_POST["sleepPlaces"]; // !!!!ДОБАВИЛ. на сайте можно выбирать кол-во комнат и спальных мест в соответствии с этим делается запрос в БД
	$rooms=$_POST["roomsAmnt"]; //комнаты
	$q=mysqli_query($connect,"SELECT * FROM
	Apartment WHERE `occupied`=false AND
	`class`='$roomtype' AND
	`places`='$places' AND
	`rooms`='$rooms'"); // Новый запрос с комнатами и местами. В дальнейшем сделаем, чтоб, когда таких номеров нет, юзеру предложить альтернативу
	$result=mysqli_fetch_assoc($q);
	mysqli_query($connect,"UPDATE Apartment SET
	`occupied`=true WHERE `id`='$result[id]'") or die(mysqli_error($connect));
	mysqli_query($connect,"INSERT INTO Users (`name`,
	`checkIn`, `checkOut`, `apartID`,`uname`,`pass`) VALUES
	('$name', '$checkIn', '$checkOut',
	'$result[id]','$username','$pass')") or die(mysqli_error($connect));
	mysqli_close($connect);
}else{
	echo "ERROR!";
	exit;
}

?>