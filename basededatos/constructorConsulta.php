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

    function crearTabla($argumentos){
        $sql = "CREATE TABLE IF NOT EXISTS".$this->tabla;
        $sql = "$sql(id INTEGER PRIMARY KEY)";
        $this->conector->sentencia($sql);
    }
    
    function eliminarTabla(){
        $sql = "DROP TABLE ".$this->tabla;
        $this->conector->sentencia($sql);
    }
}

?>