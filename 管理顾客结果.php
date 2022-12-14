<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>管理顾客结果</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <link href="网购模板.css" rel="stylesheet">
</head>
<?php session_start();
$character = $_SESSION['character'];
$wname = $_SESSION['wname'];
include("常用的.php");
templete($character);
echo "<h2>管理顾客</h2>";

?>

<body>
  <form action='管理顾客结果.php' method='get' class='search-box'>
    <select name="search_type" class='search-type'>
      <option value="cid">编号</option>
      <option value="caccount">账号</option>
      <option value="cname">名字</option>
    </select>
    <input class='search-txt' type="text" name='search' size='20' required=required placeholder="请输入" />
    <button class='search-btn' type="submit"><i class="fas fa-search"></i></button>
  </form>
  </form>
  <table border="1" align="center" width='100%'>
    <tr>
      <th align="center" width="5%">编号</th>
      <th align="center" width="15%">账号</th>
      <th align="center" width="15%">名字</th>
      <th align="center" width="10%">性别</th>
      <th align="center" width="20%">手机号</th>
      <th align="center" width="25%">地址</th>
      <th align="center" width="10%">功能</th>
    </tr>

    <?php
    $type = $_GET['search_type'];
    $search = trim($_GET['search']);

    $server = 'localhost';
    $username = 'root';
    $pw = '';
    $db = 'bshop';

    $conn = mysqli_connect($server, $username, $pw, $db);
    mysqli_query($conn, 'set names utf8'); //处理中文乱码
    if (mysqli_connect_errno()) {
      echo "Failed to connect to MySQL:" . mysqli_connect_error();
    }
    function query($sql)
    {
      global $conn;
      $result = mysqli_query($conn, $sql);
      if (!$result) {
        die("Failed to query '" . $sql . "'");
      }
      return $result;
    }

    function template($result)
    {
      global $delete_customer;
      while ($row = mysqli_fetch_assoc($result)) {
        $cid = $row['cid'];
        $caccount = $row['caccount'];
        $cname = $row['cname'];
        $csex = $row['csex'];
        $cphone = $row['cphone'];
        $caddress = $row['caddress'];

        echo "<tr>";
        echo "<td align='center'>" . $cid . "</td>";
        echo "<td align='center'>" . $caccount . "</td>";
        echo "<td align='center'>" . $cname . "</td>";
        echo "<td align='center'>" . $csex . "</td>";
        echo "<td align='center'>" . $cphone . "</td>";
        echo "<td align='center'>" . $caddress . "</td>";
        echo "<td align='center'>";
        echo "<a href='" . $delete_customer . "?cid=" . $cid . "'>删除顾客";
        echo "</td>";
        echo "</tr>";
      }
    }
    echo '‘' . $type . '’为‘' . $search . '’的搜索结果'; //字大一点，加粗
    if ($type == 'cid') {
      $sql = "SELECT * FROM customer WHERE cid = " . $search . ";";
      template(query($sql));
    } else if ($type == 'caccount') {
      $sql = "SELECT * FROM customer WHERE caccount like '" . $search . "%';";
      template(query($sql));
    } else if ($type == 'cname') {
      $sql = "SELECT * FROM customer WHERE cname like '" . $search . "%';";
      template(query($sql));
    } else {
      die("TYPE ERROR!");
    }
    mysqli_close($conn);
    ?>