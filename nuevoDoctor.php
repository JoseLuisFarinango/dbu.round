<?php
session_start();
include_once '../../../model/SessionDTO.php';
if (!isset($_SESSION['sesionDTO'])) {
    //para cuando nunca hizo login
    header('Location: ../../index.php');
    die();
    //  include '';
}
$sesionDTO = unserialize($_SESSION['sesionDTO']);
if ($sesionDTO->getTipo_usuario() != "Administrador") {
    //para cuando quiere entrar otro usuario
    header('Location: ../../index.php');
    die();
}

//echo"<div class='jumbotron text-primary text-center font-italic' style='background-color:#FE9A2E'>";
//echo "<h1 style='color:black'>BIENVENID@ <br/>D/E<br/>" . $sesionDTO->getId() . "</h1>";
//echo "</div>";
?>

<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<?php
include_once '../../../model/modelDBUround.php';
$model = new modelDBUround();
?>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Nuevo Doctor</title>
        <link rel="icon" type="image/png" href="../../../Imagenes/icono.png"/>


        <link rel="stylesheet" type="text/css" href="../../../Estilos/EstilosUs.css"/>
        <script src="js/jquery-2.1.4.js" type="text/javascript"></script>
        <!-- -->
        <link href="../../../bootstrap/bootstrap.min.css" rel="stylesheet"/>    
        <link href="../../../bootstrap/bootstrap-theme.css" rel="stylesheet"/>
        <link href='https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/css/bootstrap.min.css' rel='2stylesheet'>
        <script
            src="https://code.jquery.com/jquery-3.3.1.min.js"
            integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
        crossorigin="anonymous"></script>
        <link rel="stylesheet" href="../../../bootstrap-4.1.3-dist/css/bootstrap.min.css">
        <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1">
        <link rel="icon" type="image/png" href="../../../IMAGE/UTN_icono_1.jpg" />
        <link rel="stylesheet" href="../../../Estilos/estilosAdministrador.css">
        <link rel="stylesheet" href="../../../Estilos/font.css">

    </head>
    <body>
        <script>
            function soloLetras(e) {
                key = e.keyCode || e.which;
                tecla = String.fromCharCode(key).toLowerCase();
                letras = " áéíóúabcdefghijklmnñopqrstuvwxyz";
                especiales = "8-37-39-46";

                tecla_especial = false
                for (var i in especiales) {
                    if (key == especiales[i]) {
                        tecla_especial = true;
                        break;
                    }
                }

                if (letras.indexOf(tecla) == -1 && !tecla_especial) {
                    return false;
                }
            }
        </script>
        <div class="contenedor-encabezado">
            <div class="titulo">
                <h2>Nuevo Doctor - UTN</h2>
            </div>
            <div class="datos-usuario">
                <img class="icon-user" src="" alt="" title="Usuario">
                <label class="nomUs">
                    <?php
                    $pers = unserialize($_SESSION['us']);
