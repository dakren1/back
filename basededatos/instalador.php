<?php

require '../controladores/permisos.php';

$permiso = Permiso::buscar(1);
//$permiso->nombre = "Chofer";
//$permiso->guardar();
echo $permiso->nombre;
$permiso->eliminar();
?>