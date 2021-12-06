<!DOCTYPE html>
<html lang="en">

<head>
    <title>ERL Basic</title>
    <?php
        include("header.php");
    ?>
    <link rel="stylesheet" href="custom/css/index.css">
</head>

<body>
    <div class="container back-image">
        <?php
        include("menu.php");
        ?>
        <div class="container-fluid">
            <div class="row content">
                <div class="col-sm-12 parent-box">
                    <div class="box" id="cashvoucher">
                      <span class="glyphicon glyphicon-usd"></span> 
                      <div class="box-item">Cash Voucher</div>
                    </div>
                    <div class="box" id="sickapp">
                       <span class="glyphicon glyphicon-align-justify"></span>
                       <div class="box-item">Sick Application</div>
                    </div>
                    <div class="box" id="idm">
                      <span class="glyphicon glyphicon-list-alt"> </span>
                      <div class="box-item">IDM</div>
                    </div>
                    <div class="box" id="leaveapp">
                       <span class="glyphicon glyphicon-align-justify"></span>
                       <div class="box-item">Leave Apply</div>
                    </div>
                    <div class="box" id="casualreq">
                    <span class="glyphicon glyphicon-file"></span>
                      <div class="box-item">Casual Requisition</div>
                    </div>
                    <div class="box" id="inventory">
                      <span class="glyphicon glyphicon-tasks"></span>
                      <div class="box-item">IT inventory</div>
                    </div>
                </div>
            </div>
        </div>
        <div class="cleaner h80"></div>
        <?php
        include("footer.php");
    ?>
    </div>
    <script type="text/javascript">
    document.getElementById("cashvoucher").onclick = function () {
        location.href = "cashvoucher.php";
    };
    document.getElementById("sickapp").onclick = function () {
        location.href = "sickapp.php";
    };
    document.getElementById("idm").onclick = function () {
        location.href = "idm.php";
    };
    document.getElementById("leaveapp").onclick = function () {
        location.href = "leaveappform.php";
    };
    document.getElementById("casualreq").onclick = function () {
        location.href = "http://192.168.100.7/casualrequisition/login.php";
    };
</script>
</body>

</html>
