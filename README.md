webLSMC
==========

A project of a web site made with HTML, CSS, JavaScript and PHP. System of messages, avatars, and more... 2016-2017.
Un projecto de una web creada con HTML, CSS, JavaScript y PHP. Sistema de mensajes, avatares, y más... 2016-2017.

Paso 1. Servidores web y MSQL
-------------------------------

Es recomendando instalar WAMP o LAMP desde la web de Bitnami, o sino:

- apache2
- mysql-server
- libapache2-mod-php5
- php5
- php5-mysql

Paso 2. Instalación de la aplicación web.
-------------------------------------------

Se copian todos los ficheros que se encuentran en el repositorio y desde el navegador se accede al fichero install/install.php. Desde ahí podrás configurar algunas cosas como colores de las barrras, logotipo, banner, etc... las demás cosas deberán modificarse a través del código fuente.

Además ahí tendrás que darle el usuario y contraseña del administrador de la base de datos, así como la web y puerto mySQL. Todo se configurará solo, se creará una cuenta "Admin_Admin" con contraseña "1234" (luego se puede cambiar) para el acceso al panel de usuario/administrador de la web.

¿Qué contiene la web?
-------------------------------------------

La web tiene: portada, petición de solicitudes, y acceso al panel.

Dentro del panel tiene: configuración del usuario, mensajes privados, revisión de peticiones, comunicados internos, gestión de usuarios, y una pequeña parte personalizable.
