<?php
require_once 'db_connect.php';
$output = array('success' => false, 'messages' => array());
$cashvoucherid = $_POST['cashvoucherid'];
$sql  = "UPDATE cashvoucher_tab SET state ='deleted' WHERE cashvoucherid={$cashvoucherid}";
$query = $connect->query($sql);
//$mysqli_commit($connect);
if ($query === TRUE) {
    $output['success'] = true;
    $output['messages'] = 'Successfully Data Deleted and stored to DB trash';
} else {
    $output['success'] = false;
    $output['messages'] = 'Error while removing Cashvoucher history data';
}

$connect->close();

echo json_encode($output);
