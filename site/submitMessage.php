<?php 
	/**
	 * This php file will handle all the data from each single truck
	 */
	include_once("connection.php");
	
	$user = $_POST["user"];
	$passwd = $_POST["passwd"];
	$shipment = $_POST["shipment"];
	$positionX = $_POST["positionX"];
	$positionY = $_POST["positionY"];
	$speed = $_POST["speed"];
	
?>