<?php
require_once 'db_connect.php';
$sql1 = "SELECT CONCAT(ci.unameeng,' - ',ci.Depteng,'  |  ',ci.paymentcode) namepaycode  FROM CashVoucher_Info ci WHERE ci.unameeng like '%$_GET[search]%' or ci.Depteng like '%$_GET[search]%' LIMIT 7";
//$query1=mysqli_query($connect,$sql1);
$data = mysqli_query($connect, $sql1);
while ($result = $data->fetch_assoc()) {
    echo "<ol style='border-radius:5px;background-color : whitesmoke;
    box-shadow: .5px 1px lightgray, -.1em 0 .2em olive;'>
    $result[namepaycode]</ol>";
}
