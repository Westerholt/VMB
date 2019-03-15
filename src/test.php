<?php
	$connect = mysqli_connect('localhost', 'id8936075_maxim', '132435qwerty','id8936075_db');
	$name="qwerty";
	$ap=1;
	$msg="dasdasd";
	if($connect){
		echo "connected<br/>";
	}
	mysqli_query("INSERT INTO Contacts (`name`, `apartId`, `issue`) VALUES ('$name','$ap','$msg')") or die(mysqli_error($connect)); 
	mysqli_close($connect); 
?>