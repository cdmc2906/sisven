/*==============================================================*/
/* DBMS name:      MySQL 5.0                                    */
/* Created on:     10/12/2019 11:38:30                          */
/*==============================================================*/


drop table if exists cruge_user;

drop table if exists tb_asignacion_novedad;

drop table if exists tb_carga_informacion_revision;

drop table if exists tb_cliente;

drop table if exists tb_cliente_direccion;

drop table if exists tb_cliente_telefonos;

drop table if exists tb_comentario_oficina;

drop table if exists tb_comentario_supervision;

drop table if exists tb_condicion_promocion;

drop table if exists tb_detalle_grupo_notificacion;

drop table if exists tb_detalle_revision_historial;

drop table if exists tb_ejecutivo;

drop table if exists tb_ejecutivo_ruta;

drop table if exists tb_encuesta;

drop table if exists tb_estado;

drop table if exists tb_grupo_notificacion;

drop table if exists tb_historial_cliente_ruta;

drop table if exists tb_historial_gestion_novedad;

drop table if exists tb_historial_mb;

drop table if exists tb_indicadores;

drop table if exists tb_mines_validacion;

drop table if exists tb_novedades;

drop table if exists tb_novedad_cliente;

drop table if exists tb_opcion_pregunta;

drop table if exists tb_ordenes_mb;

drop table if exists tb_periodo_gestion;

drop table if exists tb_pregunta;

drop table if exists tb_pregunta_encuesta;

drop table if exists tb_presupuesto_venta;

drop table if exists tb_promocion;

drop table if exists tb_rango_cumplimiento;

drop table if exists tb_resultados_encuesta;

drop table if exists tb_resumen_historial_diario;

drop table if exists tb_revision_mines;

drop table if exists tb_rol;

drop table if exists tb_ruta_gestion;

drop table if exists tb_ruta_mb;

drop table if exists tb_solucion_novedad;

drop table if exists tb_stock_movistar;

drop table if exists tb_tipo_pregunta;

drop table if exists tb_transferencia_movistar;

drop table if exists tb_usuario_rol;

drop table if exists tb_usuario_ruta;

drop table if exists tb_venta_movistar;

drop table if exists tb_zonas_gestion;

/*==============================================================*/
/* Table: cruge_user                                            */
/*==============================================================*/
create table cruge_user
(
   iduser               int not null IDENTITY(1,1),
   primary key (iduser)
);

/*==============================================================*/
/* Table: tb_asignacion_novedad                                 */
/*==============================================================*/
create table tb_asignacion_novedad
(
   asn_id               int not null IDENTITY(1,1),
   ncli_id              int,
   iduser               int,
   asn_estado           int,
   asn_fecha_ingreso    datetime,
   asn_fecha_modifica   datetime,
   asn_cod_usuario_ing_mod int,
   primary key (asn_id)
);

/*==============================================================*/
/* Table: tb_carga_informacion_revision                         */
/*==============================================================*/
create table tb_carga_informacion_revision
(
   cir_id               int not null IDENTITY(1,1),
   cir_codigo           varchar(50),
   cir_nombre           varchar(250),
   cir_registros_cargados int,
   cir_fecha_inicio     datetime,
   cir_fecha_fin        datetime,
   cir_estado           int,
   cir_tipo             varchar(50),
   cir_fecha_ingreso    datetime,
   cir_fecha_modifica   datetime,
   cir_cod_usuario_ing_mod int,
   primary key (cir_id)
);

