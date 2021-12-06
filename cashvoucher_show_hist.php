<?php
require_once 'db_connect.php';

$sql555 = "SELECT aa.entrydate BillingDate,
CONCAT(cc.unameeng,'--',cc.Depteng,'--',cc.designationeng) IssuedPerson,
aa.cashvoucherid,
aa.cashvouchertype,
aa.amount1+aa.amount2 total
FROM cashvoucher_tab aa,cashvoucher_info cc
WHERE aa.usererid=cc.paymentcode
AND aa.state='ok'
ORDER BY aa.entrydate DESC
LIMIT 15;";
$result555 = mysqli_query($connect, $sql555);
echo "<table style='width:100%;background-color:#dbdde0;'>";
echo "<tr style='font-size:16px;padding:10px;'>
                        <th style='width:2%;border:1px solid black;text-align:center;'>No</th>
                        <th style='width:10%;border:1px solid black;text-align:center;'>Bill Date</th>
                        <th style='width:30%;border:1px solid black;text-align:center;'>Person</th>
                        <th style='width:20%;border:1px solid black;text-align:center;'>CashVoucherType</th>
                        <th style='width:10%;border:1px solid black;text-align:center;'>TotalAmount</th>
                        <th style='width:23%;border:1px solid black;text-align:center;'>Action</th>
                  </tr>";
$i = 0;
while ($row555 = $result555->fetch_assoc()) :
    ++$i;
    echo "<tr style='font-size:13px;font-family:Tahoma;padding:2px;'>
                        <td style='border:1px solid black;text-align:center;'>$i</td>
                        <td style='border:1px solid black;text-align:center;font-size: 11px;'>" . $row555['BillingDate'] . "</td>
                        <td class='text-capitalize' style='border:1px solid black;text-align:left;padding-left:5px;font-size: 11px;'>" . $row555['IssuedPerson'] . "</td>
                        <td style='border:1px solid black;text-align:left;padding-left:5px'>" . $row555['cashvouchertype'] . "</td>
                        <td style='border:1px solid black;text-align:left;padding-left:5px'>" . $row555['total'] . "</td>";
    echo        '<td style="border:1px solid black;text-align:center;padding:2px;>
                    <div class="btn-group">
                     <button class="btn-warning" type="button" id="deletCashVbtn" data-toggle="modal" data-target="#deleteCashVData" onclick="deleteCashV_hist(' . $row555['cashvoucherid'] . ');"><span class="glyphicon glyphicon-remove">Delete</span></button>
                     <button class="btn-primary" type="button" id="printCashVbtn" onclick="printCashV_hist(' . $row555['cashvoucherid'] . ');" data-toggle="modal" data-target="#printCashVData"><span class="glyphicon glyphicon-print">Print</span></button>
                    </div>
                </td>';
    echo  "</tr>";
endwhile;
echo "</table>";
