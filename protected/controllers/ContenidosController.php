<?php

class ContenidosController extends Controller {

    /**
     * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
     * using two-column layout. See 'protected/views/layouts/column2.php'.
     */
    public $layout = '//layouts/column2';
    
    /**
     * @return array action filters
     */
    public function filters() {
        return array('accessControl',array('CrugeAccessControlFilter'));
    }

    /**
     * Specifies the access control rules.
     * This method is used by the 'accessControl' filter.
     * @return array access control rules
     */
    public function accessRules() {
         return array(
        );
    }

    public function obtenerComonentesMultimedia($idTaller, $tipo = "") {
        $multimedia = ImgVideosSonido::model()->with(array('multimedia' => array('alias' => 'multimedia')));
    }

    public function actionSubir_documento_adjunto()
    {
        
        $model = new  DocumentosAdjuntos;
        $f = $_FILES['file'];

        $datos=array(
                        'id_usuario_doc_adj'=>Yii::app()->user->getId(),
                        'nom_original_doc_adj'=>$f['name'],
                        'registro_doc_adj'=>file_get_contents($f['tmp_name']),
                        'extension_doc_adj'=>$f['type'],
                        'tamanio_doc_adj'=>$f['size'],
                    );

        $model->attributes=$datos;
        if($model->save()){
            echo json_encode(array('id'=>Yii::app()->db->getLastInsertID(), $f['name'])); 
        }
    }    

    public function actionDescargar_documento_adjunto()
    {

            header('Pragma: public');
            header('Expires: 0');
            header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
            header('Content-Transfer-Encoding: binary');
            header('Content-length: '.$val['tamanio_doc_adj']);
            header('Content-Type: '.$val['extension_doc_adj']);
            header('Content-Disposition: attachment; filename='.str_replace(' ','-',$val['nom_original_doc_adj']));
         
            echo $val['registro_doc_adj'];
    }

    public function actionEliminar_documento_adjunto()
    {
        $model = DocumentosAdjuntos::model()->deleteByPk(Yii::app()->request->getPost('cod'));
        if($model){
            echo "si";
        }else{
            echo "no";
        }
    }

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

        $model = new Contenidos();

        if (isset($_POST['Contenidos'])) {
            $model->attributes = $_POST['Contenidos'];

            
//            exit();
            if ($model->save()){
                       //tomar el ultimo id insrtado para insertart todos lo ocntenido de este usuario para ese contenido si hay.
                       Yii::app()->user->setFlash(
                            'success', "<strong>Exito!</strong> El contenido a sido agregado al taller exitosamente."
                        );
            }
        }else{
                $this->render('create', array(                    'model' => $model,
                ));
        }
    }
    
    /**
     * este método se encarga de cargar un nuevo contenido para un curso.
     * @author Oskar <oscarmesa.elpoli@gmail.com>
     */
    public function actionNuevoContedioMediaCurso()
    {
        $this->bootstrap = true;
        //$this->layout="//layouts/column4";
        $this->render('contedioMedia');
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

        if (isset($_POST['Contenidos'])) {
            $model->attributes = $_POST['Contenidos'];
            if ($model->save())
                $this->redirect(array('admin'));
        }

        $this->render('update', array(
            'model' => $model,
            'contenido' => $this,
        ));
    }

    /**
     * Deletes a particular model.
     * If deletion is successful, the browser will be redirected to the 'admin' page.
     * @param integer $id the ID of the model to be deleted
     */
    public function actionDelete($id) {
        if (Yii::app()->request->isPostRequest) {
            // we only allow deletion via POST request
            $model = $this->loadModel($id);
            $model->state_contenido = "inactive";
            $model->save();
            // if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
            if (!isset($_GET['ajax']))
                $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
        }
        else
            throw new CHttpException(400, 'Invalid request. Please do not repeat this request again.');
    }

    /**
     * Lists all models.
     */
    public function actionIndex() {
        $model = new Contenidos();
        $model->almacenado_total = TRUE;
        $model->state_contenido = "";
        $this->render('index', array(
            'dataProvider' => $model->search(),
        ));
    }

    /**
     * Manages all models.
     */
    public function actionAdmin() {
        $model = new Contenidos('search');
        $model->unsetAttributes();  // clear any default values
        $model->almacenado_total = TRUE;
        if (isset($_GET['Contenidos'])){
            $model->attributes = $_GET['Contenidos'];
            $model->id = $_GET['Contenidos']['id'];
        }
       // print_r($model->attributes );
        $this->render('admin', array(
            'model' => $model,
        ));
        
    }

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer the ID of the model to be loaded
     */
    public function loadModel($id) {
        $model = Contenidos::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    /**
     * Performs the AJAX validation.
     * @param CModel the model to be validated
     */
    protected function performAjaxValidation($model) {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'contenidos-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

}
