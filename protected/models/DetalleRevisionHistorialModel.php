<?php

/**
 * This is the model class for table "tb_detalle_revision_historial".
 *
 * The followings are the available columns in table 'tb_detalle_revision_historial':
 * @property integer $drh_id
 * @property integer $pg_id
 * @property integer $drh_semana
 * @property string $drh_tipo_historial
 * @property string $drh_fecha_revision
 * @property string $drh_fecha_ruta
 * @property string $drh_codigo_ejecutivo
 * @property string $drh_nombre_ejecutivo
 * @property string $drh_codigo_cliente
 * @property string $drh_nombre_cliente
 * @property string $drh_ruta_usada
 * @property integer $drh_secuencia_visita
 * @property string $drh_ruta_cliente
 * @property integer $drh_secuencia_ruta
 * @property string $drh_estado_revision_ruta
 * @property string $drh_estado_revision_sec
 * @property integer $drh_cantidad_chips_venta
 * @property string $drh_metros
 * @property integer $drh_precision_usada
 * @property string $drh_validacion
 * @property string $drh_latitud_cliente
 * @property string $drh_longitud_cliente
 * @property string $drh_latitud_visita
 * @property string $drh_longitud_visita
 * @property string $drh_inicio_visita
 * @property string $drh_fin_visita
 * @property string $drh_tiempo_gestion
 * @property string $drh_tiempo_traslado
 * @property string $drh_distancia_cli_eje
 * @property string $drh_distancia_cli_anterior
 * @property string $drh_fch_ingreso
 * @property string $drh_fch_modifica
 * @property integer $drh_cod_usr_ing_mod
 *
 * The followings are the available model relations:
 * @property TbPeriodoGestion $pg
 */
