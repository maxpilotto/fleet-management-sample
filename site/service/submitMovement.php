<?php
	/**
	 * This php file will handle all the data from each single truck
	 */
	include_once("../connection.php");
	$user = mysqli_query($conn,"SELECT * FROM accounts WHERE username = '$_POST[username]' AND passwd = '$_POST[passwd]'");

	//TODO Check if the user is a driver

	if (mysqli_num_rows($user) == 0){
		echo json_encode( createHttpResponse(400,"Unauthorized access","User not found") );
	}else{
		$query = mysqli_query($conn,"INSERT INTO movements VALUES(
			null,
			'$_POST[movDate]',
			'$_POST[movTime]',
			$_POST[latitude],
			$_POST[longitude],
			$_POST[speed],
			$_POST[shipment],
			'$_POST[place]',
		)");
/*
		$resp = array(
			"status" => 200,
			"message" => "Ok",
			"error" => $conn->error
		);*/

		echo json_encode( createHttpResponse(200,"Ok","") );
	}
?>
