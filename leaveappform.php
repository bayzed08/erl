<!DOCTYPE html>
<html lang="en">

<head>
    <title>ERL Basic</title>
    <?php
        include("header.php");
        include("function.php");
        require_once 'db_connect.php';
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
                    
                    <div>
                        <form id="leaveappform" method="post" action="<?php echo $_SERVER['PHP_SELF'];?>">
                            <div class="form-group row">
                                    <label for="search" class="col-sm-1 col-form-label" style="padding:8px;text-align:right;">নাম :</label>
                                    <!------------------->
                                    <div class="col-sm-4">
                                        <input class="form-control" id="search" name="search" type="text" autocomplete="off">
                                        <div id="result"></div>
                                        <script type="text/javascript" src="custom/js/acknowledge.js">
                                        </script>
                                    </div>
                            </div>
                            <div class="form-group row">
                                <label for="typeofleave" class="col-sm-1 col-form-label" style="padding:8px;text-align:right;">ছুটির ধরন: </label>
                                <div class="col-sm-4">
                                    <select class="form-control" name="leavetype" id="leavetype">
                                        <option name="typeofleave" value="C/L">Casual Leave(C/L)</option>
                                        <option name="typeofleave" value="S/L">Sick leave(S/L)</option>
                                        <option name="typeofleave" value="E/L">Earn leave(E/L)</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="startofleave" class="col-sm-1 col-form-label" style="padding:8px;text-align:right;">ছুটি শুরু : </label>
                                <div class="col-sm-4">
                                    <input class="form-control" type="date" name="startofleave" id="startofleave" required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="endofleave" class="col-sm-1 col-form-label" style="padding:8px;text-align:right;">ছুটি শেষ : </label>
                                <div class="col-sm-4">
                                    <input class="form-control" type="date" name="endofleave" id="endofleave" required>
                                </div>
                            </div>

                            <div class="form-group row">
                                <button id="submitidmform" type="submit" class="btn btn-primary">Submit
                                </button>
                            </div>
                        </form>
                        <div style="float:right;">
                            <button type="button" class="btn btn-default btn-md" onclick="printDiv('leavereport')" id="printcmd" value="PrintDiv"> <span class="glyphicon glyphicon-print"></span> Print </button>
                        </div>

                        <div id='leavereport' class="leavereport" style="padding:15px 5px 0px 10px">
                            <?php
                        if($_POST) 
                        {
                            $reasonofleave=$_POST['reasonofleave'];
                            $leavetype=$_POST['leavetype'];
                            if($leavetype=='S/L')
                            {
                                $reasonofleave='শারীরিক অসুস্থতা';
                            }
                            elseif($leavetype=='E/L')
                            {
                               $reasonofleave='শ্রান্তি বিনোদন'; 
                            }
                            else{
                                $reasonofleave='পারিবারিক';
                            }
                            $startofleave=date("d/m/Y", strtotime($_POST['startofleave']));
                            $endofleave=date("d/m/Y", strtotime($_POST['endofleave']));
                            $datediff=($endofleave-$startofleave)+1;
                            
                            $u_nameeng=mysqli_real_escape_string($connect,$_POST['search']);
                            $salcode =trim(substr($u_nameeng,strpos($u_nameeng,"|")+1)); 
                            $sql2="SELECT ci.uname,
                               ci.designation designation,
                               ci.Dept,
                               ci.paymentcode,
                               ci.medicalfileno
                               FROM cashvoucher_info ci
                               WHERE ci.paymentcode='$salcode'"; 
                            $query2= mysqli_query($connect,$sql2);  
                            while($row = $query2->fetch_assoc()):
                            echo "
                            <div id='heading' style='width:780px;background-color:#e8eaed;'>
                                <div style='width:100%;text-align:center;font-weight: bold;font-size:22px;'>
                                     ইস্টার্ণ রিফাইনারী লিমিটেড
                                </div>
                                <table style='width:100%;'>
                                  <tr>
                                     <td style='width:20%;text-align:center;border:1px solid black;'>বেতন কোডঃ
                                      <span>&nbsp; ".$row['paymentcode']."</span></td>
                                     <td style='width:80%;padding-left:220px;'>চট্টগ্রাম</td>
                                  </tr>
                                </table>
                                <div style='text-align:center;font-weight: bold;font-size:17px;text-decoration-line: underline;'>
                                    ছুটির আবেদনপত্র<br>
                                </div>  
                            </div>";
                            echo "<div class='leavereportbody' id='leavereportbody' style='width:780px;float:left;background-color:#e8eaed;'> 
                            <div style='width:780px;clear: both;'>
                                 <table style='table-layout: fixed;width: 100%;'>
                                    <tr>
                                        <td style='width:10%;'>১। নামঃ </td>
                                        <td class='lapformunder' style='width:40%;border-bottom: 1px solid black;text-align:center;'>".$row['uname']."</td>
                                        <td style='width:10%;'>২। পদবীঃ </td>
                                        <td class='lapformunder' style='width:40%;'>".$row['designation']."</td>
                                    </tr>
                                 </table>
                                <table style='table-layout: fixed;width: 100%;'>
                                    <tr style='width:100%;'>
                                        <td style='width:15%;'>৩। শাখা/বিভাগ:</td>
                                        <td class='lapformunder' style='width:20%;'>".$row['Dept']."</span></td>
                                        <td style='width:15%;'>৪। ছুটির কারনঃ </td>
                                        <td class='lapformunder' style='width:30%;'>$reasonofleave</td>
                                        <td style='width:11%;'>৫। ছুটির ধরনঃ</td> 
                                        <td class='lapformunder' style='width:9%;'>$leavetype </td>
                                    </tr>
                                </table>
                                <table style='table-layout:fixed;width: 100%;'>
                                    <tr style='width:100%;'>
                                        <td style='width:15%;'>৬। ছুটির সময়সীমা : </td>
                                        <td class='lapformunder' style='width:30%;'> $startofleave</td>
                                        <td style='width:5%;'>হতে</td>
                                        <td class='lapformunder' style='width:30%;'>$endofleave</td>
                                        <td style='width:10%;'>পর্যন্ত মোট </td>
                                        <td class='lapformunder' style='width:5%;'>$datediff</td>
                                        <td>দিন</td>
                                    </tr>
                                </table>
                                <table style='table-layout: fixed;width: 100%;'>
                                    <tr style='width:100%;'>
                                        <td style='width:13%;'>৭।প্রারম্ভযুক্ত দিন</td>
                                        <td class='lapformunder' style='width:37%;'></td>
                                        <td style='width:12%;'>প্রত্যয়যুক্ত দিনে</td>
                                        <td class='lapformunder' style='width:38%;'></td>
                                    </tr>
                                </table>
                                <table style='table-layout: fixed;width: 100%;'>
                                    <tr style='width:100%;'>
                                        <td style='width:40%;'>৮। ছুটি উপভোগকালীন তারবার্তা দপ্তরসহ পূর্ণ ঠিকানা </td>
                                        <td class='lapformunder' style='width:60%;'></td>
                                    </tr>
                                   
                                </table>
                                <table style='table-layout: fixed;width: 100%;'>
                                 <tr style='width:100%;'>
                                        <td style='width:100%;border-bottom:1px solid black;'>&nbsp</td>
                                    </tr>
                                </table>
                                <table style='table-layout: fixed;width: 100%;'>
                                    <tr style='width:100%;'>
                                        <td style='width:55%;padding-top:5px;'>৯।_____________________ইং সনের ভ্রমন(LFA) ভাতা সহ।</td>
                                        <td style='width:20%;padding-top:5px;'> ১০।অর্জিত ছুটির নগদায়নঃ </td>
                                        <td style='width:25%;border-bottom:1px solid black;padding-top:5px;'></td>
                                    </tr>
                                </table>
                                <br>
                                 <div style='padding-top:5px;'>
                                    <span style='float:right;'>আবেদনকারীর স্বাক্ষর:______________</span><br>
                                    <span style='float:right;'>তারিখ:______________</span><br>
                                 </div>
                          
                                <div>
                                 <span style='border-bottom: 1px solid;font-weight: bold;'>সুপারিশকারী কর্মকর্তা দ্বারা ঊর্ধ্বতন কর্মকর্তার সাথে আলোচনান্তে পূরণীয় :</span>
                                </div>
                                <div style='width:100%;padding-top:5px;'>
                                <span>(ক)আবেদনকারীকে____________ইং তারিখ হতে ______________ ইং তারিখ পর্যন্ত মোট __________দিনের জন্য <br>ছুটি দেয়া যেতে পারে।<br></span>
                                <span>(খ)আবেদনকারীর ছুটি মঞ্জুর হলে জনাব ___________________________________ তাঁর কাজ দেখাশোনা করবেন।</span><br>
                                <span>(গ)আপাতত ছুটি দয়া যাবে না। তিনি ভবিষ্যতে________________________ইং তারিখ হতে এ ছুটি ভোগ করতে পারবেন।</span><br><br>
                                    <span style='float:right;'>সুপারিশকৃত কর্মকর্তার স্বাক্ষর :______________</span><br>
                                    <span style='float:right;'>পদবি:______________</span><br>
                                    <span style='float:right;'>তারিখ:______________</span><br>
                                    <span style='border-bottom: 1px solid;font-weight: bold;'>মঞ্জুরি কর্মকর্তার স্বাক্ষর </span><br>
                                    <span>বি: দ্র: ১। অসুস্থতা বশত : ছুটি হলে প্রতিষ্ঠান চিকিৎসক প্রদত্ত সার্টিফিকেট গেঁথে দিতে হবে  </span><br>
                                    <span>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp২। ছুটিকালীন যাতায়াত সাহায্য (এল এফ  এ ) গ্রহনেচ্ছু আবেদনকারীকে 
                                     এরসাথে নির্দিষ্ট ফর্ম পূরণ করে দিতে হবে।  </span>
                                  
                                </div>
                                
                            </div>
                                
                    
                            </div>";
                        endwhile;
                          echo  "</div>";
                        }
                        ?>

                        </div>
                    </div>
                </div>
            </div>
                            <script type="text/javascript">

                    document.getElementById("printcmd").onclick = function() {
                        printElement(document.getElementById("leavereport"));
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
            <div class="cleaner h80"></div>
            <?php
        include("footer.php");
    ?>
        </div>

</body>

</html>
