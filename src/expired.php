<?php

	$connect = mysqli_connect('localhost', 'id8936075_maxim', '132435qwerty','id8936075_db');
	// Попытка установить соединение с MySQL:
	if (!$connect) {
		echo "Упс, походу чёт сломалось :C Ща всё буит <br>";
		exit;
	}
	mysqli_query($connect,"UPDATE UsersInAp SET `occupied`='0' WHERE `checkOut`<NOW()") or die(mysqli_error($connect));
	mysqli_close($connect);

?>