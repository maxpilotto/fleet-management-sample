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
            $result = mysqli_query($conn,"SELECT * FROM trucks where id = $_GET[id]");

			if ($_SESSION["company"] == -1){
				header("Location: pageNotFound.php");
				return;
			}

            if (mysqli_num_rows($result) == 0){
                echo "Truck not found!";
            }else{
			    $row = mysqli_fetch_assoc($result);

				if ($row["company"] != $_SESSION["company"]){
					header("Location: pageNotFound.php");
					return;
				}

                echo "<b>Brand:</b> $row[brand] <br />";
                echo "<b>Model:</b> $row[model] <br />";
                echo "<b>Container size:</b> $row[containerSize] <br />";
                echo "<b>License plate:</b> $row[licensePlate] <br />";
            }
        ?>
	</div>

	<!-- Footer -->
	<?php 
		echo file_get_contents("defaultFooter.html");
	?>
</body>

</html>