/*==============================================================*/
/* Table: tb_cliente                                            */
/*==============================================================*/
create table tb_cliente
(
   cli_codigo           int not null IDENTITY(1,1),
   cli_codigo_cliente   varchar(50),
   cli_nombre_cliente   varchar(250),
   cli_tipo_de_identificacion varchar(50),
   cli_identificacion   varchar(50),
   cli_nombre_de_compania varchar(500),
   cli_nombre_comercial varchar(250),
   cli_contacto         varchar(250),
   cli_moneda_cli_moneda varchar(250),
   cli_moneda_nombre    varchar(250),
   cli_tipo_de_negocio  varchar(250),
   cli_tipo_de_negocio_nombre varchar(250),
   cli_subcanal         varchar(250),
   cli_subcanal_nombre  varchar(250),
   cli_lista_de_precios varchar(250),
   cli_lista_de_precios_nombre varchar(250),
   cli_lista_de_precios_2 varchar(250),
   cli_lista_de_precios_2_nombre varchar(250),
   cli_termino_de_pago  varchar(250),
   cli_termino_de_pago_nombre varchar(250),
   cli_metodo_de_pago   varchar(250),
   cli_metodo_de_pago_nombre varchar(250),
   cli_grupo            varchar(250),
   cli_grupo_nombre     varchar(250),
   cli_usuario          varchar(250),
   cli_usuario_nombre   varchar(250),
   cli_comentario       varchar(250),
   cli_objetivo_de_venta varchar(250),
   cli_maximo_descuento_porcentaje decimal(10,4),
   cli_retencion_porcentaje decimal(10,4),
   cli_tiene_credito    tinyint,
   cli_estatus          varchar(50),
   cli_creado           datetime,
   cli_creado_por       varchar(50),
   cli_latitud          varchar(250),
   cli_longitud         varchar(250),
   cli_estado           int,
   cli_fecha_ingreso    datetime,
   cli_fecha_modificacion datetime,
   cli_usuario_ingresa_modifica int,
   primary key (cli_codigo)
);

/*==============================================================*/
/* Table: tb_cliente_direccion                                  */
/*==============================================================*/
create table tb_cliente_direccion
(
   dcli_id              int not null IDENTITY(1,1),
   dcli_codigo          varchar(50),
   dcli_cliente         varchar(250),
   dcli_cliente_nombre  varchar(250),
   dcli_cliente_identificacion varchar(250),
   dcli_cliente_comentario varchar(250),
   dcli_oficina         varchar(250),
   dcli_oficina_nombre  varchar(250),
   dcli_codigo_de_barras varchar(250),
   dcli_descripcion     varchar(250),
   dcli_contacto        varchar(250),
   dcli_geo_area        varchar(500),
   dcli_geo_area_nombre varchar(500),
   dcli_geo_area_codigo_recorrido varchar(500),
   dcli_geo_area_descripcion_recorrido varchar(500),
   dcli_provincia       varchar(100),
   dcli_canton          varchar(100),
   dcli_parroquia       varchar(100),
   dcli_calle_principal varchar(500),
   dcli_nomenclatura    varchar(500),
   dcli_calle_secundaria varchar(500),
   dcli_referencia      varchar(500),
   dcli_codigo_postal   varchar(250),
   dcli_telefono        varchar(250),
   dcli_fax             varchar(250),
   dcli_email           varchar(250),
   dcli_latitud         varchar(250),
   dcli_longitud        varchar(250),
   dcli_ultima_visita   datetime,
   dcli_estado_de_localizacion varchar(250),
   dcli_fecha_ingreso   datetime,
   dcli_usr_ingresa     int,
   dcli_fecha_modifica  datetime,
   dcli_usr_modifica    int,
   primary key (dcli_id)
);

/*==============================================================*/
/* Table: tb_cliente_telefonos                                  */
/*==============================================================*/
create table tb_cliente_telefonos
(
   tcli_id              int not null IDENTITY(1,1),
   cli_codigo           int,
   tcli_telefono        varchar(20),
   tcli_estado          int,
   tcli_fecha_ingreso   datetime,
   tcli_fecha_modifica  datetime,
   tcli_cod_usuario_ing_mod int,
   primary key (tcli_id)
);

/*==============================================================*/
/* Table: tb_comentario_oficina                                 */
/*==============================================================*/
create table tb_comentario_oficina
(
   co_id                int not null IDENTITY(1,1),
   co_fecha_historial_revisado date,
   co_ejecutivo_revisado varchar(25),
   co_comentario        varchar(500),
   co_enlace_mapa       varchar(500),
   co_enlace_imagen     varchar(500),
   co_estado            int,
   co_fecha_ingreso     datetime,
   co_fecha_modificacion datetime,
   co_usuario_ingresa_modifica int,
   primary key (co_id)
);

