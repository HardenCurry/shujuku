<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>书籍页面</title>
    <link href="网购模板.css" rel="stylesheet">
</head>

<?php
session_start();
$character = $_SESSION['character'];
if ($character == "worker") {
  $wname = $_SESSION['wname'];
  echo "<h2>欢迎" . $wname . "进入书店!</h2>";
} else {
  $cname = $_SESSION['cname'];
  echo "<h2>欢迎" . $cname . "进入书店!</h2>";
}

$bid=$_GET['bid'];
echo "<h2>书籍" . $bid . "</h2>";
?>


<body>

    <?php
  include("常用的.php");
  templete($character);
  ?>

    <a align='center' href='<?php echo "检索页面.php"; ?>' style="position:absolute; top:80px; left:95px;">返回
    </a>


    <table border="1" align="center" width='100%'>
        <tr>
            <th align="center" width="5%">ID</th>
            <th align="center" width="10%">ISBN</th>
            <th align="center" width="10%">书名</th>
            <th align="center" width="10%">出版时间</th>
            <th align="center" width="5%">库存</th>
            <th align="center" width="5%">价格</th>
            <th align="center" width="5%">页数</th>
            <th align="center" width="5%">语种</th>
            <th align="center" width="5%">类型</th>
            <th align="center" width="15%">简介</th>
            <th align="center" width="15%">书籍图片</th>
            <th align="center" width="15%">功能</th>
        </tr>

        <?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "bshop";

      $conn = mysqli_connect($servername, $username, $password, $dbname);
      mysqli_query($conn, 'set names utf8');
      if (mysqli_connect_errno()) {
        echo "Failed to connect to MySQL:" . mysqli_connect_error();
      }
    
      $sql = "SELECT * FROM book where bid='$bid';";
      $result = mysqli_query($conn, $sql);
      if (!$result) {
        die('No Data in Book tables');
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
        global $character;
        while ($row = mysqli_fetch_assoc($result)) {
          $bid = $row['bid'];
          $bISBN = $row['bISBN'];
          $bname = $row['bname'];
          $bpubdate = $row['bpubdate'];
          $bamount = $row['bamount'];
          $bprice = $row['bprice'];
          $bpage = $row['bpage'];
          $blanguage = $row['blanguage'];
          $btype = $row['btype'];
          $bsummary = $row['bsummary'];
          $bpicture = $row['bpicture'];

          echo "<tr>";
          echo "<td align='center'>" . $bid . "</td>";
          echo "<td align='center'>" . $bISBN . "</td>";
          echo "<td align='center'>" . $bname . "</td>";
          echo "<td align='center'>" . $bpubdate . "年</td>";
          echo "<td align='center'>" . $bamount . "本</td>";
          echo "<td align='center'>" . $bprice . "元</td>";
          echo "<td align='center'>" . $bpage . "页</td>";
          echo "<td align='center'>" . $blanguage . "</td>";
          echo "<td align='center'>" . $btype . "</td>";
          echo "<td align='center'>" . $bsummary . "</td>";
          echo '<td><img style="display:block;margin-left:auto;margin-right:auto;"src="data:image/jpeg;base64,' . base64_encode($bpicture) . '"text-align="center" alt="Not ready" height="200px"/></td>';
          echo "<td align='center'>";
      		if ($character == "worker") {
        	echo "<a href='edit.php?bid=" . $bid . "'>修改书籍";
        	echo "<br>";
        	echo "<a href='delbook.php?bid=" . $bid . "'>删除书籍";
      		} else {
        	  if ($bamount >= 1) {
          	  echo "<a href='process_shopCart.php?bid=" . $bid . "'>加入购物车";
        	  }
      		}
          echo "</td>";
          echo "</tr>";
        }
      }
      template(query($sql));

      mysqli_close($conn);
      ?>
    
    </table>
</body>