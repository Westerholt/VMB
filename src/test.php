<?php

	$connect = mysqli_connect('localhost', 'id8936075_maxim', '132435qwerty','id8936075_db');
	// Попытка установить соединение с MySQL:
	if (!$connect) {
		echo "Упс, походу чёт сломалось :C Ща всё буит <br>";
		exit;
	}
	$name='Allah'; //Имя
	$roomType='econom'; //Тип комнаты
	$checkIn='2019-04-18'; // чекин
	$checkOut='2019-04-20'; // чекаут
	$username='qwerty'; // юзернейм
	$pass='12345qwerty'; // пароль
	$places='2'; // !!!!ДОБАВИЛ. на сайте можно выбирать кол-во комнат и спальных мест в соответствии с этим делается запрос в БД
	$rooms='1'; //комнаты
	$q=mysqli_query($connect,"SELECT * FROM
	Apartment WHERE `occupied`='0'AND
	`class`='$roomType' AND
	`places`='$places' AND
	`rooms`='$rooms'"); // Новый запрос с комнатами и местами. В дальнейшем сделаем, чтоб, когда таких номеров нет, юзеру предложить альтернативу
	$result=mysqli_fetch_assoc($q);
	echo "appID: ",$result[id],"<br/>";
	mysqli_query($connect,"UPDATE Apartment SET
	`occupied`='1' WHERE `id`='$result[id]'") or die(mysqli_error($connect));
	$apId=(int)$result[id];
	mysqli_query($connect,"INSERT INTO Users (`name`,
	`checkIn`, `checkOut`, `apartID`,`uname`,`pass`) VALUES
	('$name', '$checkIn', '$checkOut',
	'$apId','$username','$pass')") or die(mysqli_error($connect));
	mysqli_close($connect);

?>