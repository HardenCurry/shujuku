<!DOCTYPE html>
<html>

<head>
</head>

<body>
    <?php
  session_start();
  $bid = $_GET['bid'];
  $_SESSION['newbid'] = $bid;

  ?>
    <form action="editbook.php" method="get" name="form1">

        <table border="0" align="left" cellpadding="1" cellspacing="0">
            <tr>
                <h2>修改图书信息</h2>
            </tr>
            <tr>
                <td>ISBN：</td>
                <td>
                    <input type="text" name="ISBN" size="50">
                </td>
            </tr>
            <tr>
                <td>书名：</td>
                <td>
                    <input type="text" name="name" size="50">
                </td>
            </tr>
            <tr>
                <td>出版时间：</td>
                <td>
                    <input type="text" name="pubdate" size="11">
                </td>
            </tr>
            <tr>
                <td>库存：</td>
                <td>
                    <input type="text" name="amount" size="11">
                </td>
            </tr>
            <tr>
                <td>价格：</td>
                <td>
                    <input type="text" name="price" size="11">
                </td>
            </tr>
            <tr>
                <td>页数：</td>
                <td>
                    <input type="text" name="page" size="11">
                </td>
            </tr>
            <tr>
                <td>语种：</td>
                <td>
                    <input type="text" name="language" size="50">
                </td>
            </tr>
            <tr>
                <td>类型：</td>
                <td>
                    <input type="text" name="type" size="50">
                </td>
            </tr>
            <tr>
                <td>简介：</td>
                <td>
                    <input type="text" name="summary" size="90">
                </td>
            </tr>
        </table>
        <input name="submit" type="submit" value="确认修改">
    </form>
</body>

</html>