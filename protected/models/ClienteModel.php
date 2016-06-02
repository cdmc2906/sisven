<?php

/**
 * This is the model class for table "tb_cliente".
 *
 * The followings are the available columns in table 'tb_cliente':
 * @property integer $ID_CLI
 * @property integer $ID_EST
 * @property integer $ID_TCLI
 * @property string $NOMBRE_CLI
 * @property string $DOCUMENTO_CLI
 * @property string $DIRECCION_CLI
 * @property string $TELEFONO_CLI
 * @property string $EMAIL_CLI
 * @property string $FECHAINGRESO_CLI
 * @property string $FECHAMODIFICACION_CLI
 * @property integer $IDUSR_CLI
 * @property integer $IDDELTA_CLI
 *
 * The followings are the available model relations:
 * @property TbTipoCliente $iDTCLI
 * @property TbEstado $iDEST
 * @property TbVenta[] $tbVentas
 */
class ClienteModel extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'tb_cliente';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('ID_CLI', 'required'),
			array('ID_CLI, ID_EST, ID_TCLI, IDUSR_CLI, IDDELTA_CLI', 'numerical', 'integerOnly'=>true),
			array('NOMBRE_CLI, DIRECCION_CLI', 'length', 'max'=>250),
			array('DOCUMENTO_CLI', 'length', 'max'=>15),
			array('TELEFONO_CLI, EMAIL_CLI', 'length', 'max'=>50),
			array('FECHAINGRESO_CLI, FECHAMODIFICACION_CLI', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('ID_CLI, ID_EST, ID_TCLI, NOMBRE_CLI, DOCUMENTO_CLI, DIRECCION_CLI, TELEFONO_CLI, EMAIL_CLI, FECHAINGRESO_CLI, FECHAMODIFICACION_CLI, IDUSR_CLI, IDDELTA_CLI', 'safe', 'on'=>'search'),
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
			'iDTCLI' => array(self::BELONGS_TO, 'TbTipoCliente', 'ID_TCLI'),
			'iDEST' => array(self::BELONGS_TO, 'TbEstado', 'ID_EST'),
			'tbVentas' => array(self::HAS_MANY, 'TbVenta', 'ID_CLI'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'ID_CLI' => 'Id Cli',
			'ID_EST' => 'Id Est',
			'ID_TCLI' => 'Id Tcli',
			'NOMBRE_CLI' => 'Nombre Cli',
			'DOCUMENTO_CLI' => 'Documento Cli',
			'DIRECCION_CLI' => 'Direccion Cli',
			'TELEFONO_CLI' => 'Telefono Cli',
			'EMAIL_CLI' => 'Email Cli',
			'FECHAINGRESO_CLI' => 'Fechaingreso Cli',
			'FECHAMODIFICACION_CLI' => 'Fechamodificacion Cli',
			'IDUSR_CLI' => 'Idusr Cli',
			'IDDELTA_CLI' => 'Iddelta Cli',
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

		$criteria->compare('ID_CLI',$this->ID_CLI);
		$criteria->compare('ID_EST',$this->ID_EST);
		$criteria->compare('ID_TCLI',$this->ID_TCLI);
		$criteria->compare('NOMBRE_CLI',$this->NOMBRE_CLI,true);
		$criteria->compare('DOCUMENTO_CLI',$this->DOCUMENTO_CLI,true);
		$criteria->compare('DIRECCION_CLI',$this->DIRECCION_CLI,true);
		$criteria->compare('TELEFONO_CLI',$this->TELEFONO_CLI,true);
		$criteria->compare('EMAIL_CLI',$this->EMAIL_CLI,true);
		$criteria->compare('FECHAINGRESO_CLI',$this->FECHAINGRESO_CLI,true);
		$criteria->compare('FECHAMODIFICACION_CLI',$this->FECHAMODIFICACION_CLI,true);
		$criteria->compare('IDUSR_CLI',$this->IDUSR_CLI);
		$criteria->compare('IDDELTA_CLI',$this->IDDELTA_CLI);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return ClienteModel the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
