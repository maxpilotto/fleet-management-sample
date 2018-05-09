<?php
	include_once("../connection.php");
	$result = mysqli_query($conn,"SELECT a.*,d.name,d.surname,d.id as driverId FROM accounts as a,drivers as d WHERE d.account = a.id AND username = '$_POST[username]' AND passwd = '$_POST[passwd]'");

	//TODO Hash all passwords

	if (mysqli_num_rows($result) == 0){
		$response = array(
			"status" => 400,
			"message" => "Unauthorized access",
			"error" => "User not found"
		);
		
		echo json_encode($response);
	}else{
		$result = mysqli_fetch_assoc($result);
		$query = mysqli_query($conn,"SELECT * FROM shipments WHERE driver = $result[driverId] AND status <> 1");

		if (mysqli_num_rows($query) > 0){
			$query = mysqli_fetch_assoc($query);
			
			$response = array(
				"status" => 200,
				"message" => "Ok",
				"error" => "",
				"shipmentId" => $query["id"],
				"name" => $result["name"],
				"surname" => $result["surname"],
				"destination" => $query["destination"]
			);
			
			echo json_encode($response);
		}else{
			$response = array(
				"status" => 200,
				"message" => "Ok",
				"error" => "",
				"shipmentId" => 0,
				"name" => $result["name"],
				"surname" => $result["surname"],
				"destination" => "None, waiting for a new shipment"
			);
			
			echo json_encode($response);
		}
	}
?>
