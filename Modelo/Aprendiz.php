<?php

class Aprendiz {
    //creacion de variables
private $idAprendiz;
private $identificacion;
private $nombre;
private $apellido;
private $correo;
private $genero;
private $fecha;
    

//   creacion de constructor
    public function __construct($identificacion=null,
    $nombre=null,$apellido=null,$correo=null
    ,$genero=null,$fecha=null)
    {
        $this->identificacion=$identificacion;
        $this->nombre=$nombre;
        $this->apellido=$apellido;
        $this->correo=$correo;
        $this->genero=$genero;
        $this->fecha=$fecha;
    }
    
/**
 * Creando getter y setter de las variables
 */ 
public function getIdAprendiz()
{
return $this->idAprendiz;
}


public function setIdAprendiz($idAprendiz)
{
$this->idAprendiz = $idAprendiz;

return $this;
}

/**
 * Get the value of identificacion
 */ 
public function getIdentificacion()
{
return $this->identificacion;
}


public function setIdentificacion($identificacion)
{
$this->identificacion = $identificacion;

return $this;
}

/**
 * Get the value of nombre
 */ 
public function getNombre()
{
return $this->nombre;
}


public function setNombre($nombre)
{
$this->nombre = $nombre;

return $this;
}

/**
 * Get the value of apellido
 */ 
public function getApellido()
{
return $this->apellido;
}


public function setApellido($apellido)
{
$this->apellido = $apellido;

return $this;
}

/**
 * Get the value of correo
 */ 
public function getCorreo()
{
return $this->correo;
}

public function setCorreo($correo)
{
$this->correo = $correo;

return $this;
}

/**
 * Get the value of genero
 */ 
public function getGenero()
{
return $this->genero;
}

public function setGenero($genero)
{
$this->genero = $genero;

return $this;
}

/**
 * Get the value of fecha
 */ 
public function getFecha()
{
return $this->fecha;
}

public function setFecha($fecha)
{
$this->fecha = $fecha;

return $this;
}



}




