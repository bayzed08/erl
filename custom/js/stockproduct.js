
 $(document).ready(function() {
     //TOGGLE স্টক প্রোডাক্ট লিস্ট
     $("#stockProductHead").click(function() {
             $("#stockProductBody").toggle(600);
     })
     //Toggle productBrand List
     $("#ProductBrandHead").click(function() {
        $("#ProductBrandBody").toggle(600);
     })

     //Toggle Add productBrand List
     $("#AddBrandHead").click(function() {
        $("#AddBrandBody").toggle(600);
    })
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
