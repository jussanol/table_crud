<?php

namespace controladores;

class tabla extends \core\Controlador {

    /**
     * Presenta una <table> con las filas de la tabla con igual nombre que la clase.
     * @param array $datos
     */
    public function index(array $datos = array()) {

        $clausulas['order_by'] = 'modelo_marca';
        $datos["filas"] = \modelos\Datos_SQL::table("moviles")->select($clausulas); // Recupera todas las filas ordenadas
        $datos['view_content'] = \core\Vista::generar(__FUNCTION__, $datos);
        $http_body = \core\Vista_Plantilla::generar('plantilla_principal', $datos);
        \core\HTTP_Respuesta::enviar($http_body);
    }

    public function form_insertar(array $datos = array()) {

        $clausulas['order_by'] = " modelo_marca ";
//		$datos['moviles'] = \modelos\Datos_SQL::table("moviles")->select($clausulas);

        $datos['view_content'] = \core\Vista::generar(__FUNCTION__, $datos);
        $http_body = \core\Vista_Plantilla::generar('plantilla_principal', $datos);
        \core\HTTP_Respuesta::enviar($http_body);
    }

    public function validar_form_insertar(array $datos = array()) {
        $validaciones = array(
//                        "id"=>"errores_requerido && errores_numero_entero_positivo && errores_referencia:id/moviles/id"
            "modelo_marca" => "errores_requerido && errores_texto && errores_unicidad_insertar:modelo_marca/moviles/modelo_marca"
            , "valoracion" => "errores_requerido && errores_numero_entero_positivo"
            , "precio" => "errores_requerido && errores_precio"
            , "tamanio_pantalla" => "errores_texto"
            , 'autonomia' => 'errores_texto'
            , 'resolucion_camara' => 'errores_texto'
            , 'fecha_lanzamiento' => 'errores_requerido && errores_fecha'
        );
        if (!$validacion = !\core\Validaciones::errores_validacion_request($validaciones, $datos))
            $datos["errores"]["errores_validacion"] = "Corrige los errores.";
        else {
            $datos['values']['precio'] = \core\Conversiones::decimal_coma_a_punto($datos['values']['precio']);
            $datos['values']['tamanio_pantalla'] = \core\Conversiones::decimal_coma_a_punto($datos['values']['tamanio_pantalla']);
            if (!$validacion = \modelos\Datos_SQL::table("moviles")->insert($datos["values"])) // Devuelve true o false
                $datos["errores"]["errores_validacion"] = "No se han podido grabar los datos en la bd.";
        }
        if (!$validacion) //Devolvemos el formulario para que lo intente corregir de nuevo
            $this->cargar_controlador('tabla', 'form_insertar', $datos);
        else {
            // Se ha grabado la modificación. Devolvemos el control al la situacion anterior a la petición del form_modificar
//			$datos = array("alerta" => "Se han grabado correctamente los detalles");
//			// Definir el controlador que responderá después de la inserción
//			$this->cargar_controlador('tabla', 'index',$datos);
            \core\HTTP_Respuesta::set_header_line("location", \core\URL::generar("tabla/index"));
            \core\HTTP_Respuesta::enviar();
        }
    }

    public function form_modificar(array $datos = array()) {
        
        

        if (!count($datos)) { // Si no es un reenvío desde una validación fallida
            $validaciones = array(
                "id" => "errores_requerido && errores_numero_entero_positivo && errores_referencia:id/moviles/id"
            );
            if (!$validacion = !\core\Validaciones::errores_validacion_request($validaciones, $datos)) {
                $datos['mensaje'] = 'Datos erróneos para identificar el móvil a modificar';
                $datos['url_continuar'] = \core\URL::generar("tabla");
                $this->cargar_controlador('mensajes', 'mensaje', $datos);
                return;
            } else {
                $clausulas['where'] = " id = {$datos['values']['id']} ";
                if (!$filas = \modelos\Datos_SQL::table("moviles")->select($clausulas)) {
                    $datos['mensaje'] = 'Error al recuperar la fila de la base de datos';
                    $this->cargar_controlador('mensajes', 'mensaje', $datos);
                    return;
                } else {
                    $datos['values'] = $filas[0];

                    $clausulas = array('order_by' => " modelo_marca ");
                }
            }
        }

        $datos['values']['precio'] = \core\Conversiones::decimal_punto_a_coma_y_miles($datos['values']['precio']);
        $datos['values']['tamanio_pantalla'] = \core\Conversiones::decimal_punto_a_coma_y_miles($datos['values']['tamanio_pantalla']);
        $datos['view_content'] = \core\Vista::generar(__FUNCTION__, $datos);
        $http_body = \core\Vista_Plantilla::generar('plantilla_principal', $datos);
        \core\HTTP_Respuesta::enviar($http_body);
    }

