<?php

	$connect = mysqli_connect('localhost', 'id8936075_maxim', '132435qwerty','id8936075_db');
	// Попытка установить соединение с MySQL:
	if (!$connect) {
		echo "Упс, походу чёт сломалось :C Ща всё буит <br>";
		exit;
	}
	$name='Allah'; //Имя
	$roomType='econom'; //Тип комнаты
	$checkIn='2019-04-06'; // чекин
	$checkOut='2019-04-08'; // чекаут
	$username='qwerty'; // юзернейм
	$pass='12345qwerty'; // пароль
	$places='2'; // !!!!ДОБАВИЛ. на сайте можно выбирать кол-во комнат и спальных мест в соответствии с этим делается запрос в БД
	$rooms='1'; //комнаты
	$q=mysqli_query($connect,"SELECT * FROM
	Apartment WHERE
	`class`='$roomType' AND
	`places`='$places' AND
	`rooms`='$rooms'"); // Новый запрос с комнатами и местами. В дальнейшем сделаем, чтоб, когда таких номеров нет, юзеру предложить альтернативу
	$CritArr=array();
	while ($apCrit=mysqli_fetch_assoc($q)) {
		array_push($CritArr,$apCrit[id]);
	}
	foreach ($CritArr  as $key => $value) { 
		echo "Indexes By Criteria: ",$value,"<br/>";
	}
	$ApinUIA=array();
	foreach ($CritArr  as $key => $value) { 
		$q=mysqli_query($connect,"SELECT * FROM UsersInAp WHERE `id_a`='$value'");
		$res=mysqli_fetch_assoc($q);
		if ($res[id_a]!=null) {
			
			array_push($ApinUIA, $res[id_a]);
		}
		
	}
	foreach ($ApinUIA  as $key => $value) { 
		echo "<strong>ApinUIA ",$key,"</strong>: ",$value,"<br/>";
	}
	$flag=false;
	$suiting=array();
	if(sizeof($ApinUIA!=0)){
		$suiting=array_diff($CritArr, $ApinUIA);
		$inter=array_intersect($CritArr, $ApinUIA);
		foreach($suiting  as $key1 => $val1) { 
			echo "Among them are <strong>not in</strong> UserInAp: ",$val1,"<br/>";
		}
		foreach ($inter  as $key2 => $val2) { 
			echo "<strong>Intersection</strong>: ",$val2,"<br/>";
		}
		$flag=true;
	}else{
		$suiting=$CritArr;
	}
	if ($flag==true) {
		foreach($ApinUIA  as $key => $value) { 
			$q=mysqli_query($connect,"SELECT * FROM UsersInAp WHERE `id_a`='$value' AND `checkOut`<'$checkIn'");
			$res=mysqli_fetch_assoc($q);
			if ($res[id_a]!=null) {
				echo "Indexes where <strong>checkoutSMALLERcheckin</strong>: ",$res[id_a],"<br/>";
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
	foreach($suiting  as $key => $value) { 
		if($value!=null){
			$suitingID=(int)$value;
			break;
		}
	}
	
	$q=mysqli_query($connect,"INSERT INTO UsersInAp (`id_u`,`id_a`,`checkIn`,`checkOut`,`occupied`) VALUES
	('$userID','$suitingID','$checkIn','$checkOut', '1')");
	mysqli_close($connect);

?>