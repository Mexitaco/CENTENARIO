$(document).ready(function () {

    var index = 0;

    campeones.forEach(element => {
    
        let option = `
            <option value="${campeones.length - index }"> ${campeones.length - index } </option>
        `;

        index++;

        $("#filtro_temporada").append(option);
    });

    $('#nombre_primer_lugar').text(campeones[index-1][0].nombre_equipo);
    $('#puntos_primer_lugar').text('Pts: '+campeones[index-1][0].puntos);
    $('#nombre_segundo_lugar').text(campeones[index-1][1].nombre_equipo);
    $('#puntos_segundo_lugar').text('Pts: '+campeones[index-1][1].puntos);
    $('#nombre_tercer_lugar').text(campeones[index-1][2].nombre_equipo);
    $('#puntos_tercer_lugar').text('Pts: '+campeones[index-1][2].puntos);

    $("#filtro_temporada").change(function () {

        let valor = $("#filtro_temporada").val() - 1;

        $('#nombre_primer_lugar').text(campeones[valor][0].nombre_equipo);
        $('#puntos_primer_lugar').text('Pts: '+campeones[valor][0].puntos);
        $('#nombre_segundo_lugar').text(campeones[valor][1].nombre_equipo);
        $('#puntos_segundo_lugar').text('Pts: '+campeones[valor][1].puntos);
        $('#nombre_tercer_lugar').text(campeones[valor][2].nombre_equipo);
        $('#puntos_tercer_lugar').text('Pts: '+campeones[valor][2].puntos);

    });
});