<?php
// 地址
$login = 'login.php';
$sign = 'sign.php';
$manage_customer = '管理顾客.php';
$search_book = '检索页面.php';
$delete_customer = 'delCustomer.php';
$delete_book = 'delBook.php';
// sql
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "bshop";

$conn = mysqli_connect($servername, $username, $password, $dbname);
mysqli_query($conn, 'set names utf8');
function executeSql($sql)
{
    global $conn;
    $flag = false;
    $feedback = array();
    if ($sql == "") {
        echo "Error! Sql content is empty!";
    } else {
        mysqli_query($conn, 'set names utf8');
        if (mysqli_connect_errno()) {
            echo "Failed to connect to MySQL: " . mysqli_connect_error();
        }
        $query_result = mysqli_query($conn, $sql);
        if ($query_result) {
            $flag = true;
            $feedback = $query_result;
        }
        return array($flag, $feedback);
    }
}
function templete($character)
{
    if ($character == 'worker') {
        print "
        <div style=' 
                position:absolute;
                top:10px;
                right:380px;'>
            <div>
                <a href='检索页面.php'>首页</a>
            </div>
        </div>
        <div style=' 
                position:absolute;
                top:10px;
                right:320px;'>
            <div>
                <a href='管理员_录书.html'>录书</a>
            </div>
        </div>
        <div style=' 
                position:absolute;
                top:10px;
                right:240px;'>
            <div>
                <a href= '催单列表.php'>催单列表</a>
            </div>
        </div>
        <div style=' 
                position:absolute;
                top:10px;
                right:160px;'>
            <div>
                <a href='订单管理.php'>订单管理</a>
            </div>
        </div> 
        <div style=' 
                position:absolute;
                top:10px;
                right:80px;'>
            <div>
                <a href='管理顾客.php'>用户管理</a>
            </div>
        </div> 
        <div id='logout' style=' 
        position:absolute;
        top:10px;
        right:30px;'>
            <div>
                <a href='login.php'>注销</a>
            </div>
        </div>";
    } else {
        print "
<div style=' 
        position:absolute;
        top:10px;
        right:250px;'>
    <div>
        <a href='检索页面.php'>首页</a>
    </div>
</div>
<div style='        
        position:absolute;
        top:10px;
        right:160px;'>
    <div>
        <a href='orders.php'>我的订单</a>
    </div>
</div>
<div style=' 
        position:absolute;
        top:10px;
        right:90px;'>
    <div>
        <a href='view_shopCart.php'>购物车</a>
    </div>
</div>
<div id='logout' style='       
        position:absolute;
        top:10px;
        right:30px;'>
    <div>
        <a href='login.php'>注销</a>
    </div>
</div>";
    }
}