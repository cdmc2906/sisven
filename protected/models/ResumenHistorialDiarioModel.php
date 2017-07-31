<?php

/**
 * This is the model class for table "tb_resumen_historial_diario".
 *
 * The followings are the available columns in table 'tb_resumen_historial_diario':
 * @property integer $rhd_codigo
 * @property string $rhd_cod_ejecutivo
 * @property string $rhd_fecha_historial
 * @property string $rhd_parametro
 * @property string $rhd_valor
 * @property string $rhd_fecha_ingreso
 * @property string $rhd_fecha_modificacion
 * @property integer $rhd_usuario_ingresa_modifica
 * @property string $rhd_observacion_supervisor
 * @property integer $rhd_usuario_supervisor
 * @property string $rhd_fecha_modifica_observacion
 * @property integer $rhd_semana
 * @property string $rhd_fecha_ingreso_observacion
 */
class ResumenHistorialDiarioModel extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'tb_resumen_historial_diario';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('rhd_usuario_ingresa_modifica, rhd_usuario_supervisor, rhd_semana', 'numerical', 'integerOnly'=>true),
			array('rhd_cod_ejecutivo', 'length', 'max'=>20),
			array('rhd_parametro', 'length', 'max'=>50),
			array('rhd_valor', 'length', 'max'=>6),
			array('rhd_observacion_supervisor', 'length', 'max'=>250),
			array('rhd_fecha_historial, rhd_fecha_ingreso, rhd_fecha_modificacion, rhd_fecha_modifica_observacion, rhd_fecha_ingreso_observacion', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('rhd_codigo, rhd_cod_ejecutivo, rhd_fecha_historial, rhd_parametro, rhd_valor, rhd_fecha_ingreso, rhd_fecha_modificacion, rhd_usuario_ingresa_modifica, rhd_observacion_supervisor, rhd_usuario_supervisor, rhd_fecha_modifica_observacion, rhd_semana, rhd_fecha_ingreso_observacion', 'safe', 'on'=>'search'),
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
			'rhd_codigo' => 'Rhd Codigo',
			'rhd_cod_ejecutivo' => 'Rhd Cod Ejecutivo',
			'rhd_fecha_historial' => 'Rhd Fecha Historial',
			'rhd_parametro' => 'Rhd Parametro',
			'rhd_valor' => 'Rhd Valor',
			'rhd_fecha_ingreso' => 'Rhd Fecha Ingreso',
			'rhd_fecha_modificacion' => 'Rhd Fecha Modificacion',
			'rhd_usuario_ingresa_modifica' => 'Rhd Usuario Ingresa Modifica',
			'rhd_observacion_supervisor' => 'Rhd Observacion Supervisor',
			'rhd_usuario_supervisor' => 'Rhd Usuario Supervisor',
			'rhd_fecha_modifica_observacion' => 'Rhd Fecha Modifica Observacion',
			'rhd_semana' => 'Rhd Semana',
			'rhd_fecha_ingreso_observacion' => 'Rhd Fecha Ingreso Observacion',
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

		$criteria->compare('rhd_codigo',$this->rhd_codigo);
		$criteria->compare('rhd_cod_ejecutivo',$this->rhd_cod_ejecutivo,true);
		$criteria->compare('rhd_fecha_historial',$this->rhd_fecha_historial,true);
		$criteria->compare('rhd_parametro',$this->rhd_parametro,true);
		$criteria->compare('rhd_valor',$this->rhd_valor,true);
		$criteria->compare('rhd_fecha_ingreso',$this->rhd_fecha_ingreso,true);
		$criteria->compare('rhd_fecha_modificacion',$this->rhd_fecha_modificacion,true);
		$criteria->compare('rhd_usuario_ingresa_modifica',$this->rhd_usuario_ingresa_modifica);
		$criteria->compare('rhd_observacion_supervisor',$this->rhd_observacion_supervisor,true);
		$criteria->compare('rhd_usuario_supervisor',$this->rhd_usuario_supervisor);
		$criteria->compare('rhd_fecha_modifica_observacion',$this->rhd_fecha_modifica_observacion,true);
		$criteria->compare('rhd_semana',$this->rhd_semana);
		$criteria->compare('rhd_fecha_ingreso_observacion',$this->rhd_fecha_ingreso_observacion,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return ResumenHistorialDiarioModel the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
