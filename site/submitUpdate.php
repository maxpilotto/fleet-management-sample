<?php 
	/**
	 * This php file will handle all the data from each single truck
	 */
	$conn = mysqli_connect("localhost","root","","fleet_db");
	
	$user = $_POST["user"];
	$passwd = $_POST["passwd"];
	$shipment = $_POST["shipment"];
	$positionX = $_POST["positionX"];
	$positionY = $_POST["positionY"];
	$speed = $_POST["speed"];
	
?>