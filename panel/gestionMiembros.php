<?php

include_once '../config/config.php';
include_once '../config/seguridad.php';
include_once '../config/variables.php';

seguridadInterior(DIRECTOR);

if($_SESSION['rol']>=2){
if(isset($_GET['login'])){
	$conexion=mysqli_connect($host,$user,$password,$db,$port) or die("Error en la conexión");
	$loginLimpio=mysqli_real_escape_string($conexion, $_GET['login']);
	$consulta="DELETE FROM usuarios WHERE login='$loginLimpio';";
	mysqli_query($conexion, $consulta) or die(mysqli_error($conexion));
	mysqli_close($conexion);
	header("Location: gestionMiembros");
	
}}

if($_SESSION['rol']>=2){
if(isset($_POST['anadeUsuarios'])){

        $destino="../fotos/perfiles/defecto.png";
	$consulta="INSERT INTO `usuarios` VALUES('$_POST[login]', PASSWORD('$_POST[password]'), '$_POST[nombre]', '$_POST[apellidos]', '$_POST[rol]', '$_POST[puesto]', '$_POST[salario]', '$destino');";
	$conexion=mysqli_connect($host,$user,$password,$db,$port) or die("Error en la conexión");
	mysqli_query($conexion, $consulta) or die(mysqli_error($conexion));
	mysqli_close($conexion);
        
}}

if($_SESSION['rol']>=2){
if(isset($_POST['actualizaUsuarios'])){
    
        $consultaVerificar="SELECT password FROM usuarios WHERE login = '$_POST[login]'";
        $conexionVerificar=mysqli_connect($host,$user,$password,$db,$port) or die("Error en la conexión");
        $datosVerificar=mysqli_query($conexionVerificar, $consultaVerificar) or die(mysqli_error($conexionVerificar));
        $filaVerificar=mysqli_fetch_array($datosVerificar);
        if(!($_POST[password]==$filaVerificar[password])){
        
	$consulta="UPDATE usuarios SET password=password('$_POST[password]'), nombre='$_POST[nombre]', apellidos='$_POST[apellidos]', rol='$_POST[rol]', puesto='$_POST[puesto]', salario='$_POST[salario]' where login='$_POST[login]';";
	$conexion=mysqli_connect($host,$user,$password,$db,$port) or die("Error en la conexión");
	mysqli_query($conexion, $consulta) or die(mysqli_error($conexion));
        mysqli_close($conexion);}
        else{
        $consulta="UPDATE usuarios SET rol='$_POST[rol]', nombre='$_POST[nombre]', apellidos='$_POST[apellidos]', puesto='$_POST[puesto]', salario='$_POST[salario]' where login='$_POST[login]';";
	$conexion=mysqli_connect($host,$user,$password,$db,$port) or die("Error en la conexión");
	mysqli_query($conexion, $consulta) or die(mysqli_error($conexion));
        mysqli_close($conexion);
        }
}}

?>

