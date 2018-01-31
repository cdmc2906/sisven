<?php

/**
 * This is the model class for table "tb_pregunta".
 *
 * The followings are the available columns in table 'tb_pregunta':
 * @property integer $preg_id
 * @property integer $tpreg_id
 * @property string $preg_codigo
 * @property string $preg_descripcion
 * @property integer $preg_estado
 * @property string $preg_ingreso
 * @property string $preg_modifica
 *
 * The followings are the available model relations:
 * @property TbOpcionPregunta[] $tbOpcionPreguntas
 * @property TbTipoPregunta $tpreg
 * @property TbPreguntaEncuesta[] $tbPreguntaEncuestas
 */
class PreguntaModel extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'tb_pregunta';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('tpreg_id, preg_estado', 'numerical', 'integerOnly'=>true),
			array('preg_codigo', 'length', 'max'=>10),
			array('preg_descripcion', 'length', 'max'=>25),
			array('preg_ingreso, preg_modifica', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('preg_id, tpreg_id, preg_codigo, preg_descripcion, preg_estado, preg_ingreso, preg_modifica', 'safe', 'on'=>'search'),
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
			'tbOpcionPreguntas' => array(self::HAS_MANY, 'TbOpcionPregunta', 'preg_id'),
			'tpreg' => array(self::BELONGS_TO, 'TbTipoPregunta', 'tpreg_id'),
			'tbPreguntaEncuestas' => array(self::HAS_MANY, 'TbPreguntaEncuesta', 'preg_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'preg_id' => 'Preg',
			'tpreg_id' => 'Tpreg',
			'preg_codigo' => 'Preg Codigo',
			'preg_descripcion' => 'Preg Descripcion',
			'preg_estado' => 'Preg Estado',
			'preg_ingreso' => 'Preg Ingreso',
			'preg_modifica' => 'Preg Modifica',
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

		$criteria->compare('preg_id',$this->preg_id);
		$criteria->compare('tpreg_id',$this->tpreg_id);
		$criteria->compare('preg_codigo',$this->preg_codigo,true);
		$criteria->compare('preg_descripcion',$this->preg_descripcion,true);
		$criteria->compare('preg_estado',$this->preg_estado);
		$criteria->compare('preg_ingreso',$this->preg_ingreso,true);
		$criteria->compare('preg_modifica',$this->preg_modifica,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return PreguntaModel the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
