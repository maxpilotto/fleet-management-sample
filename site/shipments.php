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
			<?php  //TODO remember to update each second the list
				$result = mysqli_query($conn,"SELECT * FROM shipments WHERE company = $_SESSION[company]");

				if ($_SESSION["company"] == -1){
					header("Location: pageNotFound.php");
					return;
				}

				if (mysqli_num_rows($result) == 0){
					echo "<h1><b>No shipments found</b></h1>";
					return;
				}

				echo "
				<table class='mui-table mui-table--bordered'>
					<thead>
						<tr>
							<th>Truck</th>
							<th>Driver</th>
							<th>Start date</th>
							<th>End date</th>
							<th>Start time</th>
							<th>End time</th>
							<th>Destination</th>
							<th>Last position</th>
							<th>Movements</th>
							<th>Issues</th>
							<th>Completed</th>
							<th>Chat</th>
						</tr>
					</thead>
					<tbody>";

				foreach ($result as $row){
					$driver = mysqli_fetch_assoc(mysqli_query($conn,"SELECT * FROM drivers WHERE id = $row[driver]"));
					$truck = mysqli_fetch_assoc(mysqli_query($conn,"SELECT * FROM trucks WHERE id = $row[truck]"));
					$movements = mysqli_query($conn,"SELECT * FROM movements WHERE shipment = $row[id] ORDER BY movDate DESC");
					$issues = mysqli_query($conn,"SELECT * FROM issues WHERE shipment = $row[id]");
					$lastMovement = mysqli_fetch_assoc($movements);
					$lastPosition = "<a href='https://maps.google.com/?q=$lastMovement[latitude],$lastMovement[longitude]'>$lastMovement[latitude];$lastMovement[longitude]</a>";
					$status = mysqli_fetch_assoc(mysqli_query($conn,"SELECT * FROM shipmentstatuses WHERE id = $row[status]"));

					echo "<tr>";
					echo "<td><a href='trucks.php?id=$truck[id]'>$truck[brand], $truck[model]</a></td>";
					echo "<td><a href='drivers.php?id=$driver[id]'>$driver[name], $driver[surname]</a></td>";
					echo "<td>$row[startDate]</td>";
					echo "<td>$row[endDate]</td>";
					echo "<td>$row[startTime]</td>";
					echo "<td>$row[endTime]</td>";
					echo "<td>$row[destination]</td>";
					echo "<td>".$lastPosition."</td>";
					echo "<td><a href='movements.php?id=$row[id]'>".mysqli_num_rows($movements)."</a></td>";
					echo "<td><a href='issues.php?id=$row[id]'>".mysqli_num_rows($issues)."</a></td>";
					echo "<td>$status[name]</td>";

					if ($row["status"] != "1"){
						echo "<td><a href='chat.php?id=$row[id]'>Open</a></td>";
					}else{
						echo "<td>Closed</td>";
					}

					echo "</tr>";
				}

				echo "</tbody>
            		</table>";
			?>
        </div>
    </div>

    <!-- Footer -->
	<?php
		echo file_get_contents("defaultFooter.html");
	?>
</body>

</html>
