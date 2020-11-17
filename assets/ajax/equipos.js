var equipos;
var table;

$(document).ready(function(){

    var t = 'Partidos';
    var cont = 0;

    table = $('#tablaJornadaEquipo').DataTable( {
        "data": arregloDT,
        "pageLength": 25,
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
        initComplete: function () {
            this.api().columns([ 0 ]).every( function () {
                var column = this;
                var select = $('<select class="form-control" style="width: 80%; margin-left: 15px;"><option value="">Filtro Jornada</option></select>')
                    .appendTo( $(column.header()).empty() )
                    .on( 'change', function () {
                        var val = $.fn.dataTable.util.escapeRegex(
                            $(this).val()
                        );
                        column
                            .search( val ? '^'+val+'$' : '', true, false )
                            .draw();
                    } );
                column.data().unique().sort().each( function ( d, j ) {
                    if(column.search() === '^'+d+'$'){
                        select.append(
                          '<option value="'+d+'" selected="selected">'
                             +d+
                          '</option>'
                        )
                    } else {
                        cont++;
                        select.append('<option value="'+cont+'">'+cont+'</option>')
                    }
                });
            });
        },
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

$(document).ready(function(){

    var section = $(".posiciones-consulta");
    if (section.get(0) == null) {
        return;
    }

    var t = 'Tabla de posiciones';

    table = $('#tablaPosiciones').DataTable( {
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

$(document).ready(function(){

    var t = 'Equipos';

    table = $('#equipo-consulta').DataTable( {
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

$(document).ready(function(){

    var t = 'Historial equipo';

    table = $('#tablaHistEquipo').DataTable( {
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

$(document).on('click', '.new-equipo', function (event) {
    $('input[name=nombre_equipo]').val(this.value);
    $('input[name=nom_pas_equipo]').val(this.value);
    $('input[name=mod_equipo]').val('true');
    $('#title_modal_equipo').text("Actualizar nombre de equipo");
});

$(document).on('click', '#nuevo-equipo', function (event) {
    $('input[name=nombre_equipo]').val("");
    $('input[name=mod_equipo]').val('false');
    $('#title_modal_equipo').text("Nombre del nuevo equipo");
});


$(document).on("click", ".mod_equipo", function (e) {

    $("#modEquipo").modal("hide");

    var formEquipo = $(".form-equipo");
    var mod = new FormData(formEquipo[0]);

    loader(true);
    
    jQuery.ajax({
        url: '../controllers/EquipoController.php?equipo=true',
        data: mod,
        cache: false,
        processData: false,
        contentType: false,
        type: 'POST',
        dataType: 'json',
        success: function (response) {
            loader(false);
            if (response.success) {
                swal({
                    title: "Operación exitosa",
                    icon: 'success',
                    text: response.message
                }).then(() => {
                    location.href = "equipos.php";
                });
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
            if (response.error) {
                swal({
                    title: "Error",
                    icon: 'error',
                    text: response.responseJSON.message
                });
            }
        }
    });
    e.preventDefault();
});