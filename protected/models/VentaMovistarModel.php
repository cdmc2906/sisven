<?php

/**
 * This is the model class for table "tb_venta_movistar".
 *
 * The followings are the available columns in table 'tb_venta_movistar':
 * @property integer $vm_cod
 * @property string $vm_fecha
 * @property string $vm_transaccion
 * @property string $vm_distribuidor
 * @property string $vm_nombredistribuidor
 * @property string $vm_codigoscl
 * @property string $vm_inventarioanteriorfuente
 * @property string $vm_inventarioactualfuente
 * @property string $vm_tiposim
 * @property string $vm_icc
 * @property string $vm_min
 * @property string $vm_estado
 * @property string $vm_iddestino
 * @property string $vm_nombredestino
 * @property string $vm_inventarioanteriordestino
 * @property string $vm_inventarioactualdestino
 * @property string $vm_canal
 * @property string $vm_lote
 * @property string $vm_zona
 * @property string $vm_fecha_ingreso
 * @property string $vm_fecha_modificacion
 * @property integer $vm_usuario_ingresa_modifica
 */
class VentaMovistarModel extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'tb_venta_movistar';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('vm_usuario_ingresa_modifica', 'numerical', 'integerOnly'=>true),
			array('vm_transaccion, vm_distribuidor, vm_nombredistribuidor, vm_codigoscl, vm_inventarioanteriorfuente, vm_inventarioactualfuente, vm_tiposim, vm_icc, vm_min, vm_estado, vm_iddestino, vm_nombredestino, vm_inventarioanteriordestino, vm_inventarioactualdestino, vm_canal, vm_lote, vm_zona', 'length', 'max'=>500),
			array('vm_fecha, vm_fecha_ingreso, vm_fecha_modificacion', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('vm_cod, vm_fecha, vm_transaccion, vm_distribuidor, vm_nombredistribuidor, vm_codigoscl, vm_inventarioanteriorfuente, vm_inventarioactualfuente, vm_tiposim, vm_icc, vm_min, vm_estado, vm_iddestino, vm_nombredestino, vm_inventarioanteriordestino, vm_inventarioactualdestino, vm_canal, vm_lote, vm_zona, vm_fecha_ingreso, vm_fecha_modificacion, vm_usuario_ingresa_modifica', 'safe', 'on'=>'search'),
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
			'vm_cod' => 'Vm Cod',
			'vm_fecha' => 'Vm Fecha',
			'vm_transaccion' => 'Vm Transaccion',
			'vm_distribuidor' => 'Vm Distribuidor',
			'vm_nombredistribuidor' => 'Vm Nombredistribuidor',
			'vm_codigoscl' => 'Vm Codigoscl',
			'vm_inventarioanteriorfuente' => 'Vm Inventarioanteriorfuente',
			'vm_inventarioactualfuente' => 'Vm Inventarioactualfuente',
			'vm_tiposim' => 'Vm Tiposim',
			'vm_icc' => 'Vm Icc',
			'vm_min' => 'Vm Min',
			'vm_estado' => 'Vm Estado',
			'vm_iddestino' => 'Vm Iddestino',
			'vm_nombredestino' => 'Vm Nombredestino',
			'vm_inventarioanteriordestino' => 'Vm Inventarioanteriordestino',
			'vm_inventarioactualdestino' => 'Vm Inventarioactualdestino',
			'vm_canal' => 'Vm Canal',
			'vm_lote' => 'Vm Lote',
			'vm_zona' => 'Vm Zona',
			'vm_fecha_ingreso' => 'Vm Fecha Ingreso',
			'vm_fecha_modificacion' => 'Vm Fecha Modificacion',
			'vm_usuario_ingresa_modifica' => 'Vm Usuario Ingresa Modifica',
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

		$criteria->compare('vm_cod',$this->vm_cod);
		$criteria->compare('vm_fecha',$this->vm_fecha,true);
		$criteria->compare('vm_transaccion',$this->vm_transaccion,true);
		$criteria->compare('vm_distribuidor',$this->vm_distribuidor,true);
		$criteria->compare('vm_nombredistribuidor',$this->vm_nombredistribuidor,true);
		$criteria->compare('vm_codigoscl',$this->vm_codigoscl,true);
		$criteria->compare('vm_inventarioanteriorfuente',$this->vm_inventarioanteriorfuente,true);
		$criteria->compare('vm_inventarioactualfuente',$this->vm_inventarioactualfuente,true);
		$criteria->compare('vm_tiposim',$this->vm_tiposim,true);
		$criteria->compare('vm_icc',$this->vm_icc,true);
		$criteria->compare('vm_min',$this->vm_min,true);
		$criteria->compare('vm_estado',$this->vm_estado,true);
		$criteria->compare('vm_iddestino',$this->vm_iddestino,true);
		$criteria->compare('vm_nombredestino',$this->vm_nombredestino,true);
		$criteria->compare('vm_inventarioanteriordestino',$this->vm_inventarioanteriordestino,true);
		$criteria->compare('vm_inventarioactualdestino',$this->vm_inventarioactualdestino,true);
		$criteria->compare('vm_canal',$this->vm_canal,true);
		$criteria->compare('vm_lote',$this->vm_lote,true);
		$criteria->compare('vm_zona',$this->vm_zona,true);
		$criteria->compare('vm_fecha_ingreso',$this->vm_fecha_ingreso,true);
		$criteria->compare('vm_fecha_modificacion',$this->vm_fecha_modificacion,true);
		$criteria->compare('vm_usuario_ingresa_modifica',$this->vm_usuario_ingresa_modifica);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return VentaMovistarModel the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
