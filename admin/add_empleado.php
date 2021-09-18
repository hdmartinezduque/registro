<?php

include '../lib/configServer.php';
include '../lib/consulSQL.php';
include '../lib/link.php';
include '../js/validacion.js';
date_default_timezone_set('America/Bogota');
session_start(); 
if (isset($_GET["id"])){
  $id = $_GET["id"];
  $error = $_GET["Error"];
  if($id==3){
    $pa = $_GET["pa"];
    $sa = $_GET["sa"];
    $pn = $_GET["pn"];
    $sn = $_GET["sn"];
    $id_pais = $_GET["pais"];
    $ti = $_GET["ti"];
    $identificacion = $_GET["identificacion"];
    $fecha = $_GET["fecha"];
    $id_empleado = $_GET["id_empleado"];
  }
}

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

if (isset($_GET["id"])){
  if ($id==3){
      $action = '../process/put_empleado.php';
      $name_button = 'Actualizar Empleado';
      $campo_id = '<input type=hidden id="id_empleado" name= "id_empleado" value = "'.$id_empleado.'">';
  }else{
    $action = '../process/add_empleado.php';
    $name_button = 'Registrar Empleado';
  }
  
}else{
  $action = '../process/add_empleado.php';
  $name_button = 'Registrar Empleado';
}

$formulario = '';
$formulario .= '<form class="row g-3" name = "myForm" action="'.$action.'" onsubmit="return Validar()" method="POST">';
if (isset($_GET["id"])){
  if ($id==3){
      $formulario .= $campo_id;
  }
}
$formulario .= '<div class="col-md-6">
<label for="inputPrimerApellido" class="form-label">Primer Apellido</label>
<input type="text" class="form-control" id="primer_apellido" name="primer_apellido" maxlength="20"  required onkeyup="javascript:this.value=this.value.toUpperCase();"';
if (isset($_GET["id"])){
  if ($id==3){
    $formulario .= 'value="'.$pa.'"';
  }
}  
$formulario .='></div>';
$formulario .= '<div class="col-md-6">
<label for="inputSegundoApellido" class="form-label">Segundo Apellido</label>
<input type="text" class="form-control" id="segundo_apellido" name="segundo_apellido" maxlength="20" required onkeyup="javascript:this.value=this.value.toUpperCase();"';
if (isset($_GET["id"])){
  if ($id==3){
    $formulario .= 'value="'.$sa.'"';
  }
}
$formulario .='></div>';
$formulario .= '<div class="col-md-6">
<label for="inputPrimerNombre" class="form-label">Primer Nombre</label>
<input type="text" class="form-control" id="primer_nombre" name="primer_nombre" maxlength="20" required onkeyup="javascript:this.value=this.value.toUpperCase();"';
if (isset($_GET["id"])){
  if ($id==3){
    $formulario .= 'value="'.$pn.'"';
  }
}
$formulario .='></div>';
$formulario .= '<div class="col-md-6">
<label for="inputSegundoNombre" class="form-label">Segundo Nombre</label>
<input type="text" class="form-control" id="segundo_nombre" name="segundo_nombre" required maxlength="50" onkeyup="javascript:this.value=this.value.toUpperCase();"';
if (isset($_GET["id"])){
  if ($id==3){
    $formulario .= 'value="'.$sn.'"';
  }
}
$formulario .='></div>';

