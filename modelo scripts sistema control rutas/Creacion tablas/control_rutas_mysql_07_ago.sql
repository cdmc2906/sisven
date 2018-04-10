/*==============================================================*/
/* DBMS name:      MySQL 5.0                                    */
/* Created on:     07/08/2017 12:47:03                          */
/*==============================================================*/


drop table if exists tb_cliente;

drop table if exists tb_detalle_historial_diario;

drop table if exists tb_ejecutivo;

drop table if exists tb_ejecutivo_ruta;

drop table if exists tb_historial_mb;

drop table if exists tb_indicadores;

drop table if exists tb_ordenes_mb;

drop table if exists tb_rango_cumplimiento;

drop table if exists tb_resumen_historial_diario;

drop table if exists tb_ruta_mb;

drop table if exists tb_transferencia_movistar;

drop table if exists tb_venta_movistar;

/*==============================================================*/
/* Table: tb_cliente                                            */
/*==============================================================*/
create table tb_cliente
(
   cli_codigo           int not null,
   cli_codigo_cliente   varchar(50),
   cli_nombre_cliente   varchar(250),
   cli_latitud          varchar(250),
   cli_longitud         varchar(250),
   cli_estado           int,
   cli_fecha_ingreso    datetime,
   cli_fecha_modificacion datetime,
   cli_usuario_ingresa_modifica int,
   primary key (cli_codigo)
);

/*==============================================================*/
/* Table: tb_detalle_historial_diario                           */
/*==============================================================*/
create table tb_detalle_historial_diario
(
   rh_id                int not null,
   rh_item              varchar(25),
   rh_fecha_item        date,
   rh_fecha_ruta        date,
   rh_fecha_revision    datetime,
   rh_codigo_vendedor   varchar(50),
   rh_cod_cliente       varchar(50),
   rh_cliente           varchar(50),
   rh_ruta_visita       varchar(50),
   rh_orden_visita      int,
   rh_ruta_ejecutivo    varchar(50),
   rh_secuencia_ruta    int,
   rh_observacion_ruta  varchar(250),
   rh_observacion_secuencia varchar(250),
   rh_chips_compra      int,
   rh_metros            decimal(6,4),
   rh_validacion        varchar(50),
   rh_precision         int,
   rh_latitud_cliente   decimal(6,4),
   rh_longitud_cliente  decimal(6,4),
   rh_latitud_historial decimal(6,4),
   rh_longitud_historial decimal(6,4),
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
   e_cod                int not null,
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
   er_cod               int not null,
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
   h_cod                int not null,
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
/* Table: tb_indicadores                                        */
/*==============================================================*/
create table tb_indicadores
(
   i_codigo             int not null,
   i_fecha              date,
   i_sucursal           varchar(500),
   i_numero_bodega      int,
   i_bodega             varchar(500),
   i_numero_serie       varchar(500),
   i_numero_factura     varchar(500),
   i_cod_cliente        varchar(500),
   i_tipo_cliente       varchar(500),
   i_nombre_cliente     varchar(500),
   i_ruc                varchar(500),
   i_direccion          varchar(500),
   i_ciudad             varchar(500),
   i_telefono           varchar(500),
   i_codigo_producto    varchar(500),
   i_descripcion_producto varchar(500),
   i_codigo_grupo       varchar(500),
   i_grupo              varchar(500),
   i_cantidad           int,
   i_detalle            varchar(1024),
   i_imei               varchar(20),
   i_min                varchar(20),
   i_icc                varchar(20),
   i_costo              decimal(6,4),
   i_precio1            decimal(6,4),
   i_precio2            decimal(6,4),
   i_precio3            decimal(6,4),
   i_precio4            decimal(6,4),
   i_precio5            decimal(6,4),
   i_precio             decimal(6,4),
   i_porcendes          decimal(6,4),
   i_descuento          decimal(6,4),
   i_subtotal           decimal(6,4),
   i_iva                decimal(6,4),
   i_total              decimal(6,4),
   i_e_codigo           varchar(20),
   i_vendedor           varchar(20),
   i_provincia          varchar(20),
   i_fecha_ingreso      datetime,
   i_fecha_modificacion datetime,
   i_usuario_ingresa_modifica int,
   i_estado_icc         varchar(250),
   primary key (i_codigo)
);

/*==============================================================*/
/* Table: tb_ordenes_mb                                         */
/*==============================================================*/
create table tb_ordenes_mb
(
   o_codigo             int not null,
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
   c_cod                int not null,
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
/* Table: tb_resumen_historial_diario                           */
/*==============================================================*/
create table tb_resumen_historial_diario
(
   rhd_codigo           int not null,
   rhd_cod_ejecutivo    varchar(20),
   rhd_fecha_historial  date,
   rhd_parametro        varchar(50),
   rhd_valor            decimal(6,4),
   rhd_semana           int,
   rhd_observacion_supervisor varchar(250),
   rhd_usuario_supervisor int,
   rhd_fecha_ingreso_observacion datetime,
   rhd_fecha_modifica_observacion datetime,
   rhd_fecha_ingreso    datetime,
   rhd_fecha_modificacion datetime,
   rhd_usuario_ingresa_modifica int,
   primary key (rhd_codigo)
);

/*==============================================================*/
/* Table: tb_ruta_mb                                            */
/*==============================================================*/
create table tb_ruta_mb
(
   r_cod                int not null,
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

/*==============================================================*/
/* Table: tb_transferencia_movistar                             */
/*==============================================================*/
create table tb_transferencia_movistar
(
   tm_codigo            int not null,
   tm_fecha             date,
   tm_codigotransferencia varchar(500),
   tm_iddistribuidor    varchar(500),
   tm_nombredistribuidor varchar(500),
   tm_codigoscl         varchar(500),
   tm_inventarioanteriorfuente varchar(500),
   tm_inventarioactualfuente varchar(500),
   tm_tiposim           varchar(500),
   tm_icc               varchar(500),
   tm_min               varchar(500),
   tm_estado            varchar(500),
   tm_iddestino         varchar(500),
   tm_nombredestino     varchar(500),
   tm_inventarioanteriordestino varchar(500),
   tm_inventarioactualdestino varchar(500),
   tm_canal             varchar(500),
   tm_numero_lote       varchar(500),
   tm_zona              varchar(500),
   tm_fecha_ingreso     datetime,
   tm_fecha_modifica    datetime,
   tm_usuario_ingresa_modifica int,
   primary key (tm_codigo)
);

/*==============================================================*/
/* Table: tb_venta_movistar                                     */
/*==============================================================*/
create table tb_venta_movistar
(
   vm_cod               int not null,
   vm_fecha             datetime,
   vm_transaccion       varchar(500),
   vm_distribuidor      varchar(500),
   vm_nombredistribuidor varchar(500),
   vm_codigoscl         varchar(500),
   vm_inventarioanteriorfuente varchar(500),
   vm_inventarioactualfuente varchar(500),
   vm_tiposim           varchar(500),
   vm_icc               varchar(500),
   vm_min               varchar(500),
   vm_estado            varchar(500),
   vm_iddestino         varchar(500),
   vm_nombredestino     varchar(500),
   vm_inventarioanteriordestino varchar(500),
   vm_inventarioactualdestino varchar(500),
   vm_canal             varchar(500),
   vm_lote              varchar(500),
   vm_zona              varchar(500),
   vm_fecha_ingreso     datetime,
   vm_fecha_modificacion datetime,
   vm_usuario_ingresa_modifica int,
   vm_estado_icc        varchar(250),
   primary key (vm_cod)
);

