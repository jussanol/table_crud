<!DOCTYPE HTML>
<html >
    <head>
        <title><?php echo TITULO; ?></title>
        <meta name="Description" content="Página que se conecta a Base de datos" /> 
        <meta name="Keywords" content="palabras en castellano e ingles separadas por comas" /> 
        <meta name="Generator" content="esmvcphp framewrok" /> 
        <meta name="Origen" content="esmvcphp framework" /> 
        <meta name="Author" content="Olga Juste" /> 
        <meta name="Locality" content="Madrid, España" /> 
        <meta name="Lang" content="<?php echo \core\Idioma::get(); ?>" /> 
        <meta name="Viewport" content="maximum-scale=10.0" /> 
        <meta name="revisit-after" content="1 days" /> 
        <meta name="robots" content="INDEX,FOLLOW,NOODP" /> 
        <meta http-equiv="Content-Type" content="text/html; charset=utf8" /> 
        <meta http-equiv="Content-Language" content="<?php echo \core\Idioma::get(); ?>"/>

        <link href="favicon.ico" rel="shortcut icon" type="image/x-icon" />
        <link href="favicon.ico" rel="icon" type="image/x-icon" /> 

        <link rel="stylesheet" type="text/css" href="<?php echo URL_ROOT; ?>recursos/css/inicio/principal.css" />
        <style type="text/css" >
            /* Definiciones hoja de estilos interna */
        </style>
        <?php if (isset($_GET["administrator"])): ?>
            <link rel="stylesheet" type="text/css" href="<?php echo URL_ROOT; ?>recursos/css/administrator.css" />
        <?php endif; ?>

        <script type='text/javascript' src="<?php echo URL_ROOT . "recursos" . DS . "js" . DS . "jquery" . DS . "jquery-1.10.2.min.js"; ?>" ></script>
        <script type='text/javascript' src="<?php echo URL_ROOT . "recursos" . DS . "js" . DS . "general.js"; ?>" ></script>
        <script type="text/javascript" src=""></script>

        <script type="text/javascript" >
            /* líneas del script */
            function saludo() {
                alert("Bienvenido al primer ejercicio de Desarrollo Web en Entorno Servidor");
            }
        </script>

    </head>

    <body onload='onload();'>

        <!-- Contenido que se visualizará en el navegador, organizado con la ayuda de etiquetas html -->
        <div id="inicio"></div>
        <div id="encabezado">
            <div id="uno"><h1>Table Crud</h1></div>
            <div id="dos"><h1>Table Crud</h1></div>
        </div>



        <div id="div_menu" >
            <ul id="menu" class="menu">
                <li class="item">
                    <a href="<?php echo \core\URL::generar(); ?>" title="Inicio">Inicio</a>
                </li>
                <li class="item">
                    <a href="<?php echo \core\URL::generar("tabla"); ?>" title="Tabla">Tabla</a>
                </li>

            </ul>
        </div>

        <div id="view_content">

            <?php
            echo $datos['view_content'];
            ?>

        </div>


        <div id="pie">

            Pie del documento.<br />
            Documento creado por Olga Juste Sánchez. <a href="mailto:olgajuste.92@gmail.com">Contactar</a><br />
            Fecha última actualización: 2 de Febrero de 2014.
        </div>


</body>

</html>