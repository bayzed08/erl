<?php
require_once 'db_connect.php';
//product search
$sql2 = "SELECT sp.Productname as productname FROM stockproduct sp where sp.Productname like '%$_GET[productnamesearch]%' limit 5";
$data1 = mysqli_query($connect, $sql2);
while ($resultproduct = $data1->fetch_assoc()) {
    echo "<li style='border-radius:3px;background-color : #d1d1d1;
    box-shadow: .8px 2px lightgray, -.1em 0 .4em olive;'>$resultproduct[productname]</li>";
}
