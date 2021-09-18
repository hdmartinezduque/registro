<?php

include '../lib/configServer.php';
include '../lib/consulSQL.php';
include '../lib/link.php';
date_default_timezone_set('America/Bogota');
session_start(); 
$id_empleado=consultasSQL::clean_string($_GET["id"]);

if(empty($_SESSION['userid']))
{
    $return = '<script language="javascript">
    document.location.href="../index.php?id=0&Error=Conexion no valida"</script>';
}else{

    if(consultasSQL::DeleteSQL('empleado', "id='".$id_empleado."'")){
        $return = '<script language="javascript">
        document.location.href="../admin/add_empleado.php?id=0&Error=Actualizacion exitosa"</script>';
    }else{
        $return = '<script language="javascript">
        document.location.href="../admin/add_empleado.php?id=5&Error=Se presentaron problemas"</script>';
    }
}
print $return;
?>