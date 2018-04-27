/*==============================================================*/
/* DBMS name:      Microsoft SQL Server 2008                    */
/* Created on:     26/04/2018 17:24:16                          */
/*==============================================================*/


if exists (select 1
            from  sysobjects
           where  id = object_id('cruge_user')
            and   type = 'U')
   drop table cruge_user
go

if exists (select 1
            from  sysindexes
           where  id    = object_id('tb_asignacion_novedad')
            and   name  = 'relationship_23_fk'
            and   indid > 0
            and   indid < 255)
   drop index tb_asignacion_novedad.relationship_23_fk
go

if exists (select 1
            from  sysindexes
           where  id    = object_id('tb_asignacion_novedad')
            and   name  = 'relationship_22_fk'
            and   indid > 0
            and   indid < 255)
   drop index tb_asignacion_novedad.relationship_22_fk
go

if exists (select 1
            from  sysobjects
           where  id = object_id('tb_asignacion_novedad')
            and   type = 'U')
   drop table tb_asignacion_novedad
go

if exists (select 1
            from  sysobjects
           where  id = object_id('tb_carga_informacion_revision')
            and   type = 'U')
   drop table tb_carga_informacion_revision
go

if exists (select 1
            from  sysobjects
           where  id = object_id('tb_cliente')
            and   type = 'U')
   drop table tb_cliente
go

if exists (select 1
            from  sysobjects
           where  id = object_id('tb_comentario_oficina')
            and   type = 'U')
   drop table tb_comentario_oficina
go

if exists (select 1
            from  sysobjects
           where  id = object_id('tb_comentario_supervision')
            and   type = 'U')
   drop table tb_comentario_supervision
go

if exists (select 1
            from  sysindexes
           where  id    = object_id('tb_detalle_grupo_notificacion')
            and   name  = 'relationship_28_fk'
            and   indid > 0
            and   indid < 255)
   drop index tb_detalle_grupo_notificacion.relationship_28_fk
go

if exists (select 1
            from  sysindexes
           where  id    = object_id('tb_detalle_grupo_notificacion')
            and   name  = 'relationship_26_fk'
            and   indid > 0
            and   indid < 255)
   drop index tb_detalle_grupo_notificacion.relationship_26_fk
go

if exists (select 1
            from  sysobjects
           where  id = object_id('tb_detalle_grupo_notificacion')
            and   type = 'U')
   drop table tb_detalle_grupo_notificacion
go

if exists (select 1
            from  sysindexes
           where  id    = object_id('tb_detalle_revision_historial')
            and   name  = 'relationship_36_fk'
            and   indid > 0
            and   indid < 255)
   drop index tb_detalle_revision_historial.relationship_36_fk
go

if exists (select 1
            from  sysobjects
           where  id = object_id('tb_detalle_revision_historial')
            and   type = 'U')
   drop table tb_detalle_revision_historial
go

if exists (select 1
            from  sysobjects
           where  id = object_id('tb_ejecutivo')
            and   type = 'U')
   drop table tb_ejecutivo
go

if exists (select 1
            from  sysobjects
           where  id = object_id('tb_ejecutivo_ruta')
            and   type = 'U')
   drop table tb_ejecutivo_ruta
go

if exists (select 1
            from  sysobjects
           where  id = object_id('tb_encuesta')
            and   type = 'U')
   drop table tb_encuesta
go

if exists (select 1
            from  sysobjects
           where  id = object_id('tb_estado')
            and   type = 'U')
   drop table tb_estado
go

if exists (select 1
            from  sysobjects
           where  id = object_id('tb_grupo_notificacion')
            and   type = 'U')
   drop table tb_grupo_notificacion
go

if exists (select 1
            from  sysobjects
           where  id = object_id('tb_historial_cliente_ruta')
            and   type = 'U')
   drop table tb_historial_cliente_ruta
go

if exists (select 1
            from  sysindexes
           where  id    = object_id('tb_historial_gestion_novedad')
            and   name  = 'relationship_21_fk'
            and   indid > 0
            and   indid < 255)
   drop index tb_historial_gestion_novedad.relationship_21_fk
go

if exists (select 1
            from  sysobjects
           where  id = object_id('tb_historial_gestion_novedad')
            and   type = 'U')
   drop table tb_historial_gestion_novedad
go

if exists (select 1
            from  sysindexes
           where  id    = object_id('tb_historial_mb')
            and   name  = 'relationship_32_fk'
            and   indid > 0
            and   indid < 255)
   drop index tb_historial_mb.relationship_32_fk
go

if exists (select 1
            from  sysobjects
           where  id = object_id('tb_historial_mb')
            and   type = 'U')
   drop table tb_historial_mb
go

if exists (select 1
            from  sysobjects
           where  id = object_id('tb_indicadores')
            and   type = 'U')
   drop table tb_indicadores
go

if exists (select 1
            from  sysindexes
           where  id    = object_id('tb_mines_validacion')
            and   name  = 'relationship_31_fk'
            and   indid > 0
            and   indid < 255)
   drop index tb_mines_validacion.relationship_31_fk
go

if exists (select 1
            from  sysindexes
           where  id    = object_id('tb_mines_validacion')
            and   name  = 'relationship_29_fk'
            and   indid > 0
            and   indid < 255)
   drop index tb_mines_validacion.relationship_29_fk
go

if exists (select 1
            from  sysobjects
           where  id = object_id('tb_mines_validacion')
            and   type = 'U')
   drop table tb_mines_validacion
go

if exists (select 1
            from  sysindexes
           where  id    = object_id('tb_novedades')
            and   name  = 'relationship_11_fk'
            and   indid > 0
            and   indid < 255)
   drop index tb_novedades.relationship_11_fk
go

if exists (select 1
            from  sysobjects
           where  id = object_id('tb_novedades')
            and   type = 'U')
   drop table tb_novedades
go

if exists (select 1
            from  sysindexes
           where  id    = object_id('tb_novedad_cliente')
            and   name  = 'relationship_8_fk'
            and   indid > 0
            and   indid < 255)
   drop index tb_novedad_cliente.relationship_8_fk
go

if exists (select 1
            from  sysindexes
           where  id    = object_id('tb_novedad_cliente')
            and   name  = 'relationship_7_fk'
            and   indid > 0
            and   indid < 255)
   drop index tb_novedad_cliente.relationship_7_fk
go

if exists (select 1
            from  sysobjects
           where  id = object_id('tb_novedad_cliente')
            and   type = 'U')
   drop table tb_novedad_cliente
go

