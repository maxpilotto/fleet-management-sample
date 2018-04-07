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
            $result = mysqli_query($conn,"SELECT * FROM movements WHERE shipment = $_GET[id] ORDER BY movDate DESC");

            if (mysqli_num_rows($result) == 0){
                echo "No movements found";
            }else{
                foreach($result as $row){
					echo "Movement #".$row["id"];
					echo "<br/>";
				}
            }
        ?>

	</div>
	
	<!-- Footer -->
	<?php 
		echo file_get_contents("defaultFooter.html");
	?>
</body>

</html>
