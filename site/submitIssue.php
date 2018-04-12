<?php 
	/**
	 * This php file will handle all the issues sent by the drivers
	 */
	include_once("connection.php");
	
	$user = $_POST["user"];
	$passwd = $_POST["passwd"];
	$shipment = $_POST["shipment"];
	$title = $_POST["title"];
	$body = $_POST["body"];
	$cause = $_POST["cause"];
	
?>