if exists (select 1
            from  sysindexes
           where  id    = object_id('tb_opcion_pregunta')
            and   name  = 'relationship_12_fk'
            and   indid > 0
            and   indid < 255)
   drop index tb_opcion_pregunta.relationship_12_fk
go

if exists (select 1
            from  sysobjects
           where  id = object_id('tb_opcion_pregunta')
            and   type = 'U')
   drop table tb_opcion_pregunta
go

if exists (select 1
            from  sysindexes
           where  id    = object_id('tb_ordenes_mb')
            and   name  = 'relationship_35_fk'
            and   indid > 0
            and   indid < 255)
   drop index tb_ordenes_mb.relationship_35_fk
go

if exists (select 1
            from  sysobjects
           where  id = object_id('tb_ordenes_mb')
            and   type = 'U')
   drop table tb_ordenes_mb
go

if exists (select 1
            from  sysobjects
           where  id = object_id('tb_periodo_gestion')
            and   type = 'U')
   drop table tb_periodo_gestion
go

if exists (select 1
            from  sysindexes
           where  id    = object_id('tb_pregunta')
            and   name  = 'relationship_25_fk'
            and   indid > 0
            and   indid < 255)
   drop index tb_pregunta.relationship_25_fk
go

if exists (select 1
            from  sysobjects
           where  id = object_id('tb_pregunta')
            and   type = 'U')
   drop table tb_pregunta
go

if exists (select 1
            from  sysindexes
           where  id    = object_id('tb_pregunta_encuesta')
            and   name  = 'relationship_18_fk'
            and   indid > 0
            and   indid < 255)
   drop index tb_pregunta_encuesta.relationship_18_fk
go

if exists (select 1
            from  sysindexes
           where  id    = object_id('tb_pregunta_encuesta')
            and   name  = 'relationship_17_fk'
            and   indid > 0
            and   indid < 255)
   drop index tb_pregunta_encuesta.relationship_17_fk
go

if exists (select 1
            from  sysobjects
           where  id = object_id('tb_pregunta_encuesta')
            and   type = 'U')
   drop table tb_pregunta_encuesta
go

if exists (select 1
            from  sysobjects
           where  id = object_id('tb_presupuesto_venta')
            and   type = 'U')
   drop table tb_presupuesto_venta
go

if exists (select 1
            from  sysobjects
           where  id = object_id('tb_rango_cumplimiento')
            and   type = 'U')
   drop table tb_rango_cumplimiento
go

if exists (select 1
            from  sysindexes
           where  id    = object_id('tb_resultados_encuesta')
            and   name  = 'relationship_27_fk'
            and   indid > 0
            and   indid < 255)
   drop index tb_resultados_encuesta.relationship_27_fk
go

if exists (select 1
            from  sysindexes
           where  id    = object_id('tb_resultados_encuesta')
            and   name  = 'relationship_16_fk'
            and   indid > 0
            and   indid < 255)
   drop index tb_resultados_encuesta.relationship_16_fk
go

if exists (select 1
            from  sysindexes
           where  id    = object_id('tb_resultados_encuesta')
            and   name  = 'relationship_15_fk'
            and   indid > 0
            and   indid < 255)
   drop index tb_resultados_encuesta.relationship_15_fk
go

if exists (select 1
            from  sysobjects
           where  id = object_id('tb_resultados_encuesta')
            and   type = 'U')
   drop table tb_resultados_encuesta
go

if exists (select 1
            from  sysindexes
           where  id    = object_id('tb_resumen_historial_diario')
            and   name  = 'relationship_34_fk'
            and   indid > 0
            and   indid < 255)
   drop index tb_resumen_historial_diario.relationship_34_fk
go

if exists (select 1
            from  sysobjects
           where  id = object_id('tb_resumen_historial_diario')
            and   type = 'U')
   drop table tb_resumen_historial_diario
go

if exists (select 1
            from  sysindexes
           where  id    = object_id('tb_revision_mines')
            and   name  = 'relationship_30_fk'
            and   indid > 0
            and   indid < 255)
   drop index tb_revision_mines.relationship_30_fk
go

if exists (select 1
            from  sysobjects
           where  id = object_id('tb_revision_mines')
            and   type = 'U')
   drop table tb_revision_mines
go

if exists (select 1
            from  sysobjects
           where  id = object_id('tb_rol')
            and   type = 'U')
   drop table tb_rol
go

if exists (select 1
            from  sysindexes
           where  id    = object_id('tb_ruta_gestion')
            and   name  = 'relationship_1_fk'
            and   indid > 0
            and   indid < 255)
   drop index tb_ruta_gestion.relationship_1_fk
go

if exists (select 1
            from  sysobjects
           where  id = object_id('tb_ruta_gestion')
            and   type = 'U')
   drop table tb_ruta_gestion
go

if exists (select 1
            from  sysindexes
           where  id    = object_id('tb_ruta_mb')
            and   name  = 'relationship_33_fk'
            and   indid > 0
            and   indid < 255)
   drop index tb_ruta_mb.relationship_33_fk
go

if exists (select 1
            from  sysobjects
           where  id = object_id('tb_ruta_mb')
            and   type = 'U')
   drop table tb_ruta_mb
go

if exists (select 1
            from  sysindexes
           where  id    = object_id('tb_solucion_novedad')
            and   name  = 'relationship_24_fk'
            and   indid > 0
            and   indid < 255)
   drop index tb_solucion_novedad.relationship_24_fk
go

if exists (select 1
            from  sysobjects
           where  id = object_id('tb_solucion_novedad')
            and   type = 'U')
   drop table tb_solucion_novedad
go

if exists (select 1
            from  sysindexes
           where  id    = object_id('tb_telefono_cliente')
            and   name  = 'relationship_6_fk'
            and   indid > 0
            and   indid < 255)
   drop index tb_telefono_cliente.relationship_6_fk
go

if exists (select 1
            from  sysobjects
           where  id = object_id('tb_telefono_cliente')
            and   type = 'U')
   drop table tb_telefono_cliente
go

if exists (select 1
            from  sysobjects
           where  id = object_id('tb_tipo_pregunta')
            and   type = 'U')
   drop table tb_tipo_pregunta
go

if exists (select 1
            from  sysobjects
           where  id = object_id('tb_transferencia_movistar')
            and   type = 'U')
   drop table tb_transferencia_movistar
go

if exists (select 1
            from  sysindexes
           where  id    = object_id('tb_usuario_rol')
            and   name  = 'relationship_5_fk'
            and   indid > 0
            and   indid < 255)
   drop index tb_usuario_rol.relationship_5_fk
