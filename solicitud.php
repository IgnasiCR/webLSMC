<?php

include_once './config/config.php';
include_once './config/variables.php';

if(isset($_POST['enviarSolicitud'])){
    
        $textoEnvio=htmlentities(addslashes($_POST[redaccion]));
	$consulta="INSERT INTO solicitudes values('','$_POST[nombre]','$_POST[edad]','$_POST[dni]','$_POST[empresa]','$_POST[telefono]','$_POST[razonSolicitud]','".$textoEnvio."');";
	$conexion=mysqli_connect($host,$user,$password,$db,$port) or die("Error en la conexión");
	mysqli_query($conexion, $consulta) or die(mysqli_error($conexion));
	mysqli_close($conexion);
        $confirmacion="Solicitud enviada correctamente. Entre 24 y 48 horas tendrá respuesta.";
}

?>

<html>
    
    <head>
        
        <title><?php echo $tituloWeb ?></title>
        
        <meta charset="utf-8"/>
        
        <link rel="stylesheet" type="text/css" href="lsmc.css">
        
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
        
        <div class="seccion" style="background-color: <?php echo $colorBarra ?>;"><p><?php echo $confirmacion ?></div>
        
        <div class="seccion2">
            
           <table align="center"><tr><td><img src="<?php echo $logo ?>" align="center" /></td></tr></table>
            
            <hr width="75%" />
            
            <p><b>Los Santos Media Corporation</b> abre su bolsa de empleo para obtener la
            oportunidad de formar parte de nuestro grupo de empresas dedicadas 
            los medios de comunicación. La solicitud que se tramitará mediante el
            envío de este formulario será para el puesto de Becario. Actualmente
            no contamos con ningún número de plazas limitadas en la corporación,
            por lo que las oposiciones permanecerán abiertas hasta nuevo aviso.</p>

            <p>Aseguramos un puesto de trabajo fijo si el empleado cumple con el perfil
            que se busca en la empresa. Los salarios se establecerán acorde al trabajo
            realizado, y se remunera en muchas ocasiones con pagas extra.</p>

            <p>La dirección de la empresa pone al servicio de la plantilla de empleados
            un equipo de coordinadores cuya labor se centra en la formación de los empleados.
            Se ocupan de guiarles en sus funciones, y de proporcionar las enseñanzas necesarias
            para llevar a cabo su trabajo satisfactoriamente.</p>
       
            <hr width="75%" />
            
            <table class="solicitud_tabla"><tr><td>
                       
                        <script type="text/javascript" src="./editor/editor.js"></script> <script type="text/javascript">
  bkLib.onDomLoaded(function() {
        new nicEditor({buttonList : ['bold','italic','underline','strikeThrough','ol','ul','link','left','center','right','justify','html','image']}).panelInstance('areaTexto');
       
  });
  </script>
                        
		<form class="solicitud" method="POST" action="">
                    
                    <table>
                        
                        <tr>
                        
                            <td>Nombre:</td><td><input type="text" name="nombre" required/></td></tr>
                        
                        <tr><td>Edad:</td><td><input type="text" name="edad" required/></td></tr>
                        
			<tr><td>DNI ((ID Personaje)):</td><td><input type="text" name="dni" reqired/></td></tr>
                       
                        <tr><td>Empresa a la que quiere pertenecer:</td><td>
                            <input type="radio" name="empresa" value="NNY" checked> News Near You<br>
                            <input type="radio" name="empresa" value="LSFM"> Los Santos FM<br>
                            <input type="radio" name="empresa" value="LSV"> Los Santos Visión</td></tr>
                        <tr><td>Teléfono:</td><td><input type="text" name="telefono" required/></td></tr>
                        
                        <tr><td>¿Por qué quiere pertenecer a la empresa solicitada?:</td><td><textarea name="razonSolicitud" rows="10" cols="30" required></textarea></td></tr>
                        
                        <tr><td>Teniendo en cuenta a la empresa de la corporación<br/>
                                a la que va a pertenecer, redacte una noticia/guión<br/>
                                de radio/guión de televisión de temática libre:</td><td><textarea cols="50" name="redaccion" id="areaTexto" style="width:100%; height:300px" required>

                                                                    </textarea></td></tr>
                        
			<tr><td><label><input type="submit" name="enviarSolicitud" value="Enviar"/></label></td></tr>
                        
                    </table>
                        
                </form></td></tr></table>
                
            </div>
        
        <div class="inferior">
            
           <p><?php echo $copyright ?></p>
                        
        </div>
        
    </body>
    
    
</html>
