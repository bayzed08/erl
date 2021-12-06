<!DOCTYPE html>
<html lang="en">

<head>
    <title>Acknowledgement Login</title>
    <?php
        include("header.php");
    require_once 'db_connect.php';
    ?>
    <script type="text/javascript" src="custom/js/loginjs.js"></script>
</head>

<body>
    <div class="container">
        <?php
        include("menu.php");
    ?>

        <div class="container-fluid text-center">
            <div class="row content">

                <div id="loginbox" style="margin-top:50px;" class="mainbox col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2">
                    <div class="panel panel-info">
                        <div class="panel-heading">
                            <div class="panel-title">Sign in here to go Acknowledgement page</div>
                        </div>
                        <div id="msg"></div>
                        <div style="padding-top:30px" class="panel-body">
                            <div style="display:none" id="login-alert" class="alert alert-danger col-sm-12"></div>
                            <form id="loginform" class="form-horizontal" action="loginCheck.php" method="post">
                                <div style="margin-bottom: 25px" class="input-group">
                                    <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                                    <input id="username" type="text" class="form-control" name="username" value="" placeholder="username" autocomplete="off">
                                </div>
                                <div style="margin-bottom: 25px" class="input-group">
                                    <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
                                    <input id="password" type="password" class="form-control" name="password" placeholder="password" autocomplete="off">
                                </div>
                                <div style="margin-top:10px" class="form-group">
                                    <!-- Button -->
                                    <div class="col-sm-12 controls">
                                        <button type="submit" id="submit">Login</button>
                                        <!--a id="btn-login" href="logincheck.php" class="btn btn-success">Login </a-->
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div id="passwdchange" style="margin-top:5px;" class="mainbox col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2">
                    <div class="panel panel-info">
                       <div class="panel-heading">
                           <button id="btncngpass"><div class="panel-title">Change password here</div></button>
                       </div> 
                       <div id="msg2"></div>
                        <div id="passcngbody" style="display:none;">
                                 
                            <div style="padding-top:30px" class="panel-body">
                            <!--<div style="display:none" id="passwdchange-alert" class="alert alert-danger col-sm-12"></div>-->
                            <form id="passwdchangeform" class="form-horizontal">
                                <div style="margin-bottom: 10px" class="input-group">
                                    <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                                    <input id="username2" type="text" class="form-control" name="username2" value="" placeholder="username" autocomplete="off" required>
                                </div>
                                <div style="margin-bottom: 10px" class="input-group">
                                    <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
                                    <input id="oldpassword" type="password" class="form-control" name="oldpassword" placeholder="Current Password" autocomplete="off" required>
                                </div>
                                <div style="margin-bottom: 10px" class="input-group">
                                    <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
                                    <input id="npassword" type="password" class="form-control" name="npassword" placeholder="New Password" required>
                                </div>
                                <div style="margin-bottom: 10px" class="input-group">
                                    <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
                                    <input id="npassword2" type="password" class="form-control" name="npassword2" placeholder="New Password again" required>
                                </div>
                                 <div style="margin-top:10px" class="form-group">
                                    <!-- Button -->
                                    <div class="col-sm-4 controls">
                                        <input class="btn btn-primary" type="submit" id="submitc" name="submitc" value="Change My Password">
                                        <!--<button type="submit" id="submitc" name="submitc"></button>-->
                                        <!--a id="btn-login" href="logincheck.php" class="btn btn-success">Login </a-->
                                    </div>
                                </div>
                            </form>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
        <div class="cleaner h30"></div>
        <?php
        include("footer.php");
    ?>
    </div>

</body>

</html>