go

if exists (select 1
            from  sysindexes
           where  id    = object_id('tb_usuario_rol')
            and   name  = 'relationship_4_fk'
            and   indid > 0
            and   indid < 255)
   drop index tb_usuario_rol.relationship_4_fk
go

if exists (select 1
            from  sysobjects
           where  id = object_id('tb_usuario_rol')
            and   type = 'U')
   drop table tb_usuario_rol
go

if exists (select 1
            from  sysindexes
           where  id    = object_id('tb_usuario_ruta')
            and   name  = 'relationship_3_fk'
            and   indid > 0
            and   indid < 255)
   drop index tb_usuario_ruta.relationship_3_fk
go

if exists (select 1
            from  sysindexes
           where  id    = object_id('tb_usuario_ruta')
            and   name  = 'relationship_2_fk'
            and   indid > 0
            and   indid < 255)
   drop index tb_usuario_ruta.relationship_2_fk
go

if exists (select 1
            from  sysobjects
           where  id = object_id('tb_usuario_ruta')
            and   type = 'U')
   drop table tb_usuario_ruta
go

if exists (select 1
            from  sysobjects
           where  id = object_id('tb_venta_movistar')
            and   type = 'U')
   drop table tb_venta_movistar
go

if exists (select 1
            from  sysobjects
           where  id = object_id('tb_zonas_gestion')
            and   type = 'U')
   drop table tb_zonas_gestion
go

/*==============================================================*/
/* Table: cruge_user                                            */
/*==============================================================*/
create table cruge_user (
   iduser               int                  not null,
   constraint pk_cruge_user primary key nonclustered (iduser)
)
go

/*==============================================================*/
/* Table: tb_asignacion_novedad                                 */
/*==============================================================*/
create table tb_asignacion_novedad (
   asn_id               int                  not null,
   ncli_id              int                  null,
   iduser               int                  null,
   asn_estado           int                  null,
   asn_fecha_ingreso    datetime             null,
   asn_fecha_modifica   datetime             null,
   asn_cod_usuario_ing_mod int                  null,
   constraint pk_tb_asignacion_novedad primary key nonclustered (asn_id)
)
go

/*==============================================================*/
/* Index: relationship_22_fk                                    */
/*==============================================================*/
create index relationship_22_fk on tb_asignacion_novedad (
ncli_id asc
)
go

/*==============================================================*/
/* Index: relationship_23_fk                                    */
/*==============================================================*/
create index relationship_23_fk on tb_asignacion_novedad (
iduser asc
)
go

/*==============================================================*/
/* Table: tb_carga_informacion_revision                         */
/*==============================================================*/
create table tb_carga_informacion_revision (
   cir_id               int                  not null,
   cir_codigo           varchar(50)          null,
   cir_nombre           varchar(250)         null,
   cir_registros_cargados int                  null,
   cir_fecha_inicio     datetime             null,
   cir_fecha_fin        datetime             null,
   cir_estado           int                  null,
   cir_tipo             varchar(50)          null,
   cir_fecha_ingreso    datetime             null,
   cir_fecha_modifica   datetime             null,
   cir_cod_usuario_ing_mod int                  null,
   constraint pk_tb_carga_informacion_revisi primary key nonclustered (cir_id)
)
go

/*==============================================================*/
/* Table: tb_cliente                                            */
/*==============================================================*/
create table tb_cliente (
   cli_codigo           int                  not null,
   cli_codigo_cliente   varchar(50)          null,
   cli_nombre_cliente   varchar(250)         null,
   cli_latitud          varchar(250)         null,
   cli_longitud         varchar(250)         null,
   cli_estado           int                  null,
   cli_fecha_ingreso    datetime             null,
   cli_fecha_modificacion datetime             null,
   cli_usuario_ingresa_modifica int                  null,
   constraint pk_tb_cliente primary key nonclustered (cli_codigo)
)
go

/*==============================================================*/
/* Table: tb_comentario_oficina                                 */
/*==============================================================*/
create table tb_comentario_oficina (
   co_id                int                  not null,
   co_fecha_historial_revisado datetime             null,
   co_ejecutivo_revisado varchar(25)          null,
   co_comentario        varchar(500)         null,
   co_enlace_mapa       varchar(500)         null,
   co_enlace_imagen     varchar(500)         null,
   co_estado            int                  null,
   co_fecha_ingreso     datetime             null,
   co_fecha_modificacion datetime             null,
   co_usuario_ingresa_modifica int                  null,
   constraint pk_tb_comentario_oficina primary key nonclustered (co_id)
)
go

/*==============================================================*/
/* Table: tb_comentario_supervision                             */
/*==============================================================*/
create table tb_comentario_supervision (
   cs_id                int                  not null,
   cs_fecha_historial_supervisado datetime             null,
   cs_ejecutivo_supervisado varchar(25)          null,
   cs_comentario        varchar(500)         null,
   cs_estado            int                  null,
   cs_fecha_ingreso     datetime             null,
   cs_fecha_modificacion datetime             null,
   cs_usuario_ingresa_modifica int                  null,
   constraint pk_tb_comentario_supervision primary key nonclustered (cs_id)
)
go

/*==============================================================*/
/* Table: tb_detalle_grupo_notificacion                         */
/*==============================================================*/
create table tb_detalle_grupo_notificacion (
   dnot_id              int                  not null,
   gno_id               int                  null,
   iduser               int                  null,
   constraint pk_tb_detalle_grupo_notificaci primary key nonclustered (dnot_id)
)
go

/*==============================================================*/
/* Index: relationship_26_fk                                    */
/*==============================================================*/
create index relationship_26_fk on tb_detalle_grupo_notificacion (
iduser asc
)
go

/*==============================================================*/
/* Index: relationship_28_fk                                    */
/*==============================================================*/
create index relationship_28_fk on tb_detalle_grupo_notificacion (
gno_id asc
)
go

