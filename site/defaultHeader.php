<!--
This is the default header and it is included in all pages but the index
-->
<header class="mui-appbar mui--z1">
	<div class="mui-container">
		<table>
			<tr class="mui--appbar-height">
				<?php
				if (isset($_SESSION["logged"])){
					if ($_SESSION["userType"] == 'm'){
						echo "<td class='mui--text-title'>ACME Dashboard</td>";
					}else{
						echo "<td class='mui--text-title'>$_SESSION[companyName]</td>";
					}
				}else{
					echo "<td class='mui--text-title'>ACME</td>";
				}
				?>
				<td class="mui--text-right">
					<ul class="mui-list--inline mui--text-body2">
						<?php
						//TODO check if the company is active or not
						if (isset($_SESSION["logged"])){
							if ($_SESSION["userType"] == 'm'){
								echo '<li><a href="companies.php">Companies</a></li>';
							}else if ($_SESSION["userType"] == 'a'){
								echo '<li><a href="accounts.php">Accounts</a></li>';
							}

							echo '<li><a href="trucks.php">Trucks</a></li>';
							echo '<li><a href="drivers.php">Drivers</a></li>';
							echo '<li><a href="shipments.php">Shipments</a></li>';
							echo '<li><a href="issues.php">Issues</a></li>';
							echo '<li><a href="logout.php"><i class="fa" aria-hidden="true"></i> Logout</a></li>';
						}else{
							echo '<li><a href="loginForm.php"><i class="fa" aria-hidden="true"></i> Login</a></li>';
						}
						?>
					</ul>
				</td>
			</tr>
		</table>
	</div>
</header>
