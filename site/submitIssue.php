<?php 
	/**
	 * This php file will handle all the issues sent by the drivers
	 */
	$conn = mysqli_connect("localhost","root","","fleet_db");
	
	$user = $_POST["user"];
	$passwd = $_POST["passwd"];
	$shipment = $_POST["shipment"];
	$title = $_POST["title"];
	$body = $_POST["body"];
	$cause = $_POST["cause"];
	
?>