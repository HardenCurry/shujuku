<!DOCTYPE html>
<html>

<body>
    <?php
	session_start();
	$servername = "localhost";
	$username = "root";
	$password = "";
	$dbname = "bshop";

	$conn = mysqli_connect($servername, $username, $password, $dbname);
	mysqli_query($conn, 'set names utf8');
	if (mysqli_connect_errno()) {
		echo "Failed to connect to MySQL: " . mysqli_connect_error();
	}

	$userName = $_POST["username"];
	$pwd = $_POST["psw"];
	$selected_character = $_POST["character"];


	if ($userName == "" || $pwd == "") {
		echo "None of the value can be empty!";
		echo "<br>";
	}

	//判断店员登入
	if ($selected_character == "admin") {
		$wsql = "SELECT wid,wname FROM worker WHERE wname ='$userName' and wpassword='$pwd' ;";
		$wquery_result = mysqli_query($conn, $wsql);
		$arow = mysqli_fetch_assoc($wquery_result);

		if (!empty($arow)) {
			$_SESSION['character'] = 'worker';
			$_SESSION['wid'] = $arow["wid"];
			$_SESSION['wname'] = $arow["wname"];
			header('Location:检索页面.php');
		} else {
			echo "Error! Something wrong in your username or password!";
			echo "<br>";
		}
	}	//判断顾客登入
	else {
		if ($selected_character == "user") {
			$sql = "SELECT * FROM customer WHERE caccount= '$userName' and cpassword = '$pwd' ;";
			$query_result = mysqli_query($conn, $sql);
			$row = mysqli_fetch_assoc($query_result);
			if (!empty($row)) {
				$_SESSION['character'] = 'customer';
				$_SESSION['cid'] = $row["cid"];
				$_SESSION['phone'] = $row["cphone"];
				$_SESSION['address'] = $row["caddress"];
				$_SESSION['cname'] = $row["cname"];
				header('Location:检索页面.php');
			} else {
				echo "Error! Something wrong in your username or password!";
				echo "<br>";
			}
		}
	}
	?>
</body>

</html>