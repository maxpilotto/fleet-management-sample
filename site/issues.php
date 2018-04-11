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
			if ($_SESSION["company"] == -1){
				header("Location: pageNotFound.php");
				return;
			}
			
			if (isset($_GET["id"])){
				$result = mysqli_query($conn,"SELECT * FROM issues WHERE shipment = $_GET[id]");
				$ship = mysqli_fetch_assoc(mysqli_query($conn,"SELECT * FROM shipments WHERE id = $_GET[id]"));


				if ($ship["company"] != $_SESSION["company"]){
					header("Location: pageNotFound.php");
					return;
				}
			}else{
				$result = mysqli_query($conn,"SELECT * FROM issues i,shipments s WHERE i.shipment = s.id AND s.company = $_SESSION[company]");
			}

			if (mysqli_num_rows($result) == 0){
				echo "<h1><b>No issues found</b></h1>";
				return;
			}

			echo '
				<table class="mui-table">
				<thead>
				<tr>
				<th>Title</th>
				<th>Code</th>
				<th>Shipment</th>
				<th>Status</th>
				</tr>
				</thead>
				<tbody>';

			foreach ($result as $row){
				$shipment = mysqli_fetch_assoc(mysqli_query($conn,"SELECT * FROM shipments WHERE id = $row[shipment]"));

				echo "<tr>";
				echo "<td><a href='issueDetails.php?id=$row[id]'>$row[title]</a></td>";
				echo "<td>$row[code]</td>";
				echo "<td>$shipment[destination]</td>";
				echo "<td>$row[status]</td>";
				echo "</tr>";
			}
			?>

		</tbody>
	</table>
</div>

</div>

<!-- Footer -->
<?php
echo file_get_contents("defaultFooter.html");
?>
</body>

</html>
