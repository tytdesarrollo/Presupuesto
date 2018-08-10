<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;
use PDO;
use app\models\LoginForm;
use app\models\ContactForm;
use app\models\TwPcReporteEIR;
use app\models\TwPcReporteSQL;
use app\models\SpReportesMain;
use app\models\SpReportesConsolidadoVigencia;
use app\models\SpReportesFiltroMes;
use app\models\SpReportesAnticipo;
use app\models\SpRecomposicionPresupuesto;
use app\models\SpCabeceraReportes;
use app\models\SpFuerza;
use app\models\SpModalidad;
use app\models\SpVigencia;
use app\models\SpEsm;
use app\models\SpInsertAutPagos;
use app\models\SpInsertReduc;
use app\models\SpInsertAdi;

class SiteController extends Controller
{
	public function actionPrueba()
    {

		$this->layout=false;

	   return $this->render('prueba');
    }

    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    public function actionIndex()
    {
		//--------------------------Ejecucion del procedimiento ------------------------------------
        // creaa el objeto
        $model = new SpReportesMain;
        // ejecutamos el procedimiento
        $spreportesmain = $model->procedimiento();  
        //--------------------------Ejecucion del procedimiento ------------------------------------
        
        //tamano del array retornado por el procedimiento 
        $tamano = count($spreportesmain);
        //saco el total
        $total = $spreportesmain[0]['TOTAL']; 
        $total = number_format($total, 2, ',', '.');
        //los totales de la tabla 
        $totalarr = $spreportesmain[$tamano-1];
        //elimino los totales de la consulta general
        unset($spreportesmain[$tamano-1]);
		
		//genero la sesion
		$clave = round($spreportesmain[0]['ENCRIP']); 
		
		if($clave==1){
			
			Yii::$app->session['sesion'] = Yii::$app->request->get('cx');     
		
		}
		
		if(isset(Yii::$app->session['sesion'])){
			
			 return $this->render('index',["spreportesmain"=>$spreportesmain, "total"=>$total, "totalarr"=>$totalarr]); 
		
		}else{
		
		return $this->redirect(['site/salida']);
		
		}
    }

