<?php

/**
 * This is the model class for table "tb_resultado_valida_chip".
 *
 * The followings are the available columns in table 'tb_resultado_valida_chip':
 * @property integer $rvc_id
 * @property string $rvc_dato_chip
 * @property string $rvc_tipo_validacion
 * @property string $rvc_subtipo_validacion
 * @property string $rvc_resultado_validacion
 * @property string $rvc_ejecutivo
 * @property string $rvc_solicitud_fecha
 * @property string $rvc_solicitud_ip
 * @property string $rvc_solicitud_dispositivo
 * @property string $rvc_solicitud_navegador
 * @property integer $rvc_estado_validacion
 */
class ResultadoValidaChipModel extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'tb_resultado_valida_chip';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('rvc_estado_validacion', 'numerical', 'integerOnly'=>true),
			array('rvc_dato_chip, rvc_tipo_validacion, rvc_subtipo_validacion, rvc_resultado_validacion, rvc_ejecutivo', 'length', 'max'=>20),
			array('rvc_solicitud_ip', 'length', 'max'=>50),
			array('rvc_solicitud_dispositivo, rvc_solicitud_navegador', 'length', 'max'=>250),
			array('rvc_solicitud_fecha', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('rvc_id, rvc_dato_chip, rvc_tipo_validacion, rvc_subtipo_validacion, rvc_resultado_validacion, rvc_ejecutivo, rvc_solicitud_fecha, rvc_solicitud_ip, rvc_solicitud_dispositivo, rvc_solicitud_navegador, rvc_estado_validacion', 'safe', 'on'=>'search'),
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
			'rvc_id' => 'Rvc',
			'rvc_dato_chip' => 'Rvc Dato Chip',
			'rvc_tipo_validacion' => 'Rvc Tipo Validacion',
			'rvc_subtipo_validacion' => 'Rvc Subtipo Validacion',
			'rvc_resultado_validacion' => 'Rvc Resultado Validacion',
			'rvc_ejecutivo' => 'Rvc Ejecutivo',
			'rvc_solicitud_fecha' => 'Rvc Solicitud Fecha',
			'rvc_solicitud_ip' => 'Rvc Solicitud Ip',
			'rvc_solicitud_dispositivo' => 'Rvc Solicitud Dispositivo',
			'rvc_solicitud_navegador' => 'Rvc Solicitud Navegador',
			'rvc_estado_validacion' => 'Rvc Estado Validacion',
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

		$criteria->compare('rvc_id',$this->rvc_id);
		$criteria->compare('rvc_dato_chip',$this->rvc_dato_chip,true);
		$criteria->compare('rvc_tipo_validacion',$this->rvc_tipo_validacion,true);
		$criteria->compare('rvc_subtipo_validacion',$this->rvc_subtipo_validacion,true);
		$criteria->compare('rvc_resultado_validacion',$this->rvc_resultado_validacion,true);
		$criteria->compare('rvc_ejecutivo',$this->rvc_ejecutivo,true);
		$criteria->compare('rvc_solicitud_fecha',$this->rvc_solicitud_fecha,true);
		$criteria->compare('rvc_solicitud_ip',$this->rvc_solicitud_ip,true);
		$criteria->compare('rvc_solicitud_dispositivo',$this->rvc_solicitud_dispositivo,true);
		$criteria->compare('rvc_solicitud_navegador',$this->rvc_solicitud_navegador,true);
		$criteria->compare('rvc_estado_validacion',$this->rvc_estado_validacion);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return ResultadoValidaChipModel the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
