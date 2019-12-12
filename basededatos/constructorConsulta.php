<?php

require 'conector.php';

class Builder{
    private $conector;
    private $tabla;
    function __construct(string $tabla)
    {
        $this->conector = new Conector();
        $this->tabla = $tabla;
    }


    /**
     * Devuelve la cadena en mysql
     */
    function cadena(){
        return "varchar(50)";
    }

    function cadenaConNumero(int $numeros){
        return "varchar($numeros)";
    }
    /**
     * Devuelve un gran entero en mysql
     */
    function granEnteroIncremental(){
        return "bigint(20) unsigned AUTO_INCREMENT";
    }

    function granEntero(){
        return "bigint(20) unsigned";
    }

    function crearTabla($argumentos){
        $this->conector->iniciarConexion();
        $sql = "CREATE TABLE IF NOT EXISTS ".$this->tabla;
        $sql = "$sql(id ".$this->granEnteroIncremental()." PRIMARY KEY ";
        foreach($argumentos as $clave => $valor){
            $sql = "$sql , $clave $valor";
        }
        $sql = "$sql )";
        $this->conector->sentencia($sql);
        $this->conector->cerrarConexion();
    }
    
    function eliminarTabla(){
        $this->conector->iniciarConexion();
        $sql = "DROP TABLE ".$this->tabla;
        $this->conector->sentencia($sql);
        $this->conector->cerrarConexion();
    }

    function eliminarUltimaLetra(string $cadena){
        return substr($cadena,0,-1);
    }

    function insertar(array $parametros){
        $this->conector->iniciarConexion();
        $sql = "INSERT INTO ".$this->tabla." (";
        $valores ="(";
        foreach($parametros as $clave => $valor){
            $sql = "$sql $clave ,";
            $valores = "$valores  $valor ,";
        }
        $sql = $this->eliminarUltimaLetra($sql);
        $valores = $this->eliminarUltimaLetra($valores);
        $sql = "$sql) VALUES $valores ) ";
//        echo $sql."\n";
        $this->conector->sentencia($sql);
        $this->conector->cerrarConexion();
    }

    function actualizar(int $id, array $parametros){
        $this->conector->iniciarConexion();
        $sql = " UPDATE ".$this->tabla." SET ";
        
        foreach($parametros as $clave => $valor){
            $sql = "$sql $clave = $valor,";
            
        }
        $sql = $this->eliminarUltimaLetra($sql);
        $sql = "$sql WHERE id = $id";
        //echo $sql."\n";
        $this->conector->sentencia($sql);
        $this->conector->cerrarConexion();
    }

    function obtener(int $id){
        $this->conector->iniciarConexion();
        $sql = "SELECT * FROM ".$this->tabla." WHERE id = $id";
        $resultado = $this->conector->consulta($sql);
        $this->conector->cerrarConexion();
        return $resultado->fetch_assoc();
    }

    function obtenerTodos(){
        $this->conector->iniciarConexion();
        $retorno = [];
        $sql = "SELECT * FROM ".$this->tabla;
        $resultado = $this->conector->sentencia($sql);
        $this->conector->cerrarConexion();
        return $resultado;
    }

    function eliminar(int $id){
        $this->conector->iniciarConexion();
        $sql = "DELETE FROM ".$this->tabla." WHERE id = $id";
        $this->conector->sentencia($sql);
        $this->conector->cerrarConexion();
    }
}

?>