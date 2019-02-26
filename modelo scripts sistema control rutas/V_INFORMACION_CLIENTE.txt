create view V_INFORMACION_CLIENTE
as
select 
cli_codigo_cliente
,cli_nombre_cliente
,cli_identificacion
,cli_tipo_de_negocio
,cli_tipo_de_negocio_nombre
,cli_usuario
,cli_usuario_nombre
,cli_creado_por
,cli_creado
,cli_estatus
,dcli_calle_principal
,dcli_calle_secundaria
,dcli_nomenclatura
,dcli_referencia
,dcli_provincia
,dcli_canton
,dcli_parroquia
,dcli_email
,dcli_telefono
,dcli_latitud
,dcli_longitud
,dcli_ultima_visita
,dcli_estado_de_localizacion

from tb_cliente as a
inner join tb_cliente_direccion as b
on a.cli_codigo_cliente=b.dcli_cliente