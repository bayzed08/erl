<?php
require_once 'db_connect.php';
if($_POST['username2'])
{
    $uname=$_POST['username2'];
    $oldpassword=$_POST['oldpassword'];
    $npasswd=$_POST['npassword'];
    $rnpasswd=$_POST['npassword2'];
    
    if(!empty($uname))
    {
      //echo " username ".$uname; 
        $sql="select count(*) count22,aa.password  from usertab aa where aa.username='$uname'";
        $result=mysqli_query($connect,$sql);
        $row=mysqli_fetch_array($result);
        if($row['count22']>0)
        {
            if($row['password']==$oldpassword && $npasswd==$rnpasswd)
            {
                
                $sql2="update usertab aa set aa.password='$npasswd' where aa.username='$uname'";
                $result2=mysqli_query($connect,$sql2);
                echo "Change password successfully";
                
            }
            else
            {
                echo "Running password is not correct or new password missmatch";   
            }
        }
        else
        {
            echo "No Valid User found here ";
        }
    }
    else 
    {
        echo "username is empty";
    }
   
    
}
else
{
   echo "nothing"   ; 
}
    
?>