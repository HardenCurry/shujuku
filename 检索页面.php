<!DOCTYPE html>
<html lang="en">
<!-- 要改 title,form-action,功能 -->

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>检索页面</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css"
        integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="网购模板.css" rel="stylesheet">
</head>
<!-- 检索页面与检索结果html一样 -->
<?php session_start();
$character = $_SESSION['charactor'];
if ($character == "worker") {
  $wname = $_SESSION['wname'];
  echo "<h2>管理书籍</h2>";
} else {
  $cname = $_SESSION['cname'];
  echo "<h2>欢迎" . $cname . "进入书店!</h2>";
}
?>

<body>
    <?php
  include("常用的.php");
  templete($character);
  ?>
    <form action='检索结果.php' method='get' class='search-box'>
        <select name="search_type" class='search-type'>
            <option value="bname">书名</option>
            <option value="aname">作者</option>
            <option value="ISBN">ISBN</option>
        </select>
        <input class='search-txt' type="text" name='search' size='20' required=required placeholder="请输入" />
        <button class='search-btn' type="submit"><i class="fas fa-search"></i></button>
    </form>
    </form>
    <table border="1" align="center" width='100%'>
        <tr>
            <th align="center" width="15%">图片</th>
            <th align="center" width="15%">书名</th>
            <th align="center" width="15%">作者</th>
            <th align="center" width="10%">出版时期</th>
            <th align="center" width="10%">页数</th>
            <th align="center" width="10%">价格</th>
            <th align="center" width="10%">库存</th>
            <th align="center" width="15%">功能</th>
        </tr>

        <?php
    $servername = "localhost";
    $username = 'root';
    $password = '';
    $dbname = 'bshop';

    $conn = mysqli_connect($servername, $username, $password, $dbname);
    mysqli_query($conn, 'set names utf8');
    if (mysqli_connect_errno()) {
      echo "Failed to connect to MySQL:" . mysqli_connect_error();
    }
    $sql = "SELECT * FROM book";
    $result = mysqli_query($conn, $sql);
    //如果数据库里没有数据时？
    if (!$result) {
      die('No Data in Book tables');
    }
    $num_rows = mysqli_num_rows($result);
    echo '书的个数：' . $num_rows;

    while ($row = mysqli_fetch_assoc($result)) {
      $bname = $row['bname'];
      $bid = $row['bid'];
      $bamount = $row['bamount'];
      $bpicture = $row['bpicture'];
      $bprice = $row['bprice'];
      $bpage = $row['bpage'];
      $bpubdate = $row['bpubdate'];
      $anamearr = array();
      $ct = 0;

      $select_sql = "SELECT aid FROM bauni WHERE bid=" . $bid . ";"; //用bid搜索bauni（链接表）的aid

      $select_result = mysqli_query($conn, $select_sql);

      while ($select_rows = mysqli_fetch_assoc($select_result)) {
        $select_sql2 = "SELECT aname FROM author WHERE aid=" . $select_rows['aid'] . ";"; //用aid搜索author表的aname        
        $select_result2 = mysqli_query($conn, $select_sql2);
        if (!$select_result2) {
          die("Failed to query '" . $select_sql2 . "'");
        }
        while ($select_rows2 = mysqli_fetch_assoc($select_result2)) {
          $anamearr[$ct] = $select_rows2['aname'];
          $ct++;
        }
        $aname = implode(",", $anamearr);
      }
      echo "<tr>";
      echo '<td><img style="display:block;margin-left:auto;margin-right:auto;"src="data:image/jpeg;base64,' . base64_encode($bpicture) . '"text-align="center" alt="Not ready" height="200px"/></td>';
      echo "<td align='center'>" . $bname . "</td>";
      echo "<td align='center'>" . $aname . "</td>";
      echo "<td align='center'>" . $bpubdate . "年</td>";
      echo "<td align='center'>" . $bpage . "页</td>";
      echo "<td align='center'>" . $bprice . "元</td>";
      echo "<td align='center'>" . $bamount . "本</td>";
      echo "<td align='center'>";
      if ($character == "worker") {
        echo "<a href='bookinfo.php?bid=" . $bid . "'>修改书籍";
        echo "<br>";
        echo "<a href='delbook.php?bid=" . $bid . "'>删除书籍";
      } else {
        echo "<a href='bookinfo.php?bid=" . $bid . "'>书籍页面";
        echo "<br>";
        if ($bamount >= 1) {
          echo "<a href='process_shopCart.php?bid=" . $bid . "'>加入购物车";
        }
      }
      echo "</td>";
      echo "</tr>";
    }
    mysqli_close($conn);
    ?>
    </table>
</body>

</html>