    public function actionSalida()
    {
		
		Yii::$app->session['sesion'];
			
		Yii::$app->session->destroy();
		
		 $this->layout=false;
        
		 return $this->render('logout');
    }

    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])) {
            Yii::$app->session->setFlash('contactFormSubmitted');

            return $this->refresh();
        }
        return $this->render('contact', [
            'model' => $model,
        ]);
    }

    public function actionSeleccion()
    {
		$this->layout='main_seleccion';
        return $this->render('seleccion');
    }

	public function actionAdiciones()
    {
		
				$this->layout='main_mant';
				
		$model = new SpModalidad;
		$model2 = new SpVigencia;
		$model3 = new SpFuerza;

		$spmodalidad = $model->procedimiento();
		$spvigencia = $model2->procedimiento();
		$spfuerza = $model3->procedimiento();

		
			foreach($spmodalidad as $spmodalidadarr):
			endforeach;
			foreach($spvigencia as $spvigenciaarr):
			endforeach;
			foreach($spfuerza as $spfuerzaarr):
			endforeach;		

			if(isset(Yii::$app->session['sesion'])){
			
        return $this->render('adiciones',["MODALIDAD"=>$spmodalidadarr,"VIGENCIA"=>$spvigenciaarr,"FUERZA"=>$spfuerzaarr]);
		
			}else{
						
			Yii::$app->session['sesion'];
			
			Yii::$app->session->destroy();
		
		return $this->redirect(['site/salida']);
		
		}
    }

	public function actionReducciones()
    {
		$this->layout='main_mant';
				
		$model = new SpModalidad;
		$model2 = new SpVigencia;
		$model3 = new SpFuerza;

		$spmodalidad = $model->procedimiento();
		$spvigencia = $model2->procedimiento();
		$spfuerza = $model3->procedimiento();

		
			foreach($spmodalidad as $spmodalidadarr):
			endforeach;
			foreach($spvigencia as $spvigenciaarr):
			endforeach;
			foreach($spfuerza as $spfuerzaarr):
			endforeach;		

			if(isset(Yii::$app->session['sesion'])){
			
        return $this->render('reducciones',["MODALIDAD"=>$spmodalidadarr,"VIGENCIA"=>$spvigenciaarr,"FUERZA"=>$spfuerzaarr]);
		
		}else{
						
			Yii::$app->session['sesion'];
			
			Yii::$app->session->destroy();
		
		return $this->redirect(['site/salida']);
		
		}
    }

	public function actionAutopago()
    {
		$this->layout='main_mant';
				
		$model = new SpModalidad;
		$model2 = new SpVigencia;
		$model3 = new SpFuerza;

		$spmodalidad = $model->procedimiento();
		$spvigencia = $model2->procedimiento();
		$spfuerza = $model3->procedimiento();

		
			foreach($spmodalidad as $spmodalidadarr):
			endforeach;
			foreach($spvigencia as $spvigenciaarr):
			endforeach;
			foreach($spfuerza as $spfuerzaarr):
			endforeach;		

			if(isset(Yii::$app->session['sesion'])){
			
        return $this->render('autopago',["MODALIDAD"=>$spmodalidadarr,"VIGENCIA"=>$spvigenciaarr,"FUERZA"=>$spfuerzaarr]);
		
		}else{
						
			Yii::$app->session['sesion'];
			
			Yii::$app->session->destroy();
		
		return $this->redirect(['site/salida']);
		
		}
    }

	public function actionPresupuesto()
    {
		/*
        $model = new TwPcReporteEIR;

        $twpcreporteeir = $model->ReporteEIR();

        $RAZON_SOCIAL = $twpcreporteeir[1];
        $CABEZERA = explode("_*", $twpcreporteeir[2]);
        return $this->render('presupuesto',["RAZON_SOCIAL"=>$RAZON_SOCIAL, "CABEZERA"=>$CABEZERA]);
         */
        
        if(!isset($mensaje)){
            $mensaje = false;
        }
        

        $model1 = new SpCabeceraReportes;

        //------------------cabecera de la vista-----------------------        
        $resultados1 = $model1->procedimiento2();

        foreach ($resultados1 as $key) {
            $nombre = $key['EMPCOD'];
            $nit = $key['NIT'];
        }
        //------------------cabecera de la vista-----------------------
        //
        //------------------opciones posibles del formulario -----------------------
        //Opciones de fuerza
        $fuerza = $model1->procedimiento3(1);
        //opciones de modalidad
        $modalidad = $model1->procedimiento3(2);
        //opcion de vigencia
        $vigencia = $model1->procedimiento3(3);
        //------------------opciones posibles del formulario -----------------------

		if(isset(Yii::$app->session['sesion'])){
		
        $this->layout='main_rep';        
        return $this->render('presupuesto',["nombre"=>$nombre, "nit"=>$nit, "fuerza"=>$fuerza, "modalidad"=>$modalidad, "vigencia"=>$vigencia,
                                            "mensaje"=>$mensaje]);
											
		}else{
						
			Yii::$app->session['sesion'];
			
			Yii::$app->session->destroy();
		
		return $this->redirect(['site/salida']);
		
		}
    }
	public function actionExcel()
    {
		if(Yii::$app->request->get('optionsRadios')=='option1'){
            // datos del formulario 
            $from = Yii::$app->request->get('from');
            $to = Yii::$app->request->get('to');
            $vigencia = Yii::$app->request->get('vigencia');
            $modalidad = Yii::$app->request->get('modalidad');
            $fuerza = Yii::$app->request->get('codFrz');

            return $this->redirect(['site/ejecucioningresos', "from"=>$from, "to"=>$to,"vigencia"=>$vigencia,"modalidad"=>$modalidad,"codFrz"=>$fuerza]);
        
        }elseif(Yii::$app->request->get('optionsRadios')=='option2'){
            // datos del formulario 
            $from = Yii::$app->request->get('from');
            $to = Yii::$app->request->get('to');
            $vigencia = Yii::$app->request->get('vigencia');
            $modalidad = Yii::$app->request->get('modalidad');
            $fuerza = Yii::$app->request->get('codFrz');

            return $this->redirect(['site/excelconsolvig', "from"=>$from, "to"=>$to,"vigencia"=>$vigencia,"modalidad"=>$modalidad,"codFrz"=>$fuerza]);

        }elseif(Yii::$app->request->get('optionsRadios')=='option3'){
            // no necesita fuerza ni modalidad
            // datos del formulario 
            $from = Yii::$app->request->get('from');
            $to = Yii::$app->request->get('to');
            $vigencia = Yii::$app->request->get('vigencia');
            $modalidad = '';
            $fuerza = '';

            return $this->redirect(['site/excelpresupuestantic', "from"=>$from, "to"=>$to,"vigencia"=>$vigencia,"modalidad"=>$modalidad,"codFrz"=>$fuerza]);

        }elseif(Yii::$app->request->get('optionsRadios')=='option4'){
            // datos del formulario 
            $from = Yii::$app->request->get('from');
            $to = Yii::$app->request->get('to');
            $vigencia = Yii::$app->request->get('vigencia');
            $modalidad = Yii::$app->request->get('modalidad');
            $fuerza = Yii::$app->request->get('codFrz');

            return $this->redirect(['site/excelpresupuestfiltro', "from"=>$from, "to"=>$to,"vigencia"=>$vigencia,"modalidad"=>$modalidad,"codFrz"=>$fuerza]);
        }
    }
	public function actionEjecucioningresos()
    {
        /*$this->layout=false;

        $model = new TwPcReporteEIR;

        $twpcreporteeir = $model->ReporteEIR();

        $BLOQUE1 = $twpcreporteeir[0];
        $RAZON_SOCIAL = $twpcreporteeir[1];
        $IN_PERIODO1 = $twpcreporteeir[3];
        $IN_PERIODO2 = $twpcreporteeir[4];
        $BLOQUE_F = explode("#", $twpcreporteeir[5]);
        $BLOQUE_H = explode("#", $twpcreporteeir[6]);
        $CABEZERA = explode("_*", $twpcreporteeir[2]);

        foreach ($BLOQUE1 as $BLOQUE1_KEY) {
            $BLOQUE1_ARR[] = $BLOQUE1_KEY['RUBRO'];
            $BLOQUE2_ARR[] = $BLOQUE1_KEY['DESCRIPCION'];
            $BLOQUE3_ARR[] = $BLOQUE1_KEY['PRESU_INI'];
            $BLOQUE4_ARR[] = $BLOQUE1_KEY['ADICIONES'];
            $BLOQUE5_ARR[] = $BLOQUE1_KEY['REDUCCIONES'];
            $BLOQUE6_ARR[] = $BLOQUE1_KEY['PRESU_DEFI'];
            $BLOQUE7_ARR[] = $BLOQUE1_KEY['AUT_PAGOS'];
            $BLOQUE8_ARR[] = $BLOQUE1_KEY['SALDO_EJECU'];
        }

    return $this->render('excelejecucioningreso',["RAZON_SOCIAL"=>$RAZON_SOCIAL, "CABEZERA"=>$CABEZERA, "BLOQUE1_ARR"=>$BLOQUE1_ARR, "BLOQUE2_ARR"=>$BLOQUE2_ARR, "BLOQUE3_ARR"=>$BLOQUE3_ARR, "BLOQUE4_ARR"=>$BLOQUE4_ARR, "BLOQUE5_ARR"=>$BLOQUE5_ARR, "BLOQUE6_ARR"=>$BLOQUE6_ARR, "BLOQUE7_ARR"=>$BLOQUE7_ARR, "BLOQUE8_ARR"=>$BLOQUE8_ARR,"IN_PERIODO1"=>$IN_PERIODO1,"IN_PERIODO2"=>$IN_PERIODO2, "BLOQUE_F"=>$BLOQUE_F, "BLOQUE_H"=>$BLOQUE_H]);*/
        //---------------------------------------CABECERA REPORTE----------------------------------------
        $model1 = new SpCabeceraReportes;
        $opcion = 'OPCION1';
        $fechaIni =  Yii::$app->request->get('from');
        $fechaFin =  Yii::$app->request->get('to');
        $vigencia =  Yii::$app->request->get('vigencia');
        $fuerza =    Yii::$app->request->get('codFrz');
        $modalidad = Yii::$app->request->get('modalidad');

        $cabRecompPresu = $model1->procedimiento($opcion,$fechaIni,$fechaFin,$vigencia,$fuerza,$modalidad);
        //---------------------------------------CABECERA REPORTE----------------------------------------


        //---------------------------------------CUERPO REPORTE----------------------------------------
        // declara el objeto 
        $model = new SpRecomposicionPresupuesto;
        //ejecuta el procedimiento 
        $spPresuRecomp = $model->procedimiento($fechaIni,$fechaFin,$vigencia,$fuerza,$modalidad);  
        // saber si la consulta trae resultados
        $tamano = count($spPresuRecomp);
        // si es diferente de cero genera el reporte
        if($tamano !== 0){
            //se obtienen los nombre de las columnas oara leer la consulta
            $columnas = explode("*_",$spPresuRecomp[0]['NOMBRES_COLUMNAS']);
            //cantidad de columnas por leer
            $cantidad = count($columnas);
            //se reemplazan los nombres por los que van siempre fijos en excel
            $nombreColExc = $columnas;
            $nombreColExc[0] = 'ESTABLECIMIENTO DE SANIDAD MILITAR';
            $nombreColExc[1] = 'PRESUPUESTO INICIAL';
            $nombreColExc[$cantidad-1] = 'PRESUPUESTO FINAL';

            $this->layout=false;
            return $this->render('excelejecucioningreso',["spPresuRecomp"=>$spPresuRecomp,"columnas"=>$columnas,"cantidad"=>$cantidad,
                                                          "nombreColExc"=>$nombreColExc,"cabRecompPresu"=>$cabRecompPresu]);
        }else{
            $mensaje = 1;

            $this->layout=false;
            return $this->redirect(['site/presupuesto',"mensaje"=>$mensaje]);
        }        
        //---------------------------------------CUERPO REPORTE----------------------------------------
    }
	
	public function actionExcelconsolvig()
    {
		//---------------------------------------CABECERA REPORTE----------------------------------------
        $model1 = new SpCabeceraReportes;
        $opcion = 'OPCION2';
        $fechaIni =  Yii::$app->request->get('from');
        $fechaFin =  Yii::$app->request->get('to');
        $vigencia =  Yii::$app->request->get('vigencia');
        $fuerza =    Yii::$app->request->get('codFrz');
        $modalidad = Yii::$app->request->get('modalidad');
        $cabConsVigen = $model1->procedimiento($opcion,$fechaIni,$fechaFin,$vigencia,$fuerza,$modalidad);
        //---------------------------------------CABECERA REPORTE----------------------------------------


        //---------------------------------------CUERPO REPORTE----------------------------------------
        //$this->layout=false;      
        $model = new SpReportesConsolidadoVigencia;

        $spreportesconvig = $model->procedimiento($fechaIni,$fechaFin,$vigencia,$fuerza,$modalidad);    
         // saber si la consulta trae resultados
        $tamano = count($spreportesconvig);
        // si es diferente de cero genera el reporte
        if($tamano !== 0){
            //se obtienen los nombre de las columnas oara leer la consulta
            $columnas = explode("*_",$spreportesconvig[0]['NOMBRES_COLUMNAS']);
            //cantidad de columnas por leer
            $cantidad = count($columnas);
            //se reemplazan los nombres por los que van siempre fijos en excel
            $nombreColExc = $columnas;
            $nombreColExc[0] = 'ESTABLECIMIENTO DE SANIDAD MILITAR';
            $nombreColExc[1] = 'DESCRIPCIÓN';
            $nombreColExc[2] = 'PRESUPUESTO INICIAL';
            $nombreColExc[3] = 'ADICIONES';
            $nombreColExc[4] = 'REDUCCIONES';
            $nombreColExc[5] = 'PRESUPUESTO DEFINITIVO';
            $nombreColExc[$cantidad-3] = 'TOTAL AUTORIZADO';
            $nombreColExc[$cantidad-2] = 'SALDO POR EJECUTAR';
            $nombreColExc[$cantidad-1] = 'PROYECCIÓN';
            //---------------------------------------CUERPO REPORTE----------------------------------------
        
            $this->layout=false;
            return $this->render('excelconsolvig',["spreportesconvig"=>$spreportesconvig,"columnas"=>$columnas,"cantidad"=>$cantidad,
                                                   "nombreColExc"=>$nombreColExc,"cabConsVigen"=>$cabConsVigen]);
        }else{
            $mensaje = 1;

            $this->layout=false;
            return $this->redirect(['site/presupuesto',"mensaje"=>$mensaje]);
        }
    }
		
	public function actionExcelpresupuestantic()
    {
		//---------------------------------------CABECERA REPORTE----------------------------------------
        $model1 = new SpCabeceraReportes;
        $opcion = 'OPCION3';
        $fechaIni =  Yii::$app->request->get('from');
        $fechaFin =  Yii::$app->request->get('to');
        $vigencia =  Yii::$app->request->get('vigencia');
        $fuerza = '';
        $modalidad = '';
        $cabPresAntic = $model1->procedimiento($opcion,$fechaIni,$fechaFin,$vigencia,$fuerza,$modalidad);
        //---------------------------------------CABECERA REPORTE----------------------------------------       
        

        //---------------------------------------CUERPO REPORTE----------------------------------------
         // declara el objeto 
        $model = new SpReportesAnticipo;
        //ejecuta el procedimiento 
        $spReporAnt = $model->procedimiento($fechaIni,$fechaFin,$vigencia);  
         // saber si la consulta trae resultados
        $tamano = count($spReporAnt);
        // si es diferente de cero genera el reporte
        if($tamano !== 0){
            //se obtienen los nombre de las columnas oara leer la consulta
            $columnas = explode("*_",$spReporAnt[0]['NOMBRES_COLUMNAS']);
            //cantidad de columnas por leer
            $cantidad = count($columnas);
            //se reemplazan los nombres por los que van siempre fijos en excel
            //$nombreColExc = array('NUMERO AUTORIZACIÓN','ESM', 'AMORTIZACIÓN','FECHA','SALDO POR AMORTIZAR','MES FACTURADO');
            $nombreColExc = array('NUMERO AUTORIZACIÓN','ESM', 'AMORTIZACIÓN','FECHA','MES FACTURADO');
            //---------------------------------------CUERPO REPORTE----------------------------------------

            $this->layout=false;
            return $this->render('excelpresupuestantic',["spReporAnt"=>$spReporAnt,"columnas"=>$columnas,"cantidad"=>$cantidad,
                                                          "nombreColExc"=>$nombreColExc,"cabPresAntic"=>$cabPresAntic]);
        }else{
            $mensaje = 1;

            $this->layout=false;
            return $this->redirect(['site/presupuesto',"mensaje"=>$mensaje]);
        }
    }
			
	public function actionExcelpresupuestfiltro()
    {
		//---------------------------------------CABECERA REPORTE----------------------------------------
        $model1 = new SpCabeceraReportes;
        $opcion = 'OPCION4';
        $fechaIni =  Yii::$app->request->get('from');
        $fechaFin =  Yii::$app->request->get('to');
        $vigencia =  Yii::$app->request->get('vigencia');
        $fuerza =    Yii::$app->request->get('codFrz');
        $modalidad = Yii::$app->request->get('modalidad');
        $cabFiltroMes = $model1->procedimiento($opcion,$fechaIni,$fechaFin,$vigencia,$fuerza,$modalidad);
        //---------------------------------------CABECERA REPORTE----------------------------------------


        //---------------------------------------CUERPO REPORTE----------------------------------------
        // declara el objeto 
        $model = new SpReportesFiltroMes;
        //ejecuta el procedimiento 
        $spPreosuFil = $model->procedimiento($fechaIni,$fechaFin,$vigencia,$fuerza,$modalidad);  
         // saber si la consulta trae resultados
        $tamano = count($spPreosuFil);
        // si es diferente de cero genera el reporte
        if($tamano !== 0){
            //se obtienen los nombre de las columnas oara leer la consulta
            $columnas = explode("*_",$spPreosuFil[0]['NOMBRES_COLUMNAS']);
            //cantidad de columnas por leer
            $cantidad = count($columnas);
            //se reemplazan los nombres por los que van siempre fijos en excel
            $nombreColExc = $columnas;
            $nombreColExc[0] = 'ESTABLECIMIENTO DE SANIDAD MILITAR';
            $nombreColExc[1] = 'DESCRIPCIÓN';
            $nombreColExc[2] = 'PRESUPUESTO INICIAL';
            $nombreColExc[3] = 'ADICIONES';
            $nombreColExc[4] = 'REDUCCIONES';
            $nombreColExc[5] = 'PRESUPUESTO DEFINITIVO';
            $nombreColExc[$cantidad-3] = 'TOTAL AUTORIZADO';
            $nombreColExc[$cantidad-2] = 'SALDO POR EJECUTAR';
            $nombreColExc[$cantidad-1] = 'PROYECCIÓN';

            $nombres = $model->nombreFiltroMes($nombreColExc);
            $nombreColExc = $nombres[0];
            $NombreColExc2 = $nombres[1];
            //---------------------------------------CUERPO REPORTE----------------------------------------


            $this->layout=false;
            return $this->render('excelpresupuestfiltro',["spPreosuFil"=>$spPreosuFil,"columnas"=>$columnas,"cantidad"=>$cantidad,
                                                          "nombreColExc"=>$nombreColExc,"NombreColExc2"=>$NombreColExc2,
                                                          "cabFiltroMes"=>$cabFiltroMes]);
        }else{
            $mensaje = 1;

            $this->layout=false;
            return $this->redirect(['site/presupuesto',"mensaje"=>$mensaje]);
        }
    }
	
	public function actionGuardarautorizacionpago()
    {   

        $c1  = Yii::$app->request->get('numdoc');
        $c2  = Yii::$app->request->get('fecmov');
        $c3  = Yii::$app->request->get('fecaut');
        $c4  = Yii::$app->request->get('fuerza');
        $c5  = Yii::$app->request->get('modalidad');
        $c6  = Yii::$app->request->get('vigencia');
        $c7  = Yii::$app->request->get('esm');
        $c8  = Yii::$app->request->get('autpag');
        $c9  = Yii::$app->request->get('autant');
        $c10 = Yii::$app->request->get('mesfac');
        $model = new SpInsertAutPagos;
        $insertAutPag = $model->procedimiento($c1,$c2,$c3,$c4,$c5,$c6,$c7,$c8,$c9,$c10);   
        
        //echo $c1." - ".$c2." - ".$c3." - ".$c4." - ".$c5." - ".$c6." - ".$c7." - ".$c8." - ".$c9." - ".$c10;
    
    }
	
	public function actionGuardarareduccion()
    {
        $c1  = Yii::$app->request->get('numdoc');
        $c2  = Yii::$app->request->get('fecmov');
        $c3  = Yii::$app->request->get('fecaut');
        $c4  = Yii::$app->request->get('fuerza');
        $c5  = Yii::$app->request->get('modalidad');
        $c6  = Yii::$app->request->get('vigencia');
        $c7  = Yii::$app->request->get('esm');
        $c8  = Yii::$app->request->get('autpag');
        $model = new SpInsertReduc;
        $insertAutPag = $model->procedimiento($c1,$c2,$c3,$c4,$c5,$c6,$c7,$c8);   

        //echo $c1." - ".$c2." - ".$c3." - ".$c4." - ".$c5." - ".$c6." - ".$c7." - ".$c8;
        
    }

     public function actionGuardararadicion(){
        $c1  = Yii::$app->request->get('numdoc');
        $c2  = Yii::$app->request->get('fecmov');
        $c3  = Yii::$app->request->get('fecaut');
        $c4  = Yii::$app->request->get('fuerza');
        $c5  = Yii::$app->request->get('modalidad');
        $c6  = Yii::$app->request->get('vigencia');
        $c7  = Yii::$app->request->get('esm');
        $c8  = Yii::$app->request->get('autpag');
        $model = new SpInsertAdi;
        $insertAutPag = $model->procedimiento($c1,$c2,$c3,$c4,$c5,$c6,$c7,$c8);   

        //echo $c1." - ".$c2." - ".$c3." - ".$c4." - ".$c5." - ".$c6." - ".$c7." - ".$c8;
    }
	
		public function actionEsm()
    {
		if (isset($_POST['modalidad'])){		
		
		$modalidad = $_POST['modalidad'];
		$vigencia = $_POST['vigencia'];
		$codfuerza = $_POST['codFrz'];
		
		Yii::$app->session['modalidad'] = $modalidad;		
		Yii::$app->session['vigencia'] = $vigencia;		
		Yii::$app->session['codFrz'] = $codfuerza;		
		
		}//echo(($modalidad)?json_encode($modalidad):'');		
		//echo(($vigencias)?json_encode($vigencias):'');		
		//echo(($codfuerza)?json_encode($codfuerza):'');	
		
		
				$model4 = new SpEsm;
				$spesm = $model4->procedimiento();
				
			foreach($spesm as $spesmarr):
			endforeach;	
			
									$codigos = "";
									$desc = "";
									for($i=0;$i<count($spesmarr);$i++) {

										$codigos = $codigos.$spesmarr[$i]['CODI_ESM'].'_*';
										$desc = $desc.$spesmarr[$i]['NOM_ESM'].'_*';									
									}
									
									$ESM = array($codigos,$desc);
									

		echo(($ESM)?json_encode($ESM):'');	
		

		
		
	
	
    }
}