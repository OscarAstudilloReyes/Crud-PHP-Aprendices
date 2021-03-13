<?php

// namespace ;

class DatosAprendiz
{

    private $miConexion;
    private $retorno;

    public function __construct()
    {
        $this->miConexion = Conexion::singleton();
        $this->retorno = new stdClass();
    }

    public function agregar(Aprendiz $ap)
    {

        try {
            $consulta = "INSERT INTO estudiantes VALUES(null,?,?,?,?,?,?)";

            $resultado = $this->miConexion->prepare($consulta);
            $resultado->bindParam(1, $ap->getIdentificacion());
            $resultado->bindParam(2, $ap->getNombre());
            $resultado->bindParam(3, $ap->getApellido());
            $resultado->bindParam(4, $ap->getCorreo());
            $resultado->bindParam(5, $ap->getGenero());
            $resultado->bindParam(6, $ap->getFecha());
            $resultado->execute();

            $this->retorno->mensaje = "Agregado correctamente";
            $this->retorno->estado = true;
            $this->retorno->datos = $resultado;
        } catch (PDOException $ex) {

            $this->retorno->mensaje = $ex->getMessage();
            $this->retorno->estado = false;
            $this->retorno->datos = null;
        }
        return $this->retorno;
    }

    public function consultar($identificacion)
    {

        try {
            $consulta = "SELECT * FROM estudiantes WHERE esIndentificacion =?";
            $resultado = $this->miConexion->prepare($consulta);
            $resultado->bindParam(1, $identificacion);
            $resultado->execute();
            // consulta el nimero de registros con rowCount()
            if ($resultado->rowCount() > 0) {
                $this->retorno->estado = true;
                $this->retorno->mensaje = "Datos del aprendiz";
            } else {
                $this->retorno->estado = false;
                $this->retorno->mensaje = "No existe aprendiz con esa identificacion";
            }
            //Se convierte os datos en obejtos dondode sus taributos toman el nombre de los mismos
            //    campos de la base de datos
            $this->retorno->datos = $resultado->fetchObject();
        } catch (PDOException $ex) {
            $this->retorno->estado = false;
            $this->retorno->mensaje = "Problemas " . $ex->getMessage();
            $this->retorno->datos = null;
        }
        return $this->retorno;
    }

    public function Actualizar(Aprendiz $ap)
    {

        try {

            $consulta = "UPDATE estudiantes SET esIndentificacion=?
            ,esNombre=?, esApellido=?, esCorreo=?, esGenero=?, esFecha=?
            WHERE idEstudiante=? ";

            $resultado = $this->miConexion->prepare($consulta);
            $resultado->bindParam(1, $ap->getIdentificacion());
            $resultado->bindParam(2, $ap->getNombre());
            $resultado->bindParam(3, $ap->getApellido());
            $resultado->bindParam(4, $ap->getCorreo());
            $resultado->bindParam(5, $ap->getGenero());
            $resultado->bindParam(6, $ap->getFecha());
            //pasar el id
            $resultado->bindParam(7, $ap->getIdAprendiz());
            $resultado->execute();

            $this->retorno->mensaje = "Actualizado correctamente";
            $this->retorno->estado = true;
            $this->retorno->datos = $resultado;
        } catch (PDOException $ex) {

            $this->retorno->mensaje = $ex->getMessage();
            $this->retorno->estado = false;
            $this->retorno->datos = null;
        }
        return $this->retorno;
    }

    public function eliminar($idAprendiz)
    {

        try {
            // utilizando el procedimineto almacenado
            //Ejm de creacion de uno
            // Create procedure borrarEstudiante
            // idBorrar int
            // delete from estudiante where idEstuidante=idBorrar
            $consulta = "CALL eliminarEstudiante(?)";
            $resultado = $this->miConexion->prepare($consulta);
            $resultado->bindParam(1, $idAprendiz);
            $resultado->execute();
            $this->retorno->mensaje = "Eliminado correctamente";
            $this->retorno->estado = true;
            $this->retorno->datos = $resultado;
        } catch (PDOException $ex) {
            $this->retorno->estado = false;
            $this->retorno->mensaje = "Problemas " . $ex->getMessage();
            $this->retorno->datos = null;
        }
        return $this->retorno;
    }

    public function listar()
    {
        try {
            $consulta = "SELECT * FROM estudiantes ";
            $resultado = $this->miConexion->query($consulta); //query cuando no lleva parametros
            $resultado->execute();

            // $this->retorno->datos = $resultado->fetchAll(PDO::FETCH_OBJ);
            // $this->retorno->datos = $resultado->fetchAll();

            $this->retorno->estado = true;
            $this->retorno->mensaje = "Datos Aprendices";
            $this->retorno->datos = $resultado->fetchAll();
        } catch (PDOException $ex) {
            $this->retorno->estado = false;
            $this->retorno->mensaje = "Problemas " . $ex->getMessage();
            $this->retorno->datos = null;
        }

        return $this->retorno;
    }
}
