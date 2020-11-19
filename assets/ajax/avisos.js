var table;

function getDatos() {
        
    var t = 'Avisos';

    table = $('#tablaAvisos').DataTable( {
        "ajax": {
            "url": "../controllers/AvisosController.php?consulta=true",
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
        dom: "<'row'<'col-sm-6 mx-1'l><'col-sm-6 mx-1'f>>" +
        "<'row'<'col-sm-12'tr>>" +
        "<'row'<'col-sm-5'i><'col-sm-7'p>>",
    });
}

$(document).on("click", ".btn-eliminar-avisos", function (e) {
    var id = $(this).data("id");
    console.log(id);

    var a = $(this);

    console.log(a);

    a.parents("tr").addClass("selected");
    swal({
        text: '¿Realmente deseas eliminar el registro?',
        buttons: {
            cancel: {
              text: "No",
              value: null,
              visible: true,
              className: "",
              closeModal: true,
            },
            confirm: {
              text: "Si",
              value: true,
              visible: true,
              className: "",
              closeModal: true
            }
          },
        icon: 'warning'
    }).then(function (value) {
        loader(true);
        console.log(value);
        if (value == true) {
            $.ajax({
                url: "../controllers/AvisosController.php?eliminar=true&id="+id,
                type: 'POST',
                dataType: "json",
                success: function (response) {
                    loader(false);
                    if(response.success){
                        swal({
                            title: 'Operación exitosa',
                            message: response.message,
                            icon: 'success'
                        });
                        
                        loader(true);
                        table.ajax.reload( null, false );
                        loader(false);
                    }
                    else{
                        loader(false);
                        swal(response.message, '', 'info');
                    }
                    
                },
                error: function(request, msg, error) {
                    loader(false);
                    swal('Error', 'Ocurrió un error inesperado', 'error');
                }
            });
        }
        loader(false);
    }).catch(function () {
        a.parents("tr").removeClass("selected");
    });
    e.preventDefault();
});


$(document).ready(function(){

    getDatos();
});

$(document).on('click', '.btn-mod-aviso', function (event) {
    const id = $(this).data("id");
    const titulo = $(this).data("tittle");
    const mensaje = $(this).data("message");

    $('input[name=id_aviso]').val(id);
    $('input[name=titulo]').val(titulo);
    $('textarea[name=mensaje]').val(mensaje);
    $('input[name=mod_aviso]').val('true');
    $('#title_modal_aviso').text("Actualizar aviso");
});

$(document).on('click', '#nuevo-aviso', function (event) {
    $('input[name=id_aviso]').val("");
    $('input[name=titulo]').val("");
    $('textarea[name=mensaje]').val("");
    $('input[name=mod_aviso]').val('false');
    $('#title_modal_aviso').text("Nuevo aviso");
});

$(document).on("click", ".btn-enviar-aviso", function (e) {

    $("#mod-avisos").modal("hide");

    var formAviso = $(".form-avisos");
    var dat = new FormData(formAviso[0]);

    loader(true);
    
    jQuery.ajax({
        url: '../controllers/AvisosController.php?aviso=true',
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

