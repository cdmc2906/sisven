<?php

/**
 * This is the model class for table "tb_resumen_historial_diario".
 *
 * The followings are the available columns in table 'tb_resumen_historial_diario':
 * @property integer $rhd_id
 * @property integer $pg_id
 * @property string $rhd_cod_ejecutivo
 * @property string $rhd_fecha_historial
 * @property string $rhd_parametro
 * @property string $rhd_valor
 * @property integer $rhd_semana
 * @property string $rhd_tipo
 * @property integer $rhd_estado
 * @property string $rhd_fecha_ingreso
 * @property string $rhd_fecha_modificacion
 * @property integer $rhd_usuario_ingresa_modifica
 *
 * The followings are the available model relations:
 * @property TbPeriodoGestion $pg
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
			array('pg_id, rhd_semana, rhd_estado, rhd_usuario_ingresa_modifica', 'numerical', 'integerOnly'=>true),
			array('rhd_cod_ejecutivo', 'length', 'max'=>20),
			array('rhd_parametro, rhd_tipo', 'length', 'max'=>50),
			array('rhd_valor', 'length', 'max'=>250),
			array('rhd_fecha_historial, rhd_fecha_ingreso, rhd_fecha_modificacion', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('rhd_id, pg_id, rhd_cod_ejecutivo, rhd_fecha_historial, rhd_parametro, rhd_valor, rhd_semana, rhd_tipo, rhd_estado, rhd_fecha_ingreso, rhd_fecha_modificacion, rhd_usuario_ingresa_modifica', 'safe', 'on'=>'search'),
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
			'rhd_id' => 'Rhd',
			'pg_id' => 'Pg',
			'rhd_cod_ejecutivo' => 'Rhd Cod Ejecutivo',
			'rhd_fecha_historial' => 'Rhd Fecha Historial',
			'rhd_parametro' => 'Rhd Parametro',
			'rhd_valor' => 'Rhd Valor',
			'rhd_semana' => 'Rhd Semana',
			'rhd_tipo' => 'Rhd Tipo',
			'rhd_estado' => 'Rhd Estado',
			'rhd_fecha_ingreso' => 'Rhd Fecha Ingreso',
			'rhd_fecha_modificacion' => 'Rhd Fecha Modificacion',
			'rhd_usuario_ingresa_modifica' => 'Rhd Usuario Ingresa Modifica',
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

		$criteria->compare('rhd_id',$this->rhd_id);
		$criteria->compare('pg_id',$this->pg_id);
		$criteria->compare('rhd_cod_ejecutivo',$this->rhd_cod_ejecutivo,true);
		$criteria->compare('rhd_fecha_historial',$this->rhd_fecha_historial,true);
		$criteria->compare('rhd_parametro',$this->rhd_parametro,true);
		$criteria->compare('rhd_valor',$this->rhd_valor,true);
		$criteria->compare('rhd_semana',$this->rhd_semana);
		$criteria->compare('rhd_tipo',$this->rhd_tipo,true);
		$criteria->compare('rhd_estado',$this->rhd_estado);
		$criteria->compare('rhd_fecha_ingreso',$this->rhd_fecha_ingreso,true);
		$criteria->compare('rhd_fecha_modificacion',$this->rhd_fecha_modificacion,true);
		$criteria->compare('rhd_usuario_ingresa_modifica',$this->rhd_usuario_ingresa_modifica);

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