/*==============================================================*/
/* Table: tb_detalle_revision_historial                         */
/*==============================================================*/
create table tb_detalle_revision_historial (
   drh_id               int                  not null,
   pg_id                int                  null,
   drh_semana           int                  null,
   drh_tipo_historial   varchar(100)         null,
   drh_fecha_revision   datetime             null,
   drh_fecha_ruta       datetime             null,
   drh_codigo_ejecutivo varchar(100)         null,
   drh_nombre_ejecutivo varchar(200)         null,
   drh_codigo_cliente   varchar(50)          null,
   drh_nombre_cliente   varchar(100)         null,
   drh_ruta_usada       varchar(50)          null,
   drh_secuencia_visita int                  null,
   drh_ruta_cliente     varchar(50)          null,
   drh_secuencia_ruta   int                  null,
   drh_estado_revision_ruta varchar(100)         null,
   drh_estado_revision_sec varchar(100)         null,
   drh_cantidad_chips_venta int                  null,
   drh_metros           decimal(10,4)        null,
   drh_precision_usada  int                  null,
   drh_validacion       varchar(500)         null,
   drh_latitud_cliente  decimal(20,10)       null,
   drh_longitud_cliente decimal(20,10)       null,
   drh_latitud_visita   decimal(20,10)       null,
   drh_longitud_visita  decimal(20,10)       null,
   drh_inicio_visita    datetime             null,
   drh_fin_visita       datetime             null,
   drh_tiempo_gestion   datetime             null,
   drh_tiempo_traslado  datetime             null,
   drh_distancia_cli_eje decimal(20,10)       null,
   drh_distancia_cli_anterior decimal(20,10)       null,
   drh_fch_ingreso      datetime             null,
   drh_fch_modifica     datetime             null,
   drh_cod_usr_ing_mod  int                  null,
   constraint pk_tb_detalle_revision_histori primary key nonclustered (drh_id)
)
go

/*==============================================================*/
/* Index: relationship_36_fk                                    */
/*==============================================================*/
create index relationship_36_fk on tb_detalle_revision_historial (
pg_id asc
)
go

/*==============================================================*/
/* Table: tb_ejecutivo                                          */
/*==============================================================*/
create table tb_ejecutivo (
   e_cod                int                  not null,
   e_nombre             varchar(50)          null,
   e_usr_mobilvendor    varchar(5)           null,
   e_iniciales          varchar(5)           null,
   e_estado             int                  null,
   e_tipo               varchar(50)          null,
   constraint pk_tb_ejecutivo primary key nonclustered (e_cod)
)
go

/*==============================================================*/
/* Table: tb_ejecutivo_ruta                                     */
/*==============================================================*/
create table tb_ejecutivo_ruta (
   er_cod               int                  not null,
   er_usuario           varchar(50)          null,
   er_usuario_nombre    varchar(50)          null,
   er_ruta              varchar(50)          null,
   er_ruta_nombre       varchar(50)          null,
   er_estatus           varchar(50)          null,
   er_fecha_ingreso     datetime             null,
   er_fecha_asignacion  datetime             null,
   er_fecha_modificacion datetime             null,
   er_cod_usr_ing       int                  null,
   er_cod_usr_mod       int                  null,
   constraint pk_tb_ejecutivo_ruta primary key nonclustered (er_cod)
)
go

/*==============================================================*/
/* Table: tb_encuesta                                           */
/*==============================================================*/
create table tb_encuesta (
   enc_id               int                  not null,
   enc_codigo           varchar(10)          null,
   enc_nombre           varchar(25)          null,
   enc_estado           int                  null,
   enc_fecha_inicio     datetime             null,
   enc_fecha_fin        datetime             null,
   enc_fecha_ingreso    datetime             null,
   enc_fecha_modifica   datetime             null,
   enc_cod_usuario_ing_mod int                  null,
   constraint pk_tb_encuesta primary key nonclustered (enc_id)
)
go

/*==============================================================*/
/* Table: tb_estado                                             */
/*==============================================================*/
create table tb_estado (
   est_id               int                  not null,
   est_nombre           varchar(50)          null,
   est_tipo             varchar(50)          null,
   est_fecha_ingreso    datetime             null,
   est_fecha_modifica   datetime             null,
   est_cod_usuario_ing_mod int                  null,
   constraint pk_tb_estado primary key nonclustered (est_id)
)
go

/*==============================================================*/
/* Table: tb_grupo_notificacion                                 */
/*==============================================================*/
create table tb_grupo_notificacion (
   gno_id               int                  not null,
   gno_nombre           varchar(50)          null,
   gno_estado           int                  null,
   gno_fecha_ingreso    datetime             null,
   gno_fecha_modifica   datetime             null,
   gno_cod_usuario_ing_mod int                  null,
   constraint pk_tb_grupo_notificacion primary key nonclustered (gno_id)
)
go

/*==============================================================*/
/* Table: tb_historial_cliente_ruta                             */
/*==============================================================*/
create table tb_historial_cliente_ruta (
   hcr_id               int                  not null,
   hcr_ruta_anterior    varchar(150)         null,
   hcr_ruta_nueva       varchar(150)         null,
   hcr_direccion_anterior varchar(150)         null,
   hcr_direccion_nueva  varchar(150)         null,
   hcr_semana_anterior  int                  null,
   hcr_semana_nueva     int                  null,
   hcr_dia_anterior     int                  null,
   hcr_dia_nuevo        int                  null,
   hcr_secuencia_anterior int                  null,
   hcr_secuencia_nueva  int                  null,
   hcr_estado_anterior  int                  null,
   hcr_estado_nuevo     int                  null,
   hcr_fch_actualiza_ruta datetime             null,
   hcr_cambios          varchar(500)         null,
   hcr_fch_ingreso      datetime             null,
   hcr_fch_modificacion datetime             null,
   hcr_cod_usuario_ing_mod int                  null,
   constraint pk_tb_historial_cliente_ruta primary key nonclustered (hcr_id)
)
go

/*==============================================================*/
/* Table: tb_historial_gestion_novedad                          */
/*==============================================================*/
create table tb_historial_gestion_novedad (
   hgan_id              int                  not null,
   ncli_id              int                  null,
   hgan_observacion     varchar(500)         null,
   hgan_estado_anterior int                  null,
   hgan_estado_actual   int                  null,
   hgan_fecha_ingreso   datetime             null,
   hgan_fecha_modifica  datetime             null,
   constraint pk_tb_historial_gestion_noveda primary key nonclustered (hgan_id)
)
go

/*==============================================================*/
/* Index: relationship_21_fk                                    */
/*==============================================================*/
create index relationship_21_fk on tb_historial_gestion_novedad (
ncli_id asc
)
go

