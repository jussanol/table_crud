
/*
 * @file: tables_and_user.sql
 * @author: olgajuste.92@gmail.com
 * @since: 2014 febrero
*/

use daw;

set names utf8;

set sql_mode = 'traditional';

drop table if exists daw_moviles;
create table daw_moviles
( id integer auto_increment
, modelo_marca varchar(100) not null
, valoracion varchar(100) not null
, precio decimal(12,2) null default null
, tamanio_pantalla decimal(12,2) null default null
, autonomia decimal(12,2) null default null
, resolucion_camara decimal(12,2) null default null
, fecha_lanzamiento date not null
, primary key (id)
, unique (modelo_marca)
)
engine = myisam default charset=utf8
;


