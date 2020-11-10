var table;

$(".form-jornada").submit(function (e) {
    e.preventDefault();

    var form = $(".form-jornada");
    var data = new FormData(form[0]);

    swal({
        title: 'Reiniciar Liga',
        text: '¿Realmente deseas crear las nuevas jornadas?',
        icon: 'warning',
        type: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Aceptar',
        cancelButtonText: 'Cancelar',
    }).then(function () {

        $.ajax({
            url: "../controllers/JornadaController.php?crear-jornada=true",
            data: data,
            cache: false,
            processData: false,
            contentType: false,
            type: 'POST',
            dataType: 'json',
            success: function (response) {

                if (response.success) {
                    swal({
                        title: "Operación exitosa",
                        type: 'success',
                        icon: 'success',
                        message: response.message
                    }).then(() => {
                        location.href = "conJornada.php";
                    });
                }
                else {
                    swal(response.message, "", "info");
                }
            }
        });
    });
});

$(document).ready(function () {
    //AQUÍ BUSCA LA ETIQUETA HTML "MAIN" CON LA CLASE usuarios-section PARA SABER DONDE ESTA EL DATA TABLE
    var section = $(".jornada-consulta");
    if (section.get(0) == null) {
        return;
    }

    // tablaUsuarios ES EL ID DE LA TABLA A LA QUE LE METEREMOS TODA LA INFORMACIÓN
    // arregloDT TIENE LA INFORMACIÓN QUE QUEREMOS MOSTRAR
    table = $('#tablaJornada').DataTable({
        "data": arregloDT,
        "pageLength": 100,
        language: {
            "decimal": "",
            "emptyTable": "No hay información disponible en la tabla",
            "info": "Mostrando _START_ a _END_ de _TOTAL_ Entradas",
            "infoEmpty": "Mostrando 0 to 0 of 0 Entradas",
            "infoFiltered": "(Filtrado from _MAX_ total Entradas)",
            "infoPostFix": "",
            "thousands": ",",
            "lengthMenu": "Mostrar _MENU_ Entradas",
            "loadingRecords": "Cargando...",
            "processing": "Procesando...",
            "search": "Búsqueda:",
            "zeroRecords": "No se encontraron registros coincidentes",
            "paginate": {
                "first": "Primero",
                "last": "Último",
                "next": "Siguiente",
                "previous": "Previo"
            },
        },
        "order": [[0, "asc"]],
        responsive: true
    });

});
