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
        <div class='mui-container'>
			<?php 
				$query = mysqli_query($conn,"SELECT * FROM companies");
			?>
        </div>

	</div>

	<!-- Footer -->
	<?php
	echo file_get_contents("defaultFooter.html");
	?>
</body>

</html>
