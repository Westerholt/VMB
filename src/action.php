<?php

if (isset($_POST["name"]) && isset($_POST["apartType"]) && isset($_POST["checkin"]) && isset($_POST["checkout"]) && isset($_POST["username"]) && isset($_POST["password"]) && isset($_POST["sleepPlaces"]) && isset($_POST["roomsAmnt"])) { 

	$connect = mysqli_connect('localhost', 'id8936075_maxim', '132435qwerty','id8936075_db');
	// Попытка установить соединение с MySQL:
	if (!$connect) {
		echo "Упс, походу чёт сломалось :C Ща всё буит <br>";
		exit;
	}
	$name=$_POST['name']; //Имя
	$roomType=$_POST['apartType']; //Тип комнаты
	$checkIn=$_POST['checkin']; // чекин
	$checkOut=$_POST['checkout']; // чекаут
	$username=$_POST['username']; // юзернейм
	$pass=password_hash($_POST['password'], PASSWORD_DEFAULT); // пароль
	$places=$_POST["sleepPlaces"]; // !!!!ДОБАВИЛ. на сайте можно выбирать кол-во комнат и спальных мест в соответствии с этим делается запрос в БД
	$rooms=$_POST["roomsAmnt"]; //комнаты
	$q=mysqli_query($connect,"SELECT * FROM
	Apartment WHERE `occupied`='0'AND
	`class`='$roomType' AND
	`places`='$places' AND
	`rooms`='$rooms'"); // Новый запрос с комнатами и местами. В дальнейшем сделаем, чтоб, когда таких номеров нет, юзеру предложить альтернативу
	$result=mysqli_fetch_assoc($q);
	mysqli_query($connect,"UPDATE Apartment SET
	`occupied`='1' WHERE `id`='$result[id]'") or die(mysqli_error($connect));
	$apId=(int)$result[id];
	mysqli_query($connect,"INSERT INTO Users (`name`,
	`checkIn`, `checkOut`, `apartID`,`uname`,`pass`) VALUES
	('$name', '$checkIn', '$checkOut',
	'$apId','$username','$pass')") or die(mysqli_error($connect));
	mysqli_close($connect);

}else{
	echo "ERROR!";
	exit;
}

?>