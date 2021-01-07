<?php
require_once 'db_connect.php';
//product search
$sql2="SELECT spm.model FROM stockproductmodel spm WHERE spm.model like '%$_GET[modelname]%' LIMIT 7";
$data1=mysqli_query($connect,$sql2);
while($resultmodel=$data1->fetch_assoc()){
    echo "<ul style='background:#b0beb9;'>$resultmodel[model]</ul>";
}
?>