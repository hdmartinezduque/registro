<?php

include '../lib/configServer.php';
include '../lib/consulSQL.php';
include '../lib/link.php';

$email=consultasSQL::clean_string($_POST['email']);
$nombre=consultasSQL::clean_string($_POST['nombre']);
$apellido=consultasSQL::clean_string($_POST['apellido']);
$password=consultasSQL::clean_string(md5($_POST['password']));
$estado =1;

$verificar= ejecutarSQL::consultar("SELECT * FROM usuario WHERE email='$email'");
$verificaltotal = mysqli_num_rows($verificar);
if ($verificaltotal>0){
    $return = '<script language="javascript">
    document.location.href="../index.php?id=1&Error=usuario ya existe"</script>';
}else{
    consultasSQL::InsertSQL("usuario", "email, nombre, apellido, password, estado", "'$email','$nombre', '$apellido','$password', '$estado'");
    $return = '<script language="javascript">
    document.location.href="../index.php?id=1&Error=Datos Correctos"</script>';
}
print $return;

?>