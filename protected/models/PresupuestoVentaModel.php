<?php

/**
 * This is the model class for table "tb_presupuesto_venta".
 *
 * The followings are the available columns in table 'tb_presupuesto_venta':
 * @property integer $p_id
 * @property string $p_codigo_vendedor
 * @property string $p_fecha_ini_validez
 * @property string $p_fecha_fin_validez
 * @property integer $p_dias_laborables
 * @property string $p_valor_presupuesto
 * @property string $p_tipo_presupuesto
 * @property integer $p_cantidad_feriados
 * @property string $p_venta_diaria_esperada
 * @property integer $p_estado_presupuesto
 * @property string $p_fecha_ingreso
 * @property string $p_fecha_modifica
 * @property integer $p_cod_usuario_ing_mod
 */
class PresupuestoVentaModel extends CActiveRecord {

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'tb_presupuesto_venta';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('p_codigo_vendedor, p_fecha_ini_validez, p_fecha_fin_validez,p_cantidad_feriados,p_valor_presupuesto', 'required'),
            array('p_dias_laborables, p_cantidad_feriados, p_estado_presupuesto, p_cod_usuario_ing_mod', 'numerical', 'integerOnly' => true),
            array('p_codigo_vendedor', 'length', 'max' => 50),
            array('p_valor_presupuesto, p_venta_diaria_esperada', 'length', 'max' => 10),
            array('p_tipo_presupuesto', 'length', 'max' => 25),
            array('p_fecha_ini_validez, p_fecha_fin_validez, p_fecha_ingreso, p_fecha_modifica', 'safe'),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('p_id, p_codigo_vendedor, p_fecha_ini_validez, p_fecha_fin_validez, p_dias_laborables, p_valor_presupuesto, p_tipo_presupuesto, p_cantidad_feriados, p_venta_diaria_esperada, p_estado_presupuesto, p_fecha_ingreso, p_fecha_modifica, p_cod_usuario_ing_mod', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'p_id' => 'ID',
            'p_codigo_vendedor' => 'Vendedor',
            'p_fecha_ini_validez' => 'Fecha Inicio',
            'p_fecha_fin_validez' => 'Fecha Fin',
            'p_dias_laborables' => 'Dias Laborables',
            'p_valor_presupuesto' => 'Valor Presupuesto',
            'p_tipo_presupuesto' => 'Tipo Presupuesto',
            'p_cantidad_feriados' => 'Cantidad Feriados',
            'p_venta_diaria_esperada' => 'Venta Diaria Esperada',
            'p_estado_presupuesto' => 'Estado Presupuesto',
            'p_fecha_ingreso' => 'Fecha Ingreso',
            'p_fecha_modifica' => 'Fecha Modifica',
            'p_cod_usuario_ing_mod' => 'Cod Usuario Ing Mod',
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
    public function search() {
        // @todo Please modify the following code to remove attributes that should not be searched.

        $criteria = new CDbCriteria;

        $criteria->compare('p_id', $this->p_id);
        $criteria->compare('p_codigo_vendedor', $this->p_codigo_vendedor, true);
        $criteria->compare('p_fecha_ini_validez', $this->p_fecha_ini_validez, true);
        $criteria->compare('p_fecha_fin_validez', $this->p_fecha_fin_validez, true);
        $criteria->compare('p_dias_laborables', $this->p_dias_laborables);
        $criteria->compare('p_valor_presupuesto', $this->p_valor_presupuesto, true);
        $criteria->compare('p_tipo_presupuesto', $this->p_tipo_presupuesto, true);
        $criteria->compare('p_cantidad_feriados', $this->p_cantidad_feriados);
        $criteria->compare('p_venta_diaria_esperada', $this->p_venta_diaria_esperada, true);
        $criteria->compare('p_estado_presupuesto', $this->p_estado_presupuesto);
        $criteria->compare('p_fecha_ingreso', $this->p_fecha_ingreso, true);
        $criteria->compare('p_fecha_modifica', $this->p_fecha_modifica, true);
        $criteria->compare('p_cod_usuario_ing_mod', $this->p_cod_usuario_ing_mod);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return PresupuestoVentaModel the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

}
