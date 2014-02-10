<div>
    <h2>Listado de móviles</h2>

    <table border='1'>
        <thead>
            <tr>
                <th>Marca y modelo</th>
                <th>Valoración experta</th>
                <th>Precio libre</th>
                <th>Tamaño de pantalla</th>
                <th>Autonomía - Conversación</th>
                <th>Resolucion Cámara</th>
                <th>Fecha de lanzamiento</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php
            foreach ($datos['filas'] as $fila) {
                echo "
					<tr>
						<td>{$fila['modelo_marca']}</td>
						<td>{$fila['valoracion']}</td>
						<td>" . \core\Conversiones::decimal_punto_a_coma_y_miles($fila['precio']) . "</td>
						<td>" . \core\Conversiones::decimal_punto_a_coma_y_miles($fila['tamanio_pantalla']) . " pulgadas</td>
                                                <td>";
                if ($fila['autonomia'] == 0.00) {
                    echo '';
                } else {
                    echo "{$fila['autonomia']} horas";
                }
                echo "</td>                                                
                                                <td>{$fila['resolucion_camara']} megapíxel</td>
                                                <td>{$fila['fecha_lanzamiento']} </td>
						<td>"
                                                .\core\HTML_Tag::a_boton_onclick('boton', array('tabla', 'form_modificar', $fila['id']), 'modificar').
                                                "-" 
                                                .\core\HTML_Tag::a_boton_onclick('boton', array('tabla', 'form_borrar', $fila['id']), 'borrar').

						"</td>
					</tr>
					";
            }
            echo "
				<tr>
					<td colspan='7'></td>
					<td><a class='boton' href='?menu=tabla&submenu=form_insertar' >insertar</a></td>
				</tr>
			";
            ?>
        </tbody>
    </table>
</div>