<?php

/**
 * This is the model class for table "tb_tipo_producto".
 *
 * The followings are the available columns in table 'tb_tipo_producto':
 * @property integer $ID_TPRO
 * @property integer $ID_EST
 * @property string $TIPO_TPRO
 *
 * The followings are the available model relations:
 * @property TbProducto[] $tbProductos
 * @property TbEstado $iDEST
 */
class TipoProductoModel extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'tb_tipo_producto';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('ID_EST', 'numerical', 'integerOnly'=>true),
			array('TIPO_TPRO', 'length', 'max'=>50),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('ID_TPRO, ID_EST, TIPO_TPRO', 'safe', 'on'=>'search'),
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
			'tbProductos' => array(self::HAS_MANY, 'TbProducto', 'ID_TPRO'),
			'iDEST' => array(self::BELONGS_TO, 'TbEstado', 'ID_EST'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'ID_TPRO' => 'Id Tpro',
			'ID_EST' => 'Id Est',
			'TIPO_TPRO' => 'Tipo Tpro',
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

		$criteria->compare('ID_TPRO',$this->ID_TPRO);
		$criteria->compare('ID_EST',$this->ID_EST);
		$criteria->compare('TIPO_TPRO',$this->TIPO_TPRO,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return TipoProductoModel the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
