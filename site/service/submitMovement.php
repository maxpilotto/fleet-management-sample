<?php
	/**
	 * This php file will handle all the data from each single truck
	 */
	include_once("../connection.php");
	$user = mysqli_query($conn,"SELECT * FROM accounts WHERE username = '$_POST[username]' AND passwd = '$_POST[passwd]'");

	//TODO Check if the user is a driver

	if (mysqli_num_rows($user) == 0){
		$response = array(
			"status" => 400,
			"message" => "Unauthorized access",
			"error" => "User not found"
		);
		echo json_encode($response);
	}else{
		$query = mysqli_query($conn,"INSERT INTO movements(`movDate`, `movTime`, `latitude`, `longitude`, `speed`, `shipment`)
			VALUES(
			'$_POST[movDate]',
			'$_POST[movTime]',
			$_POST[latitude],
			$_POST[longitude],
			$_POST[speed],
			$_POST[shipment]
		)");

		if ($query){
			$response = array(
				"status" => 200,
				"message" => "Ok",
				"error" => ""
			);
		
			echo json_encode($response);
		}else{
			$response = array(
				"status" => 500,
				"message" => "Query error",
				"error" => mysqli_error($conn)
			);
		
			echo json_encode($response);
		}
	}
?>
