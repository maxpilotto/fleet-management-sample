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

        if (isset($_GET["id"])){
            $result = mysqli_query($conn,"SELECT * FROM drivers WHERE id = $_GET[id]");

            if (mysqli_num_rows($result) == 0){
    			echo "Driver not found";
    		}else{
    			$row = mysqli_fetch_assoc($result);

    			echo "<b>Name:</b> $row[name]<br />";
    			echo "<b>Surname:</b> $row[surname]<br />";
    		}
        }else{
		    $result = mysqli_query($conn,"SELECT * FROM drivers WHERE company = $_SESSION[company]");

            if (mysqli_num_rows($result) == 0){
    			echo "No drivers found";
    		}else{
    			$row = mysqli_fetch_assoc($result);

                echo "
                <table class='mui-table'>
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Surname</th>
                            <th>Shipments to do</th>
                        </tr>
                    </thead>
                <tbody>";

                foreach($result as $row){
					$shipments = mysqli_query($conn,"SELECT * FROM shipments WHERE driver = $row[id]");
					$toDo = 0;

					foreach($shipments as $shipment){
						if ($shipment["status"] == '2' or $shipment["status"] == 4){
							$toDo++;
						}
					}

                    echo "<tr>";
                    echo "<td>$row[name]</td>";
                    echo "<td>$row[surname]</td>";
                    echo "<td>$toDo</td>";
                    echo "</tr>";
                }

                echo "
                    </tbody>
                </table>";
    		}
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
