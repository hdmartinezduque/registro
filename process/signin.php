<?php

session_start();
include '../lib/configServer.php';
include '../lib/ConsulSQL.php';

$verUser = '';
$email=consultasSQL::clean_string($_POST['email']);
$password=consultasSQL::clean_string(md5($_POST['password']));

$verificar= ejecutarSQL::consultar("SELECT * FROM usuario WHERE email='$email' AND password='$password' AND estado = 1");
$verificaltotal = mysqli_num_rows($verificar);

if ($verificaltotal>0){
    $filaU=mysqli_fetch_array($verificar, MYSQLI_ASSOC);
    $_SESSION['email']=$email;
    $_SESSION['password']=$password;
    $_SESSION['userid']=$filaU['id'];

    $return = '<script language="javascript">
    document.location.href="../admin/principal.php"</script>';
}else{
    $return = '<script language="javascript">
    document.location.href="../index.php?id=0&Error=Datos Incorrectos"</script>';
}
print $return;
?>