//echo ;
                    echo $pers->getApellidos() . " " . $pers->getNombres() . "" . "<a class='botonCS' href='../../../model/CerrarSesion.php'>Cerrar Sesión</a>";
                    ?>
                </label>
            </div>
        </div>


        <form action="../../../controller/controller.php">
            <div class="formulario">
                <h2 class="tituloAC">REGISTRO DE DOCTOR</h2>
                <table class="tabla">
                    <tr>
                        <td class="tr">
                            <label class="texto">Ingrese los datos:</label>
                            <br/>
                        </td>
                    </tr>
                    <tr>
                        <td class ="tr">
                            <label class="texto">Rol(Doctor):</label>
                        </td>
                        <td class="tr2">
                            <select class="selecion" id="id_rol" name="id_rol">
                                <?php
                                $listado = $model->getRol();
                                foreach ($listado as $prov) {
                                    echo "<option value='" . $prov->getId_rol() . "'>" . $prov->getNombre_rol() . "</option>";
                                }
                                ?>
                            </select>

                        </td>
                    </tr>
                    <tr>
                        <td class="tr">
                            <label class="texto" >Cedula:</label>
                        </td>
                        <td>
                            <input class="selecion"type="text" style="text-align:left" name="cedula" required="true">

                        </td>
                    </tr>


                    <tr>
                        <td class="tr">
                            <label class="texto">Nombres:</label>
                        </td>
                        <td>
                            <input onkeypress="return soloLetras(event)" class="selecion" style="text-align:left" type="text"  name="nombres" required="true">
                        </td>
                    </tr>
                    <tr>
                        <td class="tr">
                            <label class="texto">Apellidos:</label>
                        </td>
                        <td>
                            <input onkeypress="return soloLetras(event)" class="selecion" style="text-align:left" type="text"  name="apellidos" required="true">
                        </td>
                    </tr>
                    <tr>
                        <td class="tr">
                            <label class="texto">Fecha Nacimiento:</label>
                        </td>
                        <td>
                            <?php
                            // Obteniendo la fecha actual del sistema con PHP
                            $fechaActual = date('d-m-Y');
                            //echo ;
                            ?>
                            <input value="1995-01-01" style="text-align:left"  class="selecion"type="date" name="fecha_nacimiento" min="1960-01-01"  max="1995-12-31" required="true">


                        </td>
                    </tr>
                    <tr>
                        <td class="tr">
                            <label class="texto">Celular:</label>
                        </td>
                        <td>
                            <input class="selecion" style="text-align:left" type="text"  name="telefono" required="true">
                        </td>
                    </tr>

                    <tr>
                        <td class="tr">
                            <label class="texto">Tipo Sangre:</label>
                        </td>
                        <td class="tr2">
                            <select  class="selecion" style="text-align:left" id="id_tipo_sangre" name="id_tipo_sangre">
                                <?php
                                $lista = $model->getTipoSangre();
                                foreach ($lista as $prov) {


                                    echo "<option value='" . $prov->getId_tipo_sangre() . "'>" . $prov->getTipo() . "</option>";
                                }
                                ?>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td class="tr">
                            <label class="texto">Área(Medicina):</label>
                        </td>
                        <td class="tr2">
                            <select class="selecion" style="text-align:left" id="id_tipo_area" name="id_tipo_area" >

                                <?php
                                $list = $model->getTipoAreaDoctor();
                                foreach ($list as $prov) {

                                    echo "<option value='" . $prov->getId_tipo_area() . "'>" . $prov->getNombre_area() . "</option>";
                                }
                                ?>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td class="tr">
                            <label class="texto">Departamento:</label>
                        </td>
                        <td class="tr2">
                            <select class="selecion" style="text-align:left" id="id_area_espec" name="id_area_espec" >

                                <?php
                                $lis = $model->getAreaEspecializada();
                                foreach ($lis as $prov) {

                                    echo "<option value='" . $prov->getId_area_espec() . "'>" . $prov->getFacultad_departamento() . "</option>";
                                }
                                ?>
                            </select>
                        </td>
                    </tr>

                    <tr>
                        <td class="tr">
                            <label class="texto">Email:</label>
                        </td>
                        <td>
                            <input class="selecion" style="text-align:left"  pattern=".+@utn.edu.ec" type="email"  name="email" required="true">
                        </td>
                    </tr>
                    <tr>
                        <td class="tr">
                            <label class="texto">Genero:</label>
                        </td>
                        <td class="tr2">

                            <select class="selecion" style="text-align:left" id="genero" name="genero" >


                                <option value="Masculino">Masculino</option>
                                <option value="Femenino">Femenino</option>
                            </select>

                        </td>
                    </tr>

                    <tr>
                        <td class="tr">
                            <label class="texto">Ciudad:</label>
                        </td>
                        <td>
                            <input class="selecion" style="text-align:left" type="text"  name="ciudad" required="true">
                        </td>
                    </tr>
                    <tr>
                        <td class="tr">
                            <label class="texto">Dirección:</label>
                        </td>
                        <td>
                            <input class="selecion" style="text-align:left" type="text"  name="direccion" required="true">
                        </td>
                    </tr>
                    <tr>
                        <td class="tr">
                            <label class="texto">Estado(Activo/Desactivo):</label>
                        </td>
                        <td class="tr2">

                            <select class="selecion" style="text-align:left" id="estado" name="estado" >
                                <option value="1">Activo (✓) </option>
                                <option value="0">Desactivo (X) </option>
                            </select>

                        </td>
                    </tr>


                    <tr>
                        <td>
                        <td colspan="2" class="tr3"></td>
                        </td>
                    </tr>
                </table>
                <input type="hidden" name="opcion" value="insertDoctor">
                <input class="botonG" type="submit" value="Aceptar" >
                <center><a href="ReporteDoctores.php">REGRESAR</a></center>
            </div>
        </form>
        <?php
        // put your code here
        ?>
        <BR/>
    </body>
</html>
