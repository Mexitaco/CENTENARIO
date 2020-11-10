var table;

var contGolLocal = 1;
var contAmaLocal = 1;
var contRojLocal = 1;

var contGolVisitante = 1;
var contAmaVisitante = 1;
var contRojVisitante = 1;

function eliminar(obj,arg1) {
    $(obj).closest('.inclinar-'+arg1).remove();
}

$(document).on('click', 'button[id]', function (event) {

    let id = this.id;

    if (id == 'new-goles-local') {
        if (contGolLocal < 30) {
            contGolLocal++;
            crearBoton('.new-goles-local', '.new-anotador-local', 'select_goles_local', '1');
        }
    } else if (id == 'cerrar-select_goles_local') { contGolLocal--; }

    if (id == 'new-tarAma-local') {
        if (contAmaLocal < 11) {
            contAmaLocal++;
            crearBoton('.new-tarAma-local', '.new-amolestado-amarillo-local', 'select_amarillas_local', '1');
        }
    } else if (id == 'cerrar-select_amarillas_local') { contAmaLocal--; }

    if (id == 'new-tarRoj-local') {
        if (contRojLocal < 4) {
            contRojLocal++;
            crearBoton('.new-tarRoj-local', '.new-amolestado-roja-local', 'select_rojas_local', '1');
        }
    } else if(id == 'cerrar-select_rojas_local') { contRojLocal--; }

    if (id == 'new-goles-visitante') {
        if (contGolVisitante < 30) {
            contGolVisitante++;
            crearBoton('.new-goles-visitante', '.new-anotador-visitante', 'select_goles_visitante', '2');
        }
    } else if (id == 'cerrar-select_goles_visitante') { contGolVisitante--; }

    if (id == 'new-tarAma-visitante') {
        if (contAmaVisitante < 11) {
            contAmaVisitante++;
            crearBoton('.new-tarAma-visitante', '.new-amolestado-amarillo-visitante', 'select_amarillas_visitante', '2');
        }
    } else if(id == 'cerrar-select_amarillas_visitante') { contAmaVisitante--; }

    if (id == 'new-tarRoj-visitante') {
        if (contRojVisitante < 4) {
            contRojVisitante++;
            crearBoton('.new-tarRoj-visitante', '.new-amolestado-roja-visitante', 'select_rojas_visitante', '2');
        }
    } else if(id == 'cerrar-select_rojas_visitante') { contRojVisitante--; }

    function crearBoton(arg1, arg2, arg3, arg4) {

        $(arg1)
            .append($(arg2)
                .html())
            .find('button')
            .attr({
                "onclick": "eliminar(this,"+arg4+")",
                "id": "cerrar-"+arg3,
                "class": "btn btn-danger more-info fas fa-minus",
                "style": function () {
                    if (arg4 == '1') {
                        return "margin-top: auto; margin-left: 25px;";
                    } else {
                        return "margin-top: auto; margin-right: 25px;";
                    }
                }
            });
    }

    console.log("Se presionó el Boton con Id :" + id)
});


$(document).ready(function () {
    $('#nombreEquipoLocal').text(resPartido[0][0]);
    $('#nombreEquipoVisitante').text(resPartido[0][4]);
    $('#cancha').text(resPartido[0][9]);
    $('#horario').text(resPartido[0][8]);
});


$(document).on("click", ".enviarTodo", function (e) {

    var formJornada = $(".form-calificar-jornada");
    var cali = new FormData(formJornada[0]);

    jQuery.ajax({
        url: '../controllers/CalificarJornadaController.php?save-caljor=true',
        data: cali,
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
                    location.href = "conJor.php";
                });
            }
            else {
                swal(response.message, "", "info");
            }
        },
        error: function () {
            swal("Por favor ingrese valores mayor a 1", "", "error");
        }
    });
    e.preventDefault();
});