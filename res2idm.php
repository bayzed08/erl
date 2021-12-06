<?php
require_once 'db_connect.php';
$sql1="SELECT CONCAT(ci.unameeng,' ',ci.Depteng,'-',ci.paymentcode) namepaycode  FROM CashVoucher_Info ci WHERE ci.unameeng like '%$_GET[search]%' or ci.Depteng like '%$_GET[search]%' LIMIT 7";
//$query1=mysqli_query($connect,$sql1);
$data=mysqli_query($connect,$sql1);
while($result=$data->fetch_assoc()){
    echo "<ul style='background:#d4d3f0;'>$result[namepaycode]</ul>";
}
?>