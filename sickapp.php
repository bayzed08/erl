<!DOCTYPE html>
<html lang="en">

<head>
    <title>Sick Application</title>
    <?php
    include("header.php");
    require_once 'db_connect.php';
    date_default_timezone_set("Asia/Dhaka");
    include("function.php");
    error_reporting(0);
    ?>
    <!-- for printing -->

</head>

<body>
    <div class="container">
        <?php
        include("menu.php");
        ?>

        <div class="container-fluid text-center">
            <div class="row content">
                <div class="col-sm-12 text-left">
                    <h3 id="DDReport">Sick Application</h3>
                    <hr>
                    <div id="Dreportshow">
                        <form id="ssdreportform" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                            <div class="form-group" style="width:100%;">
                                <div class="form-group row">
                                    <div class="col-sm-6">
                                        <input class="form-control" id="search" name="search" type="text" autocomplete="off" placeholder="User Name">
                                        <div id="result"></div>
                                        <script type="text/javascript" src="custom/js/sickapp.js">
                                        </script>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-6">
                                        <input class="form-control" type="text" name="sreason" id="sreason" maxlength="78" placeholder="Sick leave Reason: like Sickness, Chest pain, Headache..">
                                    </div>
                                </div>
                                <div style="width:30%;">
                                    From Date: <br>
                                    <input class="form-control" type="date" name="sdate" id="sdate">
                                    To Date: <br>
                                    <input class="form-control" type="date" name="sdate2" id="sdate2">
                                </div>
                                <br>
                                <button id="sdreport" type="submit" class="btn btn-primary" onSubmit="document.getElementById('Dreportshow').style.display='relative'">submit
                                </button>
                            </div>
                        </form>
                        <div style="float:right;">
                            <button type="button" class="btn btn-default btn-md" id="printcmd" value="PrintDiv"> <span class="glyphicon glyphicon-print"></span> Print </button>
                        </div>
                        <br>
                        <br>
                        <div class="dreport" id="dreport">
                            <?php
                            if ($_POST) {
                                $sreason = $_POST['sreason'];
                                $sdate = $_POST['sdate'];
                                $sdateF = date("d-m-y", strtotime($sdate));
                                $sdate2 = $_POST['sdate2'];
                                $sdate2F = date("d-m-y", strtotime($sdate2));
                                $diff = dateDiffInDays($sdate, $sdate2) + 1;
                                if ($diff > 1) {
                                    $daycount = "days";
                                } else $daycount = "day";
                                //$diff=format($diff,"%R%a days");
                                $datee = date("d/m/Y");
                                $timee = date("h:i:s a");


                                $u_name = mysqli_real_escape_string($connect, $_POST['search']);
                                $salcode = trim(substr($u_name, strpos($u_name, "|") + 1));
                                $sql2 = "SELECT ci.unameeng,
                              CONCAT(ci.designationeng,' (',ci.Depteng,')') designation,
                               ci.paymentcode,
                               ci.medicalfileno
                               FROM cashvoucher_info ci
                               WHERE ci.paymentcode='$salcode'";
                                $query2 = mysqli_query($connect, $sql2);

                                while ($row = $query2->fetch_assoc()) :
                                    // {
                                    echo "<div style='width:100%;font-size:17px;padding-top:80px;padding-left:60px;padding-right:60px;'>
                        <div style='padding:10px;'>
                            To: DCMO<br>
                            From: " . $row['designation'] . "<br>
                            Through: Proper Channel
                        </div>
                        <br>
                        <div style='padding:10px;'>
                            Subject: <u>Prayer for Sick leave</u>
                        </div>
                        <div style='padding:15px;'>
                            Sir,<br>
                            This is to inform you that, I could not attend my office duty on
                            ";
                                    if ($sdateF == $sdate2F) {
                                        echo "$sdateF for ($diff) $daycount on account of $sreason.";
                                    } else {
                                        echo "$sdateF to $sdate2F total $diff $daycount because of $sreason.";
                                    }
                                    echo "
                            <br>
                            <br>
                            I, therefore pray that you would take necessary actions for granting me sick leave (s/l) for the above-mentioned day.
                            <br>
                            <br>
                            <br>
                            Sincerely yours,<br>
                            <br>
                            <br>
                            <br>
                        </div>
                        <div style='padding:10px;'>
                            (" . $row['unameeng'] . ") <br>
                             Date: $datee<br>
                             Salary Code: " . $row['paymentcode'] . "<br>
                             Medical File no: " . $row['medicalfileno'] . "
                        </div>
                        <br><br><br>
                     </div>";
                                endwhile;
                            }
                            ?>
                            <!--sick leave formate -->

                        </div>
                    </div>
                </div>


            </div>
        </div>
        <div class="cleaner h80"></div>
        <script type="text/javascript">
            document.getElementById("printcmd").onclick = function() {
                printElement(document.getElementById("dreport"));
            }

            function printElement(elem) {
                var domClone = elem.cloneNode(true);
                var $printSection = document.getElementById("printSection");
                if (!$printSection) {
                    var $printSection = document.createElement("div");
                    $printSection.id = "printSection";
                    document.body.appendChild($printSection);
                }
                $printSection.innerHTML = "";
                $printSection.appendChild(domClone);
                window.print();
                window.close();
            }
        </script>
        <?php
        include("footer.php");
        ?>
    </div>

</body>

</html>