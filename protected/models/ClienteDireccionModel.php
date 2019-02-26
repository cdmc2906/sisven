<?php

/**
 * This is the model class for table "tb_cliente_direccion".
 *
 * The followings are the available columns in table 'tb_cliente_direccion':
 * @property integer $dcli_id
 * @property string $dcli_codigo
 * @property string $dcli_cliente
 * @property string $dcli_cliente_nombre
 * @property string $dcli_cliente_identificacion
 * @property string $dcli_cliente_comentario
 * @property string $dcli_oficina
 * @property string $dcli_oficina_nombre
 * @property string $dcli_codigo_de_barras
 * @property string $dcli_descripcion
 * @property string $dcli_contacto
 * @property string $dcli_geo_area
 * @property string $dcli_geo_area_nombre
 * @property string $dcli_geo_area_codigo_recorrido
 * @property string $dcli_geo_area_descripcion_recorrido
 * @property string $dcli_provincia
 * @property string $dcli_canton
 * @property string $dcli_parroquia
 * @property string $dcli_calle_principal
 * @property string $dcli_nomenclatura
 * @property string $dcli_calle_secundaria
 * @property string $dcli_referencia
 * @property string $dcli_codigo_postal
 * @property string $dcli_telefono
 * @property string $dcli_fax
 * @property string $dcli_email
 * @property string $dcli_latitud
 * @property string $dcli_longitud
 * @property string $dcli_ultima_visita
 * @property string $dcli_estado_de_localizacion
 * @property string $dcli_fecha_ingreso
 * @property integer $dcli_usr_ingresa
 * @property string $dcli_fecha_modifica
 * @property integer $dcli_usr_modifica
 */
