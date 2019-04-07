<?php

include_once './config/config.php';
include_once './config/variables.php';

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
        
        <div class="seccion" style="background-color: <?php echo $colorBarra ?>;"></div>
        
        <div class="seccion2">
            
            <table align="center"><tr><td><img src="<?php echo $logo ?>" align="center" /></td></tr></table>
            
            <hr width="75%" />
            
            <p><b>Los Santos Media Corporation</b> es la corporación número uno en 
                medios de comunicación en la ciudad de Los Santos. Su sede se 
                encuentra en Western Avenue, Vinewood, Los Santos. En la 
                actualidad las empresas que forman parte de ella son <b>Los Santos 
                Visión</b> (empresa pública dedicada al campo televisivo en Los Santos), 
                <b>Los Santos FM</b> (empresa pública dedicada al campo de radio-locución en Los Santos), 
                y <b>News Near You</b> (empresa privada dedicada al campo periodístico en Los Santos).</p>

                
                    
                <p>La corporación es de carácter público y está financiada en su 
                totalidad por la Alcaldía de Los Santos. Fue creada en julio del
                año 2016 a raíz del cierre de la empresa Radio Televisión Pública
                de Los Santos por Otto Fredriksson, Arnold Gibbs y Aria Zaffiri 
                (antigua directiva de Radio Televisión Pública de Los Santos) con
                un objetivo común: proporcionar información clara y entretener al
                espectador con la mejor programación en diferentes formatos.</p>
                
                <table align="center"><tr><td>
                        <img class="imagenes" src="images/logo_edificio.png"/></td></tr></table>
                
            </div>
        
        <div class="inferior">
            
            <p><?php echo $copyright ?></p>
                        
        </div>
        
    </body>
    
    
</html>

