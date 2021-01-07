$(document).ready(function() {
    //To show cashvoucher form
    $("#DDReport").click(function() {
            $("#Dreportshow").toggle(600);
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

    //for printing
    document.getElementById("printcmd").onclick = function() {
        printElement(document.getElementById("dreport"));
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

    // function printDiv(dreport) {
    //     var restorepage = document.body.innerHTML;
    //     var printcontent = document.getElementById(dreport).innerHTML;
    //     document.body.innerHTML = printcontent;
    //     document.title = 'Cashvoucher-<?php echo date("d-m-Y") . '_' . date("h_i") ?>';
    //     window.print();
    //     document.body.innerHTML = restorepage;
    // }

});