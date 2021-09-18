
<?php
include '../lib/configServer.php';
include '../lib/consulSQL.php';
include '../lib/link.php';
include '../js/validacion.js';


date_default_timezone_set('America/Bogota');
session_start(); 
$json_menu = file_get_contents('../lib/menu.json');
$data = json_decode($json_menu);
if(!empty($data)){
  $menu = '<nav class="navbar fixed-bottom navbar-expand-sm navbar-dark bg-dark">
  <div class="container-fluid">
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarCollapse">
        <ul class="navbar-nav">

        <li class="nav-item dropup">
            <a class="nav-link dropdown-toggle" href="#" id="dropdown10" data-bs-toggle="dropdown" aria-expanded="false">Empleados</a>
            <ul class="dropdown-menu" aria-labelledby="dropdown10">';
  foreach($data as $row){
    $menu .= '<li><a class="dropdown-item" href="'.$row->link.'">'.$row->modulo.'</a></li>';
  }
}

$consulta_empleados ='';
$verificar= ejecutarSQL::consultar("SELECT * FROM empleado_det");
$verificaltotal = mysqli_num_rows($verificar);


if($verificaltotal>0){
  $consulta_empleados ='
  <table id="registro" class="table table-striped table-bordered" style="width:100%">
  <thead>
    <th>Nombre Completo</th>
    <th>Pais</th>
    <th>Tipo Identidad</th>
    <th>Identificaci&oacute;n</th>
    <th>Correo electronico</th>

    <th>Fecha Registro</th>
  </thead>
  <tbody>';
    while($fila=mysqli_fetch_array($verificar, MYSQLI_ASSOC)){
      $mensaje = 'Editar';
      $edicion = 'add_empleado.php?id=3&Error='.$mensaje.'&pa='.$fila['primer_apellido'].'&sa='.$fila['segundo_apellido'].'&pn='.$fila['primer_nombre'].'&sn='.$fila["segundo_nombre"].'&pais='.$fila['id_pais'].'&ti='.$fila['id_identificacion'].'&identificacion='.$fila['numero_identificacion'].'&id_empleado='.$fila['id'].'&fecha='.$fila['fecha_registro'];
      $consulta_empleados .= '<tr>';
      $consulta_empleados .= '<td>'.$fila['primer_apellido'].' ';
      $consulta_empleados .= $fila['segundo_apellido'].' ';
      $consulta_empleados .= $fila['primer_nombre'].' ';
      $consulta_empleados .= $fila['segundo_nombre'].'</td>';
      $consulta_empleados .= '<td>'.$fila['pais'].'</td>';
      $consulta_empleados .= '<td>'.$fila['tipo_identificacion'].'</td>';
      $consulta_empleados .= '<td>'.$fila['numero_identificacion'].'<a href="#" onclick="Eliminar('.$fila['id'].')"><img src="../img/trash.png" height="16" width="16" align = right title="Eliminar"></a><a href="'.$edicion.'"> <img src="../img/pen.png" height="16" width="16" align = right title="Click para Editar"></a></td>';
      $consulta_empleados .= '<td>'.$fila['email'].'</td>';
      $consulta_empleados .= '<td>'.$fila['fecha_registro'].'</td>';
      $consulta_empleados .= '</tr>';
    }
    $consulta_empleados .='</tbody></table>';
    $consulta_empleados .= "<script>
    $(document).ready(function() {
        $('#registro').DataTable( {
            'pagingType': 'full_numbers'
        } );
    } );
    </script>";
}


$agregar_empleados = '<center><table><tr><td>No existen datos clic para registro de empleado <a href="add_empleado.php"><img src = "../img/add.png" height="16" width="16" align = "right"></a></td></tr></table></center>';

$head = '<html lang="en">';
$head .= '<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="description" content="">
<title>Registro Empleados</title>';
$head .= '<style>
  .bd-placeholder-img {
    font-size: 1.125rem;
    text-anchor: middle;
    -webkit-user-select: none;
    -moz-user-select: none;
    user-select: none;
  }

  @media (min-width: 768px) {
    .bd-placeholder-img-lg {
      font-size: 3.5rem;
    }
  }
</style>


</head>';


$body_head = '<body>';
$body_foot = '</body></html>';


if(empty($_SESSION['userid']))
{
    $return = '<script language="javascript">
    document.location.href="../index.php?id=0&Error=Conexion no valida"</script>';
}else{
    $id = $_SESSION['userid'];
    $modulo = 1;
    $fecha  = date("Y-m-d H:i:s");
    $mvto = 'conexion';
    //Insertar LOG TX
    consultasSQL::InsertSQL("logtx","id_usuario, id_modulo , fecha_trax, mvto","'$id', '$modulo', '$fecha', '$mvto'");
    $return =  $head;
    $return .= $body_head;
    if (strlen($consulta_empleados)>0){
        $return .= $consulta_empleados;
    }else{
        $return .= $agregar_empleados;
    }
    $return .= $menu;
    $return .= $body_foot;

}
print $return;
?>