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
			if ($_SESSION["company"] == -1){
				header("Location: pageNotFound.php");
				return;
			}

            if (isset($_GET["id"])){
				$trucks = mysqli_query($conn,"SELECT * FROM trucks WHERE id = $_GET[id]");

				if (mysqli_num_rows($trucks) == 0){
	                echo "<h1><b>Truck not found found</b></h1>";
					return;
				}

				$truck = mysqli_fetch_assoc($trucks);

				if ($_SESSION["company"] != $truck["company"]){
					header("Location: pageNotFound.php");
				}

                echo '
				<div class="mui-container">
    			<table class="mui-table">
        			<thead>
        				<tr>
            				<th>Brand</th>
            				<th>Model</th>
            				<th>Container size</th>
            				<th>License plate</th>
        				</tr>
        			</thead>
        			<tbody>';

					echo "<tr>
                        <td>$truck[brand]</td>
                        <td>$truck[model]</td>
                        <td>$truck[containerSize]</td>
                        <td>$truck[licensePlate]</td>
                    </tr>";

					echo "</tbody>
	                </table>
					</div>";

            }else{
                $trucks = mysqli_query($conn,"SELECT * FROM trucks WHERE company = $_SESSION[company]");

                echo '
				<div class="mui-container">
    			<table class="mui-table">
        			<thead>
        				<tr>
            				<th>Brand</th>
            				<th>Model</th>
            				<th>Container size</th>
            				<th>License plate</th>
                            <th>Shipments to do</th>
                            <th>Last seen</th>
        				</tr>
        			</thead>
        			<tbody>';


                foreach ($trucks as $truck){
                    $shipments = mysqli_query($conn,"SELECT * FROM shipments WHERE truck = $truck[id]");
                    $toDo = 0;
					$currentShipment = -1;
                    $lastSeen = 'Warehouse';

    				foreach($shipments as $shipment){
    					if ($shipment["status"] == '2' or $shipment["status"] == '4'){
							if ($shipment["status"] == '2' and $currentShipment == -1){
								$currentShipment = $shipment["id"];
							}
    						$toDo++;
    					}
    				}

                    if ($currentShipment != -1){
                        $lastMovement = mysqli_fetch_assoc(mysqli_query($conn,"SELECT * FROM movements WHERE shipment = $currentShipment ORDER BY movDate DESC"));
						$lastSeen = $lastMovement["place"];
                    }

                    echo "<tr>
                        <td>$truck[brand]</td>
                        <td>$truck[model]</td>
                        <td>$truck[containerSize]</td>
                        <td>$truck[licensePlate]</td>
                        <td>$toDo</td>
                        <td>$lastSeen</td>
                    </tr>";
                }

                echo "</tbody>
                </table>
				</div>";
            }
        ?>
	</div>

	<!-- Footer -->
	<?php
		echo file_get_contents("defaultFooter.html");
	?>
</body>

</html>
