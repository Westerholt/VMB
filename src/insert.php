<?php

	echo "qq!<br/>";
	$connect = mysqli_connect('localhost', 'id8936075_maxim', '132435qwerty','id8936075_db');
	// Попытка установить соединение с MySQL:
	if (!$connect) {
		echo "Damn, boi <br>";
		exit;
	}else{
		echo "connected<br/>";
	}
	for ($i=0; $i<6; $i++) { 
		mysqli_query($connect,"INSERT INTO Apartment (`class`, `places`, `rooms`, `occupied`, `contents`) VALUES ('business', '6', '3', '0', '3')") or die(mysqli_error($connect)); 
		echo "Inserted row #",$i," business 6 places 3 rooms<br/>";
	} 
	
	mysqli_close($connect); 

?>