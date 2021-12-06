<?php
$output=null;
require_once 'db_connect.php';
if(isset($_POST['submit12']))
{
    
    $cashdesc=$_POST['cashdesc'];
    $cashamount=$_POST['cashamount'];
    $billtype=$_POST['billtype'];
    foreach($cashdesc as $key=>$value)
    {
        echo $cashdesc[$key];
        $query="insert into ebill.claimedbill (billingdate,Billtypeid,IsReceipt,billtype) 
        values('".$cashdesc[$key]."',
        '".$cashamount[$key]."',
        '".$billtype."')";
        $insert=mysqli_query($connect,$query);
        mysqli_commit($connect);
        if($insert)
        {
            $output.="<p>successfully added</p>";
        }
    }
}
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
    <!-- for printing -->
    <script language="javascript">
        function printDiv(dreport) {
            var restorepage = document.body.innerHTML;
            var printcontent = document.getElementById(dreport).innerHTML;
            document.body.innerHTML = printcontent;
            document.title = 'Cashvoucher-<?php echo date("d-m-Y").'_'.date("h_i") ?>';
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
                    <h3 id="DDReport">Cash Voucher</h3>
                    <hr>
                    <div id="Dreportshow">
                        <form id="ssdreportform" method="post" action="<?php echo $_SERVER['PHP_SELF'];?>">
                            <div class="form-group" style="width:100%;"> User Name:
                                <?php
                            //$sql1="SELECT ci.uname uname FROM CashVoucher_Info ci";
                            //$query1=mysqli_query($connect,$sql1);
                            ?>
                                <!------------------->
                                <input id="search" name="search" type="text">
                                <div id="result"></div>
                                <script>
                                    $("#search").on("input", function() {
                                        $search = $("#search").val();
                                        if ($search.length > 0) {
                                            $.get("res.php", {
                                                "search": $search
                                            }, function($data) {
                                                $("#result").fadeIn();
                                                $("#result").html($data);

                                            })
                                        }
                                        $(document).on('click', 'li', function() {
                                            $('#search').val($(this).text());
                                            $('#result').fadeOut();
                                        });
                                    });
                                 //for check 
                                    function showdinput(checked)
                                    {
                                        if(checked)
                                            $("#dinput").fadeIn();
                                        else
                                            $("#dinput").fadeOut();       
                                    }
                                </script>
                                <input type="checkbox" name="billtype" value="medical"> Medical
                                <input type="checkbox" name="billtype" value="transport" onchange="showdinput(this.checked)">Transport
                                <input type="checkbox" name="billtype" value="Pettycash">Pettycash
                                <input type="checkbox" name="billtype" value="tada">TA DA  
                                <div class="row" id="dinput" style="display:none">
                                    <div class="col-sm-7"><input style="width:100%" type="text" name="cashdesc[]" placeholder="Description:">
                                    </div>
                                    <div class="col-sm-3">
                                        <input style="width:100%" type="number" name="cashamount[]" placeholder="Amount: ">
                                    </div>
                                    <div class="col-sm-2">
                                        <a href="#" id="add">Add More</a>
                                    </div>
                                </div>
                                <div></div>
                                <!-- //now script for dynamic input-->
                                <script>
                                    $(document).ready(function(e) {
                                        //varaiables
                                        var html ='<p><div>&nbsp&nbsp<input type="text" style="width:57%" name="cashdesc[]" id="childdesc" placeholder="Description: "> &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp<input type="number" name="cashamount[]" id="childamount" placeholder="Amount: "><a href="#" id="remove">Remove</a></div></p>';
                                       
                                        //add rows o the form
                                        $("#add").click(function() {
                                            $("#dinput").append(html);
                                        });
                                        //remove rows from
                                        $("#dinput").on('click', '#remove', function(e) {
                                            $(this).parent('div').remove();
                                        });
                                        //populate values from first row
                                    });

                                </script>

                                <button id="sdreport" type="submit" class="btn btn-primary" name="submit12" onSubmit="document.getElementById('Dreportshow').style.display='block'">submit
                                </button>
                            </div>
                        </form>
                        <div style="float:right;">
                            <button type="button" class="btn btn-default btn-md" onclick="printDiv('dreport')" id="printcmd" value="PrintDiv"> <span class="glyphicon glyphicon-print"></span> Print </button>
                        </div>
                        <br>
                        <br>
                        <div class="dreport" id="dreport">
                        

                        </div>
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
