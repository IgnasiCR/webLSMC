<?php
include_once "./config/config.php";
include_once './config/variables.php';
if(isset($_POST['entrar'])){
	    //Conecto con la BD
	    $conexion=mysqli_connect($host,$user,$password, $db, $port);
	    // Escapar código no seguro que llegue desde el formulario
		$usuario=mysqli_real_escape_string($conexion,$_POST['login']);
		$pass=mysqli_real_escape_string($conexion,$_POST['password']);
		//Crear el string o cadena de consulta
		$consulta="Select * from usuarios "
                        . "where login='$usuario' "
                        . "and `password`= password('$pass');";
				 
	    // Lanzar la ejecución de la consulta				
	    $datos=mysqli_query($conexion,$consulta) or die(mysqli_error($conexion));
	    //Comprobar que nos da como resultado una fila en la bd
	    if(mysqli_num_rows($datos)==1){
		//identificación positiva
		session_start();
		$_SESSION['autenticado']=true;
		$fila=mysqli_fetch_array($datos,MYSQLI_ASSOC);
		$_SESSION['rol']=$fila['rol'];
                $_SESSION['nombre']=$fila['login'];
                $_SESSION['nombreUsuario']=$fila['nombre'];
                $_SESSION['apellidosUsuario']=$fila['apellidos'];
                $_SESSION['puesto']=$fila['puesto'];
                $_SESSION['salario']=$fila['salario'];
		header("Location: panel/");
		}else{
			$error="Fallo en la autenticación y/o acceso restringido.";
		}
	
}	

?>

<html>
    
    <head>
        
        <title><?php echo $tituloWeb ?></title>
        
        <meta charset="utf-8"/>
        
        <link rel="stylesheet" type="text/css" href="lsmc.css">
        
         <script type="text/javascript" src="validacion.js"></script>
        
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
                <li><a href="solicitud">Solicitud</a></li>
                <li><a href="login">Login</a></li>

            </ul>
            
        </div>
        
         <div class="seccion" style="background-color: <?php echo $colorBarra ?>;"><p><?php echo $error;?></p></div>
        
        <div class="seccion2">
            
           <table align="center"><tr><td><img src="<?php echo $logo ?>" align="center" /></td></tr></table>
            
            <hr width="75%" />
    
            <h1 align="center" style="font-family: 'Open Sans', sans-serif; font-size: 35px; padding: 2px;">Acceso al Panel Privado</h1>
            
            <table align="center"><tr><td><form class="miLogin" name="loguearse" method="POST" action="" onsubmit="return validarLogin(this);">
            
            <p style="font-family: 'Open Sans', sans-serif; font-size: 15px; padding: 2px;">
                <label>Login: </label><input type="text" name="login" placeholder="Ejemplo: Nombre_Apellido" onkeypress="this.style.backgroundColor='';" required/>
            <label>Password: </label><input type="password" name="password" onkeypress="this.style.backgroundColor='';" required/>
            <p align="center"><input type="submit" name="entrar" value="Entrar"/></p>
             
            
                        </form></td></tr>  
           
            </table>
                
            </div>
        
        <div class="inferior">
            
            <p><?php echo $copyright ?></p>
                        
        </div>
        
    </body>
    
    
</html>