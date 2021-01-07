<!DOCTYPE html>
<html lang="en">

<head>
    <title>ERL Basic</title>
    <?php
        include("header.php");
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
                    <div id="myCarousel" class="carousel slide" data-ride="carousel">
                        <!-- Indicators -->
                        <ol class="carousel-indicators">
                            <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                            <li data-target="#myCarousel" data-slide-to="1"></li>
                            <li data-target="#myCarousel" data-slide-to="2"></li>
                        </ol>

                        <!-- Wrapper for slides -->
                        <div class="carousel-inner">
                            <div class="item active">
                                <img src="images/bg.jpg" alt="Tank" style="width:100%;height:600px; ">
                            </div>

                            <div class="item">
                                <img src="images/erl.jpg" alt="factory" style="width:100%;height:600px">
                            </div>

                            <div class="item">
                                <img src="images/erlunit22.jpg" alt="Unit 2" style="width:100%;height:600px;">
                            </div>
                        </div>

                        <!-- Left and right controls -->
                        <a class="left carousel-control" href="#myCarousel" data-slide="prev">
                            <span class="glyphicon glyphicon-chevron-left"></span>
                            <span class="sr-only">Previous</span>
                        </a>
                        <a class="right carousel-control" href="#myCarousel" data-slide="next">
                            <span class="glyphicon glyphicon-chevron-right"></span>
                            <span class="sr-only">Next</span>
                        </a>
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
