<?php
session_start();
if (!isset($_SESSION["sess_user"])) {
   header("Location: login.php");
} else {
?>
<?php
   require_once 'db_connect.php';
   include("function.php");
   if (isset($_POST["fromdate"])) {
      $output = '';
      $fromdate = $_POST['fromdate'];
      $todate = $_POST['todate'];
      $datetoday = banglastring(date("d/m/Y"));
      $fdate = banglastring(date("d-m-Y", strtotime($fromdate)));
      $tdate = banglastring(date("d-m-Y", strtotime($todate)));
      $month = date('F', strtotime($fromdate));
      $sql222 = "SELECT DATE( aa.entrydate) IssueDate,
       CONCAT(ci.unameeng,'--',ci.Depteng,'--',ci.designationeng) IssuedPerson,
       aa.productname,
       aa.prductdesc,
       aa.supplyqnty
       FROM acknowledgetab aa,cashvoucher_info ci
       WHERE aa.state='ok'
       AND aa.userid=ci.paymentcode
       AND DATE(aa.entrydate) BETWEEN '$fromdate' AND '$todate'
       ORDER BY aa.productname, aa.prductdesc,IssueDate";
      $query222 = mysqli_query($connect, $sql222);

      $output = '<div class="dreport" id="dreport">';
      $output .= '<div style="text-align:center;">
                <span style="font-size:25px;">ইস্টার্ণ রিফাইনারী লিমিটেড</span>
                <br><span style="font-size:20px;">উত্তর পতেঙ্গা,চট্টগ্রাম</span>
                <br><span style="font-size:15px;">পণ্য বিতরণ প্রতিবেদন(' . $fdate . ' থেকে ' . $tdate . ')</span>
            </div>';
      $output .= '<div><br>
             <span style="padding-right: 20px;float:right">তারিখ: ' . $datetoday . '</span>
             <br>
            </div>';
      $output .= '<table style="width:100%;">';
      $output .= '<tr>
                <th style="width:2%;border:1px solid black;text-align:center;">নং</th>
                <th style="width:12%;border:1px solid black;text-align:center;">ইস্যুর তারিখ</th>
                <th style="width:20%;border:1px solid black;text-align:center;">পণ্যের নাম</th>
                <th style="width:25%;border:1px solid black;text-align:center;">মডেল / বিবরণ</th>
                <th style="width:2%;border:1px solid black;text-align:center;font-size:6px;">পরিমাণ</th>
                <th style="width:35%;border:1px solid black;text-align:center;">ব্যবহারকারী ব্যক্তি</th>
             </tr>';
      $i = 0;
      while ($row222 = $query222->fetch_assoc()) :
         $p = banglastring(++$i);
         $issuedate = banglastring(date("d-m-Y", strtotime($row222['IssueDate'])));
         $output .= '<tr style="padding:3px;font-size:11px;">
                <td style="border:1px solid black;text-align:center;">' . $p . '</td>
                <td style="border:1px solid black;text-align:center;padding-left:3px;">' . $issuedate . '</td>
                <td style="border:1px solid black;text-align:left;padding-left:5px;">' . $row222['productname'] . '</td>
                <td style="border:1px solid black;text-align:left;padding-left:5px;">' . $row222['prductdesc'] . '</td>
                <td style="border:1px solid black;text-align:center;">' . $row222['supplyqnty'] . '</td>
                <td style="border:1px solid black;text-align:left;padding-left:5px;font-size:10px;">' . $row222['IssuedPerson'] . '</td>
             </tr>';
      endwhile;
      $output .= '</table>';
      $output .= '</div>';


      echo $output;
   } else {
      $output = '<div>IT IS WRONG</div>';
      echo $output;
   }
}
?>

