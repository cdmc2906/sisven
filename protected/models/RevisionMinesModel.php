<?php

/**
 * This is the model class for table "tb_revision_mines".
 *
 * The followings are the available columns in table 'tb_revision_mines':
 * @property integer $rmva_id
 * @property integer $iduser
 * @property string $rmva_icc
 * @property string $rmva_min
 * @property integer $rmva_numero_revision
 * @property string $rmva_estado_revision
 * @property string $rmva_tipo
 * @property integer $rmva_carga
 * @property string $rmva_fecha_gestion
 * @property string $rmva_resultado_llamad
 * @property string $rmva_motivo_no_contado
 * @property string $rmva_operadora
 * @property string $rmva_lugar_compra
 * @property string $rmva_precio
 * @property integer $rmva_estado
 * @property string $rmva_fecha_ingreso
 * @property string $rmva_fecha_modifica
 * @property integer $rmva_cod_usuario_ing_mod
 *
 * The followings are the available model relations:
 * @property CrugeUser $iduser0
 */
class RevisionMinesModel extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'tb_revision_mines';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('iduser, rmva_numero_revision, rmva_carga, rmva_estado, rmva_cod_usuario_ing_mod', 'numerical', 'integerOnly'=>true),
			array('rmva_icc, rmva_min, rmva_estado_revision, rmva_operadora', 'length', 'max'=>50),
			array('rmva_tipo', 'length', 'max'=>25),
			array('rmva_resultado_llamad, rmva_motivo_no_contado, rmva_lugar_compra', 'length', 'max'=>100),
			array('rmva_precio', 'length', 'max'=>10),
			array('rmva_fecha_gestion, rmva_fecha_ingreso, rmva_fecha_modifica', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('rmva_id, iduser, rmva_icc, rmva_min, rmva_numero_revision, rmva_estado_revision, rmva_tipo, rmva_carga, rmva_fecha_gestion, rmva_resultado_llamad, rmva_motivo_no_contado, rmva_operadora, rmva_lugar_compra, rmva_precio, rmva_estado, rmva_fecha_ingreso, rmva_fecha_modifica, rmva_cod_usuario_ing_mod', 'safe', 'on'=>'search'),
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
			'rmva_id' => 'Rmva',
			'iduser' => 'Iduser',
			'rmva_icc' => 'Rmva Icc',
			'rmva_min' => 'Rmva Min',
			'rmva_numero_revision' => 'Rmva Numero Revision',
			'rmva_estado_revision' => 'Rmva Estado Revision',
			'rmva_tipo' => 'Rmva Tipo',
			'rmva_carga' => 'Rmva Carga',
			'rmva_fecha_gestion' => 'Rmva Fecha Gestion',
			'rmva_resultado_llamad' => 'Rmva Resultado Llamad',
			'rmva_motivo_no_contado' => 'Rmva Motivo No Contado',
			'rmva_operadora' => 'Rmva Operadora',
			'rmva_lugar_compra' => 'Rmva Lugar Compra',
			'rmva_precio' => 'Rmva Precio',
			'rmva_estado' => 'Rmva Estado',
			'rmva_fecha_ingreso' => 'Rmva Fecha Ingreso',
			'rmva_fecha_modifica' => 'Rmva Fecha Modifica',
			'rmva_cod_usuario_ing_mod' => 'Rmva Cod Usuario Ing Mod',
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

		$criteria->compare('rmva_id',$this->rmva_id);
		$criteria->compare('iduser',$this->iduser);
		$criteria->compare('rmva_icc',$this->rmva_icc,true);
		$criteria->compare('rmva_min',$this->rmva_min,true);
		$criteria->compare('rmva_numero_revision',$this->rmva_numero_revision);
		$criteria->compare('rmva_estado_revision',$this->rmva_estado_revision,true);
		$criteria->compare('rmva_tipo',$this->rmva_tipo,true);
		$criteria->compare('rmva_carga',$this->rmva_carga);
		$criteria->compare('rmva_fecha_gestion',$this->rmva_fecha_gestion,true);
		$criteria->compare('rmva_resultado_llamad',$this->rmva_resultado_llamad,true);
		$criteria->compare('rmva_motivo_no_contado',$this->rmva_motivo_no_contado,true);
		$criteria->compare('rmva_operadora',$this->rmva_operadora,true);
		$criteria->compare('rmva_lugar_compra',$this->rmva_lugar_compra,true);
		$criteria->compare('rmva_precio',$this->rmva_precio,true);
		$criteria->compare('rmva_estado',$this->rmva_estado);
		$criteria->compare('rmva_fecha_ingreso',$this->rmva_fecha_ingreso,true);
		$criteria->compare('rmva_fecha_modifica',$this->rmva_fecha_modifica,true);
		$criteria->compare('rmva_cod_usuario_ing_mod',$this->rmva_cod_usuario_ing_mod);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return RevisionMinesModel the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