    public function validar_form_modificar(array $datos = array()) {

        $validaciones = array(
            "id" => "errores_requerido && errores_numero_entero_positivo && errores_referencia:id/moviles/id"
            , "modelo_marca" => "errores_requerido && errores_texto && errores_unicidad_modificar:id,modelo_marca/moviles/modelo_marca,id"
            , "valoracion" => "errores_requerido && errores_texto"
            , "precio" => "errores_requerido && errores_precio"
            , "tamanio_pantalla" => "errores_texto"
            , 'autonomia' => 'errores_texto'
            , 'resolucion_camara' => 'errores_texto'
            , 'fecha_lanzamiento' => 'errores_requerido && errores_fecha'
        );
        if (!$validacion = !\core\Validaciones::errores_validacion_request($validaciones, $datos)) {
            //print_r($datos);
            $datos["errores"]["errores_validacion"] = "Corrige los errores.";
        } else {
            $datos['values']['precio'] = \core\Conversiones::decimal_coma_a_punto($datos['values']['precio']);
            $datos['values']['tamanio_pantalla'] = \core\Conversiones::decimal_coma_a_punto($datos['values']['tamanio_pantalla']);
            if (!$validacion = \modelos\Datos_SQL::table("moviles")->update($datos["values"])) // Devuelve true o false
                $datos["errores"]["errores_validacion"] = "No se han podido grabar los datos en la bd.";
        }
        if (!$validacion) //Devolvemos el formulario para que lo intente corregir de nuevo
            $this->cargar_controlador('tabla', 'form_modificar', $datos);

        else {
            $datos = array("alerta" => "Se han modificado correctamente.");
            // Definir el controlador que responderá después de la inserción
            $this->cargar_controlador('tabla', 'index', $datos);
//            \core\HTTP_Respuesta::set_header_line("location", \core\URL::generar("tabla/index"));
//            \core\HTTP_Respuesta::enviar();
        }
    }

    public function form_borrar(array $datos = array()) {

        $validaciones = array(
            "id" => "errores_requerido && errores_numero_entero_positivo && errores_referencia:id/moviles/id"
        );
        if (!$validacion = !\core\Validaciones::errores_validacion_request($validaciones, $datos)) {
            $datos['mensaje'] = 'Datos erróneos para identificar el artículo a borrar';
            $datos['url_continuar'] = \core\URL::http('?menu=tabla');
            $this->cargar_controlador('mensajes', 'mensaje', $datos);
            return;
        } else {
            $clausulas['where'] = " id = {$datos['values']['id']} ";
            if (!$filas = \modelos\Datos_SQL::table("moviles")->select($clausulas)) {
                $datos['mensaje'] = 'Error al recuperar la fila de la base de datos';
                $this->cargar_controlador('mensajes', 'mensaje', $datos);
                return;
            } else {
                $datos['values'] = $filas[0];
                $datos['values']['precio'] = \core\Conversiones::decimal_punto_a_coma_y_miles($datos['values']['precio']);
                $datos['values']['tamanio_pantalla'] = \core\Conversiones::decimal_punto_a_coma_y_miles($datos['values']['tamanio_pantalla']);
                $clausulas = array('order_by' => " modelo_marca ");
            }
        }
        $datos['view_content'] = \core\Vista::generar(__FUNCTION__, $datos);
        $http_body = \core\Vista_Plantilla::generar('plantilla_principal', $datos);
        \core\HTTP_Respuesta::enviar($http_body);
    }

