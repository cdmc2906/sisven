<?php

class PeriodoGestionController extends Controller {

    /**
     * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
     * using two-column layout. See 'protected/views/layouts/column2.php'.
     */
    public $layout = LAYOUT_ADMIN_CATALOG;

//
//	/**
//	 * @return array action filters
//	 */
//	public function filters()
//	{
//		return array(
//			'accessControl', // perform access control for CRUD operations
//			'postOnly + delete', // we only allow deletion via POST request
//		);
//	}
//
//	/**
//	 * Specifies the access control rules.
//	 * This method is used by the 'accessControl' filter.
//	 * @return array access control rules
//	 */
//	public function accessRules()
//	{
//		return array(
//			array('allow',  // allow all users to perform 'index' and 'view' actions
//				'actions'=>array('index','view'),
//				'users'=>array('*'),
//			),
//			array('allow', // allow authenticated user to perform 'create' and 'update' actions
//				'actions'=>array('create','update'),
//				'users'=>array('@'),
//			),
//			array('allow', // allow admin user to perform 'admin' and 'delete' actions
//				'actions'=>array('admin','delete'),
//				'users'=>array('admin'),
//			),
//			array('deny',  // deny all users
//				'users'=>array('*'),
//			),
//		);
//	}

    /**
     * Displays a particular model.
     * @param integer $id the ID of the model to be displayed
     */
    public function actionView($id) {
        $this->render('view', array(
            'model' => $this->loadModel($id),
        ));
    }

    /**
     * Creates a new model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     */
    public function actionCreate() {
        $model = new PeriodoGestionModel;

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['PeriodoGestionModel'])) {
            $model->attributes = $_POST['PeriodoGestionModel'];
            $fechaIngresadaFin = $model->pg_fecha_fin;
            $fechaFinNueva = date('Y-m-d', strtotime($model->pg_fecha_fin . ' + 1 day'));
            $model->pg_fecha_fin = $fechaFinNueva;

            $periodoAnteriorActivo = PeriodoGestionModel::model()->findByAttributes(array('pg_estado' => 1, 'pg_tipo' => $model->pg_tipo));
            if (isset($periodoAnteriorActivo)) {
                $periodoAnteriorActivo ["pg_estado"] = 2;
                $periodoAnteriorActivo ["pg_fecha_modificacion"] = date(FORMATO_FECHA_LONG);
                $periodoAnteriorActivo ["pg_cod_usuario_ing_mod"] = Yii::app()->user->id;
            
                if ($periodoAnteriorActivo->save()) {
                    $model->pg_descripcion = "DEL " . $model->pg_fecha_inicio . " AL " . $fechaIngresadaFin;
                    $anio = DateTime::createFromFormat(FORMATO_FECHA_3, $model->pg_fecha_inicio)->format("Y");
                    $model->pg_anio = $anio;
                    $mes = DateTime::createFromFormat(FORMATO_FECHA_3, $model->pg_fecha_inicio)->format("m");
                    $model->pg_mes = $mes;
                    $model->pg_estado = 1;
                    $model->pg_fecha_ingreso = date(FORMATO_FECHA_LONG);
                    $model->pg_fecha_modificacion = date(FORMATO_FECHA_LONG);
                    $model->pg_cod_usuario_ing_mod = Yii::app()->user->id;
                    if ($model->save())
                        $this->redirect(array('view', 'id' => $model->pg_id));
                }
            }else {
                $model->pg_descripcion = "DEL " . $model->pg_fecha_inicio . " AL " . $model->$fechaIngresadaFin;
                $anio = DateTime::createFromFormat(FORMATO_FECHA_3, $model->pg_fecha_inicio)->format("Y");
                $model->pg_anio = $anio;
                $mes = DateTime::createFromFormat(FORMATO_FECHA_3, $model->pg_fecha_inicio)->format("m");
                $model->pg_mes = $mes;
                $model->pg_estado = 1;
                $model->pg_fecha_ingreso = date(FORMATO_FECHA_LONG);
                $model->pg_fecha_modificacion = date(FORMATO_FECHA_LONG);
                $model->pg_cod_usuario_ing_mod = Yii::app()->user->id;

                if ($model->save())
                    $this->redirect(array('view', 'id' => $model->pg_id));
            }
        }

        $this->render('create', array(
            'model' => $model,
        ));
    }

    /**
     * Updates a particular model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id the ID of the model to be updated
     */
    public function actionUpdate($id) {
        $model = $this->loadModel($id);

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['PeriodoGestionModel'])) {
            $model->attributes = $_POST['PeriodoGestionModel'];
            if ($model->save())
                $this->redirect(array('view', 'id' => $model->pg_id));
        }

        $this->render('update', array(
            'model' => $model,
        ));
    }

    /**
     * Deletes a particular model.
     * If deletion is successful, the browser will be redirected to the 'admin' page.
     * @param integer $id the ID of the model to be deleted
     */
    public function actionDelete($id) {
        $this->loadModel($id)->delete();

        // if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
        if (!isset($_GET['ajax']))
            $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
    }

    /**
     * Lists all models.
     */
    public function actionIndex() {
        $dataProvider = new CActiveDataProvider('PeriodoGestionModel');
        $this->render('index', array(
            'dataProvider' => $dataProvider,
        ));
    }

    /**
     * Manages all models.
     */
    public function actionAdmin() {
        $model = new PeriodoGestionModel('search');
        $model->unsetAttributes();  // clear any default values
        if (isset($_GET['PeriodoGestionModel']))
            $model->attributes = $_GET['PeriodoGestionModel'];

        $this->render('admin', array(
            'model' => $model,
        ));
    }

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer $id the ID of the model to be loaded
     * @return PeriodoGestionModel the loaded model
     * @throws CHttpException
     */
    public function loadModel($id) {
        $model = PeriodoGestionModel::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    /**
     * Performs the AJAX validation.
     * @param PeriodoGestionModel $model the model to be validated
     */
    protected function performAjaxValidation($model) {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'periodo-gestion-model-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

}
