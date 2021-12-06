<?php
session_start();
if(!isset($_SESSION["sess_user"])){
 header("Location: login.php");
}
else
{
?>
<?php
require_once 'db_connect.php';
$output = array('success' => false, 'messages' => array());
$serialno = $_POST['serialno'];
$sql  ="UPDATE acknowledgetab SET state ='deleted' WHERE serialno={$serialno}";
$query = $connect->query($sql);
//$mysqli_commit($connect);    
if($query=== TRUE) 
{
    $output['success'] = true;
    $output['messages'] = 'Successfully Data Deleted and stored to DB trash';
} else
{
    $output['success'] = false;
    $output['messages'] = 'Error while removing Acknowledge data'; 
}

$connect->close();

echo json_encode($output);

}
?>
