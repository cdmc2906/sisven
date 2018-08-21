<?php

/**
 * This is the model class for table "tb_ejecutivo".
 *
 * The followings are the available columns in table 'tb_ejecutivo':
 * @property integer $e_cod
 * @property string $e_nombre
 * @property string $e_usr_mobilvendor
 * @property string $e_iniciales
 * @property integer $e_estado
 * @property string $e_tipo
 *
 * The followings are the available model relations:
 * @property TbEjecutivoRuta[] $tbEjecutivoRutas
 */
class EjecutivoModel extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'tb_ejecutivo';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('e_estado', 'numerical', 'integerOnly'=>true),
			array('e_nombre, e_tipo', 'length', 'max'=>50),
			array('e_usr_mobilvendor, e_iniciales', 'length', 'max'=>5),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('e_cod, e_nombre, e_usr_mobilvendor, e_iniciales, e_estado, e_tipo', 'safe', 'on'=>'search'),
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
			'tbEjecutivoRutas' => array(self::HAS_MANY, 'TbEjecutivoRuta', 'e_cod'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'e_cod' => 'E Cod',
			'e_nombre' => 'E Nombre',
			'e_usr_mobilvendor' => 'E Usr Mobilvendor',
			'e_iniciales' => 'E Iniciales',
			'e_estado' => 'E Estado',
			'e_tipo' => 'E Tipo',
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

		$criteria->compare('e_cod',$this->e_cod);
		$criteria->compare('e_nombre',$this->e_nombre,true);
		$criteria->compare('e_usr_mobilvendor',$this->e_usr_mobilvendor,true);
		$criteria->compare('e_iniciales',$this->e_iniciales,true);
		$criteria->compare('e_estado',$this->e_estado);
		$criteria->compare('e_tipo',$this->e_tipo,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return EjecutivoModel the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
