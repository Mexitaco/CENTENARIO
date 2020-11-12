var equipos;
var table;

$(document).ready(function(){

    // tablaUsuarios ES EL ID DE LA TABLA A LA QUE LE METEREMOS TODA LA INFORMACIÓN
    // arregloDT TIENE LA INFORMACIÓN QUE QUEREMOS MOSTRAR
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
                var select = $('<select style="width: 80%; margin: 0px 5px;"><option value="">Filtro Jornada</option></select>')
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
                        select.append('<option value="'+d+'">'+d+'</option>')
                    }
                });
            });
        },
        responsive: true
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