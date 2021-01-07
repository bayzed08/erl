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
if(isset($_POST["serialno"]))
{
   $output = '';
   $serialno=$_POST['serialno'];
   $datee=date("d/m/Y");
   $sql222="SELECT uname,
   CONCAT(ci.designation,'(',ci.Dept,')') designation,
   tt.productname,
   tt.prductdesc,
   tt.supplyqnty
   FROM cashvoucher_info ci,acknowledgetab tt
   WHERE ci.paymentcode=tt.userid
   AND tt.serialno='$serialno'"; 
   $query222=mysqli_query($connect,$sql222);
    $output='<div class="dreport" id="dreport">';
    $output.='<table style="width:760px;">
                <tr><td style="text-align:center;font-weight: bold;font-size:20px;">ইস্টার্ণ রিফাইনারী লিমিটেড</td></tr>
                <tr><td style="text-align:center;">চট্টগ্রাম</td></tr>
                <tr><td style="text-align:center;">সিডিপি উপ-বিভাগ </td></tr>
                <tr><td style="text-align:center;font-weight: bold;font-size:15px;"><u>প্রাপ্তিস্বীকার পত্র </u></td></tr>
              </table>';
   $output.='<div style="text-align:right;padding-right:10px">তারিখঃ &nbsp'.$datee.'</div>';
             while($row222 = $query222->fetch_assoc()):
    $output.='<table style="width:100%;">
              <tr>
               <td style="text-align:centre;width:50%;padding-left:10px;"> গ্রহীতার নামঃ &nbsp' .$row222['uname']. '</td>
                <td style="text-align:right;width:50%;padding-right:10px;">পদবিঃ &nbsp'.$row222['designation'].'</td>
              </tr>
             </table><br>';
    $i=1;
    $output.='<table style="width:760px;">
               <tr style="height:25px;font-size:10px;">
                <th style="width:5%;border:1px solid black;text-align:center;">ক্র নং </th>
                <th style="width:22%;border:1px solid black;text-align:center;">পন্যের নাম </th>
                <th style="width:38%;border:1px solid black;text-align:center;">মডেল/বিবরণ</th>
                <th style="width:10%;border:1px solid black;text-align:center;">চাহিদার পরিমাণ</th>
                <th style="width:12%;border:1px solid black;text-align:center;">সরবরাহের পরিমাণ</th>
                <th style="width:8%;border:1px solid black;text-align:center;">মন্তব্য </th>
               </tr>
                <tr style="height:28px;font-size:13px;">
                  <td style="width:5%;border:1px solid black;text-align:center;">'.$i.'</td>
                  <td style="width:22%;border:1px solid black;text-align:center;">'.$row222['productname'].'</td>
                  <td style="width:38%;border:1px solid black;text-align:center;">'.$row222['prductdesc'].'</td>
                  <td style="width:10%;border:1px solid black;text-align:center;">'.$row222['supplyqnty'].'</td>
                   <td style="width:12%;border:1px solid black;text-align:center;">'.$row222['supplyqnty'].'</td>
                   <td style="width:8%;border:1px solid black;text-align:center;"></th>
                </tr>';
           endwhile;
       while($i<5):
             $output.='<tr style="height:25px;">
                        <td style="width:5%;border:1px solid black;text-align:center;"></td>
                        <td style="width:22%;border:1px solid black;text-align:center;"> </td>
                        <td style="width:38%;border:1px solid black;text-align:center;"></td>
                        <td style="width:10%;border:1px solid black;text-align:center;"></td>
                        <td style="width:12%;border:1px solid black;text-align:center;"></td>
                        <td style="width:8%;border:1px solid black;text-align:center;"></td>
                      </tr>';
             $i++;
        endwhile;
            $output.='</table><br><br><br><br><br>';
            $output.='<table style="width:100%;">
                        <tr>
                            <td style="text-align:left;width:50%;;padding:10px;text-decoration:overline;">&nbsp&nbspবিতরণকারীর স্বাক্ষর &nbsp&nbsp</td>
                            <td style="text-align:right;width:50%;padding:10px;text-decoration:overline; ">&nbsp গ্রহীতার স্বাক্ষর &nbsp&nbsp&nbsp&nbsp</td>
                        </tr>
                    </table>';
            $output.='</div><br>';  
    
    
    
    echo $output;
}

}
?>

