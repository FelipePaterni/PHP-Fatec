<?php
$id = filter_input(INPUT_GET, 'id');

include_once '../class/Viagem.php';
$cat = new Viagem();

$cat->setId($id);
$cat->crud(0);
?>

<meta http-equiv="refresh" content="0.1;URL=?p=viagem/listar">