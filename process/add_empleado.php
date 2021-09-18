<?php

include '../lib/configServer.php';
include '../lib/consulSQL.php';
include '../lib/link.php';
include '../js/validacion.js';
date_default_timezone_set('America/Bogota');
session_start(); 

function CorreoElectronico($primer_nombre, $primer_apellido, $id_pais){
    $primer_nombre = str_replace(' ','',$primer_nombre);
    $primer_apellido = str_replace(' ','',$primer_apellido);
    $conn= ejecutarSQL::consultar("SELECT * FROM pais where id ='$id_pais'");
    while($con=mysqli_fetch_array($conn, MYSQLI_ASSOC)){
        $dominio = $con['dominio'];
      }
    $correoelectronico = $primer_nombre.'.'.$primer_apellido.'@'.$dominio;
    $conn= ejecutarSQL::consultar("SELECT * FROM empleado where email ='$correoelectronico'");
    $conntotal = mysqli_num_rows($conn);
    
    if($conntotal>0){
        $val = 0;
        $contador =1;
        while($val ==0){
            $correoelectronico = $primer_nombre.'.'.$primer_apellido.$contador.'@'.$dominio;
            $conn= ejecutarSQL::consultar("SELECT * FROM empleado where email ='$correoelectronico'");
            $conntotal = mysqli_num_rows($conn);
            if($conntotal==0){
                $val = 1;
            }else{
                $contador = $contador+1;
            }
        }
    }
    
    return strtolower($correoelectronico);

}

function validarFecha($fecha_ingreso){
    $fecha_actua = date("Y-m-d");
    $diff = (strtotime($fecha_actua)-strtotime($fecha_ingreso))/86400;
    if ($diff<0){
        $mensaje = 1;
    }else{
        if($diff>30){
            $mensaje = 2;
        }else{
            $mensaje = 0;
        }
    }
    return $mensaje;
}

function ValidarIdentificacion($numero_identificacion){
    $conn= ejecutarSQL::consultar("SELECT * FROM empleado where numero_identificacion ='$numero_identificacion'");
    $conntotal = mysqli_num_rows($conn);
    return $conntotal;

}
$primer_apellido = $_POST["primer_apellido"];
$segundo_apellido = $_POST["segundo_apellido"];
$primer_nombre = $_POST["primer_nombre"];
$segundo_nombre = $_POST["segundo_nombre"];
$id_pais = $_POST["id_pais"];
$id_identificacion = $_POST["id_identificacion"];
$numero_identificacion = $_POST["numero_identificacion"];
$fecha_ingreso = $_POST["fecha_ingreso"];
$estado = $_POST["estado"];

$email = CorreoElectronico($primer_nombre, $primer_apellido, $id_pais);

if(empty($_SESSION['userid']))
{
    $return = '<script language="javascript">
    document.location.href="../index.php?id=0&Error=Conexion no valida"</script>';
}else{
  $id = $_SESSION['userid'];
  $modulo = 1;
  $fecha  = date("Y-m-d H:i:s");
  $mvto = 'Empleado'.$numero_identificacion.' Registrado con exito';
if ($estado=="on"){
    $estado=1;
}else{
    $estado=1;
}
  //Insertar LOG TX
  consultasSQL::InsertSQL("logtx","id_usuario, id_modulo , fecha_trax, mvto","'$id', '$modulo', '$fecha', '$mvto'");
  if (validarFecha($fecha_ingreso)!=0)
  {
    $return = '<script language="javascript">
    document.location.href="../admin/add_empleado.php?id=4&Error=Error en la fecha de Ingreso"</script>';   
  }else{
    if (ValidarIdentificacion($numero_identificacion) == 0){
    consultasSQL::InsertSQL(
          "empleado",
          "primer_apellido
          , segundo_apellido 
          , primer_nombre
          , segundo_nombre
          , id_pais
          , tipo_identificacion
          , numero_identificacion
          , email
          , estado
          , fecha_registro"
          ,"'$primer_apellido', '$segundo_apellido', '$primer_nombre', '$segundo_nombre','$id_pais', '$id_identificacion', '$numero_identificacion', '$email', '$estado', '$fecha_ingreso'");
    
            $return = '<script language="javascript">
            document.location.href="../admin/add_empleado.php?id=1&Error=Empleado Ingresado Exitosamente"</script>';   
    }else{
        $return = '<script language="javascript">
        document.location.href="../admin/add_empleado.php?id=2&Error=El numero de identificacion '.$numero_identificacion.' ya se encuentra registrado"</script>'; 
    }   
}
}
print $return;


?>