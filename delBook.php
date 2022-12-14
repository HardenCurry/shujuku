<!DOCTYPE html>
<html>

<head>
</head>

<body>
    <?php
    include('常用的.php');
    $bid = $_GET['bid'];
    $sql = "SELECT bid FROM book WHERE bid=" . $bid . "";
    $result = executeSql($sql);
    if ($result[0] & mysqli_num_rows($result[1]) == 0) {
        // echo "<script>alert('不存在的cid：'.$cid.')</script>";
        // header("Refresh:1; url=" . $manage_customer);
        echo "不存在的bid：'.$bid.'";
        echo "<a href=" . $search_book . "></a>";
    } else {
        $sql = "DELETE FROM book WHERE bid=" . $bid . "";
        $result = mysqli_query($conn, $sql);
        if (!$result) {
            echo "失败删除书籍";
            echo "<a href=" . $search_book . "></a>";
        } else {
            echo "成功删除书籍";
            echo "<a href=" . $search_book . "></a>";
        }
        echo "<br>";
        echo "<a href=" . $search_book . ">返回</a>";
    }
    ?>
</body>

</html>