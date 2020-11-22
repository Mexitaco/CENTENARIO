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
                        icon: 'success',
                        text: response.message
                    });

                    $("#myModal").modal("hide");
                    loader(true);
                    table.ajax.reload( null, false );
                    loader(false);

                }
                else {
                    swal({
                        title: "Advertencia",
                        icon: 'info',
                        text: response.message
                    });
                }
            },
            error: function (response) {
                loader(false);
                $("#myModal").modal("hide");
                if (response.error) {
                    swal({
                        title: "Error",
                        icon: 'error',
                        text: response.responseJSON.message
                    });
                }
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

    var t = 'Pagos realizados';

    // tablaUsuarios ES EL ID DE LA TABLA A LA QUE LE METEREMOS TODA LA INFORMACIÓN
    // arregloDT TIENE LA INFORMACIÓN QUE QUEREMOS MOSTRAR
    table = $('#tablaFinanzas').DataTable( {
        "ajax": {
            "url": "../controllers/PagosController.php?consulta=true",
            "dataSrc": "",
            "dataType": "json"
        },
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
        dom: "<'row'<'col-sm-12 mx-1'l><'col-sm-12 btn-action mx-1'B><'col-sm-12 mx-1'f>>" +
        "<'row'<'col-sm-12'tr>>" +
        "<'row'<'col-sm-5'i><'col-sm-7'p>>",
        buttons: [
            {
                extend: 'print',
                title: t
            },
            {
                extend: 'pdf',
                title: t
            },
            {
                extend: 'excel',
                title: t
            }
        ]
    });
    
});


$(document).ready(function(){

    var t = 'Historial de pagos';

    equipos = $('#tablaHistorialPagos').DataTable( {
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
        dom: '<"col-xs-3"l><"col-xs-5"B><"col-xs-4"f>rtip',
        buttons: [
            {
                extend: 'print',
                title: t
            },
            {
                extend: 'pdf',
                title: t
            },
            {
                extend: 'excel',
                title: t
            }
        ]

    });
    
});