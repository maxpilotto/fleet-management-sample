<html>

<?php
session_start();
echo file_get_contents("defaultHead.html");
include_once("connection.php");
?>

<body>
	<!-- Header -->
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
							if (isset($_SESSION["logged"])){
								header("Location: index.php");
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

	<!-- Content -->
	<div id="content-wrapper" class="mui--text-center">
		<div class="mui--appbar-height"></div>
		<br/>
		<br/>
		<br/>
		<div class="mui-container">
			<h2>Please fill the following form with the informations of your company, <br/> we'll elaborate your request in a couple of days</h2>
			<br/>
			<br/>
			<div class="mui-panel">
				<form class="mui-form" method="post" action="#">
					<div class="mui-textfield">
						<input type="text" name="name" placeholder="Your company name" required>
					</div>
					<div class="mui-textfield">
						<textarea name="html"  placeholder="Main page (html only)" required></textarea>
					</div>
					<div class="mui-textfield">
						<input type="text" name="piva" placeholder="VAT Number" required>
					</div>
					<div class="mui-textfield">
						<input type="text" name="city" placeholder="Your company city" required>
					</div>
					<div class="mui-textfield">
						<input type="text" name="category" placeholder="Your company main occupation" required>
					</div>
					
					<input name="submit" type="submit" class="mui-btn mui-btn--primary"/>
				</form>
				
				<?php 
					if (isset($_POST["submit"])){
						include("connection.php");
						$res = mysqli_query($conn,"INSERT INTO companies VALUES(null,'$_POST[name]','$_POST[html]','$_POST[piva]','$_POST[city]','$_POST[category]',0)");
					}
				?>
			</div>
		</div>
	</div>

	<!-- Footer -->
	<?php
	echo file_get_contents("defaultFooter.html");
	?>
</body>

</html>
