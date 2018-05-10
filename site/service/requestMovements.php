<?php
	include_once("../connection.php");
	$result = mysqli_query($conn,"SELECT a.*,d.id as driverId FROM accounts as a,drivers as d WHERE d.account = a.id AND username = '$_POST[username]' AND passwd = '$_POST[passwd]'");

	//TODO Hash all passwords

	if (mysqli_num_rows($result) == 0){
		$response = array(
			"status" => 400,
			"message" => "Unauthorized access",
			"error" => "User not found"
		);
		
		echo json_encode($response);
	}else{
		$query = mysqli_query($conn,"SELECT * FROM movements WHERE shipment = $_POST[shipmentId]");

		if (mysqli_num_rows($query) > 0){
			$response = array();
						
			foreach ($query as $movement){
				$tmp = array(
					"movDate" => $movement["movDate"],
					"movTime" => $movement["movTime"],
					"latitude" => $movement["latitude"],
					"longitude" => $movement["longitude"],
					"speed" => $movement["speed"]
				);
				
				$response[] = $tmp;
			}

			$httpResponse["status"] = 200;
			$httpResponse["message"] = "Ok";
			$httpResponse["error"] = "";
			$httpResponse["movements"] = $response;
			
			echo json_encode($httpResponse);
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