/*==============================================================*/
/* Table: tb_historial_mb                                       */
/*==============================================================*/
create table tb_historial_mb (
   h_cod                int                  not null,
   pg_id                int                  null,
   h_id                 int                  null,
   h_fecha              datetime             null,
   h_usuario            varchar(500)         null,
   h_usuario_nombre     varchar(500)         null,
   h_ruta               varchar(500)         null,
   h_ruta_nombre        varchar(500)         null,
   h_semana             int                  null,
   h_dia                int                  null,
   h_cod_cliente        varchar(500)         null,
   h_nom_cliente        varchar(500)         null,
   h_direccion          varchar(500)         null,
   h_accion             varchar(500)         null,
   h_cod_accion         varchar(500)         null,
   h_cod_comentario     varchar(500)         null,
   h_comentario         varchar(500)         null,
   h_monto              varchar(500)         null,
   h_latitud            decimal(10,5)        null,
   h_longitud           decimal(10,5)        null,
   h_romper_secuencia   int                  null,
   h_fch_ingreso        datetime             null,
   h_fch_modificacion   datetime             null,
   h_fch_desde          datetime             null,
   h_fch_hasta          datetime             null,
   h_usr_ing_mod        int                  null,
   constraint pk_tb_historial_mb primary key nonclustered (h_cod)
)
go

/*==============================================================*/
/* Index: relationship_32_fk                                    */
/*==============================================================*/
create index relationship_32_fk on tb_historial_mb (
pg_id asc
)
go

/*==============================================================*/
/* Table: tb_indicadores                                        */
/*==============================================================*/
create table tb_indicadores (
   i_codigo             int                  not null,
   i_fecha              datetime             null,
   i_sucursal           varchar(500)         null,
   i_numero_bodega      int                  null,
   i_bodega             varchar(500)         null,
   i_numero_serie       varchar(500)         null,
   i_numero_factura     varchar(500)         null,
   i_cod_cliente        varchar(500)         null,
   i_tipo_cliente       varchar(500)         null,
   i_nombre_cliente     varchar(500)         null,
   i_ruc                varchar(500)         null,
   i_direccion          varchar(500)         null,
   i_ciudad             varchar(500)         null,
   i_telefono           varchar(500)         null,
   i_codigo_producto    varchar(500)         null,
   i_descripcion_producto varchar(500)         null,
   i_codigo_grupo       varchar(500)         null,
   i_grupo              varchar(500)         null,
   i_cantidad           int                  null,
   i_detalle            varchar(1024)        null,
   i_imei               varchar(20)          null,
   i_min                varchar(20)          null,
   i_icc                varchar(20)          null,
   i_costo              decimal(6,4)         null,
   i_precio1            decimal(6,4)         null,
   i_precio2            decimal(6,4)         null,
   i_precio3            decimal(6,4)         null,
   i_precio4            decimal(6,4)         null,
   i_precio5            decimal(6,4)         null,
   i_precio             decimal(6,4)         null,
   i_porcendes          decimal(6,4)         null,
   i_descuento          decimal(6,4)         null,
   i_subtotal           decimal(6,4)         null,
   i_iva                decimal(6,4)         null,
   i_total              decimal(6,4)         null,
   i_e_codigo           varchar(20)          null,
   i_vendedor           varchar(20)          null,
   i_provincia          varchar(20)          null,
   i_fecha_ingreso      datetime             null,
   i_fecha_modificacion datetime             null,
   i_usuario_ingresa_modifica int                  null,
   i_estado_icc         varchar(250)         null,
   constraint pk_tb_indicadores primary key nonclustered (i_codigo)
)
go

/*==============================================================*/
/* Table: tb_mines_validacion                                   */
/*==============================================================*/
create table tb_mines_validacion (
   miva_id              int                  not null,
   cir_id               int                  null,
   iduser               int                  null,
   miva_carga           int                  null,
   miva_tipo            varchar(25)          null,
   miva_fecha           datetime             null,
   miva_bodega          varchar(100)         null,
   miva_nomcli          varchar(100)         null,
   miva_codgrup         varchar(100)         null,
   miva_detalle         varchar(100)         null,
   miva_imei            varchar(50)          null,
   miva_min             varchar(20)          null,
   miva_vendedor        varchar(100)         null,
   miva_estado          int                  null,
   miva_estado_reasignacion int                  null,
   miva_usario_reasignado int                  null,
   miva_fecha_ingreso   datetime             null,
   miva_fecha_modifica  datetime             null,
   miva_cod_usuario_ing_mod int                  null,
   constraint pk_tb_mines_validacion primary key nonclustered (miva_id)
)
go

/*==============================================================*/
/* Index: relationship_29_fk                                    */
/*==============================================================*/
create index relationship_29_fk on tb_mines_validacion (
iduser asc
)
go

/*==============================================================*/
/* Index: relationship_31_fk                                    */
/*==============================================================*/
create index relationship_31_fk on tb_mines_validacion (
cir_id asc
)
go

/*==============================================================*/
/* Table: tb_novedades                                          */
/*==============================================================*/
create table tb_novedades (
   nov_id               int                  not null,
   gno_id               int                  null,
   nov_descripcion      varchar(100)         null,
   nov_estado           int                  null,
   nov_categoria        varchar(50)          null,
   nov_fecha_ingreso    datetime             null,
   nov_fecha_modifica   datetime             null,
   nov_cod_usuario_ingresa_modifica int                  null,
   constraint pk_tb_novedades primary key nonclustered (nov_id)
)
go

/*==============================================================*/
/* Index: relationship_11_fk                                    */
/*==============================================================*/
create index relationship_11_fk on tb_novedades (
gno_id asc
)
go

/*==============================================================*/
/* Table: tb_novedad_cliente                                    */
/*==============================================================*/
create table tb_novedad_cliente (
   ncli_id              int                  not null,
   nov_id               int                  null,
   cli_codigo           int                  null,
   ncli_estado          int                  null,
   ncli_observacion     varchar(500)         null,
   ncli_fecha_ingreso   datetime             null,
   ncli_fecha_modifica  datetime             null,
   ncli_cod_usuario_ing_mod int                  null,
   constraint pk_tb_novedad_cliente primary key nonclustered (ncli_id)
)
go

/*==============================================================*/
/* Index: relationship_7_fk                                     */
/*==============================================================*/
create index relationship_7_fk on tb_novedad_cliente (
cli_codigo asc
)
go

/*==============================================================*/
/* Index: relationship_8_fk                                     */
/*==============================================================*/
create index relationship_8_fk on tb_novedad_cliente (
nov_id asc
)
go

/*==============================================================*/
/* Table: tb_opcion_pregunta                                    */
/*==============================================================*/
create table tb_opcion_pregunta (
   opc_id               int                  not null,
   preg_id              int                  null,
   opc_descripcion      varchar(50)          null,
   constraint pk_tb_opcion_pregunta primary key nonclustered (opc_id)
)
go