<html>
    
    <head>
        
        <title><?php echo $tituloWeb ?></title>
        
        <meta charset="utf-8"/>
        
        <link rel="stylesheet" type="text/css" href="lsmc_panel.css">
        
        <script type="text/javascript" src="miembros.js"></script>
        
    </head>
    
    <body>

        <div class="banner">
            
            <a href="index">
            
            <table align="center"><tr><td><img src="<?php echo $banner ?>" align="center" /></td></tr></table>
            
            </a>
            
        </div>
        
        <div class="menu">
            
            <ul id="menu">
                <li><a href="index">Inicio</a></li>
                
                <li><a href="datos">Datos</a><li>
                
                <li><a href="mensajes">Mensajes</a></li> 
                    
                <li><a href="salir">Salir</a></li>

            </ul>
            
        </div>
        
        <?php  if($_SESSION['rol']>=1){
         echo "<div class='menu2'>";
            
         echo "<ul id='menu'>";
            
              if($_SESSION['rol']>=1){
                echo "<li><a href='gestionSolicitudes'>Solicitudes</a></li>";}
                    
                       if($_SESSION['rol']>=1){
               echo "<li><a href='gestionComunicados'>Comunicados</a></li>";}
                
                 if($_SESSION['rol']>=2){
               echo "<li><a href='gestionMiembros'>Miembros</a></li>";}  else {
                    echo "<li><a>Miembros</a></li>";
                } 
                
                if($_SESSION['rol']>=2){
               echo "<li><a href='configuracion'>Configuración</a></li>";}  else {
                    echo "<li><a>Configuracion</a></li>";
                } 
                
             echo "</ul>";
            
        echo "</div>";
        }else{
            echo "";
        }
        ?>
        
        <div class="seccion" style="background-color: <?php echo $colorBarra ?>;">
            
            <p>Bienvenido, <?php echo "".$_SESSION['nombreUsuario']." ".$_SESSION['apellidosUsuario'].""; ?></p>
            
        </div>
        
        <div class="seccion2">
            
            <table align="center"><tr><td><img src="<?php echo $logo ?>" align="center" /></td></tr></table>
            
            <hr width="75%" />
            
            <table align="center" width="100%"><tr><td align="center">
                       
		<form class="misUsuarios" method="POST" action="" onsubmit="return validarUsuarios(this);">
                    
            
                       <label>Login: </label><input type="text" name="login" onkeypress="this.style.backgroundColor='';" required/>
                       <label>Nombre: </label><input type="text" name="nombre" onkeypress="this.style.backgroundColor='';" required/>
                       <label>Apellidos: </label><input type="text" name="apellidos" onkeypress="this.style.backgroundColor='';" required/>
			<label>Contraseña: </label><input type="password" name="password" onkeypress="this.style.backgroundColor='';" required/>
			<label>Rol: </label><input type="text" name="rol" onkeypress="this.style.backgroundColor='';" required/>
                        <label>Puesto: </label><input type="text" name="puesto"/>
                        <label>Salario: </label><input type="text" name="salario"/>
			
			<label><input type="submit" name="anadeUsuarios" value="Añadir"/></label>
			<label><input type="submit" name="actualizaUsuarios" value="Editar" style="display:none"/></label>
                        
                </form></td><tr></table>
  
                   
		<table width="800" border="0" align="center"  cellpadding="1" cellspacing="1" style="margin-bottom:5px;">
		<?php
		
		// Crear la tabla con el listado de todas las filas 
		// de la tabla alumnos de la BD ejemplos.
		
		$conexion=mysqli_connect($host,$user,$password,$db,$port) or die("Error en la conexión");
		$consultaSQL="Select * from usuarios;";
		$datos=mysqli_query($conexion, $consultaSQL) or die(mysqli_error($conexion));
		
		// Ciclamos por todos las filas que me lleguen en $datos
		
		echo "<tr><td align='center'><b>Login</b></td><td align='center'><b>Nombre</b></td><td align='center'><b>Apellidos</b></td><td align='center'><b>Contraseña</b></td><td align='center'><b>Rol</b></td><td align='center'><b>Puesto</b></td><td align='center'><b>Salario</b></td></tr>";
		
		while($fila=mysqli_fetch_array($datos,MYSQLI_ASSOC)){
			
			echo "<tr><td class='miembros'>$fila[login]</td><td class='miembros'>$fila[nombre]</td><td class='miembros'>$fila[apellidos]</td><td class='miembros'>$fila[password]</td><td class='miembros'>$fila[rol]</td><td class='miembros'>$fila[puesto]</td><td class='miembros'>$fila[salario]</td><td class='miembros'><p style='text-align:center;'><a href='gestionMiembros?login=$fila[login]'>Borrar</a></td><td class='miembros'><p style='text-align:center;'><input id='botonEnlace' type='submit' name='editarMiembros' onclick='cargaUsuarios(this);' value='Editar'></td></tr>";
			
		}
		mysqli_close($conexion);
                
                
                
?>
                </table>
            
                    
		
                
            </div>
        
        <div class="inferior">
            
            <p><?php echo $copyright ?></p>
                        
        </div>
        
    </body>
    
    
</html>
