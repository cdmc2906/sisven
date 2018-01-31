<?php

/**
 * This is the model class for table "tb_tipo_pregunta".
 *
 * The followings are the available columns in table 'tb_tipo_pregunta':
 * @property integer $tpreg_id
 * @property string $tpreg_nombre
 * @property integer $tpreg_estado
 * @property string $tpreg_fecha_inicio
 * @property string $tpreg_fecha_modifica
 * @property integer $tpreg_cod_usuario_ing_mod
 *
 * The followings are the available model relations:
 * @property TbPregunta[] $tbPreguntas
 */
class TipoPreguntaModel extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'tb_tipo_pregunta';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('tpreg_estado, tpreg_cod_usuario_ing_mod', 'numerical', 'integerOnly'=>true),
			array('tpreg_nombre', 'length', 'max'=>50),
			array('tpreg_fecha_inicio, tpreg_fecha_modifica', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('tpreg_id, tpreg_nombre, tpreg_estado, tpreg_fecha_inicio, tpreg_fecha_modifica, tpreg_cod_usuario_ing_mod', 'safe', 'on'=>'search'),
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
			'tbPreguntas' => array(self::HAS_MANY, 'TbPregunta', 'tpreg_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'tpreg_id' => 'Tpreg',
			'tpreg_nombre' => 'Tpreg Nombre',
			'tpreg_estado' => 'Tpreg Estado',
			'tpreg_fecha_inicio' => 'Tpreg Fecha Inicio',
			'tpreg_fecha_modifica' => 'Tpreg Fecha Modifica',
			'tpreg_cod_usuario_ing_mod' => 'Tpreg Cod Usuario Ing Mod',
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

		$criteria->compare('tpreg_id',$this->tpreg_id);
		$criteria->compare('tpreg_nombre',$this->tpreg_nombre,true);
		$criteria->compare('tpreg_estado',$this->tpreg_estado);
		$criteria->compare('tpreg_fecha_inicio',$this->tpreg_fecha_inicio,true);
		$criteria->compare('tpreg_fecha_modifica',$this->tpreg_fecha_modifica,true);
		$criteria->compare('tpreg_cod_usuario_ing_mod',$this->tpreg_cod_usuario_ing_mod);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return TipoPreguntaModel the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