/*==============================================================*/
/* Index: relationship_12_fk                                    */
/*==============================================================*/
create index relationship_12_fk on tb_opcion_pregunta (
preg_id asc
)
go

/*==============================================================*/
/* Table: tb_ordenes_mb                                         */
/*==============================================================*/
create table tb_ordenes_mb (
   o_codigo             int                  not null,
   pg_id                int                  null,
   o_id                 int                  null,
   o_concepto           varchar(500)         null,
   o_codigo_mb          varchar(500)         null,
   o_comentario         varchar(500)         null,
   o_fch_venta          datetime             null,
   o_fch_creacion       datetime             null,
   o_fch_despacho       datetime             null,
   o_tipo               varchar(50)          null,
   o_estatus            varchar(50)          null,
   o_cod_cliente        varchar(50)          null,
   o_nom_cliente        varchar(100)         null,
   o_id_cliente         varchar(100)         null,
   o_direccion          varchar(250)         null,
   o_lista_precio       varchar(100)         null,
   o_nom_lista_precio   varchar(100)         null,
   o_bodega_origen      varchar(100)         null,
   o_nom_bodega_origen  varchar(100)         null,
   o_termino_pago       varchar(100)         null,
   o_nom_termino_pago   varchar(100)         null,
   o_usuario            varchar(100)         null,
   o_nom_usuario        varchar(100)         null,
   o_oficina            varchar(100)         null,
   o_nom_oficina        varchar(100)         null,
   o_tipo_secuencia     varchar(100)         null,
   o_iva_12_base        decimal(10,4)        null,
   o_iva_12_valor       decimal(10,4)        null,
   o_iva_0_base         decimal(10,4)        null,
   o_iva_0_valor        decimal(10,4)        null,
   o_iva_14_base        decimal(10,4)        null,
   o_iva_14_valor       decimal(10,4)        null,
   o_subtotal           decimal(10,4)        null,
   o_porcentaje_descuento decimal(10,4)        null,
   o_descuento          decimal(10,4)        null,
   o_impuestos          decimal(10,4)        null,
   o_otros_cargos       decimal(10,4)        null,
   o_total              decimal(10,4)        null,
   o_datos              varchar(1024)        null,
   o_referencia         varchar(1024)        null,
   o_estado_proceso     varchar(1024)        null,
   o_fch_ingreso        datetime             null,
   o_fch_modificacion   datetime             null,
   o_fch_desde          datetime             null,
   o_fch_hasta          datetime             null,
   o_usr_ing_mod        int                  null,
   constraint pk_tb_ordenes_mb primary key nonclustered (o_codigo)
)
go

/*==============================================================*/
/* Index: relationship_35_fk                                    */
/*==============================================================*/
create index relationship_35_fk on tb_ordenes_mb (
pg_id asc
)
go

/*==============================================================*/
/* Table: tb_periodo_gestion                                    */
/*==============================================================*/
create table tb_periodo_gestion (
   pg_id                int                  not null,
   pg_descripcion       varchar(250)         null,
   pg_fecha_inicio      datetime             null,
   pg_fecha_fin         datetime             null,
   pg_estado            int                  null,
   pg_tipo              varchar(50)          null,
   pg_fecha_ingreso     datetime             null,
   pg_fecha_modificacion datetime             null,
   pg_cod_usuario_ing_mod int                  null,
   constraint pk_tb_periodo_gestion primary key nonclustered (pg_id)
)
go

/*==============================================================*/
/* Table: tb_pregunta                                           */
/*==============================================================*/
create table tb_pregunta (
   preg_id              int                  not null,
   tpreg_id             int                  null,
   preg_codigo          varchar(10)          null,
   preg_descripcion     varchar(25)          null,
   preg_estado          int                  null,
   preg_fecha_ingreso   datetime             null,
   preg_fecha_modifica  datetime             null,
   preg_cod_usuario_ing_mod int                  null,
   constraint pk_tb_pregunta primary key nonclustered (preg_id)
)
go

/*==============================================================*/
/* Index: relationship_25_fk                                    */
/*==============================================================*/
create index relationship_25_fk on tb_pregunta (
tpreg_id asc
)
go

/*==============================================================*/
/* Table: tb_pregunta_encuesta                                  */
/*==============================================================*/
create table tb_pregunta_encuesta (
   encp_id              int                  not null,
   enc_id               int                  null,
   preg_id              int                  null,
   encp_orden           int                  null,
   encp_fecha_ingreso   datetime             null,
   encp_fecha_modifica  datetime             null,
   encp_cod_usuario_ing_mod int                  null,
   constraint pk_tb_pregunta_encuesta primary key nonclustered (encp_id)
)
go

/*==============================================================*/
/* Index: relationship_17_fk                                    */
/*==============================================================*/
create index relationship_17_fk on tb_pregunta_encuesta (
enc_id asc
)
go

/*==============================================================*/
/* Index: relationship_18_fk                                    */
/*==============================================================*/
create index relationship_18_fk on tb_pregunta_encuesta (
preg_id asc
)
go

/*==============================================================*/
/* Table: tb_presupuesto_venta                                  */
/*==============================================================*/
create table tb_presupuesto_venta (
   p_id                 int                  not null,
   p_codigo_vendedor    varchar(50)          null,
   p_fecha_ini_validez  datetime             null,
   p_fecha_fin_validez  datetime             null,
   p_dias_laborables    int                  null,
   p_valor_presupuesto  decimal(10,4)        null,
   p_tipo_presupuesto   varchar(25)          null,
   p_cantidad_feriados  int                  null,
   p_venta_diaria_esperada decimal(10,4)        null,
   p_estado_presupuesto int                  null,
   p_fecha_ingreso      datetime             null,
   p_fecha_modifica     datetime             null,
   p_cod_usuario_ing_mod int                  null,
   constraint pk_tb_presupuesto_venta primary key nonclustered (p_id)
)
go

/*==============================================================*/
/* Table: tb_rango_cumplimiento                                 */
/*==============================================================*/
create table tb_rango_cumplimiento (
   c_cod                int                  not null,
   c_rango_min          decimal(4,2)         null,
   c_rango_max          decimal(4,2)         null,
   c_nombre_rango       varchar(500)         null,
   c_estado_rango       int                  null,
   c_fecha_ingreso      datetime             null,
   c_fecha_modificacion datetime             null,
   c_codigo_usuario_ingresa int                  null,
   c_codigo_usuario_modifica int                  null,
   constraint pk_tb_rango_cumplimiento primary key nonclustered (c_cod)
)
go

