<?php session_start(); ?>
<!DOCTYPE html>
<html>

<head>
</head>

<body>
    <?php
  $oid = $_GET['oid'];
  $wy = $_SESSION['wy'];
  $servername = "localhost";
  $username = "root";
  $password = "";
  $dbname = "bshop";

  $conn = mysqli_connect($servername, $username, $password, $dbname);
  mysqli_query($conn, 'set names utf8');
  if (mysqli_connect_errno()) {
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }

  $select_sql = "select ostatus from orders where oid='$oid'";
  $select_result = mysqli_query($conn, $select_sql);
  $ostatus = mysqli_fetch_assoc($select_result)['ostatus'];
  if ($ostatus == '未发货') {
    $sql = "UPDATE orders
    SET ostatus='已发货'
    WHERE oid='$oid';";
    $result = mysqli_query($conn, $sql);
    echo "发货成功";
    echo "<a align='center' href='订单管理.php'>返回</a>";
  } else if ($ostatus == '已发货') {
    echo "已发货的订单";
    echo "<a align='center' href='订单管理.php'>返回</a>";
  } else {
    echo "发货状态有问题";
    echo "<a align='center' href='订单管理.php'>返回</a>";
  }

  ?>
</body>

</html>