/*==============================================================*/
/* Table: tb_comentario_supervision                             */
/*==============================================================*/
create table tb_comentario_supervision
(
   cs_id                int not null IDENTITY(1,1),
   cs_fecha_historial_supervisado date,
   cs_ejecutivo_supervisado varchar(25),
   cs_comentario        varchar(500),
   cs_estado            int,
   cs_fecha_ingreso     datetime,
   cs_fecha_modificacion datetime,
   cs_usuario_ingresa_modifica int,
   primary key (cs_id)
);

/*==============================================================*/
/* Table: tb_condicion_promocion                                */
/*==============================================================*/
create table tb_condicion_promocion
(
   cpr_id               int not null IDENTITY(1,1),
   pr_id                int,
   cpr_parametro        varchar(50),
   cpr_operador         varchar(50),
   cpr_valor_min        varchar(50),
   cpr_valor_max        varchar(50),
   cpr_estado           int,
   cpr_fecha_ingreso    datetime,
   cpr_fecha_modifica   datetime,
   cpr_usr_ing_mod      int,
   primary key (cpr_id)
);

/*==============================================================*/
/* Table: tb_detalle_grupo_notificacion                         */
/*==============================================================*/
create table tb_detalle_grupo_notificacion
(
   dnot_id              int not null IDENTITY(1,1),
   gno_id               int,
   iduser               int,
   primary key (dnot_id)
);

/*==============================================================*/
/* Table: tb_detalle_revision_historial                         */
/*==============================================================*/
create table tb_detalle_revision_historial
(
   drh_id               int not null IDENTITY(1,1),
   pg_id                int,
   drh_semana           int,
   drh_tipo_historial   varchar(100),
   drh_fecha_revision   datetime,
   drh_fecha_ruta       datetime,
   drh_codigo_ejecutivo varchar(100),
   drh_nombre_ejecutivo varchar(200),
   drh_codigo_cliente   varchar(50),
   drh_nombre_cliente   varchar(100),
   drh_ruta_usada       varchar(50),
   drh_secuencia_visita int,
   drh_ruta_cliente     varchar(50),
   drh_secuencia_ruta   int,
   drh_estado_revision_ruta varchar(100),
   drh_estado_revision_sec varchar(100),
   drh_cantidad_chips_venta int,
   drh_metros           decimal(10,4),
   drh_precision_usada  int,
   drh_validacion       varchar(500),
   drh_latitud_cliente  decimal(20,10),
   drh_longitud_cliente decimal(20,10),
   drh_latitud_visita   decimal(20,10),
   drh_longitud_visita  decimal(20,10),
   drh_inicio_visita    time,
   drh_fin_visita       time,
   drh_tiempo_gestion   time,
   drh_tiempo_traslado  time,
   drh_distancia_cli_eje decimal(20,10),
   drh_distancia_cli_anterior decimal(20,10),
   drh_fch_ingreso      datetime,
   drh_fch_modifica     datetime,
   drh_cod_usr_ing_mod  int,
   primary key (drh_id)
);

/*==============================================================*/
/* Table: tb_ejecutivo                                          */
/*==============================================================*/
create table tb_ejecutivo
(
   e_cod                int not null IDENTITY(1,1),
   e_nombre             varchar(50),
   e_usr_mobilvendor    varchar(5),
   e_iniciales          varchar(5),
   e_estado             int,
   e_tipo               varchar(50),
   e_id_bodega_delta    int,
   e_mail_notificar     varchar(100),
   e_telefono_notificar varchar(20),
   e_id_tipo            int,
   e_descripcion_tipo   varchar(100),
   primary key (e_cod)
);

/*==============================================================*/
/* Table: tb_ejecutivo_ruta                                     */
/*==============================================================*/
create table tb_ejecutivo_ruta
(
   er_cod               int not null IDENTITY(1,1),
   rg_id                int,
   e_cod                int,
   er_usuario           varchar(50),
   er_usuario_nombre    varchar(50),
   er_ruta              varchar(50),
   er_ruta_nombre       varchar(250),
   er_semana_visitar    int,
   er_dia_visitar       int,
   er_estado            varchar(50),
   er_fecha_ingreso     datetime,
   er_fecha_modificacion datetime,
   er_cod_usr_ing       int,
   er_cod_usr_mod       int,
   primary key (er_cod)
);

