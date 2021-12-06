<?php
require_once 'db_connect.php';
//product model search of product search
//$sql2="SELECT spm.model FROM stockproductmodel spm WHERE spm.model like '%$_GET[productnamesearch]%' LIMIT 7";
$sql2 = "SELECT spm.model
FROM stockproduct sp, stockproductmodel spm
WHERE sp.id=spm.productid AND sp.Productname like '%$_GET[productnamesearch]%'
and spm.model like '%$_GET[modelname]%'
ORDER BY spm.model";
$data1 = mysqli_query($connect, $sql2);
while ($resultmodel = $data1->fetch_assoc()) {
    echo "<ul style='border-radius:5px;background-color : #d1d1d1;
    box-shadow: 1px 3px lightgray, -.1em 0 .4em olive;'>$resultmodel[model]</ul>";
}
