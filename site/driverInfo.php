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

		<?php
		$result = mysqli_query($conn,"SELECT * FROM drivers WHERE id = $_GET[id]");

		if (mysqli_num_rows($result) == 0){
			echo "Driver not found";
		}else{
			$row = mysqli_fetch_assoc($result);

			echo "<b>Name:</b> $row[name]<br />";
			echo "<b>Surname:</b> $row[surname]<br />";
		}
		?>

	</div>

	<!-- Footer -->
	<?php
	echo file_get_contents("defaultFooter.html");
	?>
</body>

</html>
