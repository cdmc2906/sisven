-- 11 jul 2017 
truncate tb_venta_movistar;
-- facturados y no transferidos
select 
	i_fecha
    ,i_bodega
    ,I_CODIGO_GRUPO
    ,I_NOMBRE_CLIENTE
    ,i_min
	, i_imei 
from tb_indicadores
where i_imei not in (select vm_icc from tb_venta_movistar);

select distinct i_fecha from tb_indicadores limit 1;
-- no facturados transferidos
-- select * from tb_venta_movistar limit 1 ;
select 
	DATE(VM_FECHA)
    ,VM_NOMBREDISTRIBUIDOR
    ,VM_IDDESTINO
    ,VM_NOMBREDESTINO
	, vm_icc
    ,vm_min
from tb_venta_movistar
where vm_icc not in (select vm_icc from tb_indicadores);

select count(*) from tb_indicadores;
select count(*) from tb_venta_movistar;
select vm_icc from tb_venta_movistar;
select length(trim(vm_icc)) from tb_venta_movistar;
-- 20463 
-- 23248
select 23248- 20463 ;

truncate tb_venta_movistar;
truncate tb_indicadores;


















-- truncate tb_resumen_historial;
select * from tb_resumen_historial;
select 
cast(rrh_codigo as char (50) )as rrh_codigo,
rrh_cod_ejecutivo,
rrh_fecha_historial,
rrh_parametro,
cast(cast(rrh_valor as int) as char (50) )as rrh_valor
from tb_resumen_historial;


-- delete from tb_resumen_historial where rrh_fecha_historial ='2017-06-02';

select o_codigo_mb,o_subtotal from tb_ordenes_mb limit 1;

-- update tb_ordenes_mb set o_subtotal=1000 where o_codigo_mb ='PDTCQU26001032' and o_subtotal ='3.0000';
select count(*) from tb_ordenes_mb ; -- 314
 SELECT
                o_nom_usuario AS EJECUTIVO
                ,o_cod_cliente AS COD_CLIENTE
                ,o_nom_cliente AS NOM_CLIENTE
                , CONVERT(o_subtotal, decimal(6, 0)) AS TOTALORDENES
                , DATE(o_fch_creacion) AS PERIODO
            FROM tb_ordenes_mb
            WHERE 1 = 1
                AND o_usuario='QU25'
                AND o_fch_creacion >= '2017-06-01 00:00:00'
                AND o_fch_creacion<'2017-06-01 23:59:59'
			ORDER BY o_usuario;
SELECT
                    o_usuario AS CODIGOEJECUTIVO                
                    ,o_nom_usuario AS EJECUTIVO                
                    , CONVERT(sum(o_subtotal), decimal(6, 0)) AS TOTALPEDIDOS
                FROM tb_ordenes_mb
                WHERE 1 = 1
                    AND o_fch_creacion >= '2017-06-01 00:00:00'
                    AND o_fch_creacion<'2017-06-01 23:59:59'	
                GROUP BY o_usuario
                ORDER BY o_usuario;
                
                
                select sum(o_subtotal) 
                from tb_ordenes_mb 
                where 1=1   
                AND o_fch_creacion >= '2017-06-01 00:00:00'
				AND o_fch_creacion<'2017-06-01 23:59:59'	
                AND o_usuario='QU17';
                 
                 Select o_cod_cliente, o_subtotal
                from tb_ordenes_mb 
                where 1=1   
                AND o_fch_creacion >= '2017-06-01 00:00:00'
				AND o_fch_creacion<'2017-06-01 23:59:59'	
                AND o_usuario='QU17'
                order by o_cod_cliente;
                
                 SELECT
                --  o_nom_usuario AS EJECUTIVO
                o_id as CODIGOORDEN
                ,o_codigo_mb as ORDEN
                ,o_cod_cliente AS COD_CLIENTE
                ,o_nom_cliente AS NOM_CLIENTE
                , CONVERT(o_subtotal, decimal(6, 0)) AS TOTALORDENES
                , DATE(o_fch_creacion) AS PERIODO
            FROM tb_ordenes_mb
            WHERE 1 = 1
                AND o_usuario='QU17'
                AND o_fch_creacion >= '2017-06-01 00:00:00'
                AND o_fch_creacion<'2017-06-01 23:59:59'
			ORDER BY o_usuario;
select o_codigo from tb_ordenes_mb limit 1;
 SELECT
 o_codigo as CODIGOORDEN,
                --  o_nom_usuario AS EJECUTIVO
                o_cod_cliente AS COD_CLIENTE
                ,o_nom_cliente AS NOM_CLIENTE
                , CONVERT(o_subtotal, decimal(6, 0)) AS TOTALORDENES
                , DATE(o_fch_creacion) AS PERIODO
            FROM tb_ordenes_mb
            WHERE 1 = 1
                AND o_usuario='QU21'
                AND o_fch_creacion >= '2017-06-01 00:00:00'
                AND o_fch_creacion<'2017-06-01 23:59:59'
			
            ORDER BY o_usuario;