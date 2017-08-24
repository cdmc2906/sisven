<?php

/**
 * This is the model class for table "tb_comentario_supervision".
 *
 * The followings are the available columns in table 'tb_comentario_supervision':
 * @property integer $cs_id
 * @property string $cs_fecha_historial_supervisado
 * @property string $cs_ejecutivo_supervisado
 * @property string $cs_comentario
 * @property integer $cs_estado
 * @property string $cs_fecha_ingreso
 * @property string $cs_fecha_modificacion
 * @property integer $cs_usuario_ingresa_modifica
 */
class ComentarioSupervisionModel extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'tb_comentario_supervision';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('cs_estado, cs_usuario_ingresa_modifica', 'numerical', 'integerOnly'=>true),
			array('cs_ejecutivo_supervisado', 'length', 'max'=>25),
			array('cs_comentario', 'length', 'max'=>500),
			array('cs_fecha_historial_supervisado, cs_fecha_ingreso, cs_fecha_modificacion', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('cs_id, cs_fecha_historial_supervisado, cs_ejecutivo_supervisado, cs_comentario, cs_estado, cs_fecha_ingreso, cs_fecha_modificacion, cs_usuario_ingresa_modifica', 'safe', 'on'=>'search'),
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
			'cs_id' => 'Codigo comentario',
			'cs_fecha_historial_supervisado' => 'Fecha Historial Supervisado',
			'cs_ejecutivo_supervisado' => 'Ejecutivo Supervisado',
			'cs_comentario' => 'Comentario',
			'cs_estado' => 'Cs Estado',
			'cs_fecha_ingreso' => 'Fecha Ingreso',
			'cs_fecha_modificacion' => 'Fecha Modificacion',
			'cs_usuario_ingresa_modifica' => 'Realizado por',
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

		$criteria->compare('cs_id',$this->cs_id);
		$criteria->compare('cs_fecha_historial_supervisado',$this->cs_fecha_historial_supervisado,true);
		$criteria->compare('cs_ejecutivo_supervisado',$this->cs_ejecutivo_supervisado,true);
		$criteria->compare('cs_comentario',$this->cs_comentario,true);
		$criteria->compare('cs_estado',$this->cs_estado);
		$criteria->compare('cs_fecha_ingreso',$this->cs_fecha_ingreso,true);
		$criteria->compare('cs_fecha_modificacion',$this->cs_fecha_modificacion,true);
		$criteria->compare('cs_usuario_ingresa_modifica',$this->cs_usuario_ingresa_modifica);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return ComentarioSupervisionModel the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
