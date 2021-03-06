<?php
namespace app\controllers;

use Yii;
use yii\data\ActiveDataProvider;
use yii\db\Exception;
use yii\web\NotFoundHttpException;
use yii\web\UploadedFile;
use yii\data\ArrayDataProvider;
use yii\helpers\Html;
use yii\helpers\Url;
use app\models\Categoria;
use app\models\Importacion;
use app\models\Seleccion;

    class DatosGenealogicosController extends MainController{
    
        private $specialCharacters = ['.',',','-'];
    
        //render de la pagina principal
        public function actionIndex(){
            
            $collection = $this->getMongoCollection('Acervo'); //Acervo default collection
            $datos = $collection->find($this->getDefaultFilter());
    
            $html = $this->renderAjax('resultadosBusqueda', ['dataProvider' => $this->createMongoDataProvider($datos)]);
            
            return $this->render('index',['html' => $html ]);
        }
        
        //Obtengo la coleccion de mongo desde el nombre
        private function getMongoCollection($collectionName){
            $mongodb = Yii::$app->mongodb;
            $collection = $mongodb->getCollection($collectionName);
            return $collection;
            
        }
        
        //recibe un archivo Excel e importa los datos en la mongoDB
        public function actionImportacion(){
            $modelImportacion = new Importacion();
            if (!empty(Yii::$app->request->post())){ //Si me hacen un llamado post importo el excel a mi Mongodb
                try{
                    $modelImportacion->load(Yii::$app->request->post()); //Guardo los datos ingresados por el usuario
                    $modelImportacion->save();
                    $importacionID =  $modelImportacion->id;
                    $excelRows = $this->getExcelRows($modelImportacion);
                    if (empty($excelRows)){
                        throw new Exception('El archivo tiene que se un excel');
                    }
                    $collectionName = $modelImportacion->getNombreCategoria();
                    if  (!empty($collectionName)){
                        $collection = $this->getMongoCollection($collectionName);
                        foreach ($excelRows as $excelRow){
                            $mongoDocument = $this->prepareExcelRow($excelRow,$importacionID ,$modelImportacion->categoria_id);
                            if (!empty($mongoDocument))
                                $collection->insert($mongoDocument);
                        }
                        $documentos = $collection->find(['importacion_id' => $importacionID]);
                        $html = $this->renderAjax('importPreview',['importacion_id' => $importacionID , 'dataProvider' => $this->createMongoDataProvider($documentos)]);
                    }
                }catch (\Exception $e){
                    echo $e->getMessage();
                    $html =  "
                                <h3 style='font-style: italic; font-weight: bold; color: red;'>". "Ocurrio un error durante la importacion" ."</h3>
                                <p> El archivo debe ser un Excel y contener al menos una columna llamada Nombre. </p>
                            ";
                }

                return $this->render('indexImportacion',[
                    'modelImportacion' => $modelImportacion,
                    'html' => $html
                ]);
                
            }else{ //Si me hacen un llamado get renderizo la pantalla
                return $this->render('indexImportacion',['modelImportacion' => $modelImportacion]);
            }
        }
    
        function array_change_key_case_unicode($arr, $c = CASE_LOWER) {
            $c = ($c == CASE_LOWER) ? MB_CASE_LOWER : MB_CASE_UPPER;
            foreach ($arr as $k => $v) {
                $ret[mb_convert_case($k, $c, "UTF-8")] = $v;
            }
            return $ret;
        }
    
        //Preparo una fila de excel para que se pueda guardar despues en la mongoDB
        private function prepareExcelRow($excelRow,$importacionId,$categoriaId){
            $excelRow = $this->array_change_key_case_unicode($excelRow,CASE_LOWER);
            if (array_key_exists('nombre', $excelRow)){  //Me aseguro que tenga la columna nombre
                //if (array_key_exists('apellido',$excelRow)){
                    if (!empty($excelRow['nombre'])){             //Si el campo no es nulo guardo
                        $arrayKeys = array_keys($excelRow);
                        foreach ($arrayKeys as $arrayKey){
                            if ($arrayKey != 'nombre'){
                
                                foreach ($this->specialCharacters as $specialCharacter){
                                    if (strpos($arrayKey,$specialCharacter)){
                                        $newKey = str_replace($specialCharacter,'',$arrayKey);
                                        $excelRow[$newKey] = $excelRow[$arrayKey];
                                        unset($excelRow[$arrayKey]);
                                        $arrayKey =  $newKey;
                                    }
                                }
                
                                /*//CONVIERTO LOS ROW ASCII A UTF-8 POR PROBLEMAS DE CODIFICIACION AL IMPRIMIR POR HTML EL DATO
                                $excelRow[$arrayKey] = iconv("UTF-8","ASCII//TRANSLIT",$excelRow[$arrayKey]);   */
                                $NewArrayKey = iconv("UTF-8","ASCII//TRANSLIT",$arrayKey);
                                $NewArrayKey = strtolower($NewArrayKey);
                                
                                if (!empty($excelRow[$arrayKey])){
                                    if (!empty( $excelRow['detalle'])) {
                                        $excelRow['detalle'] =   $excelRow['detalle'].' '."<b>".ucfirst($NewArrayKey).': '."</b>".$excelRow[$arrayKey].' ';
                                        $excelRow['detalleFull'] =   $excelRow['detalleFull'].' '."<b>".ucfirst($NewArrayKey).': '."</b>".$excelRow[$arrayKey]."<br>";
                                    }
                                    else{
                                        $excelRow['detalle'] = "<b>".ucfirst($arrayKey).': '."</b>".$excelRow[$arrayKey].' ';
                                        $excelRow['detalleFull'] =  $excelRow['detalle']."<br>";
                                    }
                                }
                            }
                        }
                        $excelRow['importacion_id'] = $importacionId; //guardo el id de la importacion, asi se puede borrar
                        $excelRow['categoria_id'] = $categoriaId; //guardo el id de la categoria
        
                    }else{
                        $excelRow = null;
                    }
               /* }else{
                    throw new \Exception('Error: El archivo no contiene una columna llamada Apellido.');
                }*/
                
            }else{
                throw new \Exception('Error: El archivo no contiene una columna llamada Nombre.');
            }
            return $excelRow;
        }
        
        //render de modal de mail
        public function actionEnviarMail(){
            return $this->renderAjax('modalMail');
        }
        
        //Funcion que recibe los datos para mandar un mail que luego llama a "mandarMail"
        public function actionSendMail(){
            $email = Yii::$app->request->post('email');
            $persona = Yii::$app->request->post('destinatario');
            $descripcion = Yii::$app->request->post('detail');
            $informeCompleto = Yii::$app->request->post('informe');
            $response = ['result' => 'error', 'mensaje' => 'No se pudo enviar el mail'];
            $documentos = $this->findDocumentsSelected();
            
            if (empty($informeCompleto)){
                $response =  $this->mandarMail($documentos,$email,'InformeReducido',$persona,$descripcion);
            }else{
                $response = $this->mandarMail($documentos,$email,'InformeCompleto',$persona,$descripcion);
            }
            
            \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
            return $response;
        }
    
        //funcion que recibe los documentos, renderiza el template del mail y lo envia
        private function mandarMail($documentos,$clienteMail,$tipoMail,$destinatario,$detalle){
            $response = ['result' => 'error', 'mensaje' => 'Ocurrio un mail al enviar el mail'];
            try{
                if (!empty($documentos)){
                    $cuerpoHtml = $this->renderAjax($tipoMail,['documentos' => $documentos,'destinatario' => $destinatario,'detalle' => $detalle ]);
                    $mail = Yii::$app->mailer->compose()
                        ->setFrom('adiaz@qwavee.com')
                        ->setTo($clienteMail)
                        ->setTextBody('Museo Histórico Comunal y de la Colonización Judía')
                        ->setSubject('Envio de Datos Genealógicos')
                        ->setHtmlBody($cuerpoHtml);
        
                    if ($mail->send()){
                        $response = ['result' => 'ok', 'mensaje' => 'Se envío el mail correctamente'];
                    }
                }else{
                    $response = ['result' => 'error', 'mensaje' => 'No se seleccionaron documentos para enviar'];
                }
            }catch (Exception $e){
                
            }
           
            return $response;
        }
        
        //Creacion de filtro por defecto de busqueda
        private function getDefaultFilter($searchFeld=NULL){
            $filter = [];
            if (!empty($searchFeld)){
                $filterApellido = ['apellido' =>  new \MongoDB\BSON\Regex(".*$searchFeld*.", 'i'),];
                $filterNombre =['nombre' =>  new \MongoDB\BSON\Regex(".*$searchFeld*.", 'i'),];
                $filter = ['$or' => [$filterNombre,$filterApellido]];
            }
            return $filter;
        }
        
        //Funcion privada de busqueda de documentos por categoria
        private function filterSearch($searchFeld,$collectionID){
            try{
                if (!empty($collectionID)){
                    $collectionName = Categoria::find()->where(['id' => $collectionID])->one();
                    if (!empty($collectionName)){
                        $mongodb = Yii::$app->mongodb;
                        $collection = $mongodb->getCollection($collectionName->descripcion);
                        $filter = $this->getDefaultFilter($searchFeld);
                        if  (!empty($collection)){
                            if (!empty($collection->count($filter))){
                                $datos = $collection->find($filter);
                                $html = $this->renderAjax('resultadosBusqueda', ['dataProvider' => $this->createMongoDataProvider($datos)]);
                                $response = ["result" => "ok", "mensaje" => "Se encontraron resultados en {$collectionName->descripcion}", 'info' => $html ];
                            }else{
                                $html = $this->renderAjax('resultadosBusqueda', ['mensaje' => 'No se encontraron datos en la busqueda']);
                                $response = ["result" => "error", "mensaje" => "No se encontraron resultados en {$collectionName->descripcion}", 'info' => $html ];
                            }
                        }else{
                            throw new Exception('No se encontraron datos en '.$collectionName->descripcion);
                        }
                    }else{
                        throw new Exception('No se encontro una categoria con ese id ');
                    }
                }else{
                    throw new Exception('No llego el id de la categoria');
                }
            }catch (Exception $e){
                $response = ["result" => "error", "mensaje" => $e->getMessage()];
            }
            return $response;
        }
        
        //Accion llamada desde el index que busca los documentos en la mongoDB
        public function actionBuscar(){
            try{
                $searchFeld = Yii::$app->request->get('q');
                $collectionID = Yii::$app->request->get('id');
                $response = $this->filterSearch($searchFeld,$collectionID);
                $count = $this->buscarInAllCollections($searchFeld);
                $response['count'] = $count;
            }catch (\Exception $e){
                $response = ['result' => 'error', 'mensaje' => 'Ocurrio un error durante la busqueda'];
            }
            mb_convert_encoding($response['info'], 'UTF-8', 'UTF-8');
            \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
            return $response;
        }
    
        function folder_exist($folder)
        {
            // Get canonicalized absolute pathname
            $path = realpath($folder);
        
            // If it exist, check if it's a directory
            return ($path !== false AND is_dir($path)) ? $path : false;
        }
        
        //Guardo archivo subido y obtengo todas las tupls del excel, para despues guardarlas en la mongodb
        private function getExcelRows($model){
            $reponse = null;
            $excelRows = null;
            $Excel = UploadedFile::getInstances($model,'excelFile');
            $Excel = $Excel[0];
            if (!empty($Excel)){
                $fileName = $this->changeFileName($Excel->name);
                $fileName = strtolower($fileName);
                $path =   Yii::getAlias('@webroot').'/ExcelFiles/'.$fileName;
                if (strpos($fileName, 'xls')){
                    if (!$this->folder_exist(Yii::getAlias('@webroot').'/ExcelFiles/')){
                        mkdir(Yii::getAlias('@webroot').'/ExcelFiles/',0700);
                    }
    
                    if  ($Excel->saveAs($path,true)){
                        $excelRows = \moonland\phpexcel\Excel::import($path);
                        if (!empty($excelRows[0])){
                            $excelRows = $excelRows[0];
                        }
                    }
                }
                if (!empty($excelRows)){
                    $reponse = $excelRows;
                }
            }
           
            return $reponse;
        }
        
        //Cambio el nombre los excel para guardalos
        private function changeFileName($fileName){
            $nameOfFile = explode(".", $fileName);
            $ext = end($nameOfFile);
            $fecha = new \DateTime();
            $filename = "{$fecha->getTimestamp()}.{$ext}";
            return  $filename;
        }
        
        //Borra los datos de importacion segund id
        public function actionCancelarImportacion(){
            $response = ['rta'=>'error', 'message'=> 'No se pudo cancelar la importacion'];
            $import_id = Yii::$app->request->get('id');
            if (!empty($import_id)){
                $importacion = Importacion::find()->where(['id' => $import_id])->one();
                $collectionName = $importacion->getNombreCategoria();
                $mongodb = Yii::$app->mongodb;
                $collection = $mongodb->getCollection($collectionName);
                $documentos = $collection->find(['importacion_id' => (int) $import_id ]);
                
                foreach ($documentos as $documento){
                    $collection->remove(['_id' => $documento['_id']]);
                }
                $response = ['rta'=>'ok', 'message'=>'Se cancelo lo importacion correctamente'];
            }
    
           \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
           return $response;
        }
        
        //Crea el DataProvider para mostrar datos de los documentos de mongodb
        private function createMongoDataProvider($documents){ //Creo un Data Provider para un gridview
            $colums = ['nombre','detalle','_id','importacion_id'];
            $columnas = [];
            foreach ($documents as $key=>$document) {
                $arr[] = $document;
            }
            foreach ($colums as $colum){
                if ($colum == '_id'){
                    $columnas[1] = [
                        'label'=> 'Selección',
                        'attribute' => '_id',
                        'headerOptions' => ['style' => 'width:7%'],
                        'format' => 'raw',
                        'value'=>function ($data) {
                            $exist = Seleccion::find()->where([
                                    'documento_id' => $data['_id'], 'session' => Yii::$app->session->getId()])->one();
                            $value = false;
                            if (!empty($exist)){
                                $value = true;
                            }
                            return Html::checkbox('checkbox', $value , [
                                'class'=>'btn btn-info btn-xs seleccionDocumento',
                                'categoria_id' => $data['categoria_id'],
                                'documentNombre' => $data['nombre'],
                                'document_id' =>$data['_id'],
                                'url' => Url::to(['datos-genealogicos/seleccionar-documentos'])
                            ]);
                        }
                    ];
                }else if ($colum == 'importacion_id'){
                    $columnas[4] = [
                        'label' => 'Nro. Imprt',
                        'attribute' => 'importacion_id'
                    ];
                }else if ($colum == 'detalle') {
                    $columnas[3] = [
                        'label' => 'Detalle',
                        'attribute' => 'detalle',
                        'format' => 'raw',
                        'value'=>function ($data) {
                            if (!empty($data['detalle'])){
                                $response = $data['detalle'];
                                if (strlen($response) > 90){
                                    $response = substr($response,0,87).' ...';
                                }
                                return $response ;
                            }
                            
                        }
                    ];
                }else{
                        $columnas[2] = [
                                'label' => 'Nombre',
                                'attribute' => 'nombre',
                                'headerOptions' => ['style' => 'width:7%'],
                        ];
                    }
                }
            
            //COLUMNA DETALLE
            $columnas[5] = [
                'attribute' => '_id',
                'label' => 'Más',
                'format' => 'raw',
                'value'=>function ($data) {
                    return Html::a("<i class='fa fa-eye'></i>", null ,[
                        'title' => Yii::t('app', 'Detalle'),
                        'class'=>'btn btn-info btn-xs detalleDocumento',
                        'url' => Url::to(['datos-genealogicos/render-modal',
                            'documento_id' =>$data['_id'],
                            'categoria_id' => $data['categoria_id'],
                        ])
                    ]);
                },
            ];
            
            $provider = null;
            if (!empty($arr))
                $provider = new ArrayDataProvider([
                    'allModels' => $arr,
                    'pagination' => false,
                    'sort' => [
                        'attributes' => $columnas,
                    ],
                ]);
            
            return ['dataProvider' => $provider, 'columns' => $columnas ];
        }
        
        //Devuelve un documento Mongo dado una categoria e ID
        public function getDocument($categoriaID,$documentID){
            $categoria = Categoria::find()->where(['id' => $categoriaID ])->one();
            $collectionName =  $categoria->descripcion;
            $mongodb = Yii::$app->mongodb;
            $collection = $mongodb->getCollection($collectionName);
            $mongoId = new \MongoDB\BSON\ObjectID($documentID);
            $datos = $collection->find(['_id' => $mongoId]);
            return $datos;
        }
        
        //Funcion que selecciona y deselecciona documentos de la tabla seleccion
        public function actionSeleccionarDocumentos(){
            $response = ["result" => "error", "mensaje" => "ocurio un error"];
            $session = Yii::$app->session->getId();
            $documentID = Yii::$app->request->post('document_id');
            $categoria_id = (int) Yii::$app->request->post('categoria_id');
            $documentNombre =  Yii::$app->request->post('documentNombre');
            $accion = (int) Yii::$app->request->post('accion');  // if accion = 1, tupla seleccionada. if accion = 0, tupla deseleccionada
            if ($accion == 0){
                $tupla = Seleccion::find()->where(['session' => $session, 'documento_id' => $documentID, 'categoria_id' => $categoria_id ])->one();
                if ($tupla->delete())
                    $response = ["result" => "ok", "mensaje" => "Se elimino el documento de la seleccion"];
            }else if ($accion == 1){
                $seleccion = new Seleccion();
                $seleccion->session = $session;
                $seleccion->documento_id = $documentID;
                $seleccion->nombre = $documentNombre;
                $seleccion->categoria_id = $categoria_id;
                $seleccion->save();
                $response = ["result" => "ok", "mensaje" => "Se agrego el documento a la seleccion"];
            }
            \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
            return $response;
        }
        
        //Render del Modal de Detalle de documento MongoDB
        public function actionRenderModal(){
            $categoriaID = Yii::$app->request->get('categoria_id');
            $documentID = Yii::$app->request->get('documento_id');
            $documento = $this->getDocument($categoriaID,$documentID['oid']);
            $html = $this->renderAjax('modalDetalle',['mongoDocument' => $documento]);
            $response = ["result" => "ok", "html_seleccion" => $html];
            return $html;
        }
    
        //Busca en la tabla seleccion que documentos fueron seleccionados durante la session y los devuelve
        private function findDocumentsSelected(){
            $documents = [];
            $seleccionados = Seleccion::find()->where(['session' => Yii::$app->session->getId() ])->all();
            foreach ($seleccionados as $seleccion){
                $documents[] = $this->getDocument($seleccion->categoria_id,$seleccion->documento_id);
            }
            return $documents;
        }
        
        //Funcion que cuenta la cantidad de registro por categoria
        private function buscarInAllCollections($searchFeld){
            $mongodb = Yii::$app->mongodb;
            $categorias = Categoria::find()->all();
            $count = [];
            foreach ($categorias as $categoria){
                $collection = $mongodb->getCollection($categoria->descripcion);
                $filter =   $this->getDefaultFilter($searchFeld);
                $count['cat'.$categoria->id] = $collection->count($filter);
            }
            return $count;
        }
        
        //Funcion que crea nuevas categorias
        public function actionAgregarCat(){
            $nombreCategoria = Yii::$app->request->get('nombreCategoria');
            $response = ['result' => 'error', 'mensaje' => 'No se pudo agregar la categoria'];
            if (!empty($nombreCategoria)){
                $categoria = new Categoria();
                $categoria->descripcion = $nombreCategoria;
                if ($categoria->save()){
                    $response = ['result' => true, 'mensaje' => 'Se agrego la categoria corectamente'];
                    \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
                    return $response;
                }
            }else{
                $html = $this->renderAjax('modalCategoria');
                return $html;
            }
        }
        
        public function prepareDocument($document,$origin){
            $response = false;
            $collectionName = Categoria::find()->where(['id' => $origin])->one();
            $collection = $this->getMongoCollection($collectionName['descripcion']);
            
            try{
                $mongoDocument = $this->prepareExcelRow($document,99 , $origin);
                if (!empty($mongoDocument)) {

                    if ($collection->insert($mongoDocument)) {
                        $response = TRUE;
                    }
                }
            }catch (\Exception $e){
                echo "<p style='color: red'>  <br /> No se pudo migrar el documento </p>\n";
                echo $e->getMessage();
            }
            
            return $response;
        }
        
        public function actionImportarcsv(){
    
            $document = [];
            $config = ['columna' => 0, 'resultado' => 1, 'tupla' => 2, 'cod' => 4];
    
            $lastTupla = 0;
            $lastOrigen = '';
            $cont = 0;
            try {
                $handle  = fopen(Yii::getAlias('@webroot').'/csv/cat46.csv','r');
                $length = 0;
                $delimiter = ",";
                while (($csv = fgetcsv ( $handle,  $length ,  $delimiter)) !== FALSE ){
            
                    if ($cont > 0  ){    //193813   - 261947
                        if (array_key_exists($config['tupla'],$csv)){
                            if ($csv[$config['tupla']] !== $lastTupla){
                                $lastTupla =  $csv[$config['tupla']];
        
                                if ($cont > 1){
                                    $this->prepareDocument($document,$lastOrigen); // Inserto el documento en la mongo db, buscando a que categoria corresponde segun el origen
                                }
    
                                if (array_key_exists($config['cod'],$csv)){
                                    
                                    if ($lastOrigen !== $csv[$config['cod']]){
                                        $lastOrigen = $csv[$config['cod']];
                                        $mensaje = $csv[3];
                                    }
                                }
                                
        
                                echo "<p style='color: red'>  <br /> $cont </p>\n";
                                $document = [];
                            }
    
                            $document[$csv[$config['columna']]] = $csv[$config['resultado']];
                        }
                       
                    }
                    
                    $cont++;
                }
        
            } catch (Exception $e){
                echo $e->getMessage();
            }
    
            fclose($handle);
    
    
        }
    
    }