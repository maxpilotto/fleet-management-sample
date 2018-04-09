<html>

<?php
session_start();
echo file_get_contents("defaultHead.html");
include_once("connection.php");
?>

<body>
	<!-- Header -->
	<?php
	include("defaultHeader.php");
	include("defaultAuthCheck.php");
	?>

	<!-- Content -->
	<div id="content-wrapper" class="mui--text-center">
		<div class="mui--appbar-height"></div>
		<br />
		<br />
		<div class="mui-container">
			<?php
			$result = mysqli_query($conn,"SELECT * FROM issues WHERE id = $_GET[id]");

			if (mysqli_num_rows($result) == 0){
				echo "No issues found";
				return;
			}

			$row = mysqli_fetch_assoc($result);
			$shipment = mysqli_fetch_assoc(mysqli_query($conn,"SELECT * FROM shipments WHERE id = $row[shipment]"));

			echo "<b>Title:</b> $row[title] </br>";
			echo "<b>Code:</b> $row[code] </br>";
			echo "<b>Description:</b> $row[description] </br>";
			echo "<b>Possbile cause:</b> $row[cause] </br>";
			echo "<b>Shipment:</b> $shipment[destination] </br>";
			echo "<b>Status:</b> $row[status] </br>";
			?>
		</div>
	</div>

	<!-- Footer -->
	<?php
	echo file_get_contents("defaultFooter.html");
	?>
</body>

</html>














<html>

<head>
	<?php session_start(); ?>
	<title>ACME</title>
	<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
	<link type="text/css" rel="stylesheet" href="css/materialize.min.css"  media="screen,projection"/>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />

</head>

<body>
	<script type="text/javascript" src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
	<script type="text/javascript" src="js/materialize.min.js"></script>

	<nav class="nav-extended red darken-3">
		<div class="nav-wrapper center-align">
			<a href="index.php" class="brand-logo">ACME</a>
			<ul id="nav-mobile" class="right hide-on-med-and-down">
				<?php
				if (isset($_SESSION["logged"])){
					echo '<li><a href="">'.$_SESSION["user"].'</a></li>';
					echo '<li><a href="logout.php">Logout</a></li>';
				}else{
					echo '<li><a href="login.php">Login</a></li>';
				}
				?>

			</ul>
		</div>
	</nav>

	<div class="container">

	</div>

</body>

</html>
