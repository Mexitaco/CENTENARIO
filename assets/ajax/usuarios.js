var table;

$(document).on("click", ".btn-eliminar-registro", function (e) {
    var id = $(this).data("id");
    var a = $(this);
    a.parents("tr").addClass("selected");
    swal({
        text: '¿Realmente deseas eliminar el registro?',
        showCancelButton: true,
        confirmButtonText: 'Aceptar',
        cancelButtonText: 'Cancelar',
        type: 'warning'
    }).then(function () {
        
        $.ajax({
            url: "../controllers/UsuariosController.php?eliminar=1&id="+id,
            type: 'POST',
            dataType: "json",
            success: function (response) {
               
                if(response.success){
                    swal('Operación exitosa', response.message, 'success')
                        .then(function(){
                            location.reload();
                        }).catch(function (reason) {
                            location.reload();
                        });
                }
                else{
                    swal(response.message, '', 'info');
                }
                
            },
            error: function(request, msg, error) {
                loader(false);
                swal('Error', 'Ocurrió un error inesperado', 'error');
            }
        });
    }).catch(function () {
        a.parents("tr").removeClass("selected");
    });
    e.preventDefault();
});

$(function () {
    $(".form-usuario").submit(function(e) {
        e.preventDefault();
        
        var form = $(".form-usuario");
        var data = new FormData(form[0]);

        jQuery.ajax({
            url: '../controllers/UsuariosController.php?save-usuario=true',
            data: data,
            cache: false,
            processData: false,
            contentType: false,
            type: 'POST',
            dataType: 'json',
            success: function (response) {
                
                if(response.success){
                    swal({
                        title: "Operación exitosa",
                        type: 'success',
                        icon: 'success'
                    }).then(function(){
                        location.href = "index.php";
                    }).catch(function (reason) {
                        location.href = "index.php";
                    });
                }
                else{
                    swal(response.message, "", "info");
                }
            },
             error: function () {
                
                 swal("Ocurrió un error inesperado1", "", "error");
             }
        });
    });
});

$(document).ready(function(){
    //AQUÍ BUSCA LA ETIQUETA HTML "MAIN" CON LA CLASE usuarios-section PARA SABER DONDE ESTA EL DATA TABLE
    var section = $(".usuarios-section");
    if(section.get(0) == null){
        return;
    }

    $.extend($.fn.dataTableExt.oStdClasses, {
        "sFilterInput": "form-control",
        "sLengthSelect": "form-control"
    });

    // tablaUsuarios ES EL ID DE LA TABLA A LA QUE LE METEREMOS TODA LA INFORMACIÓN
    // arregloDT TIENE LA INFORMACIÓN QUE QUEREMOS MOSTRAR
    table = $('#tablaUsuarios').DataTable( {
        "data": arregloDT,
        "pageLength": 100,
        "order": [[ 0, "asc" ]],
        responsive: true
    });
    
});