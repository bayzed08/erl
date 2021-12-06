<?php
require_once 'db_connect.php';
include("function.php");
if (isset($_POST["cashvoucherid"])) {
    $output = '';
    $cashvoucherid = $_POST['cashvoucherid'];
    $datee = date("d/m/Y");
    $sql222 = "SELECT uname,
    CONCAT(ci.designation,'(',ci.Dept,')') designation,
    ci.paymentcode,
    ci.medicalfileno,
    tt.desc1,
    tt.desc2,
    tt.amount1,
    tt.amount2
    FROM cashvoucher_info ci,cashvoucher_tab tt
    WHERE ci.paymentcode=tt.usererid
    AND tt.cashvoucherid='$cashvoucherid'";

    $query222 = mysqli_query($connect, $sql222);


    $output = "<div id='cashvoucherPrint'>";
    while ($row222 = $query222->fetch_assoc()) :
        $output .= "
                <div id='heading'>
                   <table style='width:100%'>
                        <tr>
                            <td style='width:20%;font-size:13px;'>মেডি: ফাইল নংঃ " . $row222['medicalfileno'] . " </td>
                            <td style='width:45%; display:table-cell;text-align:center;font-weight: bold;font-size:20px'>
                            ইস্টার্ণ রিফাইনারী লিমিটেড</td>
                            <td style='width:20%;padding:4px;font-size:13px; display:table-cell;text-align:left ;border: 1px solid black;'>ভাউচার নংঃ </td>
                        </tr>
                        <tr>
                            <td style='width:20%;font-size:13px;'>বেতন কোডঃ " . $row222['paymentcode'] . "</td>
                            <td style='width:45%; display:table-cell;text-align:center;font-weight: bold;font-size:14px;'>
                            চট্টগ্রাম</td>
                            <td style='width:20%; display:table-cell;text-align: center;'></td>
                        </tr>
                        <tr>
                            <td style='width:20%;'> </td>
                            <td style='width:45%; display:table-cell;text-align:center;font-weight:bold;font-size:16px;text-decoration-line: underline;'>
                            নগদ  ভাউচার </td>
                            <td style='width:20%; display:table-cell;text-align: center;font-size:13px;'>তারিখঃ <span style='text-decoration-line: underline;'>" . banglastring($datee) . "</span></td>
                        </tr>
                   </table>
                   <br>
                </div>";
        $total = $row222['amount1'] + $row222['amount2'];
        $amount2 = $row222['amount2'];
        if ($amount2 == 0) {
            $amount2 = null;
        }
        $totalbangla = num2bangla($total);
        $output .= "<div style='width:100%;'>
                        <table style='width:100%;padding:5px;'>
                           <tr>
                             <td style='width:15%;'>নগদ/চেকে  জনাব</td>
                             <td style='width:40%;border-bottom: 1px solid black;text-align:center;'>" . $row222['uname'] . "</td>
                             <td style='width:10%;text-align:center;'>পদবি</td>
                             <td style='width:33%;border-bottom: 1px solid black;text-align:center;'>" . $row222['designation'] . "</td>
                             <td style='width:5%;'> কে</td>
                           </tr>
                        </table>
                        <table style='width:100%;'>
                           <tr>
                             <td style='width:80%;border-bottom: 1px solid black;text-align:center;'>$totalbangla</td>
                             <td style='width:20%;'> টাকা প্রদান করা হউক ।</td>
                           </tr>
                        </table>
                 </div><br>";
        $output .= "<div>
                            <table style='width:100%'>
                                <tr>
                                    <th style='width:65%;text-align:center; border: 1px solid black;border-width: 1px 1px 1px 0px;padding:5px;font-size:14px;'>বিবরণ</th>
                                    <th colspan='2' style='width:19%; border: 1px solid black;padding:1px;font-size:13px;'>কাজ বন্টন / হি: কোড নং</th>
                                    <th colspan='2' style='width:15%; border: 1px solid black;border-width: 1px 0px 1px 1px;padding:5px;font-size:14px;'>টাকার অংক </th>
                                </tr>
                                <tr style='height:30px;'>
                                    <td style='width:65%; text-align:center; border: 1px solid black;border-width: 1px 1px 1px 0px;padding:2px;font-size:12px; '>" . $row222['desc1'] . "</td>
                                    <td style='width:9%; border: 1px solid black;padding:5px;'></td>
                                    <td style='width:10%; border: 1px solid black;padding:5px;'></td>
                                    <td style='width:8%; border: 1px solid black;border-width: 1px 0px 1px 1px;padding:5px;'>" .banglastring( $row222['amount1']) . "</td>
                                    <td style='width:7%; border: 1px solid black;border-width: 1px 0px 1px 1px;padding:5px;'></td>
                                </tr>
                                <tr style='height:30px;'>
                                    <td style='width:65%; text-align:center; border: 1px solid black;border-width: 1px 1px 1px 0px;padding:2px; font-size:12px;'>" . $row222['desc2'] . "</td>
                                    <td style='width:9%; border: 1px solid black;padding:5px;'></td>
                                    <td style='width:10%; border: 1px solid black;padding:5px;'></td>
                                    <td style='width:8%; border: 1px solid black;border-width: 1px 0px 1px 1px;padding:5px;'>".banglastring($amount2)."</td>
                                    <td style='width:7%; border: 1px solid black;border-width: 1px 0px 1px 1px;padding:5px;'></td>
                                </tr>
                                <tr style='height:30px;'>
                                    <td style='width:65%; text-align:center; border: 1px solid black;border-width: 1px 1px 1px 0px;padding:5px;'></td>
                                    <td style='width:9%; border: 1px solid black;padding:5px;'></td>
                                    <td style='width:10%; border: 1px solid black;padding:5px;'></td>
                                    <td style='width:8%; border: 1px solid black;border-width: 1px 0px 1px 1px;padding:5px;'></td>
                                    <td style='width:7%; border: 1px solid black;border-width: 1px 0px 1px 1px;padding:5px;'></td>
                                </tr>
                                <tr style='height:30px;'>
                                    <td style='width:65%; text-align:center; border: 1px solid black;border-width: 1px 1px 1px 0px;padding:5px;'></td>
                                    <td style='width:9%; border: 1px solid black;padding:5px;'></td>
                                    <td style='width:10%; border: 1px solid black;padding:5px;'></td>
                                    <td style='width:8%; border: 1px solid black;border-width: 1px 0px 1px 1px;padding:5px;'></td>
                                    <td style='width:7%; border: 1px solid black;border-width: 1px 0px 1px 1px;padding:5px;'></td>
                                </tr>
                                <tr style='height:30px;'>
                                    <td style='width:65%; text-align:center; border: 1px solid black;border-width: 0px 0px 0px 0px;padding:5px;'></td>
                                    <td style='width:9%; border: 1px solid black;border-width: 0px 0px 0px 0px;padding:5px;'></td>
                                    <td style='width:10%; border: 1px solid black;border-width: 0px 0px 0px 0px; padding:5px;font-weight: bold;'>মোট</td>
                                    <td style='width:8%; border: 1px solid black;border-width: 0px 0px 1px 1px;padding:5px;'>".banglastring($total)."</td>
                                    <td style='width:7%; border: 1px solid black;border-width: 0px 0px 1px 0px;padding:5px;'></td>
                                </tr>
                            </table>
                            <p style='float:right;padding:10px'>উক্ত টাকা বুঝিয়া পাইলাম </p>
                            <br><br><br>
                            <p>&nbspঅনুমোদনকারীর স্বাক্ষর:............................. </p>
                            <br>
                            <p>&nbspঅর্থ প্রদানের আদেশকারীর স্বাক্ষর :................<span style='float:right;font-weight: bold;'>প্রাপকের স্বাক্ষর &nbsp&nbsp </span></p>
                            <br>
                        </div>";
        $output .= '</div>';
    endwhile;


    echo $output;
}
