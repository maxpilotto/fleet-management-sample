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
					<td class="mui--text-title">404 Page not found</td>
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
        <img src="img/owk.jpg" />
        <br />
        <h1>This is not the page you are looking for...</h1>
        <script>
            setTimeout(function(){
                document.location.href = "index.php";
            },3000);
        </script>
	</div>

	<!-- Footer -->
	<?php
		echo file_get_contents("defaultFooter.html");
	?>
</body>

</html>
