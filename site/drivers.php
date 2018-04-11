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

			if ($_SESSION["company"] == -1){
				header("Location: pageNotFound.php");
				return;
			}

            if (mysqli_num_rows($result) == 0){
                echo "<h1><b>Driver not found</b></h1>";
    		}else{
    			$row = mysqli_fetch_assoc($result);

				if ($row["company"] != $_SESSION["company"]){
					header("Location: pageNotFound.php");
					return;
				}

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

				$shipments = mysqli_query($conn,"SELECT * FROM shipments WHERE driver = $row[id]");
				$toDo = 0;

				foreach($shipments as $shipment){
					if ($shipment["status"] == '2' or $shipment["status"] == '4'){
						$toDo++;
					}
				}

				echo "<tr>";
				echo "<td>$row[name]</td>";
				echo "<td>$row[surname]</td>";
				echo "<td>$toDo</td>";
				echo "</tr>";

                echo "
                    </tbody>
                </table>";
    		}
        }else{
		    $result = mysqli_query($conn,"SELECT * FROM drivers WHERE company = $_SESSION[company]");

            if (mysqli_num_rows($result) == 0){
                echo "<h1><b>No drivers found</b></h1>";
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
