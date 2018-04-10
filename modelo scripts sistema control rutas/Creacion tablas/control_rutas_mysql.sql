/*==============================================================*/
/* DBMS name:      MySQL 5.0                                    */
/* Created on:     13/06/2017 14:19:21                          */
/*==============================================================*/


drop table if exists tb_control_ruta;

drop table if exists tb_historial_mb;

drop table if exists tb_ordenes_mb;

drop table if exists tb_ruta_mb;

/*==============================================================*/
/* Table: tb_control_ruta                                       */
/*==============================================================*/
create table tb_control_ruta
(
   cr_id                int not null AUTO_INCREMENT,
   cr_fecha_revision    datetime,
   cr_usuario_revisa    int,
   cr_codigo_vendedor   varchar(50),
   cr_cod_cliente       varchar(50),
   cr_ruta_visita       varchar(50),
   cr_ruta_ejecutivo    varchar(50),
   cr_orden_visita      int,
   cr_secuencia_ruta    int,
   cr_observacion       varchar(250),
   cr_estado            varchar(50),
   cr_fecha_ingreso     datetime,
   cr_fecha_modificacion datetime,
   primary key (cr_id)
);

/*==============================================================*/
/* Table: tb_historial_mb                                       */
/*==============================================================*/
create table tb_historial_mb
(
   h_cod                int not null AUTO_INCREMENT,
   h_id                 int,
   h_fecha              datetime,
   h_usuario            varchar(500),
   h_usuario_nombre     varchar(500),
   h_ruta               varchar(500),
   h_ruta_nombre        varchar(500),
   h_semana             int,
   h_dia                int,
   h_cod_cliente        varchar(500),
   h_nom_cliente        varchar(500),
   h_direccion          varchar(500),
   h_accion             varchar(500),
   h_cod_accion         varchar(500),
   h_cod_comentario     varchar(500),
   h_comentario         varchar(500),
   h_monto              varchar(500),
   h_latitud            decimal(10,5),
   h_longitud           decimal(10,5),
   h_romper_secuencia   int,
   h_fch_ingreso        datetime,
   h_fch_modificacion   datetime,
   h_fch_desde          datetime,
   h_fch_hasta          datetime,
   h_usr_ing_mod        int,
   primary key (h_cod)
);

/*==============================================================*/
/* Table: tb_ordenes_mb                                         */
/*==============================================================*/
create table tb_ordenes_mb
(
   o_codigo             int not null AUTO_INCREMENT,
   o_id                 int,
   o_concepto           varchar(500),
   o_comentario         varchar(500),
   o_fch_creacion       datetime,
   o_fch_despacho       datetime,
   o_tipo               varchar(50),
   o_estatus            varchar(50),
   o_cod_cliente        varchar(50),
   o_nom_cliente        varchar(100),
   o_id_cliente         varchar(100),
   o_direccion          varchar(250),
   o_lista_precio       varchar(100),
   o_nom_lista_precio   varchar(100),
   o_bodega_origen      varchar(100),
   o_nom_bodega_origen  varchar(100),
   o_termino_pago       varchar(100),
   o_nom_termino_pago   varchar(100),
   o_usuario            varchar(100),
   o_nom_usuario        varchar(100),
   o_oficina            varchar(100),
   o_nom_oficina        varchar(100),
   o_tipo_secuencia     varchar(100),
   o_iva_12_base        decimal(10,4),
   o_iva_12_valor       decimal(10,4),
   o_iva_0_base         decimal(10,4),
   o_iva_0_valor        decimal(10,4),
   o_iva_14_base        decimal(10,4),
   o_iva_14_valor       decimal(10,4),
   o_subtotal           decimal(10,4),
   o_porcentaje_descuento decimal(10,4),
   o_descuento          decimal(10,4),
   o_impuestos          decimal(10,4),
   o_otros_cargos       decimal(10,4),
   o_total              decimal(10,4),
   o_datos              varchar(1024),
   o_referencia         varchar(1024),
   o_estado_proceso     varchar(1024),
   o_fch_ingreso        datetime,
   o_fch_modificacion   datetime,
   o_fch_desde          datetime,
   o_fch_hasta          datetime,
   o_usr_ing_mod        int,
   primary key (o_codigo)
);

/*==============================================================*/
/* Table: tb_ruta_mb                                            */
/*==============================================================*/
create table tb_ruta_mb
(
   r_cod                int not null AUTO_INCREMENT,
   r_ruta               varchar(1024),
   r_cod_cliente        varchar(1024),
   r_nom_cliente        varchar(1024),
   r_cod_direccion      varchar(1024),
   r_direccion          varchar(1024),
   r_referencia         varchar(1024),
   r_semana             int,
   r_dia                int,
   r_secuencia          int,
   r_estatus            int,
   r_fch_ingreso        datetime,
   r_fch_modificacion   datetime,
   r_fch_desde          datetime,
   r_fch_hasta          datetime,
   r_usuario_ing_mod    int,
   primary key (r_cod)
);

