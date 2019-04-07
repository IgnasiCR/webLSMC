<?php


define("DIRECTOR",2);
define("COORDINADOR",1);
define("EMPLEADO",0);

function seguridad($rol){
 //Prorogamos la sesión activa
	 session_start();
	 //Verificamos que venimos de una sesión activa e identificada
	 if(!($_SESSION['autenticado'] && $_SESSION['rol']>=$rol)){
			header("Location: ../index.php");
	 }
	
}

function seguridadInterior($rol){
 //Prorogamos la sesión activa
	 session_start();
	 //Verificamos que venimos de una sesión activa e identificada
	 if(!($_SESSION['autenticado'] && $_SESSION['rol']>=$rol)){
			header("Location: index.php");
	 }
	
}

?>