<?php
	$conn = mysqli_connect("localhost","root","","fleet_db");

	function createHttpResponse($status,$message,$error,$params = array()){
		$response = array(
			"status" => $status,
			"message" => $message,
			"error" => $error,
			"params" => array($params)
		);

		return $response;
	}
?>
