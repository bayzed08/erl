$(document).ready(function() {
    //To show cashvoucher form
    $("#DDReport").click(function() {
            $("#Dreportshow").toggle(600);
    })

        //Toggle Cashvoucher History show or Hide
        $("#cashshowtitle").click(function () {
            // $("#myModal").css("display", "block");
            $("#cashvouchertabshow").slideToggle(600);
        })
        // finding user
    $("#search").on("input", function() {
        $search = $("#search").val();
        if ($search.length > 0) {
            $.get("res.php", {
                "search": $search
            }, function($data) {
                $("#result").fadeIn();
                $test = $("#result").html($data);
            });
        } else {
            $("#result").fadeOut();
        }
        $(document).on('click', 'ol', function() {
            $('#search').val($(this).text());
            $('#result').fadeOut();
        });
    });


    // for inserting cashvoucher data in database
    $('#cashvoucherdataform').on('submit', function (e) {
        e.preventDefault();
        $("#msg").html("");
        //console.log( $( this ).serialize() );
        $.ajax({
            url: 'cashvoucher_insert.php',
            type: 'post',
            data: $('#cashvoucherdataform').serialize(),
            success: function (data) {
                if (data = 'OK') {
                    $("#msg").html('<div class="alert alert-success alert-dismissible" role="alert">' +
                        '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>' +
                        '<strong><span class="glyphicon glyphicon-ok-sign"></span> </strong>' + "Successfully Inserted" +
                        '</div>').fadeIn(2000).fadeOut(2000);
                    $('#cashvoucherdataform')[0].reset();
                    setTimeout(function () {
                        //$('#ackshowprintandDelete').load(' #ackshowprintandDelete'); // for only reload ackshowprintandDelete ...but some problem
                        window.location.href = 'cashvoucher.php';
                    }, 2000);

                } else {
                    $("#msg").html('<div class="alert alert-success alert-dismissible" role="alert">' +
                        '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>' +
                        '<strong><span class="glyphicon glyphicon-ok-sign"></span> </strong>' + "NOT Inserted" +
                        '</div>').fadeIn(1000).fadeOut(2000);
                    setTimeout(function () { // wait for 5 secs(2)
                        //  $('#ackshowprintandDelete').load(' #ackshowprintandDelete'); // then reload the page.(3)
                        window.location.href = 'cashvoucher.php';
                    }, 2000);
                }
            }
        });
        return false;
    });



});


//Delete Cashvoucher History data or
function deleteCashV_hist(cashvoucherid) {
    if (cashvoucherid) { //click on remove button
        $(".removeMessages").html("");
        $("#removeBtn").unbind('click').bind('click', function () {
            $.ajax({
                url: 'cashvoucher_historyDelete.php',
                type: 'POST',
                data: {
                    cashvoucherid: cashvoucherid
                },
                dataType: 'json',
                success: function (response) {
                    if (response.success == true) {
                        $(".removeMessages").html('<br><div class="alert alert-success alert-dismissible" role="alert">' +
                            '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>' +
                            '<strong> <span class="glyphicon glyphicon-ok-sign"></span> </strong>' + response.messages +
                            '</div>').fadeIn(500).fadeOut(3000);
                        setTimeout(function () { // wait for 5 secs(2)
                            //   $('#ackshowprintandDelete').load(' #ackshowprintandDelete'); //reload only ackshowprintandDelete have some problem
                            window.location.href = 'cashvoucher.php'; // then reload the page.(3)
                        }, 2000);
                        $("#deleteCashVData").modal('hide');

                    } else {
                        $(".removeMessages").html('<div class="alert alert-warning alert-dismissible" role="alert">' +
                            '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>' +
                            '<strong> <span class="glyphicon glyphicon-exclamation-sign"></span> </strong>' + response.messages +
                            '</div>').fadeIn(500).fadeOut(3000);
                        setTimeout(function () {
                            window.location.href = 'cashvoucher.php'; // then reload the page.(3)
                        }, 2000);
                        $("#deleteCashVData").modal('hide');
                    }
                }
            });
        });
    } else {
        alert("Error: refreash the page again");
    }
}

//PRINT cashVoucherData
function printCashV_hist(cashvoucherid) {
    if (cashvoucherid) {
        $.ajax({
            url: 'cashvoucher_historyPrint.php',
            type: 'POST',
            data: {cashvoucherid: cashvoucherid},
            success: function (data) {
                $("#cashVprintmodal").html(data);
                $("#printCashVData").modal("show");
            }
        });
    } else {
        alert("Error: refresh the page again");
    }
}
