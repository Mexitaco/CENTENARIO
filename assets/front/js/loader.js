function loader(flag) {
    console.log('caca');
    if (flag) {
        $(".loader").addClass("loader-activo");
    } else {
        $(".loader").removeClass("loader-activo");
    }   
}