<?php

/**
 * This is the model class for table "tb_presupuesto_venta".
 *
 * The followings are the available columns in table 'tb_presupuesto_venta':
 * @property integer $p_id
 * @property integer $pg_id
 * @property string $p_codigo_vendedor
 * @property string $p_fecha_ini_validez
 * @property string $p_fecha_fin_validez
 * @property integer $p_dias_laborables
 * @property string $p_valor_presupuesto
 * @property string $p_tipo_presupuesto
 * @property integer $p_cantidad_feriados
 * @property string $p_cumplimiento_diario_esperado
 * @property integer $p_estado_presupuesto
 * @property string $p_fecha_ingreso
 * @property string $p_fecha_modifica
 * @property integer $p_cod_usuario_ing_mod
 *
 * The followings are the available model relations:
 * @property TbPeriodoGestion $pg
 */
class PresupuestoVentaModel extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'tb_presupuesto_venta';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('pg_id, p_dias_laborables, p_cantidad_feriados, p_estado_presupuesto, p_cod_usuario_ing_mod', 'numerical', 'integerOnly'=>true),
			array('p_codigo_vendedor', 'length', 'max'=>50),
			array('p_valor_presupuesto, p_cumplimiento_diario_esperado', 'length', 'max'=>10),
			array('p_tipo_presupuesto', 'length', 'max'=>25),
			array('p_fecha_ini_validez, p_fecha_fin_validez, p_fecha_ingreso, p_fecha_modifica', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('p_id, pg_id, p_codigo_vendedor, p_fecha_ini_validez, p_fecha_fin_validez, p_dias_laborables, p_valor_presupuesto, p_tipo_presupuesto, p_cantidad_feriados, p_cumplimiento_diario_esperado, p_estado_presupuesto, p_fecha_ingreso, p_fecha_modifica, p_cod_usuario_ing_mod', 'safe', 'on'=>'search'),
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
			'pg' => array(self::BELONGS_TO, 'TbPeriodoGestion', 'pg_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'p_id' => 'P',
			'pg_id' => 'Pg',
			'p_codigo_vendedor' => 'P Codigo Vendedor',
			'p_fecha_ini_validez' => 'P Fecha Ini Validez',
			'p_fecha_fin_validez' => 'P Fecha Fin Validez',
			'p_dias_laborables' => 'P Dias Laborables',
			'p_valor_presupuesto' => 'P Valor Presupuesto',
			'p_tipo_presupuesto' => 'P Tipo Presupuesto',
			'p_cantidad_feriados' => 'P Cantidad Feriados',
			'p_cumplimiento_diario_esperado' => 'P Cumplimiento Diario Esperado',
			'p_estado_presupuesto' => 'P Estado Presupuesto',
			'p_fecha_ingreso' => 'P Fecha Ingreso',
			'p_fecha_modifica' => 'P Fecha Modifica',
			'p_cod_usuario_ing_mod' => 'P Cod Usuario Ing Mod',
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

		$criteria->compare('p_id',$this->p_id);
		$criteria->compare('pg_id',$this->pg_id);
		$criteria->compare('p_codigo_vendedor',$this->p_codigo_vendedor,true);
		$criteria->compare('p_fecha_ini_validez',$this->p_fecha_ini_validez,true);
		$criteria->compare('p_fecha_fin_validez',$this->p_fecha_fin_validez,true);
		$criteria->compare('p_dias_laborables',$this->p_dias_laborables);
		$criteria->compare('p_valor_presupuesto',$this->p_valor_presupuesto,true);
		$criteria->compare('p_tipo_presupuesto',$this->p_tipo_presupuesto,true);
		$criteria->compare('p_cantidad_feriados',$this->p_cantidad_feriados);
		$criteria->compare('p_cumplimiento_diario_esperado',$this->p_cumplimiento_diario_esperado,true);
		$criteria->compare('p_estado_presupuesto',$this->p_estado_presupuesto);
		$criteria->compare('p_fecha_ingreso',$this->p_fecha_ingreso,true);
		$criteria->compare('p_fecha_modifica',$this->p_fecha_modifica,true);
		$criteria->compare('p_cod_usuario_ing_mod',$this->p_cod_usuario_ing_mod);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return PresupuestoVentaModel the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