/*==============================================================*/
/* Table: tb_resultados_encuesta                                */
/*==============================================================*/
create table tb_resultados_encuesta (
   renc_id              int                  not null,
   encp_id              int                  null,
   cli_codigo           int                  null,
   iduser               int                  null,
   renc_resultado       varchar(500)         null,
   renc_fecha_ingreso   datetime             null,
   renc_fecha_modifica  datetime             null,
   constraint pk_tb_resultados_encuesta primary key nonclustered (renc_id)
)
go

/*==============================================================*/
/* Index: relationship_15_fk                                    */
/*==============================================================*/
create index relationship_15_fk on tb_resultados_encuesta (
cli_codigo asc
)
go

/*==============================================================*/
/* Index: relationship_16_fk                                    */
/*==============================================================*/
create index relationship_16_fk on tb_resultados_encuesta (
iduser asc
)
go

/*==============================================================*/
/* Index: relationship_27_fk                                    */
/*==============================================================*/
create index relationship_27_fk on tb_resultados_encuesta (
encp_id asc
)
go

/*==============================================================*/
/* Table: tb_resumen_historial_diario                           */
/*==============================================================*/
create table tb_resumen_historial_diario (
   rhd_id               int                  not null,
   pg_id                int                  null,
   rhd_cod_ejecutivo    varchar(20)          null,
   rhd_fecha_historial  datetime             null,
   rhd_parametro        varchar(50)          null,
   rhd_valor            varchar(250)         null,
   rhd_semana           int                  null,
   rhd_tipo             varchar(50)          null,
   rhd_estado           int                  null,
   rhd_orden            int                  null,
   rhd_fecha_ingreso    datetime             null,
   rhd_fecha_modificacion datetime             null,
   rhd_usuario_ingresa_modifica int                  null,
   constraint pk_tb_resumen_historial_diario primary key nonclustered (rhd_id)
)
go

/*==============================================================*/
/* Index: relationship_34_fk                                    */
/*==============================================================*/
create index relationship_34_fk on tb_resumen_historial_diario (
pg_id asc
)
go

/*==============================================================*/
/* Table: tb_revision_mines                                     */
/*==============================================================*/
create table tb_revision_mines (
   rmva_id              int                  not null,
   iduser               int                  null,
   rmva_numero_revision int                  null,
   rmva_estado_revision varchar(50)          null,
   rmva_min             varchar(50)          null,
   rmva_icc             varchar(50)          null,
   rmva_tipo            varchar(25)          null,
   rmva_carga           int                  null,
   rmva_fecha_gestion   datetime             null,
   rmva_resultado_llamad varchar(100)         null,
   rmva_motivo_no_contado varchar(100)         null,
   rmva_operadora       varchar(50)          null,
   rmva_lugar_compra    varchar(100)         null,
   rmva_precio          decimal(10,4)        null,
   rmva_estado          int                  null,
   rmva_fecha_ingreso   datetime             null,
   rmva_fecha_modifica  datetime             null,
   rmva_cod_usuario_ing_mod int                  null,
   constraint pk_tb_revision_mines primary key nonclustered (rmva_id)
)
go

/*==============================================================*/
/* Index: relationship_30_fk                                    */
/*==============================================================*/
create index relationship_30_fk on tb_revision_mines (
iduser asc
)
go

/*==============================================================*/
/* Table: tb_rol                                                */
/*==============================================================*/
create table tb_rol (
   r_id                 int                  not null,
   r_nombre_rol         varchar(100)         null,
   r_estado             int                  null,
   r_fecha_ingreso      datetime             null,
   r_fecha_modifica     datetime             null,
   r_cod_usuario_ing_mod int                  null,
   constraint pk_tb_rol primary key nonclustered (r_id)
)
go

/*==============================================================*/
/* Table: tb_ruta_gestion                                       */
/*==============================================================*/
create table tb_ruta_gestion (
   rg_id                int                  not null,
   zg_id                int                  null,
   rg_cod_ruta_mb       varchar(50)          null,
   rg_nombre_ruta       varchar(50)          null,
   rg_dia_visita        int                  null,
   rg_ejecutivo_visita  varchar(150)         null,
   rg_estado_ruta       int                  null,
   rg_fecha_ingreso     datetime             null,
   rg_fecha_modifica    datetime             null,
   rg_cod_usuario_ingresa_modifica int                  null,
   constraint pk_tb_ruta_gestion primary key nonclustered (rg_id)
)
go

/*==============================================================*/
/* Index: relationship_1_fk                                     */
/*==============================================================*/
create index relationship_1_fk on tb_ruta_gestion (
zg_id asc
)
go

/*==============================================================*/
/* Table: tb_ruta_mb                                            */
/*==============================================================*/
create table tb_ruta_mb (
   r_cod                int                  not null,
   pg_id                int                  null,
   r_ruta               varchar(100)         null,
   r_cod_cliente        varchar(100)         null,
   r_nom_cliente        varchar(200)         null,
   r_tipo_negocio       varchar(200)         null,
   r_cod_direccion      varchar(200)         null,
   r_direccion          varchar(500)         null,
   r_referencia         varchar(500)         null,
   r_semana             int                  null,
   r_dia                int                  null,
   r_secuencia          int                  null,
   r_estatus            int                  null,
   r_numero_carga_informacion int                  null,
   r_fch_ingreso        datetime             null,
   r_fch_modificacion   datetime             null,
   r_fch_desde          datetime             null,
   r_fch_hasta          datetime             null,
   r_usuario_ing_mod    int                  null,
   constraint pk_tb_ruta_mb primary key nonclustered (r_cod)
)
go

/*==============================================================*/
/* Index: relationship_33_fk                                    */
/*==============================================================*/
create index relationship_33_fk on tb_ruta_mb (
pg_id asc
)
go

/*==============================================================*/
/* Table: tb_solucion_novedad                                   */
/*==============================================================*/
create table tb_solucion_novedad (
   snov_id              int                  not null,
   ncli_id              int                  null,
   snov_solucion        varchar(500)         null,
   snov_fecha_solucion  datetime             null,
   snov_fecha_ingreso   datetime             null,
   snov_fecha_modifica  datetime             null,
   snov_cod_usuario_ing_mod int                  null,
   constraint pk_tb_solucion_novedad primary key nonclustered (snov_id)
)
go

/*==============================================================*/
/* Index: relationship_24_fk                                    */
/*==============================================================*/
create index relationship_24_fk on tb_solucion_novedad (
ncli_id asc
)
go

