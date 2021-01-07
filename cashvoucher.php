<!DOCTYPE html>
<html lang="en">

<head>
    <title>ERL CashVoucher Form</title>
    <link rel="stylesheet" href="custom/css/cashVoucher.css">
    <?php
    include("header.php");
    require_once 'db_connect.php';
    date_default_timezone_set("Asia/Dhaka");
    include("function.php");
    error_reporting(0);
    ?>
</head>

<body>
    <div class="container">
        <?php
        include("menu.php");
        ?>
        <div class="container-fluid text-center">
            <div class="row content">
                <div class="col-sm-12 text-left">
                    <h3 id="DDReport">নগদ ভাউচার </h3>
                    <hr>
                    <div id="Dreportshow">
                        <div id="cashform">
                            <br>
                            <form id="ssdreportform" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                                <div class="form-group row">
                                    <label for="search" class="col-sm-2 col-form-label" style="padding:5px;text-align:right;"><span class="glyphicon glyphicon-user"></span></label>
                                    <div class="col-sm-8">
                                        <input class="form-control" id="search" name="search" type="text" placeholder="ব্যবহারকারীর নামঃ " autocomplete="off">
                                        <div id="result"></div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="cashdesc" class="col-sm-2 col-form-label" style="padding:5px;text-align:right;"><span class="glyphicon glyphicon-align-justify"></span></label>
                                    <div class="col-sm-8">
                                        <input type="text" name="cashdesc" id="cashdesc" class="form-control" placeholder="বিবরণঃ" required>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="cashdesc2" class="col-sm-2 col-form-label" style="padding:5px;text-align:right;"><span class="glyphicon glyphicon-align-justify"></span></label>
                                    <div class="col-sm-8">
                                        <input type="text" name="cashdesc2" id="cashdesc2" class="form-control" placeholder="বিবরণ ২:">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="cashamount" class="col-sm-2 col-form-label" style="padding:5px;text-align:right;"><span class="glyphicon glyphicon-usd"></span></label>
                                    <div class="col-sm-8">
                                        <input type="number" name="cashamount" id="cashamount" class="form-control" placeholder="টাকায় পরিমান: " required>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="cashamount2" class="col-sm-2 col-form-label" style="padding:5px;text-align:right;"><span class="glyphicon glyphicon-usd"></span></label>
                                    <div class="col-sm-8">
                                        <input type="number" name="cashamount2" id="cashamount2" class="form-control" placeholder="টাকায় পরিমান: ">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-2"></div>
                                    <div class="col-sm-6">
                                        <button id="sdreport" type="submit" class="btn btn-secondary" onSubmit="document.getElementById('Dreportshow').style.display='block'">submit
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div style="float:right;">
                            <button type="button" class="btn btn-default btn-md" onclick="printDiv('dreport')" id="printcmd" value="PrintDiv"> <span class="glyphicon glyphicon-print"></span> Print </button>
                        </div>
                        <br>
                        <br>
                        <div class="dreport" id="dreport">
                            <?php
                            if ($_POST) {
                                $cashamount = $_POST['cashamount'];
                                $cashamount2 = $_POST['cashamount2'];
                                $cashamountsum = $cashamount + $cashamount2;
                                $cashamountsumnum = $cashamountsum;
                                $cashamountsumbangla = num2bangla($cashamountsum);
                                $cashdesc = $_POST['cashdesc'];
                                $cashdesc2 = $_POST['cashdesc2'];
                                $datee = date("d/m/Y");
                                $timee = date("h:i:s a");


                                $u_nameeng = mysqli_real_escape_string($connect, $_POST['search']);
                                $salcode = trim(substr($u_nameeng, strpos($u_nameeng, "|") + 1));
                                $sql2 = "SELECT ci.uname,
                               CONCAT(ci.designation,' (',ci.Dept,')') designation,
                               ci.paymentcode,
                               ci.medicalfileno
                               FROM cashvoucher_info ci
                               WHERE ci.paymentcode='$salcode'";
                                $query2 = mysqli_query($connect, $sql2);



                                while ($row = $query2->fetch_assoc()) :
                                    // {
                                    echo "<div>";
                                    echo "<br>
                 <div id='heading'>
                                <table style='width:100%'>
                                <tr>
                                 <td style='width:20%;font-size:13px;'>মেডি: ফাইল নং :" . $row['medicalfileno'] . " </td>
                                 <td style='width:45%; display:table-cell;text-align:center;font-weight: bold;font-size:20px'>
                                   ইস্টার্ণ রিফাইনারী লিমিটেড</td>
                                 <td style='width:20%;padding:4px;font-size:13px; display:table-cell;text-align:left ;border: 1px solid black;'>ভাউচার নং : </td> 
                                </tr>
                                <tr>
                                 <td style='width:20%;font-size:13px;'>বেতন কোড :" . $row['paymentcode'] . "</td>
                                 <td style='width:45%; display:table-cell;text-align:center;font-weight: bold;font-size:14px;'>
                                   চট্টগ্রাম</td>
                                  <td style='width:20%; display:table-cell;text-align: center;'></td> 
                                </tr>
                                <tr>
                                 <td style='width:20%;'> </td>
                                 <td style='width:45%; display:table-cell;text-align:center;font-weight:bold;font-size:16px;text-decoration-line: underline;'>
                                   নগদ  ভাউচার </td>
                                  <td style='width:20%; display:table-cell;text-align: center;font-size:13px;'>তারিখ: <span style='text-decoration-line: underline;'>" . banglastring($datee) . "</span></td> 
                                </tr>
                                </table>
                                <br>  
                             </div>";
                                    echo "
                </br>
                
                 <div style='width:100%;'>
                        <table style='width:100%;padding:5px;'>
                           <tr>
                             <td style='width:15%;'>নগদ/চেকে  জনাব</td>
                             <td style='width:40%;border-bottom: 1px solid black;text-align:center;'>" . $row['uname'] . "</td>
                             <td style='width:10%;text-align:center;'>পদবি</td>
                             <td style='width:33%;border-bottom: 1px solid black;text-align:center;'>" . $row['designation'] . "</td>
                             <td style='width:5%;'> কে</td>
                           </tr>
                        </table>
                        <table style='width:100%;'>
                           <tr>
                             <td style='width:80%;border-bottom: 1px solid black;text-align:center;'> $cashamountsumbangla</td>
                             <td style='width:20%;'> টাকা প্রদান করা হউক ।</td>
                           </tr>
                        </table>
                 </div>
                <br>";



                                    echo "<div><br>
                            <table style='width:100%'>
                                <tr>
                                    <th style='width:65%;text-align:center; border: 1px solid black;border-width: 1px 1px 1px 0px;padding:5px;font-size:14px;'>বিবরণ</th>
                                    <th colspan='2' style='width:19%; border: 1px solid black;padding:1px;font-size:13px;'>কাজ বন্টন / হি: কোড নং</th>
                                    <th colspan='2' style='width:15%; border: 1px solid black;border-width: 1px 0px 1px 1px;padding:5px;font-size:14px;'>টাকার অংক </th>
                                </tr>
                                <tr style='height:30px;'>
                                    <td style='width:65%; text-align:center; border: 1px solid black;border-width: 1px 1px 1px 0px;padding:2px;font-size:12px; '>
                                        $cashdesc
                                    </td>
                                    <td style='width:9%; border: 1px solid black;padding:5px;'></td>
                                    <td style='width:10%; border: 1px solid black;padding:5px;'></td>
                                    <td style='width:8%; border: 1px solid black;border-width: 1px 0px 1px 1px;padding:5px;'>$cashamount</td>
                                    <td style='width:7%; border: 1px solid black;border-width: 1px 0px 1px 1px;padding:5px;'></td>
                                </tr>
                                <tr style='height:30px;'>
                                    <td style='width:65%; text-align:center; border: 1px solid black;border-width: 1px 1px 1px 0px;padding:2px; font-size:12px;'>$cashdesc2</td>
                                    <td style='width:9%; border: 1px solid black;padding:5px;'></td>
                                    <td style='width:10%; border: 1px solid black;padding:5px;'></td>
                                    <td style='width:8%; border: 1px solid black;border-width: 1px 0px 1px 1px;padding:5px;'>$cashamount2</td>
                                    <td style='width:7%; border: 1px solid black;border-width: 1px 0px 1px 1px;padding:5px;'></td>
                                </tr>
                                <tr style='height:30px;'>
                                    <td style='width:65%; text-align:center; border: 1px solid black;border-width: 1px 1px 1px 0px;padding:5px;'></td>
                                    <td style='width:9%; border: 1px solid black;padding:5px;'></td>
                                    <td style='width:10%; border: 1px solid black;padding:5px;'></td>
                                    <td style='width:8%; border: 1px solid black;border-width: 1px 0px 1px 1px;padding:5px;'></td>
                                    <td style='width:7%; border: 1px solid black;border-width: 1px 0px 1px 1px;padding:5px;'></td>
                                </tr>
                                <tr style='height:25px;'>
                                    <td style='width:65%; text-align:center; border: 1px solid black;border-width: 1px 1px 1px 0px;padding:5px;'></td>
                                    <td style='width:9%; border: 1px solid black;padding:5px;'></td>
                                    <td style='width:10%; border: 1px solid black;padding:5px;'></td>
                                    <td style='width:8%; border: 1px solid black;border-width: 1px 0px 1px 1px;padding:5px;'></td>
                                    <td style='width:7%; border: 1px solid black;border-width: 1px 0px 1px 1px;padding:5px;'></td>
                                </tr>
                                <tr style='height:25px;'>
                                    <td style='width:65%; text-align:center; border: 1px solid black;border-width: 0px 0px 0px 0px;padding:5px;'></td>
                                    <td style='width:9%; border: 1px solid black;border-width: 0px 0px 0px 0px;padding:5px;'></td>
                                    <td style='width:10%; border: 1px solid black;border-width: 0px 0px 0px 0px; padding:5px;font-weight: bold;'>মোট</td>
                                    <td style='width:8%; border: 1px solid black;border-width: 0px 0px 1px 1px;padding:5px;'>
                                        $cashamountsumnum
                                    </td>
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
                                endwhile;
                                echo "</div>";
                            }
                            ?>

                        </div>
                    </div>
                </div>
            </div>
        </div>
        <script type="text/javascript" src="custom/js/cashVoucher.js"></script>

        <div class="cleaner h80"></div>
        <?php
        include("footer.php");
        ?>
    </div>
</body>

</html>