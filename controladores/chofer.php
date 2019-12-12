<?php
require '../basededatos/constructorConsulta.php';

class Chofer{
    private $id;
    static $nombre = "chofer";
    function __construct()
    {
        //Deuelve un arreglo con parametros
        $parametros = func_get_args();
        $num_params = func_num_args();
        if($num_params == 0){
            $this->id = null;
        }
        else{
            $this->id = $parametros[0];
        }

    }

    static function crearTabla(){
        $constructor = new Builder(self::$nombre);
        $constructor->crearTabla([
            "nombre"=>$constructor->cadenaConNumero(255)
        ]);
    }

    static function eliminarTabla(){
        $constructor = new Builder(self::$nombre);
        $constructor->eliminarTabla();
    }
}
?>