class ClienteDireccionModel extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'tb_cliente_direccion';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('dcli_usr_ingresa, dcli_usr_modifica', 'numerical', 'integerOnly'=>true),
			array('dcli_codigo', 'length', 'max'=>50),
			array('dcli_cliente, dcli_cliente_nombre, dcli_cliente_identificacion, dcli_cliente_comentario, dcli_oficina, dcli_oficina_nombre, dcli_codigo_de_barras, dcli_descripcion, dcli_contacto, dcli_codigo_postal, dcli_telefono, dcli_fax, dcli_email, dcli_latitud, dcli_longitud, dcli_estado_de_localizacion', 'length', 'max'=>250),
			array('dcli_geo_area, dcli_geo_area_nombre, dcli_geo_area_codigo_recorrido, dcli_geo_area_descripcion_recorrido, dcli_calle_principal, dcli_nomenclatura, dcli_calle_secundaria, dcli_referencia', 'length', 'max'=>500),
			array('dcli_provincia, dcli_canton, dcli_parroquia', 'length', 'max'=>100),
			array('dcli_ultima_visita, dcli_fecha_ingreso, dcli_fecha_modifica', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('dcli_id, dcli_codigo, dcli_cliente, dcli_cliente_nombre, dcli_cliente_identificacion, dcli_cliente_comentario, dcli_oficina, dcli_oficina_nombre, dcli_codigo_de_barras, dcli_descripcion, dcli_contacto, dcli_geo_area, dcli_geo_area_nombre, dcli_geo_area_codigo_recorrido, dcli_geo_area_descripcion_recorrido, dcli_provincia, dcli_canton, dcli_parroquia, dcli_calle_principal, dcli_nomenclatura, dcli_calle_secundaria, dcli_referencia, dcli_codigo_postal, dcli_telefono, dcli_fax, dcli_email, dcli_latitud, dcli_longitud, dcli_ultima_visita, dcli_estado_de_localizacion, dcli_fecha_ingreso, dcli_usr_ingresa, dcli_fecha_modifica, dcli_usr_modifica', 'safe', 'on'=>'search'),
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
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'dcli_id' => 'Dcli',
			'dcli_codigo' => 'Dcli Codigo',
			'dcli_cliente' => 'Dcli Cliente',
			'dcli_cliente_nombre' => 'Dcli Cliente Nombre',
			'dcli_cliente_identificacion' => 'Dcli Cliente Identificacion',
			'dcli_cliente_comentario' => 'Dcli Cliente Comentario',
			'dcli_oficina' => 'Dcli Oficina',
			'dcli_oficina_nombre' => 'Dcli Oficina Nombre',
			'dcli_codigo_de_barras' => 'Dcli Codigo De Barras',
			'dcli_descripcion' => 'Dcli Descripcion',
			'dcli_contacto' => 'Dcli Contacto',
			'dcli_geo_area' => 'Dcli Geo Area',
			'dcli_geo_area_nombre' => 'Dcli Geo Area Nombre',
			'dcli_geo_area_codigo_recorrido' => 'Dcli Geo Area Codigo Recorrido',
			'dcli_geo_area_descripcion_recorrido' => 'Dcli Geo Area Descripcion Recorrido',
			'dcli_provincia' => 'Dcli Provincia',
			'dcli_canton' => 'Dcli Canton',
			'dcli_parroquia' => 'Dcli Parroquia',
			'dcli_calle_principal' => 'Dcli Calle Principal',
			'dcli_nomenclatura' => 'Dcli Nomenclatura',
			'dcli_calle_secundaria' => 'Dcli Calle Secundaria',
			'dcli_referencia' => 'Dcli Referencia',
			'dcli_codigo_postal' => 'Dcli Codigo Postal',
			'dcli_telefono' => 'Dcli Telefono',
			'dcli_fax' => 'Dcli Fax',
			'dcli_email' => 'Dcli Email',
			'dcli_latitud' => 'Dcli Latitud',
			'dcli_longitud' => 'Dcli Longitud',
			'dcli_ultima_visita' => 'Dcli Ultima Visita',
			'dcli_estado_de_localizacion' => 'Dcli Estado De Localizacion',
			'dcli_fecha_ingreso' => 'Dcli Fecha Ingreso',
			'dcli_usr_ingresa' => 'Dcli Usr Ingresa',
			'dcli_fecha_modifica' => 'Dcli Fecha Modifica',
			'dcli_usr_modifica' => 'Dcli Usr Modifica',
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

		$criteria->compare('dcli_id',$this->dcli_id);
		$criteria->compare('dcli_codigo',$this->dcli_codigo,true);
		$criteria->compare('dcli_cliente',$this->dcli_cliente,true);
		$criteria->compare('dcli_cliente_nombre',$this->dcli_cliente_nombre,true);
		$criteria->compare('dcli_cliente_identificacion',$this->dcli_cliente_identificacion,true);
		$criteria->compare('dcli_cliente_comentario',$this->dcli_cliente_comentario,true);
		$criteria->compare('dcli_oficina',$this->dcli_oficina,true);
		$criteria->compare('dcli_oficina_nombre',$this->dcli_oficina_nombre,true);
		$criteria->compare('dcli_codigo_de_barras',$this->dcli_codigo_de_barras,true);
		$criteria->compare('dcli_descripcion',$this->dcli_descripcion,true);
		$criteria->compare('dcli_contacto',$this->dcli_contacto,true);
		$criteria->compare('dcli_geo_area',$this->dcli_geo_area,true);
		$criteria->compare('dcli_geo_area_nombre',$this->dcli_geo_area_nombre,true);
		$criteria->compare('dcli_geo_area_codigo_recorrido',$this->dcli_geo_area_codigo_recorrido,true);
		$criteria->compare('dcli_geo_area_descripcion_recorrido',$this->dcli_geo_area_descripcion_recorrido,true);
		$criteria->compare('dcli_provincia',$this->dcli_provincia,true);
		$criteria->compare('dcli_canton',$this->dcli_canton,true);
		$criteria->compare('dcli_parroquia',$this->dcli_parroquia,true);
		$criteria->compare('dcli_calle_principal',$this->dcli_calle_principal,true);
		$criteria->compare('dcli_nomenclatura',$this->dcli_nomenclatura,true);
		$criteria->compare('dcli_calle_secundaria',$this->dcli_calle_secundaria,true);
		$criteria->compare('dcli_referencia',$this->dcli_referencia,true);
		$criteria->compare('dcli_codigo_postal',$this->dcli_codigo_postal,true);
		$criteria->compare('dcli_telefono',$this->dcli_telefono,true);
		$criteria->compare('dcli_fax',$this->dcli_fax,true);
		$criteria->compare('dcli_email',$this->dcli_email,true);
		$criteria->compare('dcli_latitud',$this->dcli_latitud,true);
		$criteria->compare('dcli_longitud',$this->dcli_longitud,true);
		$criteria->compare('dcli_ultima_visita',$this->dcli_ultima_visita,true);
		$criteria->compare('dcli_estado_de_localizacion',$this->dcli_estado_de_localizacion,true);
		$criteria->compare('dcli_fecha_ingreso',$this->dcli_fecha_ingreso,true);
		$criteria->compare('dcli_usr_ingresa',$this->dcli_usr_ingresa);
		$criteria->compare('dcli_fecha_modifica',$this->dcli_fecha_modifica,true);
		$criteria->compare('dcli_usr_modifica',$this->dcli_usr_modifica);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return ClienteDireccionModel the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