    public function validar_form_borrar(array $datos = array()) {
        $validaciones = array(
            "id" => "errores_requerido && errores_numero_entero_positivo && errores_referencia:id/moviles/id"
        );
        if (!$validacion = !\core\Validaciones::errores_validacion_request($validaciones, $datos)) {
            $datos['mensaje'] = 'Datos erróneos para identificar el artículo a borrar';
            $datos['url_continuar'] = \core\URL::http('?menu=tabla');
            $this->cargar_controlador('mensajes', 'mensaje', $datos);
            return;
        } else {
            if (!$validacion = \modelos\Datos_SQL::delete($datos["values"], 'moviles')) {// Devuelve true o false
                $datos['mensaje'] = 'Error al borrar en la bd';
                $datos['url_continuar'] = \core\URL::http('?menu=tabla');
                $this->cargar_controlador('mensajes', 'mensaje', $datos);
                return;
            } else {
                $datos = array("alerta" => "Se borrado correctamente.");
//                $this->cargar_controlador('tabla', 'index', $datos);
                \core\HTTP_Respuesta::set_header_line("location", \core\URL::generar("tabla/index"));
                \core\HTTP_Respuesta::enviar();
            }
        }
    }

//	
//	public function listado_pdf(array $datos=array()) {
//		
//		$validaciones = array(
//			"nombre" => "errores_texto"
//		);
//		\core\Validaciones::errores_validacion_request($validaciones, $datos);
//		if (isset($datos['values']['nombre'])) 
//			$clausulas['where'] = " nombre like '%{$datos['values']['nombre']}%'";
//		$clausulas['order_by'] = 'nombre';
//		$datos['filas'] = \modelos\Datos_SQL::select( $clausulas , 'moviles');		
//		
//		$datos['html_para_pdf'] = \core\Vista::generar(__FUNCTION__, $datos);
//		
//		require_once(PATH_APP."lib/php/dompdf/dompdf_config.inc.php");
//
//		$html =
//		  '<html><body>'.
//		  '<p>Put your html here, or generate it with your favourite '.
//		  'templating system.</p>'.
//		  '</body></html>';
//
//		$dompdf = new \DOMPDF();
//		$dompdf->load_html($datos['html_para_pdf']);
//		$dompdf->render();
//		$dompdf->stream("sample.pdf", array("Attachment" => 0));
//		
//		// \core\HTTP_Respuesta::set_mime_type('application/pdf');
//		// \core\HTTP_Respuesta::enviar($datos, 'plantilla_pdf');
//		
//	}
//	
//
//	/**
//	 * Genera una respuesta json con un array que contiene objetos, siendo cada objeto una fila.
//	 * @param array $datos
//	 */
//	public function listado_js(array $datos=array()) {
//		
//		$validaciones = array(
//			"nombre" => "errores_texto"
//		);
//		\core\Validaciones::errores_validacion_request($validaciones, $datos);
//		if (isset($datos['values']['nombre'])) 
//			$clausulas['where'] = " nombre like '%{$datos['values']['nombre']}%'";
//		$clausulas['order_by'] = 'nombre';
//		$datos['filas'] = \modelos\Datos_SQL::select($clausulas, 'moviles');
//				
//		$datos['contenido_principal'] = \core\Vista::generar(__FUNCTION__, $datos);
//		
//		\core\HTTP_Respuesta::set_mime_type('text/json');
//		$http_body = \core\Vista_Plantilla::generar('plantilla_json', $datos);
//		\core\HTTP_Respuesta::enviar($http_body);
//		
//	}
//	
//	/**
//	 * Genera una respuesta json con un array que contiene objetos, siendo cada objeto una fila.
//	 * @param array $datos
//	 */
//	public function listado_js_array(array $datos=array()) {
//		
//		$validaciones = array(
//			"nombre" => "errores_texto"
//		);
//		\core\Validaciones::errores_validacion_request($validaciones, $datos);
//		if (isset($datos['values']['nombre'])) 
//			$clausulas['where'] = " nombre like '%{$datos['values']['nombre']}%'";
//		$clausulas['order_by'] = 'nombre';
//		$datos['filas'] = \modelos\Datos_SQL::select( $clausulas, 'moviles');
//				
//		$datos['contenido_principal'] = \core\Vista::generar(__FUNCTION__, $datos);
//		
//		\core\HTTP_Respuesta::set_mime_type('text/json');
//		$http_body = \core\Vista_Plantilla::generar('plantilla_json', $datos);
//		\core\HTTP_Respuesta::enviar($http_body);
//		
//	}
//	
//	
//	/**
//	 * Genera una respuesta xml.
//	 * 
//	 * @param array $datos
//	 */
//	public function listado_xml(array $datos=array()) {
//		
//		$validaciones = array(
//			"nombre" => "errores_texto"
//		);
//		\core\Validaciones::errores_validacion_request($validaciones, $datos);
//		if (isset($_datos['values']['nombre'])) 
//			$clausulas['where'] = " nombre like '%{$_datos['values']['nombre']}%'";
//		$clausulas['order_by'] = 'nombre';
//		$datos['filas'] = \modelos\Datos_SQL::select( $clausulas, 'moviles');
//				
//		$datos['contenido_principal'] = \core\Vista::generar(__FUNCTION__, $datos);
//		
//		\core\HTTP_Respuesta::set_mime_type('text/xml');
//		\core\HTTP_Respuesta::enviar('plantilla_xml', $datos);
//		
//	}
//	
//	
//	
//	
//	/**
//	 * Genera una respuesta excel.
//	 * @param array $datos
//	 */
//	public function listado_xls(array $datos=array()) {
//		
//		$validaciones = array(
//			"nombre" => "errores_texto"
//		);
//		\core\Validaciones::errores_validacion_request($validaciones, $datos);
//		if (isset($_datos['values']['nombre'])) 
//			$clausulas['where'] = " nombre like '%{$_datos['values']['nombre']}%'";
//		$clausulas['order_by'] = 'nombre';
//		$datos['filas'] = \modelos\Datos_SQL::select($clausulas, 'moviles');
//				
//		$datos['contenido_principal'] = \core\Vista::generar(__FUNCTION__, $datos);
//		
//		\core\HTTP_Respuesta::set_mime_type('application/excel');
//		$http_body = \core\Vista_Plantilla::generar('plantilla_xls', $datos);
//		\core\HTTP_Respuesta::enviar($http_body);
//		
//	}
//	
//	
}

// Fin de la clase