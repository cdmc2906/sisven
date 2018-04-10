ALTER TABLE tb_transferencia_movistar ADD INDEX (tm_codigotransferencia);
ALTER TABLE tb_transferencia_movistar ADD INDEX (tm_icc);
ALTER TABLE tb_historial_mb ADD INDEX (h_id);
ALTER TABLE tb_indicadores ADD INDEX (i_imei);
ALTER TABLE tb_ordenes_mb ADD INDEX (o_id);
-- ALTER TABLE tb_indicadores ADD INDEX ();

ALTER TABLE tb_venta_movistar ADD INDEX (vm_transaccion);
ALTER TABLE tb_venta_movistar ADD INDEX (VM_ICC);
ALTER TABLE tb_ruta_mb ADD INDEX (r_cod_cliente);

ALTER TABLE tb_revision_mines ADD INDEX (rmva_carga);
ALTER TABLE tb_mines_validacion ADD INDEX (miva_imei);