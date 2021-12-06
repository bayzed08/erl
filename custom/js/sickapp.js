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