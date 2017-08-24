<?php

/**
 * This is the model class for table "tb_comentario_oficina".
 *
 * The followings are the available columns in table 'tb_comentario_oficina':
 * @property integer $co_id
 * @property string $co_fecha_historial_revisado
 * @property string $co_ejecutivo_revisado
 * @property string $co_comentario
 * @property string $co_enlace_mapa
 * @property string $co_enlace_imagen
 * @property integer $co_estado
 * @property string $co_fecha_ingreso
 * @property string $co_fecha_modificacion
 * @property integer $co_usuario_ingresa_modifica
 */
class ComentarioOficinaModel extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'tb_comentario_oficina';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('co_estado, co_usuario_ingresa_modifica', 'numerical', 'integerOnly'=>true),
			array('co_ejecutivo_revisado', 'length', 'max'=>25),
			array('co_comentario, co_enlace_mapa, co_enlace_imagen', 'length', 'max'=>500),
			array('co_fecha_historial_revisado, co_fecha_ingreso, co_fecha_modificacion', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('co_id, co_fecha_historial_revisado, co_ejecutivo_revisado, co_comentario, co_enlace_mapa, co_enlace_imagen, co_estado, co_fecha_ingreso, co_fecha_modificacion, co_usuario_ingresa_modifica', 'safe', 'on'=>'search'),
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
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'co_id' => 'Codigo comentario',
			'co_fecha_historial_revisado' => 'Fecha Historial Revisado',
			'co_ejecutivo_revisado' => 'Ejecutivo Revisado',
			'co_comentario' => 'Comentario',
			'co_enlace_mapa' => 'Enlace Mapa',
			'co_enlace_imagen' => 'Enlace Imagen',
			'co_estado' => 'Estado',
			'co_fecha_ingreso' => 'Fecha Ingreso',
			'co_fecha_modificacion' => 'Fecha Modificacion',
			'co_usuario_ingresa_modifica' => 'Realizado por',
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

		$criteria->compare('co_id',$this->co_id);
		$criteria->compare('co_fecha_historial_revisado',$this->co_fecha_historial_revisado,true);
		$criteria->compare('co_ejecutivo_revisado',$this->co_ejecutivo_revisado,true);
		$criteria->compare('co_comentario',$this->co_comentario,true);
		$criteria->compare('co_enlace_mapa',$this->co_enlace_mapa,true);
		$criteria->compare('co_enlace_imagen',$this->co_enlace_imagen,true);
		$criteria->compare('co_estado',$this->co_estado);
		$criteria->compare('co_fecha_ingreso',$this->co_fecha_ingreso,true);
		$criteria->compare('co_fecha_modificacion',$this->co_fecha_modificacion,true);
		$criteria->compare('co_usuario_ingresa_modifica',$this->co_usuario_ingresa_modifica);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return ComentarioOficinaModel the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
