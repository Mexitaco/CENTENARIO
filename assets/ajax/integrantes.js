var table;

$(document).ready(function(){
    
    table = $('#tablaIntegrantes').DataTable( {
        "ajax": {
            "url": "../controllers/IntegranteController.php?consulta=true&id="+idt,
            "dataSrc": "",
            "dataType": "json"
        },
        "pageLength": 100,
        "order": [[ 0, "asc" ]],
        responsive: true,
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
        dom: "<'row'<'col-sm-12'tr>>"
    });

});

$(document).on('click', '.btn-mod-inte', function (event) {
    const id = $(this).data("id");
    const nom_inte = $(this).data("nomb");
    const num_camisa = $(this).data("num");

    $('input[name=id_inte]').val(id);
    $('input[name=nom_inte]').val(nom_inte);
    $('input[name=num_camisa]').val(num_camisa);
    
});


$(document).on("click", ".btn-enviar-inte", function (e) {

    $("#mod-integrante").modal("hide");

    var formInte = $(".form-integrantes");
    var dat = new FormData(formInte[0]);

    loader(true);
    
    jQuery.ajax({
        url: '../controllers/IntegranteController.php?integrante=true',
        data: dat,
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
                });

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