/*==============================================================*/
/* Table: tb_encuesta                                           */
/*==============================================================*/
create table tb_encuesta
(
   enc_id               int not null IDENTITY(1,1),
   enc_codigo           varchar(10),
   enc_nombre           varchar(25),
   enc_estado           int,
   enc_fecha_inicio     datetime,
   enc_fecha_fin        datetime,
   enc_fecha_ingreso    datetime,
   enc_fecha_modifica   datetime,
   enc_cod_usuario_ing_mod int,
   primary key (enc_id)
);

/*==============================================================*/
/* Table: tb_estado                                             */
/*==============================================================*/
create table tb_estado
(
   est_id               int not null IDENTITY(1,1),
   est_nombre           varchar(50),
   est_tipo             varchar(50),
   est_fecha_ingreso    datetime,
   est_fecha_modifica   datetime,
   est_cod_usuario_ing_mod int,
   primary key (est_id)
);

/*==============================================================*/
/* Table: tb_grupo_notificacion                                 */
/*==============================================================*/
create table tb_grupo_notificacion
(
   gno_id               int not null IDENTITY(1,1),
   gno_nombre           varchar(50),
   gno_estado           int,
   gno_fecha_ingreso    datetime,
   gno_fecha_modifica   datetime,
   gno_cod_usuario_ing_mod int,
   primary key (gno_id)
);

/*==============================================================*/
/* Table: tb_historial_cliente_ruta                             */
/*==============================================================*/
create table tb_historial_cliente_ruta
(
   hcr_id               int not null IDENTITY(1,1),
   hcr_ruta_anterior    varchar(150),
   hcr_ruta_nueva       varchar(150),
   hcr_direccion_anterior varchar(150),
   hcr_direccion_nueva  varchar(150),
   hcr_semana_anterior  int,
   hcr_semana_nueva     int,
   hcr_dia_anterior     int,
   hcr_dia_nuevo        int,
   hcr_secuencia_anterior int,
   hcr_secuencia_nueva  int,
   hcr_estado_anterior  int,
   hcr_estado_nuevo     int,
   hcr_fch_actualiza_ruta datetime,
   hcr_cambios          varchar(500),
   hcr_fch_ingreso      datetime,
   hcr_fch_modificacion datetime,
   hcr_cod_usuario_ing_mod int,
   primary key (hcr_id)
);

/*==============================================================*/
/* Table: tb_historial_gestion_novedad                          */
/*==============================================================*/
create table tb_historial_gestion_novedad
(
   hgan_id              int not null IDENTITY(1,1),
   ncli_id              int,
   hgan_observacion     varchar(500),
   hgan_estado_anterior int,
   hgan_estado_actual   int,
   hgan_fecha_ingreso   datetime,
   hgan_fecha_modifica  datetime,
   primary key (hgan_id)
);

/*==============================================================*/
/* Table: tb_historial_mb                                       */
/*==============================================================*/
create table tb_historial_mb
(
   h_cod                int not null IDENTITY(1,1),
   pg_id                int,
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
   i_codigo             int not null IDENTITY(1,1),
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
   i_vendedor           varchar(50),
   i_provincia          varchar(20),
   i_fecha_ingreso      datetime,
   i_fecha_modificacion datetime,
   i_usuario_ingresa_modifica int,
   i_estado_icc         varchar(250),
   primary key (i_codigo)
);

/*==============================================================*/
/* Table: tb_mines_validacion                                   */
/*==============================================================*/
create table tb_mines_validacion
(
   miva_id              int not null IDENTITY(1,1),
   cir_id               int,
   iduser               int,
   miva_carga           int,
   miva_tipo            varchar(25),
   miva_fecha           date,
   miva_bodega          varchar(100),
   miva_nomcli          varchar(100),
   miva_codgrup         varchar(100),
   miva_detalle         varchar(100),
   miva_imei            varchar(50),
   miva_min             varchar(20),
   miva_vendedor        varchar(100),
   miva_estado          int,
   miva_estado_reasignacion int,
   miva_usario_reasignado int,
   miva_fecha_ingreso   datetime,
   miva_fecha_modifica  datetime,
   miva_cod_usuario_ing_mod int,
   primary key (miva_id)
);

/*==============================================================*/
/* Table: tb_novedades                                          */
/*==============================================================*/
create table tb_novedades
(
   nov_id               int not null IDENTITY(1,1),
   gno_id               int,
   nov_descripcion      varchar(100),
   nov_estado           int,
   nov_categoria        varchar(50),
   nov_fecha_ingreso    datetime,
   nov_fecha_modifica   datetime,
   nov_cod_usuario_ingresa_modifica int,
   primary key (nov_id)
);

