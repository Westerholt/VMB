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
	$comp=$_POST['company']; // компания
	$pass=password_hash($_POST['password'], PASSWORD_DEFAULT); // пароль
	$places=$_POST["sleepPlaces"]; // !!!!ДОБАВИЛ. на сайте можно выбирать кол-во комнат и спальных мест в соответствии с этим делается запрос в БД
	$rooms=$_POST["roomsAmnt"]; //комнаты
	$q=mysqli_query($connect,"SELECT * FROM
	Apartment WHERE
	`class`='$roomType' AND
	`places`='$places' AND
	`rooms`='$rooms'"); // Новый запрос с комнатами и местами. В дальнейшем сделаем, чтоб, когда таких номеров нет, юзеру предложить альтернативу
	$CritArr=array();
	while ($apCrit=mysqli_fetch_assoc($q)) {
		array_push($CritArr,$apCrit[id]);
	}
	$ApinUIA=array();
	for ($i=0; $i <sizeof($CritArr); $i++) { 
		$q=mysqli_query($connect,"SELECT * FROM UsersInAp WHERE `id_a`='$CritArr[$i]'");
		$res=mysqli_fetch_assoc($q);
		if ($res[id_a]!=null) {
			array_push($ApinUIA, $res[id_a]);
		}
		
	}
	$flag=false;
	$suiting=array();
	if(sizeof($ApinUIA!=0)){
		$suiting=array_diff($CritArr, $ApinUIA);
		$flag=true;
	}else{
		$suiting=$CritArr;
	}
	if ($flag==true) {
		for ($i=0; $i < sizeof($ApinUIA); $i++) { 
			$q=mysqli_query($connect,"SELECT * FROM UsersInAp WHERE `id_a`='$ApinUIA[$i]' AND `checkOut`<'$checkIn'");
			$res=mysqli_fetch_assoc($q);
			if ($res[id_a]!=null) {
				array_push($suiting, $res[id_a]);
			}
		}
	}

	mysqli_query($connect,"INSERT INTO Users (`name`,
	`uname`,`pass`,`company`) VALUES
	('$name','$username','$pass','$comp')") or die(mysqli_error($connect));  
	$q=mysqli_query($connect,"SELECT * FROM Users WHERE `uname`='$username' AND `name`='$name'");
	$res=mysqli_fetch_assoc($q);
	$userID=(int)$res[id];
	for ($i=0; $i < sizeof($suiting); $i++) { 
		if($suiting[$i]!=null){
			$suitingID=(int)$suiting[$i];
			break;
		}
	}
	
	$q=mysqli_query($connect,"INSERT INTO UsersInAp (`id_u`,`id_a`,`checkIn`,`checkOut`,`occupied`) VALUES
	('$userID','$suitingID','$checkIn','$checkOut', '1')");
	$data=array('uID'=>$userID, 'aID'=>$suitingID);
	echo json_encode($data);
}else{
	echo "ERROR!";
	exit;
}

?>