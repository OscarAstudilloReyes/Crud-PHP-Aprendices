<?php
// extract Importar variables a la tabla de símbolos actual desde un array
extract($_REQUEST);
//importar clases que se van a usar
include "../Modelo/Aprendiz.php";
include "../Modelo/Conexion.php";
include "../Modelo/DatosAprendiz.php";
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
        // print_r($resultado);
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

