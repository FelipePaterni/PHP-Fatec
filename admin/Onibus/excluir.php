<?php
$id = filter_input(INPUT_GET, 'id');

include_once '../class/Onibus.php';
$cat = new Onibus();

$cat->setId($id);
$cat->crud(0);
?>

<meta http-equiv="refresh" content="0.1;URL=?p=onibus/listar">



