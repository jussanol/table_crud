
<form method='post' action="?menu=<?php echo $datos['controlador_clase']; ?>&submenu=validar_<?php echo $datos['controlador_metodo']; ?>" >
    <input id='id' name='id' type='hidden' value='<?php echo \core\Array_Datos::values('id', $datos); ?>' />
    Marca y Modelo: <input id='modelo_marca' name='modelo_marca' type='text' size='100'  maxlength='100' value='<?php echo \core\Array_Datos::values('modelo_marca', $datos); ?>'/>
<?php echo \core\HTML_Tag::span_error('modelo_marca', $datos); ?>
<br />
Valoración: <input id='valoracion' name='valoracion' type='text' size='10'  maxlength='10' value='<?php echo \core\Array_Datos::values('valoracion', $datos); ?>'/>
<?php echo \core\HTML_Tag::span_error('valoracion', $datos); ?>
<br />
Precio: <input id='precio' name='precio' type='text' size='20'  maxlength='20' value='<?php echo \core\Array_Datos::values('precio', $datos); ?>'/>
<?php echo \core\HTML_Tag::span_error('precio', $datos); ?>
<br />
Tamaño de pantalla: <input id='tamanio_pantalla' name='tamanio_pantalla' type='text' size='20'  maxlength='20' value='<?php echo \core\Array_Datos::values('tamanio_pantalla', $datos); ?>'/>
<br />
Autonomía - Conversacion: <input id='autonomia' name='autonomia' type='text' size='10'  maxlength='10' value='<?php echo \core\Array_Datos::values('autonomia', $datos); ?>'/>
<br />
Resolución cámara: <input id='resolucion_camara' name='resolucion_camara' type='text' size='10'  maxlength='10' value='<?php echo \core\Array_Datos::values('resolucion_camara', $datos); ?>'/>
<br />
Fecha de lanzamiento: <input id='fecha_lanzamiento' name='fecha_lanzamiento' type='text' size='10'  maxlength='10' value='<?php echo \core\Array_Datos::values('fecha_lanzamiento', $datos); ?>'/>
<?php echo \core\HTML_Tag::span_error('fecha_lanzamiento', $datos); ?>
<br />
<?php echo \core\HTML_Tag::span_error('errores_validacion', $datos); ?>

<input type='submit' value='Enviar'>
<input type='reset' value='Limpiar'>
<button type='button' onclick='location.assign("?menu=tabla&submenu=index");'>Cancelar</button>
</form>
