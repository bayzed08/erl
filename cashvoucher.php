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
                    <h3 id="DDReport" class="DDReport">নগদ ভাউচার </h3>
                    <hr>
                    <div id="Dreportshow">
                        <div id="cashform">
                            <br>
                            <form id="cashvoucherdataform" name="cashvoucherdataform">
                                <!-- data inserted by ajax jquery in cashviucher.js -->
                                <div class="form-group row">
                                    <label for="search" class="col-sm-2 col-form-label" style="padding:5px;text-align:right;"><span class="glyphicon glyphicon-user"></span></label>
                                    <div class="col-sm-8">
                                        <input class="form-control" id="search" name="search" type="text" placeholder="ব্যবহারকারীর নামঃ " autocomplete="off" required>
                                        <div id="result"></div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="cashVouchertype" class="col-sm-2 col-form-label" style="padding:8px;text-align:right;"><span class="glyphicon glyphicon-ok"></span></label>
                                    <div class="col-sm-8">
                                        <select class="form-control" name="cashVouchertype" id="cashVouchertype">
                                            <option name="typeofCashVoucher" value="Pettycash Bill">Petty Cash</option>
                                            <option name="typeofCashVoucher" value="Medical Bill">Medical</option>
                                            <option name="typeofCashVoucher" value="Transport Bill">Transport</option>
                                            <option name="typeofCashVoucher" value="TA DA Bill">TA DA</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="cashdesc1" class="col-sm-2 col-form-label" style="padding:5px;text-align:right;"><span class="glyphicon glyphicon-align-justify"></span></label>
                                    <div class="col-sm-8">
                                        <input type="text" name="cashdesc1" id="cashdesc1" class="form-control" placeholder="বিবরণঃ ১" required>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="cashdesc2" class="col-sm-2 col-form-label" style="padding:5px;text-align:right;"><span class="glyphicon glyphicon-align-justify"></span></label>
                                    <div class="col-sm-8">
                                        <input type="text" name="cashdesc2" id="cashdesc2" class="form-control" placeholder="বিবরণঃ ২">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="cashamount" class="col-sm-2 col-form-label" style="padding:5px;text-align:right;"><span class="glyphicon glyphicon-usd"></span></label>
                                    <div class="col-sm-8">
                                        <input type="number" name="cashamount1" id="cashamount1" class="form-control" placeholder="টাকায় পরিমানঃ ১" required>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="cashamount2" class="col-sm-2 col-form-label" style="padding:5px;text-align:right;"><span class="glyphicon glyphicon-usd"></span></label>
                                    <div class="col-sm-8">
                                        <input type="number" name="cashamount2" id="cashamount2" class="form-control" placeholder="টাকায় পরিমানঃ ২">
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
                            <div id="msg" style="width:760px;float:float-lg-none"></div>
                        </div>
                    </div>
                </div>
                <!--Show cashvoucher data then print and delete-->
                <div class="col-sm-12 text-left" id="cashVshowprintandDelete">
                    <hr>
                    <h3 id="cashshowtitle" class="DDReport">নগদ ভাউচারের ইতিহাস <span class="glyphicon glyphicon-menu-down"></span> </h3>
                    <hr>
                    <div class="removeMessages"></div>
                    <div id="cashvouchertabshow">
                        <?php
                        include("cashvoucher_show_hist.php");
                        ?>
                    </div>
                    <!--modal for delete data-->
                    <div class="modal fade" tabindex="-1" role="dialog" id="deleteCashVData">
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
                    <div class="modal fade" tabindex="-1" role="dialog" id="printCashVData">
                        <div class="modal-dialog" style="width:70%;">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>

                                </div>
                                <div id="printThis">
                                    <div class="modal-body" id="cashVprintmodal"></div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-default" data-dismiss="modal" id="Nobtn">Close</button>
                                    <button id="btnPrint" type="button" class="btn btn-default">Print</button>
                                </div>
                            </div><!-- /.modal-content -->
                        </div><!-- /.modal-dialog -->
                    </div>
                </div>
            </div>
        </div>

        <div class="cleaner h80"></div>
        <?php
        include("footer.php");
        ?>
    </div>
    <script type="text/javascript" src="custom/js/cashVoucher.js"></script>
    <script type="text/javascript">
        document.getElementById("btnPrint").onclick = function() {
            printElement(document.getElementById("printThis"));
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
</body>

</html>