<?php
require_once 'db_connect.php';
//product search
$sql2="SELECT sp.Productname as productname FROM stockproduct sp where sp.Productname like '%$_GET[productnamesearch]%' limit 5";
$data1=mysqli_query($connect,$sql2);
while($resultproduct=$data1->fetch_assoc()){
    echo "<li style='background:#b0beb9;'>$resultproduct[productname]</li>";
}
?>