/*==============================================================*/
/* Table: tb_novedad_cliente                                    */
/*==============================================================*/
create table tb_novedad_cliente
(
   ncli_id              int not null IDENTITY(1,1),
   nov_id               int,
   cli_codigo           int,
   ncli_estado          int,
   ncli_observacion     varchar(500),
   ncli_fecha_ingreso   datetime,
   ncli_fecha_modifica  datetime,
   ncli_cod_usuario_ing_mod int,
   primary key (ncli_id)
);

/*==============================================================*/
/* Table: tb_opcion_pregunta                                    */
/*==============================================================*/
create table tb_opcion_pregunta
(
   opc_id               int not null IDENTITY(1,1),
   preg_id              int,
   opc_descripcion      varchar(50),
   primary key (opc_id)
);

/*==============================================================*/
/* Table: tb_ordenes_mb                                         */
/*==============================================================*/
create table tb_ordenes_mb
(
   o_codigo             int not null IDENTITY(1,1),
   pg_id                int,
   o_id                 int,
   o_concepto           varchar(500),
   o_codigo_mb          varchar(500),
   o_comentario         varchar(500),
   o_fch_venta          datetime,
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
   o_departamento_ventas varchar(50),
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
/* Table: tb_periodo_gestion                                    */
/*==============================================================*/
create table tb_periodo_gestion
(
   pg_id                int not null IDENTITY(1,1),
   pg_descripcion       varchar(250),
   pg_fecha_inicio      datetime,
   pg_fecha_fin         datetime,
   pg_anio              int,
   pg_mes               int,
   pg_estado            int,
   pg_tipo              varchar(50),
   pg_fecha_ingreso     datetime,
   pg_fecha_modificacion datetime,
   pg_cod_usuario_ing_mod int,
   primary key (pg_id)
);

/*==============================================================*/
/* Table: tb_pregunta                                           */
/*==============================================================*/
create table tb_pregunta
(
   preg_id              int not null IDENTITY(1,1),
   tpreg_id             int,
   preg_codigo          varchar(10),
   preg_descripcion     varchar(25),
   preg_estado          int,
   preg_fecha_ingreso   datetime,
   preg_fecha_modifica  datetime,
   preg_cod_usuario_ing_mod int,
   primary key (preg_id)
);

/*==============================================================*/
/* Table: tb_pregunta_encuesta                                  */
/*==============================================================*/
create table tb_pregunta_encuesta
(
   encp_id              int not null IDENTITY(1,1),
   enc_id               int,
   preg_id              int,
   encp_orden           int,
   encp_fecha_ingreso   datetime,
   encp_fecha_modifica  datetime,
   encp_cod_usuario_ing_mod int,
   primary key (encp_id)
);

/*==============================================================*/
/* Table: tb_presupuesto_venta                                  */
/*==============================================================*/
create table tb_presupuesto_venta
(
   p_id                 int not null IDENTITY(1,1),
   e_cod                int,
   pg_id                int,
   p_codigo_vendedor    varchar(50),
   p_fecha_ini_validez  datetime,
   p_fecha_fin_validez  datetime,
   p_dias_laborables    int,
   p_valor_presupuesto  decimal(10,4),
   p_tipo_presupuesto   varchar(25),
   p_cantidad_feriados  int,
   p_cumplimiento_diario_esperado decimal(10,4),
   p_estado_presupuesto int,
   p_fecha_ingreso      datetime,
   p_fecha_modifica     datetime,
   p_cod_usuario_ing_mod int,
   primary key (p_id)
);

/*==============================================================*/
/* Table: tb_promocion                                          */
/*==============================================================*/
create table tb_promocion
(
   pr_id                int not null IDENTITY(1,1),
   pr_nombre            varchar(500),
   pr_fecha_inicio      datetime,
   pr_fecha_fin         datetime,
   pr_estado            int,
   pr_ingreso           datetime,
   pr_modificacion      datetime,
   pr_id_usr_ing_mod    int,
   primary key (pr_id)
);

/*==============================================================*/
/* Table: tb_rango_cumplimiento                                 */
/*==============================================================*/
create table tb_rango_cumplimiento
(
   c_cod                int not null IDENTITY(1,1),
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
/* Table: tb_resultados_encuesta                                */
/*==============================================================*/
create table tb_resultados_encuesta
(
   renc_id              int not null IDENTITY(1,1),
   encp_id              int,
   cli_codigo           int,
   iduser               int,
   renc_resultado       varchar(500),
   renc_fecha_ingreso   datetime,
   renc_fecha_modifica  datetime,
   primary key (renc_id)
);

/*==============================================================*/
/* Table: tb_resumen_historial_diario                           */
/*==============================================================*/
create table tb_resumen_historial_diario
(
   rhd_id               int not null IDENTITY(1,1),
   pg_id                int,
   rhd_cod_ejecutivo    varchar(20),
   rhd_fecha_historial  date,
   rhd_parametro        varchar(50),
   rhd_valor            varchar(250),
   rhd_semana           int,
   rhd_tipo             varchar(50),
   rhd_estado           int,
   rhd_orden            int,
   rhd_fecha_ingreso    datetime,
   rhd_fecha_modificacion datetime,
   rhd_usuario_ingresa_modifica int,
   primary key (rhd_id)
);

/*==============================================================*/
/* Table: tb_revision_mines                                     */
/*==============================================================*/
create table tb_revision_mines
(
   rmva_id              int not null IDENTITY(1,1),
   iduser               int,
   rmva_numero_revision int,
   rmva_estado_revision varchar(50),
   rmva_min             varchar(50),
   rmva_icc             varchar(50),
   rmva_tipo            varchar(25),
   rmva_carga           int,
   rmva_fecha_gestion   datetime,
   rmva_resultado_llamad varchar(100),
   rmva_motivo_no_contado varchar(100),
   rmva_operadora       varchar(50),
   rmva_lugar_compra    varchar(100),
   rmva_precio          decimal(10,4),
   rmva_estado          int,
   rmva_fecha_ingreso   datetime,
   rmva_fecha_modifica  datetime,
   rmva_cod_usuario_ing_mod int,
   primary key (rmva_id)
);

/*==============================================================*/
/* Table: tb_rol                                                */
/*==============================================================*/
create table tb_rol
(
   r_id                 int not null IDENTITY(1,1),
   r_nombre_rol         varchar(100),
   r_estado             int,
   r_fecha_ingreso      datetime,
   r_fecha_modifica     datetime,
   r_cod_usuario_ing_mod int,
   primary key (r_id)
);

/*==============================================================*/
/* Table: tb_ruta_gestion                                       */
/*==============================================================*/
create table tb_ruta_gestion
(
   rg_id                int not null IDENTITY(1,1),
   zg_id                int,
   rg_cod_ruta_mb       varchar(50),
   rg_nombre_ruta       varchar(50),
   rg_estado_ruta       int,
   rg_fecha_ingreso     datetime,
   rg_fecha_modifica    datetime,
   rg_cod_usuario_ingresa_modifica int,
   primary key (rg_id)
);

/*==============================================================*/
/* Table: tb_ruta_mb                                            */
/*==============================================================*/
create table tb_ruta_mb
(
   r_cod                int not null IDENTITY(1,1),
   pg_id                int,
   r_ruta               varchar(100),
   r_cod_cliente        varchar(100),
   r_nom_cliente        varchar(200),
   r_tipo_negocio       varchar(200),
   r_cod_direccion      varchar(200),
   r_direccion          varchar(500),
   r_referencia         varchar(500),
   r_semana             int,
   r_dia                int,
   r_secuencia          int,
   r_estatus            int,
   r_numero_carga_informacion int,
   r_fch_ingreso        datetime,
   r_fch_modificacion   datetime,
   r_fch_desde          datetime,
   r_fch_hasta          datetime,
   r_usuario_ing_mod    int,
   primary key (r_cod)
);

/*==============================================================*/
/* Table: tb_solucion_novedad                                   */
/*==============================================================*/
create table tb_solucion_novedad
(
   snov_id              int not null IDENTITY(1,1),
   ncli_id              int,
   snov_solucion        varchar(500),
   snov_fecha_solucion  datetime,
   snov_fecha_ingreso   datetime,
   snov_fecha_modifica  datetime,
   snov_cod_usuario_ing_mod int,
   primary key (snov_id)
);

/*==============================================================*/
/* Table: tb_stock_movistar                                     */
/*==============================================================*/
create table tb_stock_movistar
(
   sm_codigo            int not null IDENTITY(1,1),
   pg_id                int,
   sm_distribuidor_id   varchar(20),
   sm_nombre_del_distribuidor varchar(200),
   sm_zona              varchar(250),
   sm_provincia         varchar(250),
   sm_ciudad            varchar(250),
   sm_principal_distribuidor_id varchar(250),
   sm_nombre_del_distribuidor_principal varchar(250),
   sm_tipo_de_codigo_de_sim varchar(250),
   sm_sim_inventario_saldo int,
   sm_estado_de_sim     varchar(250),
   sm_fecha_ingreso     datetime,
   sm_fecha_modifica    datetime,
   sm_usuario_ingresa_modifica int,
   sm_numero_carga      int,
   sm_estado            int,
   primary key (sm_codigo)
);

/*==============================================================*/
/* Table: tb_tipo_pregunta                                      */
/*==============================================================*/
create table tb_tipo_pregunta
(
   tpreg_id             int not null IDENTITY(1,1),
   tpreg_nombre         varchar(50),
   tpreg_estado         int,
   tpreg_fecha_inicio   datetime,
   tpreg_fecha_modifica datetime,
   tpreg_cod_usuario_ing_mod int,
   primary key (tpreg_id)
);

/*==============================================================*/
/* Table: tb_transferencia_movistar                             */
/*==============================================================*/
create table tb_transferencia_movistar
(
   tm_codigo            int not null IDENTITY(1,1),
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
/* Table: tb_usuario_rol                                        */
/*==============================================================*/
create table tb_usuario_rol
(
   usrl_id              int not null IDENTITY(1,1),
   iduser               int,
   r_id                 int,
   usrl_nombre_usuario  varchar(250),
   usrl_estado          int,
   usrl_fecha_ingreso   datetime,
   usrl_fecha_modifica  datetime,
   usrl_cod_usuario_ing_mod int,
   primary key (usrl_id)
);

/*==============================================================*/
/* Table: tb_usuario_ruta                                       */
/*==============================================================*/
create table tb_usuario_ruta
(
   ur_id                int not null IDENTITY(1,1),
   rg_id                int,
   iduser               int,
   ur_nombre_ejecutivo  varchar(250),
   ur_estado            int,
   ur_zona_gestion      varchar(50),
   ur_fecha_ingreso     datetime,
   ur_fecha_modifica    datetime,
   ur_cod_usuario_ingresa_modifica int,
   primary key (ur_id)
);

/*==============================================================*/
/* Table: tb_venta_movistar                                     */
/*==============================================================*/
create table tb_venta_movistar
(
   vm_cod               int not null IDENTITY(1,1),
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

/*==============================================================*/
/* Table: tb_zonas_gestion                                      */
/*==============================================================*/
create table tb_zonas_gestion
(
   zg_id                int not null IDENTITY(1,1),
   zg_nombre_zona       varchar(150),
   zg_cod_ejecutivo_asignado varchar(50),
   zg_nomb_ejecutivo_asignado varchar(250),
   zg_estado_zona       int,
   zm_tipo_zona         varchar(50),
   zg_fecha_ingreso     datetime,
   zg_fecha_modifica    datetime,
   zg_cod_usuario_ingresa_modifica int,
   primary key (zg_id)
);

alter table tb_asignacion_novedad add constraint fk_relationship_22 foreign key (ncli_id)
      references tb_novedad_cliente (ncli_id);

alter table tb_asignacion_novedad add constraint fk_relationship_23 foreign key (iduser)
      references cruge_user (iduser);

alter table tb_cliente_telefonos add constraint fk_relationship_6 foreign key (cli_codigo)
      references tb_cliente (cli_codigo);

alter table tb_condicion_promocion add constraint fk_relationship_42 foreign key (pr_id)
      references tb_promocion (pr_id);

alter table tb_detalle_grupo_notificacion add constraint fk_relationship_26 foreign key (iduser)
      references cruge_user (iduser);

alter table tb_detalle_grupo_notificacion add constraint fk_relationship_28 foreign key (gno_id)
      references tb_grupo_notificacion (gno_id);

alter table tb_detalle_revision_historial add constraint fk_relationship_36 foreign key (pg_id)
      references tb_periodo_gestion (pg_id);

alter table tb_ejecutivo_ruta add constraint fk_relationship_37 foreign key (e_cod)
      references tb_ejecutivo (e_cod);

alter table tb_ejecutivo_ruta add constraint fk_relationship_38 foreign key (rg_id)
      references tb_ruta_gestion (rg_id);

alter table tb_historial_gestion_novedad add constraint fk_relationship_21 foreign key (ncli_id)
      references tb_novedad_cliente (ncli_id);

alter table tb_historial_mb add constraint fk_relationship_32 foreign key (pg_id)
      references tb_periodo_gestion (pg_id);

alter table tb_mines_validacion add constraint fk_relationship_29 foreign key (iduser)
      references cruge_user (iduser);

alter table tb_mines_validacion add constraint fk_relationship_31 foreign key (cir_id)
      references tb_carga_informacion_revision (cir_id);

alter table tb_novedades add constraint fk_relationship_11 foreign key (gno_id)
      references tb_grupo_notificacion (gno_id);

alter table tb_novedad_cliente add constraint fk_relationship_7 foreign key (cli_codigo)
      references tb_cliente (cli_codigo);

alter table tb_novedad_cliente add constraint fk_relationship_8 foreign key (nov_id)
      references tb_novedades (nov_id);

alter table tb_opcion_pregunta add constraint fk_relationship_12 foreign key (preg_id)
      references tb_pregunta (preg_id);

alter table tb_ordenes_mb add constraint fk_relationship_35 foreign key (pg_id)
      references tb_periodo_gestion (pg_id);

alter table tb_pregunta add constraint fk_relationship_25 foreign key (tpreg_id)
      references tb_tipo_pregunta (tpreg_id);

alter table tb_pregunta_encuesta add constraint fk_relationship_17 foreign key (enc_id)
      references tb_encuesta (enc_id);

alter table tb_pregunta_encuesta add constraint fk_relationship_18 foreign key (preg_id)
      references tb_pregunta (preg_id);

alter table tb_presupuesto_venta add constraint fk_relationship_39 foreign key (pg_id)
      references tb_periodo_gestion (pg_id);

alter table tb_presupuesto_venta add constraint fk_relationship_40 foreign key (e_cod)
      references tb_ejecutivo (e_cod);

alter table tb_resultados_encuesta add constraint fk_relationship_15 foreign key (cli_codigo)
      references tb_cliente (cli_codigo);

alter table tb_resultados_encuesta add constraint fk_relationship_16 foreign key (iduser)
      references cruge_user (iduser);

alter table tb_resultados_encuesta add constraint fk_relationship_27 foreign key (encp_id)
      references tb_pregunta_encuesta (encp_id);

alter table tb_resumen_historial_diario add constraint fk_relationship_34 foreign key (pg_id)
      references tb_periodo_gestion (pg_id);

alter table tb_revision_mines add constraint fk_relationship_30 foreign key (iduser)
      references cruge_user (iduser);

alter table tb_ruta_gestion add constraint fk_relationship_1 foreign key (zg_id)
      references tb_zonas_gestion (zg_id);

alter table tb_ruta_mb add constraint fk_relationship_33 foreign key (pg_id)
      references tb_periodo_gestion (pg_id);

alter table tb_solucion_novedad add constraint fk_relationship_24 foreign key (ncli_id)
      references tb_novedad_cliente (ncli_id);

alter table tb_stock_movistar add constraint fk_relationship_41 foreign key (pg_id)
      references tb_periodo_gestion (pg_id);

alter table tb_usuario_rol add constraint fk_relationship_4 foreign key (iduser)
      references cruge_user (iduser);

alter table tb_usuario_rol add constraint fk_relationship_5 foreign key (r_id)
      references tb_rol (r_id);

alter table tb_usuario_ruta add constraint fk_relationship_2 foreign key (iduser)
      references cruge_user (iduser);

alter table tb_usuario_ruta add constraint fk_relationship_3 foreign key (rg_id)
      references tb_ruta_gestion (rg_id);