class DetalleRevisionHistorialModel extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'tb_detalle_revision_historial';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('pg_id, drh_semana, drh_secuencia_visita, drh_secuencia_ruta, drh_cantidad_chips_venta, drh_precision_usada, drh_cod_usr_ing_mod', 'numerical', 'integerOnly'=>true),
			array('drh_tipo_historial, drh_codigo_ejecutivo, drh_nombre_cliente, drh_estado_revision_ruta, drh_estado_revision_sec', 'length', 'max'=>100),
			array('drh_nombre_ejecutivo', 'length', 'max'=>200),
			array('drh_codigo_cliente, drh_ruta_usada, drh_ruta_cliente', 'length', 'max'=>50),
			array('drh_metros', 'length', 'max'=>10),
			array('drh_validacion', 'length', 'max'=>500),
			array('drh_latitud_cliente, drh_longitud_cliente, drh_latitud_visita, drh_longitud_visita, drh_distancia_cli_eje, drh_distancia_cli_anterior', 'length', 'max'=>20),
			array('drh_fecha_revision, drh_fecha_ruta, drh_inicio_visita, drh_fin_visita, drh_tiempo_gestion, drh_tiempo_traslado, drh_fch_ingreso, drh_fch_modifica', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('drh_id, pg_id, drh_semana, drh_tipo_historial, drh_fecha_revision, drh_fecha_ruta, drh_codigo_ejecutivo, drh_nombre_ejecutivo, drh_codigo_cliente, drh_nombre_cliente, drh_ruta_usada, drh_secuencia_visita, drh_ruta_cliente, drh_secuencia_ruta, drh_estado_revision_ruta, drh_estado_revision_sec, drh_cantidad_chips_venta, drh_metros, drh_precision_usada, drh_validacion, drh_latitud_cliente, drh_longitud_cliente, drh_latitud_visita, drh_longitud_visita, drh_inicio_visita, drh_fin_visita, drh_tiempo_gestion, drh_tiempo_traslado, drh_distancia_cli_eje, drh_distancia_cli_anterior, drh_fch_ingreso, drh_fch_modifica, drh_cod_usr_ing_mod', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'pg' => array(self::BELONGS_TO, 'TbPeriodoGestion', 'pg_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'drh_id' => 'Drh',
			'pg_id' => 'Pg',
			'drh_semana' => 'Drh Semana',
			'drh_tipo_historial' => 'Drh Tipo Historial',
			'drh_fecha_revision' => 'Drh Fecha Revision',
			'drh_fecha_ruta' => 'Drh Fecha Ruta',
			'drh_codigo_ejecutivo' => 'Drh Codigo Ejecutivo',
			'drh_nombre_ejecutivo' => 'Drh Nombre Ejecutivo',
			'drh_codigo_cliente' => 'Drh Codigo Cliente',
			'drh_nombre_cliente' => 'Drh Nombre Cliente',
			'drh_ruta_usada' => 'Drh Ruta Usada',
			'drh_secuencia_visita' => 'Drh Secuencia Visita',
			'drh_ruta_cliente' => 'Drh Ruta Cliente',
			'drh_secuencia_ruta' => 'Drh Secuencia Ruta',
			'drh_estado_revision_ruta' => 'Drh Estado Revision Ruta',
			'drh_estado_revision_sec' => 'Drh Estado Revision Sec',
			'drh_cantidad_chips_venta' => 'Drh Cantidad Chips Venta',
			'drh_metros' => 'Drh Metros',
			'drh_precision_usada' => 'Drh Precision Usada',
			'drh_validacion' => 'Drh Validacion',
			'drh_latitud_cliente' => 'Drh Latitud Cliente',
			'drh_longitud_cliente' => 'Drh Longitud Cliente',
			'drh_latitud_visita' => 'Drh Latitud Visita',
			'drh_longitud_visita' => 'Drh Longitud Visita',
			'drh_inicio_visita' => 'Drh Inicio Visita',
			'drh_fin_visita' => 'Drh Fin Visita',
			'drh_tiempo_gestion' => 'Drh Tiempo Gestion',
			'drh_tiempo_traslado' => 'Drh Tiempo Traslado',
			'drh_distancia_cli_eje' => 'Drh Distancia Cli Eje',
			'drh_distancia_cli_anterior' => 'Drh Distancia Cli Anterior',
			'drh_fch_ingreso' => 'Drh Fch Ingreso',
			'drh_fch_modifica' => 'Drh Fch Modifica',
			'drh_cod_usr_ing_mod' => 'Drh Cod Usr Ing Mod',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 *
	 * Typical usecase:
	 * - Initialize the model fields with values from filter form.
	 * - Execute this method to get CActiveDataProvider instance which will filter
	 * models according to data in model fields.
	 * - Pass data provider to CGridView, CListView or any similar widget.
	 *
	 * @return CActiveDataProvider the data provider that can return the models
	 * based on the search/filter conditions.
	 */
	public function search()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('drh_id',$this->drh_id);
		$criteria->compare('pg_id',$this->pg_id);
		$criteria->compare('drh_semana',$this->drh_semana);
		$criteria->compare('drh_tipo_historial',$this->drh_tipo_historial,true);
		$criteria->compare('drh_fecha_revision',$this->drh_fecha_revision,true);
		$criteria->compare('drh_fecha_ruta',$this->drh_fecha_ruta,true);
		$criteria->compare('drh_codigo_ejecutivo',$this->drh_codigo_ejecutivo,true);
		$criteria->compare('drh_nombre_ejecutivo',$this->drh_nombre_ejecutivo,true);
		$criteria->compare('drh_codigo_cliente',$this->drh_codigo_cliente,true);
		$criteria->compare('drh_nombre_cliente',$this->drh_nombre_cliente,true);
		$criteria->compare('drh_ruta_usada',$this->drh_ruta_usada,true);
		$criteria->compare('drh_secuencia_visita',$this->drh_secuencia_visita);
		$criteria->compare('drh_ruta_cliente',$this->drh_ruta_cliente,true);
		$criteria->compare('drh_secuencia_ruta',$this->drh_secuencia_ruta);
		$criteria->compare('drh_estado_revision_ruta',$this->drh_estado_revision_ruta,true);
		$criteria->compare('drh_estado_revision_sec',$this->drh_estado_revision_sec,true);
		$criteria->compare('drh_cantidad_chips_venta',$this->drh_cantidad_chips_venta);
		$criteria->compare('drh_metros',$this->drh_metros,true);
		$criteria->compare('drh_precision_usada',$this->drh_precision_usada);
		$criteria->compare('drh_validacion',$this->drh_validacion,true);
		$criteria->compare('drh_latitud_cliente',$this->drh_latitud_cliente,true);
		$criteria->compare('drh_longitud_cliente',$this->drh_longitud_cliente,true);
		$criteria->compare('drh_latitud_visita',$this->drh_latitud_visita,true);
		$criteria->compare('drh_longitud_visita',$this->drh_longitud_visita,true);
		$criteria->compare('drh_inicio_visita',$this->drh_inicio_visita,true);
		$criteria->compare('drh_fin_visita',$this->drh_fin_visita,true);
		$criteria->compare('drh_tiempo_gestion',$this->drh_tiempo_gestion,true);
		$criteria->compare('drh_tiempo_traslado',$this->drh_tiempo_traslado,true);
		$criteria->compare('drh_distancia_cli_eje',$this->drh_distancia_cli_eje,true);
		$criteria->compare('drh_distancia_cli_anterior',$this->drh_distancia_cli_anterior,true);
		$criteria->compare('drh_fch_ingreso',$this->drh_fch_ingreso,true);
		$criteria->compare('drh_fch_modifica',$this->drh_fch_modifica,true);
		$criteria->compare('drh_cod_usr_ing_mod',$this->drh_cod_usr_ing_mod);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return DetalleRevisionHistorialModel the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
