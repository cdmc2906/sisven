<?php

/**
 * This is the model class for table "tb_telefono_cliente".
 *
 * The followings are the available columns in table 'tb_telefono_cliente':
 * @property integer $tcli_id
 * @property integer $cli_codigo
 * @property string $tcli_telefono
 * @property integer $tcli_estado
 * @property string $tcli_fecha_ingreso
 * @property string $tcli_fecha_modifica
 * @property integer $tcli_cod_usuario_ing_mod
 *
 * The followings are the available model relations:
 * @property TbCliente $cliCodigo
 */
class TelefonoClienteModel extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'tb_telefono_cliente';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('cli_codigo, tcli_estado, tcli_cod_usuario_ing_mod', 'numerical', 'integerOnly'=>true),
			array('tcli_telefono', 'length', 'max'=>20),
			array('tcli_fecha_ingreso, tcli_fecha_modifica', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('tcli_id, cli_codigo, tcli_telefono, tcli_estado, tcli_fecha_ingreso, tcli_fecha_modifica, tcli_cod_usuario_ing_mod', 'safe', 'on'=>'search'),
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
			'cliCodigo' => array(self::BELONGS_TO, 'TbCliente', 'cli_codigo'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'tcli_id' => 'Tcli',
			'cli_codigo' => 'Cli Codigo',
			'tcli_telefono' => 'Tcli Telefono',
			'tcli_estado' => 'Tcli Estado',
			'tcli_fecha_ingreso' => 'Tcli Fecha Ingreso',
			'tcli_fecha_modifica' => 'Tcli Fecha Modifica',
			'tcli_cod_usuario_ing_mod' => 'Tcli Cod Usuario Ing Mod',
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

		$criteria->compare('tcli_id',$this->tcli_id);
		$criteria->compare('cli_codigo',$this->cli_codigo);
		$criteria->compare('tcli_telefono',$this->tcli_telefono,true);
		$criteria->compare('tcli_estado',$this->tcli_estado);
		$criteria->compare('tcli_fecha_ingreso',$this->tcli_fecha_ingreso,true);
		$criteria->compare('tcli_fecha_modifica',$this->tcli_fecha_modifica,true);
		$criteria->compare('tcli_cod_usuario_ing_mod',$this->tcli_cod_usuario_ing_mod);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return TelefonoClienteModel the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
