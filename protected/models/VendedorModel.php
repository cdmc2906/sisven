<?php

/**
 * This is the model class for table "tb_vendedor".
 *
 * The followings are the available columns in table 'tb_vendedor':
 * @property integer $ID_VEND
 * @property integer $ID_EST
 * @property string $NOMBRE_VEND
 * @property string $TELEFONO_VEND
 * @property string $CORREO_VEND
 * @property integer $ID_TVE
 *
 * The followings are the available model relations:
 * @property TbAsignacion[] $tbAsignacions
 * @property TbComision[] $tbComisions
 * @property TbTipoVendedor $iDTVE
 * @property TbEstado $iDEST
 * @property TbVenta[] $tbVentas
 */
class VendedorModel extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'tb_vendedor';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('ID_EST, ID_TVE', 'numerical', 'integerOnly'=>true),
			array('NOMBRE_VEND', 'length', 'max'=>250),
			array('TELEFONO_VEND', 'length', 'max'=>100),
			array('CORREO_VEND', 'length', 'max'=>50),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('ID_VEND, ID_EST, NOMBRE_VEND, TELEFONO_VEND, CORREO_VEND, ID_TVE', 'safe', 'on'=>'search'),
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
			'tbAsignacions' => array(self::HAS_MANY, 'TbAsignacion', 'ID_VEND'),
			'tbComisions' => array(self::HAS_MANY, 'TbComision', 'ID_VEND'),
			'iDTVE' => array(self::BELONGS_TO, 'TbTipoVendedor', 'ID_TVE'),
			'iDEST' => array(self::BELONGS_TO, 'TbEstado', 'ID_EST'),
			'tbVentas' => array(self::HAS_MANY, 'TbVenta', 'ID_VEND'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'ID_VEND' => 'Id Vend',
			'ID_EST' => 'Id Est',
			'NOMBRE_VEND' => 'Nombre Vend',
			'TELEFONO_VEND' => 'Telefono Vend',
			'CORREO_VEND' => 'Correo Vend',
			'ID_TVE' => 'Id Tve',
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

		$criteria->compare('ID_VEND',$this->ID_VEND);
		$criteria->compare('ID_EST',$this->ID_EST);
		$criteria->compare('NOMBRE_VEND',$this->NOMBRE_VEND,true);
		$criteria->compare('TELEFONO_VEND',$this->TELEFONO_VEND,true);
		$criteria->compare('CORREO_VEND',$this->CORREO_VEND,true);
		$criteria->compare('ID_TVE',$this->ID_TVE);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return VendedorModel the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
