
-- para carga de consumo
ALTER TABLE tb_producto ADD INDEX (MIN_593_PROD); -- creado con warning
ALTER TABLE tb_consumo ADD INDEX (ID_MES,MIN_CONS); -- creado ok, si permitio una mejora en la consulta de 7mil reg antes 4m aora 10s
-- para carga de indicadores
ALTER TABLE tb_cliente ADD INDEX (DOCUMENTO_CLI);-- creado ok, 
ALTER TABLE tb_producto ADD INDEX (IMEI_PROD);-- creado con warning 0 row(s) affected, 1 warning(s): 1071 Specified key was too long; max key length is 767 bytes Records: 0  Duplicates: 0  Warnings: 1
ALTER TABLE tb_cliente ADD INDEX (IDDELTA_CLI);-- creado ok, 
ALTER TABLE TB_FACTURA ADD INDEX (NUMEROFACTURA_FACT);-- creado ok, 

--PARA CALCULO DE COMISION
ALTER TABLE tb_consumo ADD INDEX (ID_PRO); -- creado ok, si permitio una mejora en la consulta de 7mil reg antes 4m aora 10s
ALTER TABLE TB_VENTA ADD INDEX (ID_VEND); -- creado ok