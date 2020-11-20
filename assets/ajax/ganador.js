$(document).ready(function () {
    $('#nombre_primer_lugar').text(campeones[0].nombre_equipo);
    $('#puntos_primer_lugar').text('Pts: '+campeones[0].puntos);
    $('#nombre_segundo_lugar').text(campeones[1].nombre_equipo);
    $('#puntos_segundo_lugar').text('Pts: '+campeones[1].puntos);
    $('#nombre_tercer_lugar').text(campeones[2].nombre_equipo);
    $('#puntos_tercer_lugar').text('Pts: '+campeones[2].puntos);
});