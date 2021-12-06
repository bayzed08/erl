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

                    <!--Show stock Product List-->
                    <div class="col-sm-6 text-left" id="stockProductList">
                        <hr>
                        <h3 id="stockProductHead" style="text-align:center;color:#0070d0;cursor:pointer;">Product Model List<span class="glyphicon glyphicon-menu-down"></span> </h3>
                        <hr>
                        <div id="stockProductBody" style="display:none;height:500px;overflow:scroll;background-color:#ccd0d4;padding:10px;border-radius:10px;box-shadow: 0 10px 20px rgba(0,0,0,0.19), 0 6px 6px rgba(0,0,0,0.23);">
                            <?php
                            $sql555 = "SELECT sp.Productname,
                                            spm.model
                                    FROM stockproduct sp,stockproductmodel spm
                                    WHERE sp.id=spm.productid
                                    ORDER BY sp.Productname,spm.model";
                            $result555 = mysqli_query($connect, $sql555);
                            echo "<table style='width:100%;background-color:#dbdde0;'>";
                            echo "<tr style='font-size:16px;padding:10px;'>
                                                    <th style='width:2%;border:1px solid black;text-align:center;'>No</th>
                                                    <th style='width:40%;border:1px solid black;text-align:center;'>Product Category</th>
                                                    <th style='width:50%;border:1px solid black;text-align:center;'>ProductModel</th>
                                    </tr>";
                            $i = 0;
                            while ($row555 = $result555->fetch_assoc()) :
                                ++$i;
                                echo "<tr style='font-size:13px;font-family:Tahoma;padding:2px;'>
                                        <td style='border:1px solid black;text-align:center;'>$i</td>
                                        <td style='border:1px solid black;text-align:center;font-size: 11px;'>" . $row555['Productname'] . "</td>
                                        <td class='text-capitalize' style='border:1px solid black;text-align:left;padding-left:5px;font-size: 11px;'>" . $row555['model'] . "</td>

                                </tr>";
                            endwhile;
                            echo "</table>";
                            ?>
                        </div>
                    </div>
                    <!--Show stock Product Brand List-->
                    <div class="col-sm-6 text-left" id="ProductBrandList">
                        <hr>
                        <h3 id="AddBrandHead" style="text-align:center;color:#0070d0;cursor:pointer;">Add New Brand<span class="glyphicon glyphicon-menu-down"></span> </h3>
                        <hr>
                        <div id="AddBrandBody" style="display:none;background-color:#ccd0d4;padding:10px;border-radius:10px;box-shadow: 0 10px 20px rgba(0,0,0,0.19), 0 6px 6px rgba(0,0,0,0.23);">
                            <div id="msg" style="width:100%;float:float-lg-none"></div>
                            <form id="brandDataform" name="brandDataform">
                                <div class="form-group" style="width:100%;">
                                    <div class="form-group row">
                                        <label for="productnamesearch" class="col-sm-4 col-form-label" style="padding:4px;text-align:right;">পন্যের নামঃ</label>
                                        <div class="col-sm-8">
                                            <input type="text" name="productnamesearch" id="productnamesearch" class="form-control" placeholder="Product Name" autocomplete="off" required>
                                            <div id="resultproduct"></div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="supplyunit" class="col-sm-4 col-form-label" style="padding:4px;text-align:right;">ব্র্যান্ডের নামঃ</label>
                                        <div class="col-sm-8">
                                            <input type="text" name="brandname" id="brandname" class="form-control" placeholder="Brand Name" autocomplete="off" required>
                                        </div>
                                    </div>
                                    <br>
                                    <div class="form-group row">
                                        <div class="col-sm-4"></div>
                                        <div class="col-sm-8">
                                            <button id="submit12" name="submit12" type="submit" class="btn btn-primary">submit
                                            </button>
                                        </div>
                                    </div>

                                </div>
                            </form>
                        </div>
                        <hr>
                        <h3 id="ProductBrandHead" style="text-align:center;color:#0070d0;cursor:pointer;"> Product Brand List<span class="glyphicon glyphicon-menu-down"></span> </h3>
                        <hr>
                        <div id="ProductBrandBody" style="display:none;height:500px;overflow:scroll;background-color:#ccd0d4;padding:10px;border-radius:10px;box-shadow: 0 10px 20px rgba(0,0,0,0.19), 0 6px 6px rgba(0,0,0,0.23);">
                            <?php
                            $sql555 = "SELECT sp.Productname,
                                                spb.brandname
                                        FROM stockproduct sp,stockproductbrand spb
                                        WHERE sp.id=spb.productid
                                        ORDER BY sp.Productname,spb.brandname";
                            $result555 = mysqli_query($connect, $sql555);
                            echo "<table style='width:100%;background-color:#dbdde0;'>";
                            echo "<tr style='font-size:16px;padding:10px;'>
                                                    <th style='width:2%;border:1px solid black;text-align:center;'>No</th>
                                                    <th style='width:40%;border:1px solid black;text-align:center;'>Category</th>
                                                    <th style='width:50%;border:1px solid black;text-align:center;'>ProductBrand</th>
                                    </tr>";
                            $i = 0;
                            while ($row555 = $result555->fetch_assoc()) :
                                ++$i;
                                echo "<tr style='font-size:13px;font-family:Tahoma;padding:2px;'>
                                        <td style='border:1px solid black;text-align:center;'>$i</td>
                                        <td style='border:1px solid black;text-align:center;font-size: 11px;'>" . $row555['Productname'] . "</td>
                                        <td class='text-capitalize' style='border:1px solid black;text-align:left;padding-left:5px;font-size: 11px;'>" . $row555['brandname'] . "</td>

                                </tr>";
                            endwhile;
                            echo "</table>";
                            ?>
                        </div>
                    </div>
                </div>
                <div class="cleaner h80"></div>
                <script type="text/javascript" src="custom/js/stockproduct.js"></script>
                <script type="text/javascript" src="assist/datatables/datatables.min.js"></script>
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