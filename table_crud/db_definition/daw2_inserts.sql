/*
 * @file: dables_and_user.sql
 * @author: ojuste.92@gmail.com
 * @since: 2014 febrero
*/

-- use daw;

set names utf8;
set sql_mode = 'traditional';



insert into daw_moviles
  (id,  modelo_marca, valoracion,precio,tamaño_pantalla, autonomia, resolucion_camara) values
  (2, 'Sony Xperia Z','99', 669, 5, 11, 13), 
  (3, 'HTC ONE (2013)','98', 639, 4.7, 0, 4), 
  (4, 'Samsung Galaxy III','97', 659, 4.8, 22, 8)

;

