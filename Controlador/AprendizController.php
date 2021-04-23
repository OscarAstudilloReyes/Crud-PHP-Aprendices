<?php
// extract Importar variables a la tabla de símbolos actual desde un array
extract($_REQUEST);
//importar clases que se van a usar
include "../Modelo/Aprendiz.php";
include "../Modelo/Conexion.php";
include "../Modelo/DatosAprendiz.php";
include "../Modelo/enviarCorreo.php";
// para evitar errores de tipo warning
error_reporting(1);
//Objeto del aprendiz
$aPrendiz = new DatosAprendiz();

//Eleccion del boton

if ($accion == "Consultar") {
        //METODO CONSULTAR
        $resultado = $aPrendiz->consultar($txtIdentificacion);
        echo  json_encode($resultado);
} elseif ($accion == "Agregar") {
        
        // METODO DE AGREGAR
        $ap = new Aprendiz($txtIdentificacion, $txtNombre, $txtApellido, $txtCorreo, $cbGenero, $fecha);
        $resultado = $aPrendiz->agregar($ap);
        //Enviar correo cuando se inicia sesion
        $correo = new enviarCorreoPrueba();
        $objCorreo = new stdClass();
        $objCorreo->correoRemitente = "soporte.petsHealth@gmail.com"; //aqui pueden colocar el correo del administrador
        $objCorreo->nombreRemitente = "Administración ADSI"; //igual el nombre del administrador
        $objCorreo->correoDestinatario =$txtCorreo;
        $objCorreo->nombreDestinatario =$txtNombre;
        $objCorreo->asunto = "Creacion de usuario en adsi";
        $objCorreo->mensaje = "Cordial saludo , <br> Usuario " .$txtNombre."
        " . " se ha creado su usuario correctamente
        <br>
        ¿fuiste tu ?
        <table  width='50%' border='0' >
        <tr>
        <td width ='50%' align='center'>
        <img src='https://i.imgur.com/yzjVfUS.png' alt='logoLargoEmpresa' width='250' >
        </td>
        <td width='50%'>
        <br>
        <b> Atentamente ADSI	</b>
        <br>
        Gracias por confiar en nosotros
        </td>
        </tr>
        </table>";
       $resultadoCorreo = $correo->enviarCorreo($objCorreo);
       $resultado->mensaje = $resultado->mensaje . " " . $resultadoCorreo->mensaje;
        //Devueve el resultado en formatio json
        echo  json_encode($resultado);
}

elseif ($accion == "editar"){
        $ap = new Aprendiz($txtIdentificacion, $txtNombre, $txtApellido, $txtCorreo, $cbGenero, $fecha);  
        $ap->setIdAprendiz($idAprendiz);
        $resultado = $aPrendiz->Actualizar($ap);
        // print_r($resultado);
        //Devueve el resultado en formatio json
        echo  json_encode($resultado);
}

elseif ($accion=="eliminar"){
        $resultado = $aPrendiz->eliminar($idAprendiz);
        echo  json_encode($resultado);
}
elseif ($accion=="listar"){
        $resultado = $aPrendiz->listar();
        // print_r($resultado);
        echo  json_encode($resultado);
}

