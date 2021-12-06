 //Name Search
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

 //product Search
 $("#productnamesearch").on("input", function() {
     $productnamesearch = $("#productnamesearch").val();
     if ($productnamesearch.length > 0) {
         $.get("resproductname.php", {
             "productnamesearch": $productnamesearch
         }, function($data1) {
             $("#resultproduct").fadeIn();
             $("#resultproduct").html($data1);
         });
     } else {
         $("#resultproduct").fadeOut();
     }
     $(document).on('click', 'li', function() {
         $('#productnamesearch').val($(this).text());
         $('#resultproduct').fadeOut();
     });
 });
 //product MODEL Search (acknowlwdge.php/cashvoucher)
 $("#modelname").on("input", function() {
     $modelname = $("#modelname").val();
     $productnamesearch = $("#productnamesearch").val();
     if ($modelname.length > 0) {
         $.get("resmodelname.php", {
             "productnamesearch": $productnamesearch,
             "modelname": $modelname
         }, function($data1) {
             $("#resultmodel").fadeIn();
             $("#resultmodel").html($data1);
         });
     } else {
         $("#resultmodel").fadeOut();
     }
     $(document).on('click', 'ul', function() {
         $('#modelname').val($(this).text());
         $('#resultmodel').fadeOut();
     });
 });
 // SenderName Search For IDM.php
 $("#sendernamesearch").on("input", function() {
     $search = $("#sendernamesearch").val();
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
         $('#sendernamesearch').val($(this).text());
         $('#result').fadeOut();
     });
 });
 // Receiver Name Search For IDM.php
 $("#receivernamesearch").on("input", function() {
     $search = $("#receivernamesearch").val();
     if ($search.length > 0) {
         $.get("res2idm.php", {
             "search": $search
         }, function($data) {
             $("#result2").fadeIn();
             $test = $("#result2").html($data);
         });
     } else {
         $("#result2").fadeOut();
     }
     $(document).on('click', 'ul', function() {
         $('#receivernamesearch').val($(this).text());
         $('#result2').fadeOut();
     });
 });


 //TOGGLE ACKNOWLEDGEMENT PAPER/HISTORY/report
 $(document).ready(function() {
     //prpatoswikar potro form
     $("#DDReport").click(function() {
             $("#Dreportshow").toggle(600);
         })
         // FOR SHOWING of HISTORY ACKNOWLEDGEMENT 2
     $("#ackshowtitle").click(function() {
         // $("#myModal").css("display", "block");
         $("#acktabshow").slideToggle(600);
     })
     $("#ack_report").click(function() {
         // $("#myModal").css("display", "block");
         $("#ack_report_show").slideToggle(600);
     })

 });


 /////////////////For Deleting Praptiswikar from db
 //$(document).ready(function () {
 function deleteAck_hist(serialno) {

     if (serialno) { //click on remove button
         $(".removeMessages").html("");
         $("#removeBtn").unbind('click').bind('click', function() {
             $.ajax({
                 url: 'ack_historyDelete.php',
                 type: 'POST',
                 data: {
                     serialno: serialno
                 },
                 dataType: 'json',
                 success: function(response) {
                     if (response.success == true) {
                         $(".removeMessages").html('<br><div class="alert alert-success alert-dismissible" role="alert">' +
                             '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>' +
                             '<strong> <span class="glyphicon glyphicon-ok-sign"></span> </strong>' + response.messages +
                             '</div>').fadeIn(500).fadeOut(3000);
                         setTimeout(function() { // wait for 5 secs(2)
                             //   $('#ackshowprintandDelete').load(' #ackshowprintandDelete'); //reload only ackshowprintandDelete have some problem
                             window.location.href = 'acknowledgment.php'; // then reload the page.(3)
                         }, 2000);
                         $("#deleteAckData").modal('hide');;

                     } else {
                         $(".removeMessages").html('<div class="alert alert-warning alert-dismissible" role="alert">' +
                             '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>' +
                             '<strong> <span class="glyphicon glyphicon-exclamation-sign"></span> </strong>' + response.messages +
                             '</div>').fadeIn(500).fadeOut(3000);
                         setTimeout(function() {
                             window.location.href = 'acknowledgment.php'; // then reload the page.(3)
                         }, 2000);
                         $("#deleteAckData").modal('hide');
                     }
                 }
             });
         });
     } else {
         alert("Error: refresh the page again");
     }
 }
 //});
 //
 /////////////////For printing  Praptiswikar from db ACK 2
 function printAck_hist(serialno) {
     if (serialno) {
         $.ajax({
             url: 'ack_historyPrint.php',
             type: 'POST',
             data: { serialno: serialno },
             success: function(data) {
                 $("#ackprintmodal").html(data);
                 $("#printAckData").modal("show");
             }
         });
     } else {
         alert("Error: refresh the page again");
     }
 }


 //insert acknowledgement data
 $(document).ready(function() {
     $('#ackDataform').on('submit', function(e) {
         e.preventDefault();
         $("#msg").html("");
         $.ajax({
             url: 'ack_insert.php',
             type: 'post',
             data: $('#ackDataform').serialize(),
             success: function(data) {
                 if (data = 'OK') {
                     $("#msg").html('<div class="alert alert-success alert-dismissible" role="alert">' +
                         '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>' +
                         '<strong><span class="glyphicon glyphicon-ok-sign"></span> </strong>' + "Successfully Inserted" +
                         '</div>').fadeIn(2000).fadeOut(2000);
                     $('#ackDataform')[0].reset();
                     setTimeout(function() {
                         //$('#ackshowprintandDelete').load(' #ackshowprintandDelete'); // for only reload ackshowprintandDelete ...but some problem
                         window.location.href = 'acknowledgment.php';
                     }, 2000);

                 } else {
                     $("#msg").html('<div class="alert alert-success alert-dismissible" role="alert">' +
                         '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>' +
                         '<strong><span class="glyphicon glyphicon-ok-sign"></span> </strong>' + "NOT Inserted" +
                         '</div>').fadeIn(1000).fadeOut(2000);
                     setTimeout(function() { // wait for 5 secs(2)
                         //  $('#ackshowprintandDelete').load(' #ackshowprintandDelete'); // then reload the page.(3)
                         window.location.href = 'acknowledgment.php';
                     }, 2000);
                 }
             }
         });
         return false;
     });
 });
 //////////////
 // For ACK monthly Report
 $(document).ready(function() {
     $('#ack_report_form').on('submit', function(e) {
         e.preventDefault();
         $.ajax({
             url: 'ack_ReportPrint.php',
             type: 'POST',
             data: $('#ack_report_form').serialize(),
             success: function(data) {
                 $("#ackReportmodal").html(data);
                 $("#ReportAckData").modal("show");
             }
         });
         return false;
     });

 });



 // search in প্রাপ্তিস্বীকার পত্রের ইতিহাস
 function searchFromPname() {
     var input, filter, table, tr, td, cell, i, j;
     input = document.getElementById("myinput");
     filter = input.value.toUpperCase();
     table = document.getElementById("AckTabData");
     tr = table.getElementsByTagName("tr");
     for (i = 1; i < tr.length; i++) {
         // Hide the row initially.d
         tr[i].style.display = "none";

         td = tr[i].getElementsByTagName("td");
         for (var j = 0; j < td.length; j++) {
             cell = tr[i].getElementsByTagName("td")[j];
             if (cell) {
                 if (cell.innerHTML.toUpperCase().indexOf(filter) > -1) {
                     tr[i].style.display = "";
                     break;
                 }
             }
         }
     }
 }