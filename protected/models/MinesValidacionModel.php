<?php

/**
 * This is the model class for table "tb_mines_validacion".
 *
 * The followings are the available columns in table 'tb_mines_validacion':
 * @property integer $miva_id
 * @property integer $iduser
 * @property integer $miva_carga
 * @property string $miva_tipo
 * @property string $miva_fecha
 * @property string $miva_bodega
 * @property string $miva_nomcli
 * @property string $miva_codgrup
 * @property string $miva_detalle
 * @property string $miva_imei
 * @property string $miva_min
 * @property string $miva_vendedor
 * @property integer $miva_estado
 * @property integer $miva_estado_reasignacion
 * @property integer $miva_usario_reasignado
 * @property string $miva_fecha_ingreso
 * @property string $miva_fecha_modifica
 * @property integer $miva_cod_usuario_ing_mod
 *
 * The followings are the available model relations:
 * @property CrugeUser $iduser0
 */
class MinesValidacionModel extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'tb_mines_validacion';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('iduser, miva_carga, miva_estado, miva_estado_reasignacion, miva_usario_reasignado, miva_cod_usuario_ing_mod', 'numerical', 'integerOnly'=>true),
			array('miva_tipo', 'length', 'max'=>25),
			array('miva_bodega, miva_nomcli, miva_codgrup, miva_detalle, miva_vendedor', 'length', 'max'=>100),
			array('miva_imei', 'length', 'max'=>50),
			array('miva_min', 'length', 'max'=>20),
			array('miva_fecha, miva_fecha_ingreso, miva_fecha_modifica', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('miva_id, iduser, miva_carga, miva_tipo, miva_fecha, miva_bodega, miva_nomcli, miva_codgrup, miva_detalle, miva_imei, miva_min, miva_vendedor, miva_estado, miva_estado_reasignacion, miva_usario_reasignado, miva_fecha_ingreso, miva_fecha_modifica, miva_cod_usuario_ing_mod', 'safe', 'on'=>'search'),
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
			'iduser0' => array(self::BELONGS_TO, 'CrugeUser', 'iduser'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'miva_id' => 'Miva',
			'iduser' => 'Iduser',
			'miva_carga' => 'Miva Carga',
			'miva_tipo' => 'Miva Tipo',
			'miva_fecha' => 'Miva Fecha',
			'miva_bodega' => 'Miva Bodega',
			'miva_nomcli' => 'Miva Nomcli',
			'miva_codgrup' => 'Miva Codgrup',
			'miva_detalle' => 'Miva Detalle',
			'miva_imei' => 'Miva Imei',
			'miva_min' => 'Miva Min',
			'miva_vendedor' => 'Miva Vendedor',
			'miva_estado' => 'Miva Estado',
			'miva_estado_reasignacion' => 'Miva Estado Reasignacion',
			'miva_usario_reasignado' => 'Miva Usario Reasignado',
			'miva_fecha_ingreso' => 'Miva Fecha Ingreso',
			'miva_fecha_modifica' => 'Miva Fecha Modifica',
			'miva_cod_usuario_ing_mod' => 'Miva Cod Usuario Ing Mod',
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

		$criteria->compare('miva_id',$this->miva_id);
		$criteria->compare('iduser',$this->iduser);
		$criteria->compare('miva_carga',$this->miva_carga);
		$criteria->compare('miva_tipo',$this->miva_tipo,true);
		$criteria->compare('miva_fecha',$this->miva_fecha,true);
		$criteria->compare('miva_bodega',$this->miva_bodega,true);
		$criteria->compare('miva_nomcli',$this->miva_nomcli,true);
		$criteria->compare('miva_codgrup',$this->miva_codgrup,true);
		$criteria->compare('miva_detalle',$this->miva_detalle,true);
		$criteria->compare('miva_imei',$this->miva_imei,true);
		$criteria->compare('miva_min',$this->miva_min,true);
		$criteria->compare('miva_vendedor',$this->miva_vendedor,true);
		$criteria->compare('miva_estado',$this->miva_estado);
		$criteria->compare('miva_estado_reasignacion',$this->miva_estado_reasignacion);
		$criteria->compare('miva_usario_reasignado',$this->miva_usario_reasignado);
		$criteria->compare('miva_fecha_ingreso',$this->miva_fecha_ingreso,true);
		$criteria->compare('miva_fecha_modifica',$this->miva_fecha_modifica,true);
		$criteria->compare('miva_cod_usuario_ing_mod',$this->miva_cod_usuario_ing_mod);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return MinesValidacionModel the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