/*==============================================================*/
/* Table: tb_telefono_cliente                                   */
/*==============================================================*/
create table tb_telefono_cliente (
   tcli_id              int                  not null,
   cli_codigo           int                  null,
   tcli_telefono        varchar(20)          null,
   tcli_estado          int                  null,
   tcli_fecha_ingreso   datetime             null,
   tcli_fecha_modifica  datetime             null,
   tcli_cod_usuario_ing_mod int                  null,
   constraint pk_tb_telefono_cliente primary key nonclustered (tcli_id)
)
go

/*==============================================================*/
/* Index: relationship_6_fk                                     */
/*==============================================================*/
create index relationship_6_fk on tb_telefono_cliente (
cli_codigo asc
)
go

/*==============================================================*/
/* Table: tb_tipo_pregunta                                      */
/*==============================================================*/
create table tb_tipo_pregunta (
   tpreg_id             int                  not null,
   tpreg_nombre         varchar(50)          null,
   tpreg_estado         int                  null,
   tpreg_fecha_inicio   datetime             null,
   tpreg_fecha_modifica datetime             null,
   tpreg_cod_usuario_ing_mod int                  null,
   constraint pk_tb_tipo_pregunta primary key nonclustered (tpreg_id)
)
go

/*==============================================================*/
/* Table: tb_transferencia_movistar                             */
/*==============================================================*/
create table tb_transferencia_movistar (
   tm_codigo            int                  not null,
   tm_fecha             datetime             null,
   tm_codigotransferencia varchar(500)         null,
   tm_iddistribuidor    varchar(500)         null,
   tm_nombredistribuidor varchar(500)         null,
   tm_codigoscl         varchar(500)         null,
   tm_inventarioanteriorfuente varchar(500)         null,
   tm_inventarioactualfuente varchar(500)         null,
   tm_tiposim           varchar(500)         null,
   tm_icc               varchar(500)         null,
   tm_min               varchar(500)         null,
   tm_estado            varchar(500)         null,
   tm_iddestino         varchar(500)         null,
   tm_nombredestino     varchar(500)         null,
   tm_inventarioanteriordestino varchar(500)         null,
   tm_inventarioactualdestino varchar(500)         null,
   tm_canal             varchar(500)         null,
   tm_numero_lote       varchar(500)         null,
   tm_zona              varchar(500)         null,
   tm_fecha_ingreso     datetime             null,
   tm_fecha_modifica    datetime             null,
   tm_usuario_ingresa_modifica int                  null,
   constraint pk_tb_transferencia_movistar primary key nonclustered (tm_codigo)
)
go

/*==============================================================*/
/* Table: tb_usuario_rol                                        */
/*==============================================================*/
create table tb_usuario_rol (
   usrl_id              int                  not null,
   iduser               int                  null,
   r_id                 int                  null,
   usrl_nombre_usuario  varchar(250)         null,
   usrl_estado          int                  null,
   usrl_fecha_ingreso   datetime             null,
   usrl_fecha_modifica  datetime             null,
   usrl_cod_usuario_ing_mod int                  null,
   constraint pk_tb_usuario_rol primary key nonclustered (usrl_id)
)
go

/*==============================================================*/
/* Index: relationship_4_fk                                     */
/*==============================================================*/
create index relationship_4_fk on tb_usuario_rol (
iduser asc
)
go

/*==============================================================*/
/* Index: relationship_5_fk                                     */
/*==============================================================*/
create index relationship_5_fk on tb_usuario_rol (
r_id asc
)
go

/*==============================================================*/
/* Table: tb_usuario_ruta                                       */
/*==============================================================*/
create table tb_usuario_ruta (
   ur_id                int                  not null,
   rg_id                int                  null,
   iduser               int                  null,
   ur_nombre_ejecutivo  varchar(250)         null,
   ur_estado            int                  null,
   ur_zona_gestion      varchar(50)          null,
   ur_fecha_ingreso     datetime             null,
   ur_fecha_modifica    datetime             null,
   ur_cod_usuario_ingresa_modifica int                  null,
   constraint pk_tb_usuario_ruta primary key nonclustered (ur_id)
)
go

/*==============================================================*/
/* Index: relationship_2_fk                                     */
/*==============================================================*/
create index relationship_2_fk on tb_usuario_ruta (
iduser asc
)
go

/*==============================================================*/
/* Index: relationship_3_fk                                     */
/*==============================================================*/
create index relationship_3_fk on tb_usuario_ruta (
rg_id asc
)
go

/*==============================================================*/
/* Table: tb_venta_movistar                                     */
/*==============================================================*/
create table tb_venta_movistar (
   vm_cod               int                  not null,
   vm_fecha             datetime             null,
   vm_transaccion       varchar(500)         null,
   vm_distribuidor      varchar(500)         null,
   vm_nombredistribuidor varchar(500)         null,
   vm_codigoscl         varchar(500)         null,
   vm_inventarioanteriorfuente varchar(500)         null,
   vm_inventarioactualfuente varchar(500)         null,
   vm_tiposim           varchar(500)         null,
   vm_icc               varchar(500)         null,
   vm_min               varchar(500)         null,
   vm_estado            varchar(500)         null,
   vm_iddestino         varchar(500)         null,
   vm_nombredestino     varchar(500)         null,
   vm_inventarioanteriordestino varchar(500)         null,
   vm_inventarioactualdestino varchar(500)         null,
   vm_canal             varchar(500)         null,
   vm_lote              varchar(500)         null,
   vm_zona              varchar(500)         null,
   vm_fecha_ingreso     datetime             null,
   vm_fecha_modificacion datetime             null,
   vm_usuario_ingresa_modifica int                  null,
   vm_estado_icc        varchar(250)         null,
   constraint pk_tb_venta_movistar primary key nonclustered (vm_cod)
)
go

/*==============================================================*/
/* Table: tb_zonas_gestion                                      */
/*==============================================================*/
create table tb_zonas_gestion (
   zg_id                int                  not null,
   zg_nombre_zona       varchar(150)         null,
   zg_cod_ejecutivo_asignado varchar(50)          null,
   zg_nomb_ejecutivo_asignado varchar(250)         null,
   zg_estado_zona       int                  null,
   zg_fecha_ingreso     datetime             null,
   zg_fecha_modifica    datetime             null,
   zg_cod_usuario_ingresa_modifica int                  null,
   constraint pk_tb_zonas_gestion primary key nonclustered (zg_id)
)
go

