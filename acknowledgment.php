<?php
session_start();
if (!isset($_SESSION["sess_user"])) {
    header("Location: login.php");
} else {
?>

    <!DOCTYPE html>
    <html lang="en">

    <head>
        <title>ERL Basic</title>
        <?php
        include("header.php");

        require_once 'db_connect.php';
        date_default_timezone_set("Asia/Dhaka");
        include("function.php");

        error_reporting(0);
        ?>
        <link rel="stylesheet" type="text/css" href="assist/datatables/datatables.min.css">
        <style>
            tr:hover {
                background-color: whitesmoke;
                height: 35px;
            }

            tr>td:hover {
                color: blue;
            }
        </style>




    </head>

    <body>
        <div class="container">
            <?php
            include("menu.php");
            ?>
            <div class="container-fluid text-center">
                <div class="row content">
                    <div class="logposition">
                        <?= $_SESSION['sess_user']; ?><button class="btn btn-outline-info btn-sm" type="button" onclick="window.location.href='logout.php'">Logout</button>
                    </div>
                    <!--Take input of ACKdata-->
                    <div class="col-sm-12 text-left">
                        <hr>
                        <h3 id="DDReport" style="text-align:center;color:#0070d0;cursor:pointer;">প্রাপ্তিস্বীকার পত্র <span class="glyphicon glyphicon-menu-down"></span> </h3>
                        <hr>
                        <div id="msg" style="width:760px;float:float-lg-none"></div>
                        <div id="Dreportshow" style="display:none;background-color:#ccd0d4;padding:10px;border-radius:10px;box-shadow: 0 10px 20px rgba(0,0,0,0.19), 0 6px 6px rgba(0,0,0,0.23);">
                            <form id="ackDataform" name="ackDataform">
                                <div class="form-group" style="width:100%;">
                                    <div class="form-group row">
                                        <label for="search" class="col-sm-2 col-form-label" style="padding:5px;text-align:right;">গ্রহীতার নামঃ </label>
                                        <div class="col-sm-6">
                                            <input class="form-control" id="search" name="search" type="text" placeholder="Receiver Name" required autocomplete="off">
                                            <div id="result"></div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="productnamesearch" class="col-sm-2 col-form-label" style="padding:5px;text-align:right;">পন্যের নামঃ</label>
                                        <div class="col-sm-6">
                                            <input type="text" name="productnamesearch" id="productnamesearch" class="form-control" placeholder="Product Name" autocomplete="off" required>
                                            <div id="resultproduct"></div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="modelname" class="col-sm-2 col-form-label" style="padding:4px;text-align:right;">মডেল/বিবরণঃ </label>
                                        <div class="col-sm-6">
                                            <input type="text" name="modelname" id="modelname" class="form-control" placeholder="Model" autocomplete="off" required>
                                            <div id="resultmodel"></div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="supplyunit" class="col-sm-2 col-form-label" style="padding:4px;text-align:right;">সরবরাহের পরিমাণঃ</label>
                                        <div class="col-sm-6">
                                            <select class="form-control" name="supplyunit" id="supplyunit">
                                                <option name="supplyunit" value="1">01</option>
                                                <option name="supplyunit" value="2">02</option>
                                                <option name="supplyunit" value="3">03</option>
                                            </select>
                                        </div>
                                    </div>
                                    <br>
                                    <div class="form-group row">
                                        <div class="col-sm-2"></div>
                                        <div class="col-sm-6">
                                            <button id="submit12" name="submit12" type="submit" class="btn btn-primary">submit
                                            </button>
                                        </div>
                                    </div>

                                </div>
                            </form>
                            <div id="msg" style="width:760px;float:float-lg-none"></div>
                        </div>
                    </div>
                    <!--Show ack data then print and delete-->
                    <div class="col-sm-12 text-left" id="ackshowprintandDelete">
                        <hr>
                        <h3 id="ackshowtitle" style="text-align:center;color:#0070d0;cursor:pointer;">প্রাপ্তিস্বীকার পত্রের ইতিহাস <span class="glyphicon glyphicon-menu-down"></span> </h3>
                        <hr>
                        <div class="removeMessages"></div>
                        <div id="acktabshow" style="display:none;background-color:#c4c5c7;height:500px;overflow:scroll;
                        padding:10px;border-radius:15px;box-shadow: 0 10px 20px rgba(0,0,0,0.19), 0 6px 6px rgba(0,0,0,0.23);">
                            <input type="text" name="" id="myinput" onkeyup="searchFromPname()" placeholder="Search anything here..." style="padding:5px; margin: 5px;border-radius: 10px;width:30%;box-shadow: 0 2px 2px rgba(0, 0, 0, 0.19), 0 3px 3px rgba(0, 0, 0, 0.23);">
                            <?php
                            $sql555 = "SELECT
                            DATE_FORMAT(DATE(aa.entrydate),'%d/%m/%Y') IssueDate,
                           CONCAT(cc.unameeng,'-',cc.Depteng,'-',cc.designationeng) IssuedPerson,
                           aa.productname,
                           aa.prductdesc,
                           aa.supplyqnty,
                           aa.serialno
                           FROM acknowledgetab aa,cashvoucher_info cc
                            WHERE aa.userid=cc.paymentcode
                            AND aa.state='ok'
                            ORDER BY aa.entrydate DESC
                            LIMIT 150;";
                            $result555 = mysqli_query($connect, $sql555);
                            echo "<table id='AckTabData' style='width:100%;background-color:#dbdde0;'>";
                            echo "<tr style='font-size:16px;padding:10px;'>
                                         <th style='width:1%;border:1px solid black;text-align:center;'>No</th>
                                         <th style='width:10%;border:1px solid black;text-align:center;'>Issued Date</th>
                                         <th style='width:30%;border:1px solid black;text-align:center;'>IssuedPerson</th>
                                         <th style='width:23%;border:1px solid black;text-align:center;'>ProductName</th>
                                         <th style='width:25;border:1px solid black;text-align:center;'>ProductDesc</th>
                                         <th style='width:2%;border:1px solid black;text-align:center;'>Qty</th>
                                         <th style='width:13%;border:1px solid black;text-align:center;'>Action</th>
                                       </tr>";
                            $i = 0;
                            while ($row555 = $result555->fetch_assoc()) :
                                ++$i;
                                echo "<tr style='font-size:13px;font-family:Tahoma;padding:2px;'>
                                         <td style='border:1px solid black;text-align:center;'>$i</td>
                                         <td style='border:1px solid black;text-align:center;font-size: 11px;'>" . $row555['IssueDate'] . "</td>
                                         <td class='text-capitalize' style='border:1px solid black;text-align:left;padding-left:5px;font-size: 11px;'>" . $row555['IssuedPerson'] . "</td>
                                         <td style='border:1px solid black;text-align:left;padding-left:5px'>" . $row555['productname'] . "</td>
                                         <td style='border:1px solid black;text-align:left;padding-left:5px'>" . $row555['prductdesc'] . "</td>
                                         <td style='border:1px solid black;text-align:center;'>" . $row555['supplyqnty'] . "</td>";
                                echo    '<td style="border:1px solid black;text-align:center;padding:2px;>
                                        <div class="btn-group">
                                        <button class="btn-warning" type="button" id="deletAckbtn" data-toggle="modal" data-target="#deleteAckData" onclick="deleteAck_hist(' . $row555['serialno'] . ');"><span class="glyphicon glyphicon-remove">Delete</span></button>
                                         <button class="btn-primary" type="button" id="printackbtn" onclick="printAck_hist(' . $row555['serialno'] . ');" data-toggle="modal" data-target="#printAckData"><span class="glyphicon glyphicon-print">Print</span></button>
                                         </div>
                                        </td>';
                                echo    "</tr>";
                            endwhile;
                            echo "</table>";
                            ?>
                        </div>
                        <!--modal for delete data-->
                        <div class="modal fade" tabindex="-1" role="dialog" id="deleteAckData">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-body">
                                        <p>Do you really want to remove ?</p>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-default" data-dismiss="modal" id="Nobtn">No</button>
                                        <button type="button" class="btn btn-primary" id="removeBtn">Yes</button>
                                    </div>
                                </div><!-- /.modal-content -->
                            </div><!-- /.modal-dialog -->
                        </div>
                        <!--modal for print data-->
                        <div class="modal fade" tabindex="-1" role="dialog" id="printAckData">
                            <div class="modal-dialog" style="width:790px;">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal">&times;</button>

                                    </div>
                                    <div id="printThis">
                                        <div class="modal-body" id="ackprintmodal"></div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-default" data-dismiss="modal" id="Nobtn">Close</button>
                                        <button id="btnPrint" type="button" class="btn btn-default">Print</button>

                                    </div>
                                </div><!-- /.modal-content -->
                            </div><!-- /.modal-dialog -->
                        </div>
                    </div>
                    <!--Show ack REPORT-->
                    <br>
                    <div class="col-sm-12 text-left" id="showAckReport">
                        <hr>
                        <h3 id="ack_report" style="text-align:center;color:#0070d0;cursor:pointer;">প্রাপ্তিস্বীকার পত্রের রিপোর্ট <span class="glyphicon glyphicon-menu-down"></span></h3>
                        <hr>
                        <div id="ack_report_show" style="display:none;background-color:#c6cacb;padding:15px;border-radius:15px;box-shadow: 0 10px 20px rgba(0,0,0,0.19), 0 6px 6px rgba(0,0,0,0.23);">
                            <div>
                                <form id="ack_report_form">
                                    <div class="form-group row">
                                        <label for="fromdate" class="col-sm-2 col-form-label">From Date</label>
                                        <div class="col-sm-3">
                                            <input class="form-control" type="date" id="fromdate" name="fromdate">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="todate" class="col-sm-2 col-form-label">To Date</label>
                                        <div class="col-sm-3">
                                            <input class="form-control" type="date" id="todate" name="todate">
                                        </div>
                                    </div>
                                    <button type="submit" id="datesubmit" name="datesubmit" data-toggle="modal" data-target="#ReportAckData" class="btn btn-primary">Submit</button>
                                </form>
                            </div>
                        </div>
                        <!--For Report Modal-->
                        <div class="modal fade" tabindex="-1" role="dialog" id="ReportAckData">
                            <div class="modal-dialog" style="width:60%;">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    </div>
                                    <div id="printThis2">
                                        <div class="modal-body" id="ackReportmodal"></div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-default" data-dismiss="modal" id="Nobtn">Close</button>
                                        <button type="button" class="btn btn-default" id='printReportcmd'>Print</button>
                                    </div>
                                </div><!-- /.modal-content -->
                            </div><!-- /.modal-dialog -->
                        </div>
                    </div>
                </div>
                <div class="cleaner h80"></div>


                <script type="text/javascript" src="custom/js/acknowledge.js"></script>
                <script type="text/javascript" src="assist/datatables/datatables.min.js"></script>
                <script type="text/javascript">
                    document.getElementById("btnPrint").onclick = function() {
                        printElement(document.getElementById("printThis"));
                    }
                    document.getElementById("printReportcmd").onclick = function() {
                        printElement(document.getElementById("printThis2"));
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
            </div>
            <?php
            include("footer.php");
            ?>
        </div>
    </body>

    </html>
<?php
}
?>