<?php
include 'db_connect.php';
//if(isset($_POST['salcode'])||isset($_POST['productnamesearch'])||isset($_POST['Model'])||isset($_POST['sunit']))
//if(isset($_POST['saveacknowlwgementdata']))
if (isset($_POST['search'])) {
	//$userid=mysqli_real_escape_string($connect,$_POST['salcode']);
	$uname = mysqli_real_escape_string($connect, $_POST['search']);
	$salcode =trim(substr($uname,strpos($uname,"|")+1)); 
	$userid = $salcode;
	$cashVouchertype = mysqli_real_escape_string($connect, $_POST['cashVouchertype']);
	$cashdesc1 = mysqli_real_escape_string($connect, $_POST['cashdesc1']);
	$cashdesc2 = mysqli_real_escape_string($connect, $_POST['cashdesc2']);
	$cashamount1 = mysqli_real_escape_string($connect, $_POST['cashamount1']);
	$cashamount2 = mysqli_real_escape_string($connect, $_POST['cashamount2']);

	//mysqli_real_escape_string($connect,$_POST['entryuser']);
	$sql = "INSERT INTO cashvoucher_tab(cashvouchertype,desc1,desc2,amount1,amount2,usererid,entrydate)
		VALUES('$cashVouchertype','$cashdesc1','$cashdesc2','$cashamount1','$cashamount2','$userid',now())";
	if (mysqli_query($connect, $sql)) {
		//  $validator['success']=true;
		//  $validator['messages']="Successfully Data Inserted";
		echo "OK";
		// header("Location: acknowledgment2.php");
	} else {
		//  $validator['success']=false;
		//  $validator['messages']="No Data Inserted";
		echo "NOT OK";
	}
}
mysqli_close($connect);
//echo json_encode($validator);
