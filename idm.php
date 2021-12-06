<!DOCTYPE html>
<html lang="en">

<head>
    <title>IDM</title>
    <?php
        include("header.php");
        include("function.php");
        require_once 'db_connect.php';
        error_reporting(0);
    ?>
    <!-- for printing -->
    <script language="javascript">
        function printDiv(idmreport) {
            var restorepage = document.body.innerHTML;
            var printcontent = document.getElementById(idmreport).innerHTML;
            document.body.innerHTML = printcontent;
            document.title = 'IDM-<?php echo date("d-m-Y").'_'.date("h_i") ?>';
            window.print();
            document.body.innerHTML = restorepage;
        }

    </script>
</head>

<body>
    <div class="container">
        <?php
        include("menu.php");
         ?>

        <div class="container-fluid text-center">
            <div class="row content">
                <div class="col-sm-12 text-left">
                    <div>
                        <form id="idmappform" method="post" action="<?php echo $_SERVER['PHP_SELF'];?>">
                            <div class="form-group row">
                                <label for="sendernamesearch" class="col-sm-1 col-form-label" style="padding:8px;text-align:right;">প্রেরক:</label>
                                <div class="col-sm-4">
                                    <input class="form-control" id="sendernamesearch" name="sendernamesearch" type="text">
                                    <div id="result"></div>
                                    <script type="text/javascript" src="custom/js/acknowledge.js">
                                    </script>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="receivernamesearch" class="col-sm-1 col-form-label" style="padding:8px;text-align:right;">প্রাপক:</label>
                                <div class="col-sm-4">
                                    <input class="form-control" id="receivernamesearch" name="receivernamesearch" type="text">
                                    <div id="result2"></div>
                                    <script type="text/javascript" src="custom/js/acknowledge.js">
                                    </script>
                                </div>
                            </div>
                            
                            <div class="form-group row">
                                <label for="subject" class="col-sm-1 col-form-label" style="padding:8px;">বিষয় : </label>
                                <div class="col-sm-6">
                                    <input type="text" name="subject" id="subject" class="form-control" placeholder="বিষয়">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="statement" class="col-sm-1 col-form-label" style="padding:8px;"> বিবরণ : </label>
                                <div class="col-sm-8">
                                    <!--<input type="text" id="statement" class="form-control" placeholder=" বিবরণ ">-->
                                    <textarea name="statement" id="statement" class="form-control" placeholder="বিবরণ"></textarea>
                                </div>
                            </div>
                            <div class="form-group row">
                                <input type="checkbox" id="customCheck1" name="customCheck1" value="যথাযথ কর্তৃপক্ষের মাধ্যমে">
                                <label for="customCheck1">যথাযথ কর্তৃপক্ষের মাধ্যমে</label>
                            </div>
                            <div class="form-group row">
                                <button id="submitidmform" type="submit" class="btn btn-primary">Submit
                                </button>
                            </div>


                        </form>
                        <div style="float:right;">
                            <button type="button" class="btn btn-default btn-md" onclick="printDiv('idmreport')" id="printcmd" value="PrintDiv"> <span class="glyphicon glyphicon-print"></span> Print </button>
                        </div>
                        <br>
                        <br>
                        <div class="idmreport" id="idmreport" style="margin:15px;padding:35px;background-color: #d8dee3;">
                            <?php
                           if($_POST)
                           {
                            $subject=$_POST['subject']; 
                            $statement=$_POST['statement'];
                            $customCheck1=$_POST['customCheck1']; 
                            $datee=banglastring(date("d/m/Y"));
                            // echo  $subject;  
                            //echo  $statement;
                            // echo  $customCheck1;   
                        $u_name=mysqli_real_escape_string($connect,$_POST['sendernamesearch']);
                        $salcode =trim(substr($u_name,strpos($u_name,"-")+1));
                        $sql2="SELECT ci.uname,
                               CONCAT(ci.designation,'(',ci.Dept,')') designation
                               FROM cashvoucher_info ci
                               WHERE ci.paymentcode='$salcode'"; 
                        $query2= mysqli_query($connect,$sql2);
                               
                        $u_name2=mysqli_real_escape_string($connect,$_POST['receivernamesearch']);
                        $salcode2 =trim(substr($u_name2,strpos($u_name2,"-")+1));
                        $sql3="SELECT 
                               CONCAT(ci.designation,'(',ci.Dept,')') designation2
                               FROM cashvoucher_info ci
                               WHERE ci.paymentcode='$salcode2'"; 
                        $query3= mysqli_query($connect,$sql3);       
                        echo "<div style='width:100%;text-align:center;font-weight: bold;font-size:20px;'>
                            <br>ইস্টার্ণ রিফাইনারী লিমিটেড
                        </div>
                        <div style='width:100%;text-align:center;font-weight: bold;font-size:14px;'>
                            চট্টগ্রাম
                        </div>
                        <div style='width:100%;text-align:center;font-weight: bold;font-size:17px;text-decoration-line: underline;'>
                            আন্ত-বিভাগীয় স্মারকলিপি<br><br>  
                        </div>";   
                              // while($row = $query2->fetch_assoc()):
                              //   echo "<div>প্রেরক: ".$row['designation']."
                              //       </div>";
                              // endwhile;
                               $row = $query2->fetch_assoc();
                               echo "<div style='padding:7px;'>প্রেরক: ".$row['designation']."<span style='float:right;'>তারিখ :$datee</span>
                                    </div>";   
                               while($row2 = $query3->fetch_assoc()):
                               echo "<div style='padding:7px;'>প্রাপক: ".$row2['designation2']."
                                     </div>";
                               endwhile;
                        echo  "<div style='width:100%;text-align:center;'><b>$customCheck1</b><br></div>";        
                        echo  "<div style='padding:10px;'>বিষয় : $subject ।<br> <br></div>";  
                        echo  "<div style='padding:7px;'>$statement<br><br></div>";
                        echo  "<div style='padding:7px;'>
                                এমতাবস্থায় যথাযথ ব্যবস্থা নিতে অনুরোধ করা যাচ্ছে ।<br>
                                ধন্যবাদান্তে,<br><br><br>
                               </div>";
                        //echo "-----------------------";       
                        echo "<div style='padding:10px;'>__________________<br>".$row['uname']."<br>".$row['designation']."
                                    </div>";       
                           } /* end of Post  */
                        ?>


                        </div>
                        <!--End of idm Report   -->
                    </div>

                </div>
            </div>
        </div>
        <div class="cleaner h80"></div>
        <?php
        include("footer.php");
    ?>
    </div>

</body>

</html>
