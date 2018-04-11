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

			if ($_SESSION["company"] == -1){
				header("Location: pageNotFound.php");
				return;
			}

			if (mysqli_num_rows($result) == 0){
				echo "<h1><b>Issue not found</b></h1>";
				return;
			}

			$row = mysqli_fetch_assoc($result);
			$shipment = mysqli_fetch_assoc(mysqli_query($conn,"SELECT * FROM shipments WHERE id = $row[shipment]"));

			if ($shipment["company"] != $_SESSION["company"]){
				header("Location: pageNotFound.php");
				return;
			}

			echo "<div class='mui-panel'>
				<h2><b>Title</b></h2>
				$row[title]
			</div>";

			echo "<div class='mui-panel'>
				<h2><b>Description</b></h2>
				$row[description]
			</div>";

			echo "<div class='mui-panel'>
				<h2><b>Other informations</b></h2>
				<b>Code:</b> $row[code] </br>
				<b>Shipment:</b> $shipment[destination] </br>
				<b>Status:</b> $row[status] </br>
					<b>Possbile cause:</b> $row[cause] </br>
			</div>";
			?>
		</div>
	</div>

	<!-- Footer -->
	<?php
	echo file_get_contents("defaultFooter.html");
	?>
</body>

</html>
