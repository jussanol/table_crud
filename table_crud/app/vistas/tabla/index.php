<div>
    <h1>Listado de móviles</h1>

    <table border='1'>
        <thead>
            <tr>
                <th>Marca y modelo</th>
                <th>Valoración experta</th>
                <th>Precio libre</th>
                <th>Tamaño de pantalla</th>
                <th>Autonomía - Conversación</th>
                <th>Resolucion Cámara</th>
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
						<td>
							<a class='boton' href='?menu=tabla&submenu=form_modificar&id={$fila['id']}' >modificar</a>
							<a class='boton' href='?menu=tabla&submenu=form_borrar&id={$fila['id']}' >borrar</a>
						</td>
					</tr>
					";
            }
            echo "
				<tr>
					<td colspan='4'></td>
					<td><a class='boton' href='?menu=tabla&submenu=form_insertar' >insertar</a></td>
				</tr>
			";
            ?>
        </tbody>
    </table>
</div>