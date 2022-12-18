<?php session_start(); ?>
<!DOCTYPE html>
<html>

<head>
</head>

<body>
    <?php
	$bid = $_SESSION['newbid'];
	$servername = "localhost";
	$username = 'root';
	$password = '';
	$dbname = 'bshop';

	$conn = mysqli_connect($servername, $username, $password, $dbname);
	mysqli_query($conn, 'set names utf8');
	if (mysqli_connect_errno()) {
		echo "Failed to connect to MySQL: " . mysqli_connect_error();
	}

	$ISBN = $_GET["ISBN"];
	$name = $_GET["name"];
	$pubdate = $_GET["pubdate"];
	$amount = $_GET["amount"];
	$price = $_GET["price"];
	$page = $_GET["page"];
	$language = $_GET["language"];
	$type = $_GET["type"];
	$summary = $_GET["summary"];

	if ($bid != "") {
		if ($ISBN != "") {
			$sql = "UPDATE book
		SET bISBN='$ISBN'
    	WHERE bid='$bid'";
			$result = mysqli_query($conn, $sql);
		}
		if ($name != "") {
			$sql = "UPDATE book
		SET bname='$name'
    	WHERE bid='$bid'";
			$result = mysqli_query($conn, $sql);
		}
		if ($pubdate != "") {
			$sql = "UPDATE book
		SET bpubdate='$pubdate'
    	WHERE bid='$bid'";
			$result = mysqli_query($conn, $sql);
		}
		if ($amount != "") {
			$sql = "UPDATE book
		SET bamount='$amount'
    	WHERE bid='$bid'";
			$result = mysqli_query($conn, $sql);
		}
		if ($price != "") {
			$sql = "UPDATE book
		SET bprice='$price'
    	WHERE bid='$bid'";
			$result = mysqli_query($conn, $sql);
		}
		if ($page != "") {
			$sql = "UPDATE book
		SET bpage='$page'
    	WHERE bid='$bid'";
			$result = mysqli_query($conn, $sql);
		}
		if ($language != "") {
			$sql = "UPDATE book
		SET blanguage='$language'
    	WHERE bid='$bid'";
			$result = mysqli_query($conn, $sql);
		}
		if ($type != "") {
			$sql = "UPDATE book
		SET btype='$type'
    	WHERE bid='$bid'";
			$result = mysqli_query($conn, $sql);
		}
		if ($summary != "") {
			$sql = "UPDATE book
		SET bsummary='$summary'
    	WHERE bid='$bid'";
			$result = mysqli_query($conn, $sql);
		}
		echo "修改成功!";
	} else {
		echo "修改失败！";
	}
	echo "<a href='bookinfo.php?bid=" . $bid . "'>返回</a>";
	mysqli_close($conn);
	?>

</body>

</html>