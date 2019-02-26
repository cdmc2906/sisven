/*==============================================================*/
/* DBMS name:      MySQL 5.0                                    */
/* Created on:     28/01/2019 15:12:57                          */
/*==============================================================*/


drop table if exists tb_cliente;

drop table if exists tb_cliente_direccion;

drop table if exists tb_cliente_telefonos;

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
   cli_tipo_de_identificacion varchar(50),
   cli_identificacion   varchar(50),
   cli_nombre_de_compania varchar(500),
   cli_nombre_comercial varchar(250),
   cli_contacto         varchar(250),
   cli_moneda__cli_moneda varchar(250),
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
   dcli_id              int not null,
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
   dcli_calle_principal varchar(500),
   dcli_nomenclatura    varchar(500),
   dcli_calle_secundaria varchar(500),
   dcli_referencia      varchar(500),
   dcli_codigo_postal   varchar(250),
   dcli_telefono        varchar(250),
   dcli_fax             varchar(250),
   dcli_email           varchar(250),
   dcli_latitud         decimal(10,8),
   dcli_longitud        decimal(10,8),
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
   tcli_id              int not null,
   cli_codigo           int,
   tcli_telefono        varchar(20),
   tcli_estado          int,
   tcli_fecha_ingreso   datetime,
   tcli_fecha_modifica  datetime,
   tcli_cod_usuario_ing_mod int,
   primary key (tcli_id)
);

alter table tb_cliente_telefonos add constraint fk_relationship_6 foreign key (cli_codigo)
      references tb_cliente (cli_codigo) on delete restrict on update restrict;

