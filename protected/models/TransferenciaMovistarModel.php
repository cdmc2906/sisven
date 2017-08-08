<?php

/**
 * This is the model class for table "tb_transferencia_movistar".
 *
 * The followings are the available columns in table 'tb_transferencia_movistar':
 * @property integer $tm_codigo
 * @property string $tm_fecha
 * @property string $tm_codigotransferencia
 * @property string $tm_iddistribuidor
 * @property string $tm_nombredistribuidor
 * @property string $tm_codigoscl
 * @property string $tm_inventarioanteriorfuente
 * @property string $tm_inventarioactualfuente
 * @property string $tm_tiposim
 * @property string $tm_icc
 * @property string $tm_min
 * @property string $tm_estado
 * @property string $tm_iddestino
 * @property string $tm_nombredestino
 * @property string $tm_inventarioanteriordestino
 * @property string $tm_inventarioactualdestino
 * @property string $tm_canal
 * @property string $tm_numero_lote
 * @property string $tm_zona
 * @property string $tm_fecha_ingreso
 * @property string $tm_fecha_modifica
 * @property integer $tm_usuario_ingresa_modifica
 */
class TransferenciaMovistarModel extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'tb_transferencia_movistar';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('tm_usuario_ingresa_modifica', 'numerical', 'integerOnly'=>true),
			array('tm_codigotransferencia, tm_iddistribuidor, tm_nombredistribuidor, tm_codigoscl, tm_inventarioanteriorfuente, tm_inventarioactualfuente, tm_tiposim, tm_icc, tm_min, tm_estado, tm_iddestino, tm_nombredestino, tm_inventarioanteriordestino, tm_inventarioactualdestino, tm_canal, tm_numero_lote, tm_zona', 'length', 'max'=>500),
			array('tm_fecha, tm_fecha_ingreso, tm_fecha_modifica', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('tm_codigo, tm_fecha, tm_codigotransferencia, tm_iddistribuidor, tm_nombredistribuidor, tm_codigoscl, tm_inventarioanteriorfuente, tm_inventarioactualfuente, tm_tiposim, tm_icc, tm_min, tm_estado, tm_iddestino, tm_nombredestino, tm_inventarioanteriordestino, tm_inventarioactualdestino, tm_canal, tm_numero_lote, tm_zona, tm_fecha_ingreso, tm_fecha_modifica, tm_usuario_ingresa_modifica', 'safe', 'on'=>'search'),
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
			'tm_codigo' => 'Tm Codigo',
			'tm_fecha' => 'Tm Fecha',
			'tm_codigotransferencia' => 'Tm Codigotransferencia',
			'tm_iddistribuidor' => 'Tm Iddistribuidor',
			'tm_nombredistribuidor' => 'Tm Nombredistribuidor',
			'tm_codigoscl' => 'Tm Codigoscl',
			'tm_inventarioanteriorfuente' => 'Tm Inventarioanteriorfuente',
			'tm_inventarioactualfuente' => 'Tm Inventarioactualfuente',
			'tm_tiposim' => 'Tm Tiposim',
			'tm_icc' => 'Tm Icc',
			'tm_min' => 'Tm Min',
			'tm_estado' => 'Tm Estado',
			'tm_iddestino' => 'Tm Iddestino',
			'tm_nombredestino' => 'Tm Nombredestino',
			'tm_inventarioanteriordestino' => 'Tm Inventarioanteriordestino',
			'tm_inventarioactualdestino' => 'Tm Inventarioactualdestino',
			'tm_canal' => 'Tm Canal',
			'tm_numero_lote' => 'Tm Numero Lote',
			'tm_zona' => 'Tm Zona',
			'tm_fecha_ingreso' => 'Tm Fecha Ingreso',
			'tm_fecha_modifica' => 'Tm Fecha Modifica',
			'tm_usuario_ingresa_modifica' => 'Tm Usuario Ingresa Modifica',
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

		$criteria->compare('tm_codigo',$this->tm_codigo);
		$criteria->compare('tm_fecha',$this->tm_fecha,true);
		$criteria->compare('tm_codigotransferencia',$this->tm_codigotransferencia,true);
		$criteria->compare('tm_iddistribuidor',$this->tm_iddistribuidor,true);
		$criteria->compare('tm_nombredistribuidor',$this->tm_nombredistribuidor,true);
		$criteria->compare('tm_codigoscl',$this->tm_codigoscl,true);
		$criteria->compare('tm_inventarioanteriorfuente',$this->tm_inventarioanteriorfuente,true);
		$criteria->compare('tm_inventarioactualfuente',$this->tm_inventarioactualfuente,true);
		$criteria->compare('tm_tiposim',$this->tm_tiposim,true);
		$criteria->compare('tm_icc',$this->tm_icc,true);
		$criteria->compare('tm_min',$this->tm_min,true);
		$criteria->compare('tm_estado',$this->tm_estado,true);
		$criteria->compare('tm_iddestino',$this->tm_iddestino,true);
		$criteria->compare('tm_nombredestino',$this->tm_nombredestino,true);
		$criteria->compare('tm_inventarioanteriordestino',$this->tm_inventarioanteriordestino,true);
		$criteria->compare('tm_inventarioactualdestino',$this->tm_inventarioactualdestino,true);
		$criteria->compare('tm_canal',$this->tm_canal,true);
		$criteria->compare('tm_numero_lote',$this->tm_numero_lote,true);
		$criteria->compare('tm_zona',$this->tm_zona,true);
		$criteria->compare('tm_fecha_ingreso',$this->tm_fecha_ingreso,true);
		$criteria->compare('tm_fecha_modifica',$this->tm_fecha_modifica,true);
		$criteria->compare('tm_usuario_ingresa_modifica',$this->tm_usuario_ingresa_modifica);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return TransferenciaMovistarModel the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
