/*==============================================================*/
/* DBMS name:      MySQL 5.0                                    */
/* Created on:     03/07/2017 11:23:49                          */
/*==============================================================*/


drop table if exists tb_control_historial_ruta;

drop table if exists tb_ejecutivo;

drop table if exists tb_ejecutivo_ruta;

drop table if exists tb_historial_mb;

drop table if exists tb_ordenes_mb;

drop table if exists tb_rango_cumplimiento;

drop table if exists tb_resumen_historial;

drop table if exists tb_ruta_mb;

/*==============================================================*/
/* Table: tb_control_historial_ruta                             */
/*==============================================================*/
create table tb_control_historial_ruta
(
   rh_id                int not null AUTO_INCREMENT,
   rh_item              varchar(25),
   rh_fecha_item        date,
   rh_fecha_revision    datetime,
   rh_codigo_vendedor   varchar(50),
   rh_cod_cliente       varchar(50),
   rh_ruta_visita       varchar(50),
   rh_orden_visita      int,
   rh_ruta_ejecutivo    varchar(50),
   rh_secuencia_ruta    int,
   rh_observacion_ruta  varchar(250),
   rh_observacion_secuencia varchar(250),
   rh_chips_compra      int,
   rh_estado            varchar(50),
   rh_fecha_ingreso     datetime,
   rh_fecha_modificacion datetime,
   rh_usuario_revisa    int,
   primary key (rh_id)
);

/*==============================================================*/
/* Table: tb_ejecutivo                                          */
/*==============================================================*/
create table tb_ejecutivo
(
   e_cod                int not null AUTO_INCREMENT,
   e_nombre             varchar(50),
   e_usr_mobilvendor    varchar(5),
   e_iniciales          varchar(5),
   e_estado             int,
   primary key (e_cod)
);

/*==============================================================*/
/* Table: tb_ejecutivo_ruta                                     */
/*==============================================================*/
create table tb_ejecutivo_ruta
(
   er_cod               int not null AUTO_INCREMENT,
   er_usuario           varchar(50),
   er_usuario_nombre    varchar(50),
   er_ruta              varchar(50),
   er_ruta_nombre       varchar(50),
   er_estatus           varchar(50),
   er_fecha_ingreso     datetime,
   er_fecha_asignacion  datetime,
   er_fecha_modificacion datetime,
   er_cod_usr_ing       int,
   er_cod_usr_mod       int,
   primary key (er_cod)
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
   o_codigo_mb          varchar(500),
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
/* Table: tb_rango_cumplimiento                                 */
/*==============================================================*/
create table tb_rango_cumplimiento
(
   c_cod                int not null AUTO_INCREMENT,
   c_rango_min          decimal(4,2),
   c_rango_max          decimal(4,2),
   c_nombre_rango       varchar(500),
   c_estado_rango       int,
   c_fecha_ingreso      datetime,
   c_fecha_modificacion datetime,
   c_codigo_usuario_ingresa int,
   c_codigo_usuario_modifica int,
   primary key (c_cod)
);

/*==============================================================*/
/* Table: tb_resumen_historial                                  */
/*==============================================================*/
create table tb_resumen_historial
(
   rrh_codigo           int not null AUTO_INCREMENT,
   rrh_cod_ejecutivo    varchar(20),
   rrh_fecha_historial  date,
   rrh_parametro        varchar(50),
   rrh_valor            decimal(6,4),
   rrh_fecha_ingreso    datetime,
   rrh_fecha_modificacion datetime,
   rrh_usuario_ingresa_modifica int,
   primary key (rrh_codigo)
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

