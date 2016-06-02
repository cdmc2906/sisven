<?php

/**
 * This is the model class for table "tb_producto".
 *
 * The followings are the available columns in table 'tb_producto':
 * @property integer $ID_PRO
 * @property integer $ID_EST
 * @property integer $ID_COMP
 * @property integer $ID_TPRO
 * @property integer $ID_BODEGA
 * @property string $NOMBRE_PROD
 * @property string $MIN_PROD
 * @property string $ICC_PROD
 * @property string $IMEI_PROD
 * @property string $NUMSERIE_PROD
 * @property string $PRECIO_PROD
 * @property string $COSTO_PROD
 * @property string $PORCENTAJEDESCUENTO_PROD
 * @property string $PRECIO1_PROD
 * @property string $PRECIO2_PROD
 * @property string $PRECIO3_PROD
 * @property string $MIN_593_PROD
 *
 * The followings are the available model relations:
 * @property TbAsignacion[] $tbAsignacions
 * @property TbConsumo[] $tbConsumos
 * @property TbCompra $iDCOMP
 * @property TbBodega $iDBODEGA
 * @property TbEstado $iDEST
 * @property TbTipoProducto $iDTPRO
 * @property TbVenta[] $tbVentas
 */
class ProductoModel extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'tb_producto';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('ID_EST, ID_COMP, ID_TPRO, ID_BODEGA', 'numerical', 'integerOnly'=>true),
			array('NOMBRE_PROD, MIN_PROD, ICC_PROD, IMEI_PROD, NUMSERIE_PROD, MIN_593_PROD', 'length', 'max'=>1024),
			array('PRECIO_PROD, COSTO_PROD, PORCENTAJEDESCUENTO_PROD, PRECIO1_PROD, PRECIO2_PROD, PRECIO3_PROD', 'length', 'max'=>24),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('ID_PRO, ID_EST, ID_COMP, ID_TPRO, ID_BODEGA, NOMBRE_PROD, MIN_PROD, ICC_PROD, IMEI_PROD, NUMSERIE_PROD, PRECIO_PROD, COSTO_PROD, PORCENTAJEDESCUENTO_PROD, PRECIO1_PROD, PRECIO2_PROD, PRECIO3_PROD, MIN_593_PROD', 'safe', 'on'=>'search'),
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
			'tbAsignacions' => array(self::HAS_MANY, 'TbAsignacion', 'ID_PRO'),
			'tbConsumos' => array(self::HAS_MANY, 'TbConsumo', 'ID_PRO'),
			'iDCOMP' => array(self::BELONGS_TO, 'TbCompra', 'ID_COMP'),
			'iDBODEGA' => array(self::BELONGS_TO, 'TbBodega', 'ID_BODEGA'),
			'iDEST' => array(self::BELONGS_TO, 'TbEstado', 'ID_EST'),
			'iDTPRO' => array(self::BELONGS_TO, 'TbTipoProducto', 'ID_TPRO'),
			'tbVentas' => array(self::HAS_MANY, 'TbVenta', 'ID_PRO'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'ID_PRO' => 'Id Pro',
			'ID_EST' => 'Id Est',
			'ID_COMP' => 'Id Comp',
			'ID_TPRO' => 'Id Tpro',
			'ID_BODEGA' => 'Id Bodega',
			'NOMBRE_PROD' => 'Nombre Prod',
			'MIN_PROD' => 'Min Prod',
			'ICC_PROD' => 'Icc Prod',
			'IMEI_PROD' => 'Imei Prod',
			'NUMSERIE_PROD' => 'Numserie Prod',
			'PRECIO_PROD' => 'Precio Prod',
			'COSTO_PROD' => 'Costo Prod',
			'PORCENTAJEDESCUENTO_PROD' => 'Porcentajedescuento Prod',
			'PRECIO1_PROD' => 'Precio1 Prod',
			'PRECIO2_PROD' => 'Precio2 Prod',
			'PRECIO3_PROD' => 'Precio3 Prod',
			'MIN_593_PROD' => 'Min 593 Prod',
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

		$criteria->compare('ID_PRO',$this->ID_PRO);
		$criteria->compare('ID_EST',$this->ID_EST);
		$criteria->compare('ID_COMP',$this->ID_COMP);
		$criteria->compare('ID_TPRO',$this->ID_TPRO);
		$criteria->compare('ID_BODEGA',$this->ID_BODEGA);
		$criteria->compare('NOMBRE_PROD',$this->NOMBRE_PROD,true);
		$criteria->compare('MIN_PROD',$this->MIN_PROD,true);
		$criteria->compare('ICC_PROD',$this->ICC_PROD,true);
		$criteria->compare('IMEI_PROD',$this->IMEI_PROD,true);
		$criteria->compare('NUMSERIE_PROD',$this->NUMSERIE_PROD,true);
		$criteria->compare('PRECIO_PROD',$this->PRECIO_PROD,true);
		$criteria->compare('COSTO_PROD',$this->COSTO_PROD,true);
		$criteria->compare('PORCENTAJEDESCUENTO_PROD',$this->PORCENTAJEDESCUENTO_PROD,true);
		$criteria->compare('PRECIO1_PROD',$this->PRECIO1_PROD,true);
		$criteria->compare('PRECIO2_PROD',$this->PRECIO2_PROD,true);
		$criteria->compare('PRECIO3_PROD',$this->PRECIO3_PROD,true);
		$criteria->compare('MIN_593_PROD',$this->MIN_593_PROD,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return ProductoModel the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
