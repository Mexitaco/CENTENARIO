var table;

$(".form-jornada").submit(function (e) {
    e.preventDefault();

    var form = $(".form-jornada");
    var data = new FormData(form[0]);

    swal({
        text: '¿Realmente deseas reiniciar la liga?',
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
        if (value == true) {
            $.ajax({
                url: "../controllers/JornadaController.php?crear-jornada=true",
                data: data,
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
                            message: response.message
                        }).then(() => {
                            location.href = "conJor.php";
                        });
                    } else {
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
        }
        loader(false);
    });
});

$(document).ready(function () {

    if (arregloDT != null) {
        $('#local_nombre').text(arregloDT[0].local);
        $('#local_goles').text(arregloDT[0].goles_local);
        $('#local_tarAma').text(arregloDT[0].tarjetas_amarillas_local);
        $('#local_tarRoj').text(arregloDT[0].tarjetas_rojas_local);
        
        $('#horario').text(arregloDT[0].horario);
        $('#cancha').text(arregloDT[0].cancha);
        $('#num_jornada').text('Número de jornada: '+arregloDT[0].num_jornada);
        $('#equipo_ganador').text('Ganador: '+arregloDT[0].equipo_ganador);

        $('#visitante_nombre').text(arregloDT[0].visitante);
        $('#visitante_goles').text(arregloDT[0].goles_visitante);
        $('#visitante_tarAma').text(arregloDT[0].tarjetas_amarillas_visitante);
        $('#visitante_tarRoj').text(arregloDT[0].tarjetas_rojas_visitante);
    }

});


$(".form-terminar-jornada").submit(function (e) {
    e.preventDefault();

    var form = $(".form-terminar-jornada");
    var data = new FormData(form[0]);

    swal({
        text: '¿Realmente deseas terminar la temporada?',
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
        if (value == true) {
            $.ajax({
                url: "../controllers/JornadaController.php?terminar-jornada=true",
                data: data,
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
                            message: response.message
                        }).then(() => {
                            location.href = "conJor.php";
                        });
                    } else {
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
                            text: response.message
                        });
                    }
                }
            });
        }
        loader(false);
    });
});