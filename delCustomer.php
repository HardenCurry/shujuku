<!DOCTYPE html>
<html>

<head>
</head>

<body>
    <?php
    include('常用的.php');
    $cid = $_GET['cid'];
    $sql = "SELECT cid FROM customer WHERE cid=" . $cid . "";
    $result = executeSql($sql);
    if ($result[0] & mysqli_num_rows($result[1]) == 0) {
        // echo "<script>alert('不存在的cid：'.$cid.')</script>";
        // header("Refresh:1; url=" . $manage_customer);
        echo "不存在的cid：'.$cid.'";
        echo "<a href=" . $manage_customer . "></a>";
    } else {
        $sql = "DELETE FROM customer WHERE cid=" . $cid . "";
        $result = mysqli_query($conn, $sql);
        if (!$result) {
            echo "失败删除顾客";
            echo "<a href=" . $manage_customer . "></a>";
        } else {
            echo "成功删除顾客";
            echo "<a href=" . $manage_customer . "></a>";
        }
        echo "<br>";
        echo "<a href=" . $manage_customer . ">返回</a>";
    }
    ?>
</body>

</html>