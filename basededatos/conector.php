<?php

class Conector{
    private $nombre;
    private $password;
    private $usuario;
    private $host;
    private $conexion;

    function __construct()
    {
        $this->nombre = "delbonoremis";
        $this->password = "";
        $this->usuario = "root";
        $this->host="localhost";
    }

    function iniciarConexion(){
        $this->conexion = new mysqli($this->host,$this->usuario,$this->password,$this->nombre);
        if($this->conexion->connect_errno){
            echo "Fallo en conectar a mysql".$this->conexion->connect_errno;
        }
    }

    function sentencia($sql)
    {
        if(!$this->conexion->query($sql)){
            echo "Fallo en la sentencia".$this->conexion->error;
        }
    }

    function consulta($sql){
        $resultado = $this->conexion->query($sql);
        if(!$resultado){
            echo "Fallo en la consulta";
            return null;
        }
        else{
            return $resultado;
        }
    }

    function cerrarConexion(){
        mysqli_close($this->conexion);
    }

}

?>