$formulario .= '<div class="col-md-6">
<label for="inputPais" class="form-label">Pais</label>
<select id="id_pais" name="id_pais" class="form-control" data-live-search="false" title="Pais" required>';
if (isset($_GET["id"])){
  if ($id==3){
    $conn= ejecutarSQL::consultar("SELECT * FROM pais WHERE id = '$id_pais'");
    while($con=mysqli_fetch_array($conn, MYSQLI_ASSOC)){
      $formulario .= '<option selected value = "'.$con['id'].'">'.$con['pais'].'</option>';
      }
    $conn= ejecutarSQL::consultar("SELECT * FROM pais");
    while($con=mysqli_fetch_array($conn, MYSQLI_ASSOC)){
      $formulario .= '<option value = "'.$con['id'].'">'.$con['pais'].'</option>';
    }
  }else{
      $conn= ejecutarSQL::consultar("SELECT * FROM pais");
      while($con=mysqli_fetch_array($conn, MYSQLI_ASSOC)){
      $formulario .= '<option value = "'.$con['id'].'">'.$con['pais'].'</option>';
    }
  }
}else{
    $conn= ejecutarSQL::consultar("SELECT * FROM pais");
    while($con=mysqli_fetch_array($conn, MYSQLI_ASSOC)){
      $formulario .= '<option value = "'.$con['id'].'">'.$con['pais'].'</option>';
  }
}
$formulario .= '</select></div>';

  
$formulario .= '<div class="col-md-6">
<label for="inputIdentificacion" class="form-label">Tipo Identificacion</label>
<select id="id_identificacion" name="id_identificacion" class="form-control" data-live-search="false" title="Tipo Identificacion" required>';
if (isset($_GET["id"])){  
  if ($id==3){
      $conn= ejecutarSQL::consultar("SELECT * FROM tipo_identificacion WHERE id='$ti'");
      while($con=mysqli_fetch_array($conn, MYSQLI_ASSOC)){
        $formulario .= '<option selected value = "'.$con['id'].'">'.$con['tipo_identificacion'].'</option>';
      }
      $conn= ejecutarSQL::consultar("SELECT * FROM tipo_identificacion");
      while($con=mysqli_fetch_array($conn, MYSQLI_ASSOC)){
        $formulario .= '<option value = "'.$con['id'].'">'.$con['tipo_identificacion'].'</option>';
      }
  }else{
      $conn= ejecutarSQL::consultar("SELECT * FROM tipo_identificacion");
      while($con=mysqli_fetch_array($conn, MYSQLI_ASSOC)){
        $formulario .= '<option value = "'.$con['id'].'">'.$con['tipo_identificacion'].'</option>';
      }
  }
}else{
    $conn= ejecutarSQL::consultar("SELECT * FROM tipo_identificacion");
    while($con=mysqli_fetch_array($conn, MYSQLI_ASSOC)){
      $formulario .= '<option value = "'.$con['id'].'">'.$con['tipo_identificacion'].'</option>';
  }
}
$formulario .= '</select></div>';
$formulario .= '<div class="col-md-6">
<label for="inputidentificacion" class="form-label">Identificaci&oacute;n</label>
<input type="text" class="form-control" id="numero_identificacion" name="numero_identificacion" required '; 
if (isset($_GET["id"])){
  if ($id==3){
    $formulario .= 'value="'.$identificacion.'"';
  }
}
$formulario .='></div>';

$formulario .='<div class="col-md-6">
<label for="inputfechaIngreso" class="form-label">Fecha Ingreso</label>
<input type="date" class="form-control" id="fecha_ingreso" name = "fecha_ingreso" required ';
if (isset($_GET["id"])){
  if ($id==3){
     $formulario .= 'readonly value="'.$fecha.'"';
  }
}
$formulario .='></div>';
$formulario .= '<div class="col-md-1">
<div class="checkbox">
  <label for="inputEstado" class="form-label">Estado</label>
  <input type="checkbox" checked data-toggle="toggle" id = "estado" name = "estado">
</div>
</div>';
$formulario .= '<div class="col-12">
<center><button type="submit" class="btn btn-primary">'.$name_button.'</button></center>
</div><br><br><br>';
$formulario .= '</form>';

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

  if(empty($_SESSION['userid']))
  {
      $return = '<script language="javascript">
      document.location.href="../index.php?id=0&Error=Conexion no valida"</script>';
  }else{
    //$id = $_SESSION['userid'];
    //$modulo = 1;
    //$fecha  = date("Y-m-d H:i:s");
    //$mvto = 'conexion';
    //Insertar LOG TX
    //consultasSQL::InsertSQL("logtx","id_usuario, id_modulo , fecha_trax, mvto","'$id', '$modulo', '$fecha', '$mvto'");
    $return =  $head;
    $return .= $body_head;
    $return .= $formulario; 
    if (isset($_GET["id"])){
          $return .= '<center><p>'.$error.'</p></center>';
    }  
    $return .= $menu;
    $return .= $body_foot;
  }
  print $return;
?>