<?php
	include_once("../connection.php");
	$result = $mysqli_query($conn,"SELECT * FROM accounts WHERE username = $_POST[username] AND passwd = $_POST[passwd]");

	if (mysqli_num_rows($result) == 0){
		echo json_encode( createHttpResponse(400,"Unauthorized access","User not found") );
	}else{
		$query = mysqli_query($conn,"SELECT * FROM shipments WHERE driver = $_POST[id] AND status <> 1");
/*
		$resp = array(
			"status" => 200,
			"message" => "Ok",
			"error" => $query->error,
			"shipmentId" => $query["id"]
		);*/

		echo json_encode( createHttpResponse(200,"Ok","",array(
				"shipmentId" => $query["id"]
			))
		);
	}
?>
