<?php

/**
 * This is the model class for table "tb_novedades".
 *
 * The followings are the available columns in table 'tb_novedades':
 * @property integer $nov_id
 * @property integer $gno_id
 * @property string $nov_descripcion
 * @property integer $nov_estado
 * @property string $nov_fecha_ingreso
 * @property string $nov_fecha_modifica
 * @property integer $nov_cod_usuario_ingresa_modifica
 *
 * The followings are the available model relations:
 * @property TbNovedadCliente[] $tbNovedadClientes
 * @property TbGrupoNotificacion $gno
 */
class NovedadesModel extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'tb_novedades';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('gno_id, nov_estado, nov_cod_usuario_ingresa_modifica', 'numerical', 'integerOnly'=>true),
			array('nov_descripcion', 'length', 'max'=>100),
			array('nov_fecha_ingreso, nov_fecha_modifica', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('nov_id, gno_id, nov_descripcion, nov_estado, nov_fecha_ingreso, nov_fecha_modifica, nov_cod_usuario_ingresa_modifica', 'safe', 'on'=>'search'),
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
			'tbNovedadClientes' => array(self::HAS_MANY, 'TbNovedadCliente', 'nov_id'),
			'gno' => array(self::BELONGS_TO, 'TbGrupoNotificacion', 'gno_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'nov_id' => 'Nov',
			'gno_id' => 'Gno',
			'nov_descripcion' => 'Nov Descripcion',
			'nov_estado' => 'Nov Estado',
			'nov_fecha_ingreso' => 'Nov Fecha Ingreso',
			'nov_fecha_modifica' => 'Nov Fecha Modifica',
			'nov_cod_usuario_ingresa_modifica' => 'Nov Cod Usuario Ingresa Modifica',
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

		$criteria->compare('nov_id',$this->nov_id);
		$criteria->compare('gno_id',$this->gno_id);
		$criteria->compare('nov_descripcion',$this->nov_descripcion,true);
		$criteria->compare('nov_estado',$this->nov_estado);
		$criteria->compare('nov_fecha_ingreso',$this->nov_fecha_ingreso,true);
		$criteria->compare('nov_fecha_modifica',$this->nov_fecha_modifica,true);
		$criteria->compare('nov_cod_usuario_ingresa_modifica',$this->nov_cod_usuario_ingresa_modifica);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return NovedadesModel the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
