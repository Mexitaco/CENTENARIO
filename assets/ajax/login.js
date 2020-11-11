$(function () {
    $(".formlogin").submit(function(e) {
        e.preventDefault();

        loader(true);

        var form = $(".formlogin");
        var data = new FormData(form[0]);
        
        $.ajax({
            url: '../controllers/LoginController.php',
            data: data,
            cache: false,
            processData: false,
            contentType: false,
            type: 'POST',
            dataType: 'json',
            success: function (response) {
                loader(false);
                if(response.success){
                    location.href = "index.php";
                }
                else{
                    //swal(response.message, "", "info");
                    swal({
                        title: response.message,
                        type: 'error',
                        icon: 'error'
                    })
                }
            },
            complete: function (response) {
                loader(false);
            }
        });
    });
});

