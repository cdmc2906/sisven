<?php

/**
 * This is the model class for table "tb_encuesta".
 *
 * The followings are the available columns in table 'tb_encuesta':
 * @property integer $enc_id
 * @property string $enc_codigo
 * @property string $enc_nombre
 *
 * The followings are the available model relations:
 * @property TbPreguntaEncuesta[] $tbPreguntaEncuestas
 */
class EncuestaModel extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'tb_encuesta';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('enc_codigo', 'length', 'max'=>10),
			array('enc_nombre', 'length', 'max'=>25),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('enc_id, enc_codigo, enc_nombre', 'safe', 'on'=>'search'),
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
			'tbPreguntaEncuestas' => array(self::HAS_MANY, 'TbPreguntaEncuesta', 'enc_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'enc_id' => 'Enc',
			'enc_codigo' => 'Enc Codigo',
			'enc_nombre' => 'Enc Nombre',
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

		$criteria->compare('enc_id',$this->enc_id);
		$criteria->compare('enc_codigo',$this->enc_codigo,true);
		$criteria->compare('enc_nombre',$this->enc_nombre,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return EncuestaModel the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
