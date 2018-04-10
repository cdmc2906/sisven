/*==============================================================*/
/* DBMS name:      MySQL 5.0                                    */
/* Created on:     28/02/2018 16:03:10                          */
/*==============================================================*/

/*==============================================================*/
/* Table: tb_periodo_gestion                                    */
/*==============================================================*/
create table tb_periodo_gestion
(
   pg_id                int not null,
   pg_descripcion       varchar(250),
   pg_fecha_inicio      datetime,
   pg_fecha_fin         datetime,
   pg_estado            int,
   pg_tipo              varchar(50),
   pg_fecha_ingreso     datetime,
   pg_fecha_modificacion datetime,
   pg_cod_usuario_ing_mod int,
   primary key (pg_id)
);


ALTER TABLE tb_historial_mb ADD COLUMN pg_id INT NULL AFTER h_cod;
alter table tb_historial_mb add constraint fk_relationship_32 foreign key (pg_id)
      references tb_periodo_gestion (pg_id) on delete restrict on update restrict;

ALTER TABLE tb_ordenes_mb ADD COLUMN pg_id INT NULL AFTER o_codigo;
alter table tb_ordenes_mb add constraint fk_relationship_35 foreign key (pg_id)
      references tb_periodo_gestion (pg_id) on delete restrict on update restrict;

ALTER TABLE tb_resumen_historial_diario ADD COLUMN pg_id INT NULL AFTER rhd_codigo;
alter table tb_resumen_historial_diario add constraint fk_relationship_34 foreign key (pg_id)
      references tb_periodo_gestion (pg_id) on delete restrict on update restrict;

ALTER TABLE tb_ruta_mb ADD COLUMN pg_id INT NULL AFTER r_cod;
alter table tb_ruta_mb add constraint fk_relationship_33 foreign key (pg_id)
      references tb_periodo_gestion (pg_id) on delete restrict on update restrict;

