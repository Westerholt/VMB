<?php

	$connect = mysqli_connect('localhost', 'id8936075_maxim', '132435qwerty','id8936075_db');
	// Попытка установить соединение с MySQL:
	if (!$connect) {
		echo "Упс, походу чёт сломалось :C Ща всё буит <br>";
		exit;
	}
	mysqli_query($connect,"SET @apId=(SELECT apartId FROM Users WHERE `checkOut`<NOW());
	DELETE FROM Users WHERE checkOut < NOW();
	UPDATE Apartment SET `occupied`=0 WHERE `id`=@apId;") or die(mysqli_error($connect));
	mysqli_close($connect);

?>