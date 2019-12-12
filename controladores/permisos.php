<?php
require '../basededatos/constructorConsulta.php';

class Permiso{
    public $id;
    public $nombre;
    static $nombreTabla = "permisos";
    function __construct()
    {

    }

    static function crearTabla(){
        $constructor = new Builder(self::$nombreTabla);
        $constructor->crearTabla([
            "nombre"=>$constructor->cadenaConNumero(255)
        ]);
    }

    function guardar(){
        $constructor = new Builder(self::$nombreTabla);
        if($this->id == null){
            $constructor->insertar([
                "nombre"=>"'$this->nombre'"
            ]);
        }else{
            $constructor->actualizar($this->id, [
                "nombre"=>"'$this->nombre'"
            ]);
        }

    }


    static function buscar(int $id){
        $constructor = new Builder(self::$nombreTabla);
        $resultado = $constructor->obtener($id);
        $permiso = new Permiso();
        $permiso->id = $resultado["id"];
        $permiso->nombre = $resultado["nombre"];
        return $permiso;
    }

    static function eliminarTabla(){
        $constructor = new Builder(self::$nombreTabla);
        $constructor->eliminarTabla();
    }

    static function obtenerTodos(){
        $constructor = new Builder(self::$nombreTabla);
        $retorno = [];
        
    }

    function eliminar(){
        $constructor = new Builder(self::$nombreTabla);
        $constructor->eliminar($this->id);
    }
}
