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
					<td class="mui--text-title">ACME</td>
					<td class="mui--text-right">
						<ul class="mui-list--inline mui--text-body2">
						</ul>
					</td>
				</tr>
			</table>
		</div>
	</header>

	<!-- Content -->
	<div id="content-wrapper" class="mui--text-center">
		<div class="mui--appbar-height"></div>
        <br />
        <br />
        <h1>Waaaaaait a second!! How did you end up here ? Get out NOW!!</h1>
        <script>
            setTimeout(function(){
                document.location.href = "index.php";
            },2500);
        </script>
	</div>
	
	<!-- Footer -->
	<?php 
		echo file_get_contents("defaultFooter.html");
	?>
</body>

</html>
