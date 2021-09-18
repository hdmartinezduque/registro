<?php
include '../lib/configServer.php';
include '../lib/consulSQL.php';

$data = file_get_contents("../lib/user.json");
$user = json_decode($data);


foreach ($user as $row) {
    $email = $row->email;
    $nombre = $row->nombre;
    $apellido = $row->apellido;
    $password = $row->pass;
    $estado = $row->estado;
}
$password=consultasSQL::clean_string(md5($password));
consultasSQL::InsertSQL("usuario", "email, nombre, apellido, password, estado", "'$email','$nombre', '$apellido','$password', '$estado'"); 
?>