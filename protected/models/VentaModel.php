<?php

/**
 * This is the model class for table "tb_venta".
 *
 * The followings are the available columns in table 'tb_venta':
 * @property integer $ID_VENT
 * @property integer $ID_VEND
 * @property integer $ID_CLI
 * @property integer $ID_PRO
 * @property string $FECHA_VENT
 * @property string $MES_VENT
 * @property integer $SEMANA_VENT
 * @property integer $PRECIO_VENT
 * @property integer $CANTIDAD_VENT
 * @property integer $NUMFACTURA_VENT
 * @property integer $IDUSR_VENT
 * @property string $FECHAINGRESO_VENT
 * @property string $FECHAMODIFICACION_VENT
 *
 * The followings are the available model relations:
 * @property TbVendedor $iDVEND
 * @property TbProducto $iDPRO
 * @property TbCliente $iDCLI
 */
class VentaModel extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'tb_venta';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('ID_VENT', 'required'),
			array('ID_VENT, ID_VEND, ID_CLI, ID_PRO, SEMANA_VENT, PRECIO_VENT, CANTIDAD_VENT, NUMFACTURA_VENT, IDUSR_VENT', 'numerical', 'integerOnly'=>true),
			array('MES_VENT', 'length', 'max'=>20),
			array('FECHA_VENT, FECHAINGRESO_VENT, FECHAMODIFICACION_VENT', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('ID_VENT, ID_VEND, ID_CLI, ID_PRO, FECHA_VENT, MES_VENT, SEMANA_VENT, PRECIO_VENT, CANTIDAD_VENT, NUMFACTURA_VENT, IDUSR_VENT, FECHAINGRESO_VENT, FECHAMODIFICACION_VENT', 'safe', 'on'=>'search'),
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
			'iDVEND' => array(self::BELONGS_TO, 'TbVendedor', 'ID_VEND'),
			'iDPRO' => array(self::BELONGS_TO, 'TbProducto', 'ID_PRO'),
			'iDCLI' => array(self::BELONGS_TO, 'TbCliente', 'ID_CLI'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'ID_VENT' => 'Id Vent',
			'ID_VEND' => 'Id Vend',
			'ID_CLI' => 'Id Cli',
			'ID_PRO' => 'Id Pro',
			'FECHA_VENT' => 'Fecha Vent',
			'MES_VENT' => 'Mes Vent',
			'SEMANA_VENT' => 'Semana Vent',
			'PRECIO_VENT' => 'Precio Vent',
			'CANTIDAD_VENT' => 'Cantidad Vent',
			'NUMFACTURA_VENT' => 'Numfactura Vent',
			'IDUSR_VENT' => 'Idusr Vent',
			'FECHAINGRESO_VENT' => 'Fechaingreso Vent',
			'FECHAMODIFICACION_VENT' => 'Fechamodificacion Vent',
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

		$criteria->compare('ID_VENT',$this->ID_VENT);
		$criteria->compare('ID_VEND',$this->ID_VEND);
		$criteria->compare('ID_CLI',$this->ID_CLI);
		$criteria->compare('ID_PRO',$this->ID_PRO);
		$criteria->compare('FECHA_VENT',$this->FECHA_VENT,true);
		$criteria->compare('MES_VENT',$this->MES_VENT,true);
		$criteria->compare('SEMANA_VENT',$this->SEMANA_VENT);
		$criteria->compare('PRECIO_VENT',$this->PRECIO_VENT);
		$criteria->compare('CANTIDAD_VENT',$this->CANTIDAD_VENT);
		$criteria->compare('NUMFACTURA_VENT',$this->NUMFACTURA_VENT);
		$criteria->compare('IDUSR_VENT',$this->IDUSR_VENT);
		$criteria->compare('FECHAINGRESO_VENT',$this->FECHAINGRESO_VENT,true);
		$criteria->compare('FECHAMODIFICACION_VENT',$this->FECHAMODIFICACION_VENT,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return VentaModel the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
