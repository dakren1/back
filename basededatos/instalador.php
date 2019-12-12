<?php

require 'constructorConsulta.php';

$chofer = new Builder("chofer");
$chofer->eliminarTabla();
$chofer->crearTabla([]);
?>