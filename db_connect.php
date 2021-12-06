<?php
/**
 * Created by PhpStorm.
 * User: ERLCDP
 * Date: 8/29/2017
 * Time: 2:29 PM
 */
$servername="localhost";
$username="root";
$password="Erladmin1234";
$dbname = "erl";
//create connection
global $connect;
$connect = new mysqli($servername, $username,$password,$dbname);
//for support unicode
mysqli_select_db($connect,$dbname);
mysqli_query($connect,'SET CHARACTER SET utf8');
mysqli_query($connect,"SET SESSION collation_connection ='utf8_general_ci'");
//check connection
if($connect -> connect_error)
{
    die("connection Fail :".$connect->connect_error);
}else{
    //echo "Successfully connected";
}
?>