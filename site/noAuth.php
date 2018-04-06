<html>

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>ACSE</title>
	<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/animate.css/3.5.2/animate.min.css">
	<link rel="stylesheet" href="//cdn.muicss.com/mui-0.9.39-rc1/extra/mui-colors.min.css">
	<script src="//cdn.muicss.com/mui-0.9.39-rc1/extra/mui-combined.min.js"></script>
	<style>
	html,
	body {
		height: 100%;
	}

	html,
	body,
	input,
	textarea,
	buttons {
		-webkit-font-smoothing: antialiased;
		-moz-osx-font-smoothing: grayscale;
		text-shadow: 1px 1px 1px rgba(0, 0, 0, 0.004);
	}

	header {
		position: fixed;
		top: 0;
		right: 0;
		left: 0;
		z-index: 2;
	}

	header ul.mui-list--inline {
		margin-bottom: 0;
	}

	header a {
		color: #fff;
	}

	header table {
		width: 100%;
	}

	#content-wrapper {
		min-height: 100%;

		/* sticky footer */
		box-sizing: border-box;
		margin-bottom: -100px;
		padding-bottom: 100px;
	}

	footer {
		box-sizing: border-box;
		height: 100px;
		background-color: #eee;
		border-top: 1px solid #e0e0e0;
		padding-top: 35px;
	}
	</style>
</head>

<body>
	<!-- Header -->
	<header class="mui-appbar mui--z1">
		<div class="mui-container">
			<table>
				<tr class="mui--appbar-height">
					<td class="mui--text-title">ACSE</td>
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
            },5000);
        </script>
	</div>

	<!-- Footer -->
	<footer>
		<div class="mui-container mui--text-center">
			Made by <a href="https://www.github.com/maxpilotto">maxpilotto</a> with <a href="https://www.muicss.com">MUICSS</a>
		</div>
	</footer>

	<script src="//cdnjs.cloudflare.com/ajax/libs/wow/1.1.2/wow.min.js"></script>
	<script>
	new WOW().init();
	</script>
</body>

</html>
