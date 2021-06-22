alter table tb_ejecutivo_ruta add er_fecha_inicio_gestion datetime;
alter table tb_ejecutivo_ruta add er_fecha_fin_gestion datetime;

update tb_ejecutivo_ruta 
set er_fecha_inicio_gestion ='2018-06-15 00:00:00'
,er_fecha_fin_gestion ='2018-06-15 00:00:00'
