<?php

/**
 * This is the model class for table "tb_sucursal".
 *
 * The followings are the available columns in table 'tb_sucursal':
 * @property integer $ID_SUC
 * @property integer $ID_EST
 * @property string $NOMBRE_SUC
 * @property string $DIRECCION_SUC
 * @property string $TELEFONO_SUC
 * @property integer $ID_EMP
 *
 * The followings are the available model relations:
 * @property TbBodega[] $tbBodegas
 * @property TbEmpresa $iDEMP
 * @property TbEstado $iDEST
 */
class SucursalModel extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'tb_sucursal';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('ID_EST, ID_EMP', 'numerical', 'integerOnly'=>true),
			array('NOMBRE_SUC, TELEFONO_SUC', 'length', 'max'=>50),
			array('DIRECCION_SUC', 'length', 'max'=>250),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('ID_SUC, ID_EST, NOMBRE_SUC, DIRECCION_SUC, TELEFONO_SUC, ID_EMP', 'safe', 'on'=>'search'),
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
			'tbBodegas' => array(self::HAS_MANY, 'TbBodega', 'ID_SUC'),
			'iDEMP' => array(self::BELONGS_TO, 'TbEmpresa', 'ID_EMP'),
			'iDEST' => array(self::BELONGS_TO, 'TbEstado', 'ID_EST'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'ID_SUC' => 'Id Suc',
			'ID_EST' => 'Id Est',
			'NOMBRE_SUC' => 'Nombre Suc',
			'DIRECCION_SUC' => 'Direccion Suc',
			'TELEFONO_SUC' => 'Telefono Suc',
			'ID_EMP' => 'Id Emp',
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

		$criteria->compare('ID_SUC',$this->ID_SUC);
		$criteria->compare('ID_EST',$this->ID_EST);
		$criteria->compare('NOMBRE_SUC',$this->NOMBRE_SUC,true);
		$criteria->compare('DIRECCION_SUC',$this->DIRECCION_SUC,true);
		$criteria->compare('TELEFONO_SUC',$this->TELEFONO_SUC,true);
		$criteria->compare('ID_EMP',$this->ID_EMP);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return SucursalModel the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
