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
            $result = mysqli_query($conn,"SELECT * FROM movements WHERE shipment = $_GET[id] ORDER BY movDate DESC");

            if (mysqli_num_rows($result) == 0){
                echo "<h1><b>No movements found</b></h1>";
            }else{
				echo "
				<table class='mui-table'>
					<thead>
						<tr>
							<th>Date</th>
							<th>Time</th>
							<th>Position</th>
							<th>Speed</th>
							<th>Place</th>
						</tr>
					</thead>
				<tbody>";

                foreach($result as $row){
					$shipment = mysqli_fetch_assoc(mysqli_query($conn,"SELECT * FROM shipments WHERE id = $row[shipment]"));

					echo "<tr>";
					echo "<td>$row[movDate]</td>";
					echo "<td>$row[movTime]</td>";
					echo "<td> <a href='https://maps.google.com/?q=$row[latitude],$row[longitude]'>$row[latitude];$row[longitude]</a> </td>";
					echo "<td>$row[speed]</td>";
					echo "<td>$row[place]</td>";
					echo "</tr>";
				}

				echo "
	                </tbody>
	            </table>";
            }
        ?>

		</div>

	</div>

	<!-- Footer -->
	<?php
		echo file_get_contents("defaultFooter.html");
	?>
</body>

</html>
