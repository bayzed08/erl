$(document).ready(function () {
    $("#loginform").submit(function () {
        $("#msg").html("");
        if ($("#username").val() == "" || $("#password").val() == "") {
            $("#msg").html('<div class="alert alert-warning alert-dismissible" role="alert">' +
                '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>' +
                '<strong><span class="glyphicon glyphicon-exclamation-sign"></span> </strong>' + "Fill both username and password please" +
                '</div>').fadeIn(1000).fadeOut(3000);
                
        } else {
            var form = $(this);
            $.ajax({
                url: form.attr('action'),
                type: form.attr('method'),
                data: form.serialize(),
                dataType: 'json',
                success: function (response) {
                    if (response.success == true) {
                        $("#msg").html('<div class="alert alert-success alert-dismissible" role="alert">' +
                            '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>' +
                            '<strong><span class="glyphicon glyphicon-ok-sign"></span> </strong>' + response.messages +
                            '</div>').fadeIn(1000).fadeOut(2000).end();
                        //window.location.href='acknowledgment.php';
                        $("#loginform").hide(500);
                        setTimeout(function () { // wait for 5 secs(2)
                            window.location.href = 'acknowledgment.php'; // then reload the page.(3)
                        }, 500);

                    } else {
                        $("#msg").html('<div class="alert alert-warning alert-dismissible" role="alert">' +
                            '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>' +
                            '<strong><span class="glyphicon glyphicon-exclamation-sign"></span> </strong>' + response.messages +
                            '</div>').fadeIn(1000).fadeOut(3000);
                        $("#loginform")[0].reset();
                    }
                }
            });
        }
        return false;
    });
});

//// password change 
$(document).ready(function () {
    $("#btncngpass").click(function () {
        $("#passcngbody").slideToggle(900);
    })
    //submit password change form
    $("#passwdchangeform").on('submit', function (e) {
        e.preventDefault();
        //$("#msg").html("");
        $.ajax({
            url: 'loginpassChange.php',
            type: 'POST',
            data: $('#passwdchangeform').serialize(),
            success: function (data) {
                if(data=='Change password successfully')
                    {
                    $("#passcngbody").hide(2000);
                    $("#msg2").html('<div class="alert alert-success alert-dismissible" role="alert">' +
                    '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>' +
                    '<strong><span class="glyphicon glyphicon-ok-sign"></span> </strong>' +data+
                    '</div>').fadeIn(3000).fadeOut(2000); 
                    $('#passwdchangeform')[0].reset();
                    }
                else 
                    {
                    $("#msg2").html('<div class="alert alert-success alert-dismissible" role="alert">' +
                    '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>' +
                    '<strong><span class="glyphicon glyphicon-ok-sign"></span> </strong>' +data+
                    '</div>').fadeIn(3000).fadeOut(3000);
                    $('#passwdchangeform')[0].reset();
                        
                    }
               
            }
        });
    });
});

















