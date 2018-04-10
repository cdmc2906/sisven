<?php

/**
 * This is the model class for table "tb_periodo_gestion".
 *
 * The followings are the available columns in table 'tb_periodo_gestion':
 * @property integer $pg_id
 * @property string $pg_descripcion
 * @property string $pg_fecha_inicio
 * @property string $pg_fecha_fin
 * @property integer $pg_estado
 * @property string $pg_tipo
 * @property string $pg_fecha_ingreso
 * @property string $pg_fecha_modificacion
 * @property integer $pg_cod_usuario_ing_mod
 */
class PeriodoGestionModel extends CActiveRecord {

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'tb_periodo_gestion';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('pg_fecha_inicio,pg_fecha_fin,pg_tipo', 'required'),
            array('pg_estado,pg_cod_usuario_ing_mod', 'numerical', 'integerOnly' => true),
            array('pg_descripcion', 'length', 'max' => 250),
            array('pg_tipo', 'length', 'max' => 50),
            array('pg_fecha_inicio, pg_fecha_fin, pg_fecha_ingreso, pg_fecha_modificacion', 'safe'),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('pg_id, pg_descripcion, pg_fecha_inicio, pg_fecha_fin, pg_estado, pg_tipo, pg_fecha_ingreso, pg_fecha_modificacion, pg_cod_usuario_ing_mod', 'safe', 'on' => 'search'),
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
            'pg_id' => 'Id Periodo',
            'pg_descripcion' => 'Descripcion',
            'pg_fecha_inicio' => 'Fecha Inicio',
            'pg_fecha_fin' => 'Fecha Fin',
            'pg_estado' => 'Estado',
            'pg_tipo' => 'Tipo',
            'pg_fecha_ingreso' => 'Fecha Ingreso',
            'pg_fecha_modificacion' => 'Fecha Modificacion',
            'pg_cod_usuario_ing_mod' => 'Ingresado por',
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

        $criteria->compare('pg_id', $this->pg_id);
        $criteria->compare('pg_descripcion', $this->pg_descripcion, true);
        $criteria->compare('pg_fecha_inicio', $this->pg_fecha_inicio, true);
        $criteria->compare('pg_fecha_fin', $this->pg_fecha_fin, true);
        $criteria->compare('pg_estado', $this->pg_estado);
        $criteria->compare('pg_tipo', $this->pg_tipo, true);
        $criteria->compare('pg_fecha_ingreso', $this->pg_fecha_ingreso, true);
        $criteria->compare('pg_fecha_modificacion', $this->pg_fecha_modificacion, true);
        $criteria->compare('pg_cod_usuario_ing_mod', $this->pg_cod_usuario_ing_mod);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return PeriodoGestionModel the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

}
