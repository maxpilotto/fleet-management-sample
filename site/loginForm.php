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
	?>

    <!-- Content -->
    <div id="content-wrapper" class="mui--text-center">
        <div class="mui--appbar-height"></div>
        <br />
        <br />
        <div class="mui-container">
            <form class="mui-form" method="post" >
                <legend>Please input your sensitive data here</legend>
                <div class="mui-textfield">
                    <input type="text" placeholder="Username" name="user">
                </div>
                <div class="mui-textfield">
                    <input type="password" placeholder="Password" name="passwd">
                </div>
                <button type="submit" name="submit" class="mui-btn mui-btn--raised">Submit</button>
            </form>
        </div>
        <br />
        <br />
        <div id="msg">
        </div>

        <?php
        if (isset($_POST["submit"])){
            $username = $_POST["user"];
            $passwd = $_POST["passwd"];
            $result = mysqli_query($conn,"SELECT * FROM accounts WHERE username = '$username' AND passwd = '$passwd'");

            if (mysqli_num_rows($result) == 0){
                echo "<script>
                document.getElementById('msg').innerHTML = '<p>Wrong username or password!</p>';
                </script>";
            }else{
				$row = mysqli_fetch_assoc($result);
				$type = mysqli_fetch_assoc(mysqli_query($conn,"SELECT * FROM accounts a,accounttypes aa WHERE a.type = aa.id AND a.id = $row[id]"));
				$company = mysqli_fetch_assoc(mysqli_query($conn,"SELECT * FROM companies WHERE id = $row[company]"));
				
                $_SESSION["logged"] = session_id();
                $_SESSION["userId"] = $row["id"];
				$_SESSION["company"] = $row["company"];
				$_SESSION["companyName"] = $company["name"];
				$_SESSION["userType"] = $type["code"];
                $_SESSION["user"] = $username;
				
				header("Location: index.php");
            }
        }
        ?>
    </div>

    <!-- Footer -->
	<?php 
		echo file_get_contents("defaultFooter.html");
	?>
</body>

</html>
