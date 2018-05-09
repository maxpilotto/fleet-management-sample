<?php
	include_once("../connection.php");
	$result = mysqli_query($conn,"SELECT a.*,d.name,d.surname,d.id as driverId FROM accounts as a,drivers as d WHERE d.account = a.id AND username = '$_POST[username]' AND passwd = '$_POST[passwd]'");

	//TODO Hash all passwords

	if (mysqli_num_rows($result) == 0){
		echo json_encode( createHttpResponse(400,"Unauthorized access","User not found") );
	}else{
		$result = mysqli_fetch_assoc($result);
		$query = mysqli_fetch_assoc(mysqli_query($conn,"SELECT * FROM shipments WHERE driver = $result[driverId] AND status <> 1"));

		//TODO return also the driver's name and surname since the clients only sends the credentials and doesn't know which driver is logged

		echo json_encode( createHttpResponse(200,"Ok","",array(
				"shipmentId" => $query["id"]
			))
		);
	}
?>
