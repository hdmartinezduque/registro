<script type="text/javascript">

function Validar() 
{
    var primer_apellido = document.forms["myForm"]["primer_apellido"].value;
	var segundo_apellido = document.forms["myForm"]["segundo_apellido"].value;
	var primer_nombre = document.forms["myForm"]["primer_nombre"].value;
	var segundo_nombre = document.forms["myForm"]["segundo_nombre"].value;
    var RE = new RegExp("^[a-zA-Z\\s]+$");

    if(!RE.test(primer_apellido))
	{
		alert("Primer Apellido: No cumple con las especificaciones del campo");
		return false;
	} 

    if(!RE.test(segundo_apellido))
	{
		alert("Segundo Apellido: No cumple con las especificaciones del campo");
		return false;
	} 

    if(!RE.test(primer_nombre))
	{
		alert("Primer Nombre: No cumple con las especificaciones del campo");
		return false;
	} 

    if(!RE.test(segundo_nombre))
	{
		alert("Segundo Nombre: No cumple con las especificaciones del campo");
		return false;
	} 
}

function Eliminar(cod) 
{
	var empleado = confirm("esta seguro que desea eliminar al empleado");
	if(empleado) {
		var dir = "../process/del_empleado.php?id=" + cod;
		window.location.href = dir;
	}
	else return false;
}
</script>