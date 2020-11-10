<?php
    //VERIFICADORES DE ACCESO 
    include_once "../auth/AuthSession.php";
    include_once "../conexion/Conexion.php";
    include_once "../models/Usuario.php";

    if(AuthSession::getUsuario() == null){
        header('Location: login.php');
    }

?>

<!DOCTYPE html>
<html lang="es">
    <head>
        <title>Usuarios</title>
        <meta charset="utf-8">
        <meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" name="viewport" />

        <?php   
            include_once "components/js.html";    //CARGAR LOS JS
            include_once "components/css.html";   //CARGAR LOS CSS
        ?>
        <script type="text/javascript">

            /*
                 ESTE ES EL ARREGLO QUE VA A CARGAR TODA LA INFO DE LAS TABLAS AL DATA TABLE,
                 PERO ANTES USUAMOS EL MÉTODO CONSULTAR PARA TRAER LA INFORMACIÓN Y CONVERTIRLA
                 EN UN OBJETO JSON PARA QUE EL DATA TABLE PUEDA MOSTRARLO
             */
            var arregloDT = <?php echo json_encode(Usuario::consultar()); ?>;
            console.log(arregloDT);

        </script>

        <script src="../assets/ajax/usuarios.js"></script>

        <!-- DEPENDIENDO DE LA ACCIÓN QUE SE HAGA SE MANDA A LLAMAR ESTE ARCHIVO PARA PRODECER LA PETICIÓN POR AJAX -->       

    </head>
    <body>

        <?php
            include_once "components/nav.php"; //IMPRIMIR NAVEGADOR
        ?>

        <!-- IMPORTANTE DARLE UNA CLASE ÚNICA, YA QUE SE VINCULARA CON usuarios.js PARA BUSCAR LA TABLA -->
        <main class="usuarios-section">
            <div class="col-12">
                <!-- IMPORTANTE DARLE UN ID A LA TABLA, PORQUE AQUÍ SE METERA LA INFORMACIÓN DEL DATA TABLE-->
                <table id="tablaUsuarios" cellspacing="0" width="100%">
                    <thead>
                    <tr>
                        <!-- 
                            PARA QUE LA INFORMACIÓN SE MUESTRE SIN PROBLEMAS SE DEBE ESPECÍFICAR
                            TODOS LOS CAMPOS QUE VAYA A TENER NUESTRA CONSULTA, DE LO CONTRARIO SE
                            MOSTRARÁ, PERO LA INFORMACIÓN ESTARÁ DESFAZADA POR LA COLUMNA FALTANTE
                        -->
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Usuario</th>
                    </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </main>

        <?php
          
            include_once "components/footer.php"; //IMPRIMIR FOOTER
        ?>
         
    </body>
</html>