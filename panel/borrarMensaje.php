
<?php

include_once '../config/config.php';
include_once '../config/seguridad.php';

seguridadInterior(EMPLEADO);

$receptor = $_GET['receptor'];

if(!($receptor==$_SESSION['nombre'])){
            header("Location: mensajes");
        }
if(isset($_GET['ID'])){
	$conexion=mysqli_connect($host,$user,$password,$db,$port) or die("Error en la conexión");
	$IDLimpio=mysqli_real_escape_string($conexion, $_GET['ID']);
        $receptorLimpio=mysqli_real_escape_string($conexion, $_SESSION['nombre']);
	$consulta="DELETE FROM mensajes WHERE ID='$IDLimpio' and receptor='$receptorLimpio';";
	mysqli_query($conexion, $consulta) or die(mysqli_error($conexion));
	mysqli_close($conexion);
	header("Location: mensajes");
	
}
