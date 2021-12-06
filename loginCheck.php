<?php
    require_once 'db_connect.php';
		$username = mysqli_real_escape_string($connect,$_POST["username"] );
		$password = mysqli_real_escape_string($connect,$_POST["password"] );
		$sql = "SELECT count(*) FROM usertab WHERE username='$username' AND password='$password'";
	    $res = mysqli_query($connect,$sql);
	    $row = mysqli_fetch_array($res);
	
   		if($row[0]>0){
   		$validator['success']=true;
        $validator['messages']="Login Successfully";
        session_start();
        $_SESSION['sess_user']=$username;
   		}
   		else{
   		$validator['success']=false;
        $validator['messages']="Username or Password mismatched";	
   		}
mysqli_close($connect);
echo json_encode($validator);

?>