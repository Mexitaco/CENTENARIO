var table;

$(function (){

    $("#equipos").change(function () {

        if ($("#equipos").val() != '0') {
            $('#mod').removeClass('hid');
            $('#mod').addClass('sho');
        } else {
            $('#mod').removeClass('sho');
            $('#mod').addClass('hid');
        }

        $('.equipo').val(document.getElementById('equipos').value);
    });
});

$(function () {
    $(".form-pagos").submit(function(e) {
        e.preventDefault();
        
        var form = $(".form-pagos");
        var data = new FormData(form[0]);

        loader(true);

        jQuery.ajax({
            url: '../controllers/PagosController.php?save-pagos=true',
            data: data,
            cache: false,
            processData: false,
            contentType: false,
            type: 'POST',
            dataType: 'json',
            success: function (response) {
                loader(false);
                if(response.success){
                    swal({
                        title: "Operación exitosa",
                        type: 'success',
                        icon: 'success',
                        message: response.message
                    }).then(() => {
                        location.href = "finanzas.php";
                    });
                }
                else{
                    swal(response.message, "", "info");
                }
            },
             error: function () {
                loader(false);
                swal("Por favor ingrese un valor mayor a 1", "", "error");
             }
        });
    });
});

$(document).ready(function(){
    //AQUÍ BUSCA LA ETIQUETA HTML "MAIN" CON LA CLASE usuarios-section PARA SABER DONDE ESTA EL DATA TABLE
    var section = $(".finanzas-section");
    if(section.get(0) == null){
        return;
    }

    $.extend($.fn.dataTableExt.oStdClasses, {
        "sFilterInput": "form-control",
        "sLengthSelect": "form-control"
    });

    // tablaUsuarios ES EL ID DE LA TABLA A LA QUE LE METEREMOS TODA LA INFORMACIÓN
    // arregloDT TIENE LA INFORMACIÓN QUE QUEREMOS MOSTRAR
    table = $('#tablaFinanzas').DataTable( {
        "data": arregloDT,
        "pageLength": 100,
        language: {
            "decimal":        "",
            "emptyTable":     "No hay información disponible en la tabla",
            "info":           "Mostrando _START_ a _END_ de _TOTAL_ Entradas",
            "infoEmpty":      "Mostrando 0 to 0 of 0 Entradas",
            "infoFiltered":   "(Filtrado from _MAX_ total Entradas)",
            "infoPostFix":    "",
            "thousands":      ",",
            "lengthMenu":     "Mostrar _MENU_ Entradas",
            "loadingRecords": "Cargando...",
            "processing":     "Procesando...",
            "search":         "Búsqueda:",
            "zeroRecords":    "No se encontraron registros coincidentes",
            "paginate": {
                "first":      "Primero",
                "last":       "Último",
                "next":       "Siguiente",
                "previous":   "Previo"
            },
        },
        "order": [[ 0, "asc" ]],
        responsive: true,
    });
    
});