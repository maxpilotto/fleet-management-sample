<?php 
	/**
	 * This php file will handle all the data from each single truck
	 */
	include_once("connection.php");
	$user = mysqli_query($conn,"SELECT * FROM accounts WHERE username = '$_POST[user]' AND passwd = '$_POST[pass]'");
	
	if (mysqli_num_rows($user) == 0){
		include("authError.php");
	}else{
		mysqli_query($conn,"INSERT INTO movements VALUES(
			null,
			'$_POST[movDate]',
			'$_POST[movTime]',
			$_POST[latitude],
			$_POST[longitude],
			$_POST[speed],
			$_POST[shipment],
			'$_POST[place]',
		)");
		
		$resp = array(
			"status" => 200,
			"message" => "Ok",
			"error" => $conn->error
		);
		
		echo json_encode($resp);
	}
?>