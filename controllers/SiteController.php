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
use app\models\SpReportesConsolidadoVigencia;
use app\models\SpFuerza;
use app\models\SpModalidad;
use app\models\SpVigencia;
use app\models\SpEsm;

class SiteController extends Controller
{
	public function actionPrueba()
    {

		$model = new SpFuerza;

		$spfuerza = $model->procedimiento();	

	return $this->render('prueba',["DATO"=>$spfuerza]);
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
		return $this->render('index');
	// return $this->redirect(['site/presupuesto']);
    }

    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        }
        return $this->render('login', [
            'model' => $model,
        ]);
    }

    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
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
		$model4 = new SpEsm;
		$model3 = new SpFuerza;

		$spmodalidad = $model->procedimiento();
		$spvigencia = $model2->procedimiento();
		$spesm = $model4->procedimiento();
		$spfuerza = $model3->procedimiento();
		
			foreach($spmodalidad as $spmodalidadarr):
			endforeach;
			foreach($spvigencia as $spvigenciaarr):
			endforeach;
			foreach($spfuerza as $spfuerzaarr):
			endforeach;			

        return $this->render('adiciones',["MODALIDAD"=>$spmodalidadarr,"VIGENCIA"=>$spvigenciaarr,"FUERZA"=>$spfuerzaarr]);
    }

	public function actionReducciones()
    {
		$this->layout='main_mant';
        return $this->render('reducciones');
    }

	public function actionAutopago()
    {
		$this->layout='main_mant';
        return $this->render('autopago');
    }

	public function actionPresupuesto()
    {
		$this->layout='main_rep';
		$model = new TwPcReporteEIR;

		$twpcreporteeir = $model->ReporteEIR();

		$RAZON_SOCIAL = $twpcreporteeir[1];
		$CABEZERA = explode("_*", $twpcreporteeir[2]);

        return $this->render('presupuesto',["RAZON_SOCIAL"=>$RAZON_SOCIAL, "CABEZERA"=>$CABEZERA]);
    }
	public function actionExcel()
    {
		if(Yii::$app->request->get('optionsRadios')=='option1'){
		return $this->redirect(['site/ejecucioningresos', "from"=>Yii::$app->request->get('from'), "to"=>Yii::$app->request->get('to')]);		
		
		}elseif(Yii::$app->request->get('optionsRadios')=='option2'){
		return $this->redirect(['site/excelconsolvig', "from"=>Yii::$app->request->get('from'), "to"=>Yii::$app->request->get('to')]);
		
		}elseif(Yii::$app->request->get('optionsRadios')=='option3'){
		return $this->redirect(['site/excelpresupuestantic', "from"=>Yii::$app->request->get('from'), "to"=>Yii::$app->request->get('to')]);
		
		}elseif(Yii::$app->request->get('optionsRadios')=='option4'){
		return $this->redirect(['site/excelpresupuestfiltro', "from"=>Yii::$app->request->get('from'), "to"=>Yii::$app->request->get('to')]);
		
		}
    }
	public function actionEjecucioningresos()
    {
        		$this->layout=false;

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

	return $this->render('excelejecucioningreso',["RAZON_SOCIAL"=>$RAZON_SOCIAL, "CABEZERA"=>$CABEZERA, "BLOQUE1_ARR"=>$BLOQUE1_ARR, "BLOQUE2_ARR"=>$BLOQUE2_ARR, "BLOQUE3_ARR"=>$BLOQUE3_ARR, "BLOQUE4_ARR"=>$BLOQUE4_ARR, "BLOQUE5_ARR"=>$BLOQUE5_ARR, "BLOQUE6_ARR"=>$BLOQUE6_ARR, "BLOQUE7_ARR"=>$BLOQUE7_ARR, "BLOQUE8_ARR"=>$BLOQUE8_ARR,"IN_PERIODO1"=>$IN_PERIODO1,"IN_PERIODO2"=>$IN_PERIODO2, "BLOQUE_F"=>$BLOQUE_F, "BLOQUE_H"=>$BLOQUE_H]);
    }
	
	public function actionExcelconsolvig()
    {
		//$this->layout=false;
		
		$model = new SpReportesConsolidadoVigencia;

		$spreportesconvig = $model->procedimiento();	
    
		$DATO_INI = $spreportesconvig[0];		
		
		foreach ($DATO_INI as $DATO_KEY) {			
			$DATO[] = $DATO_KEY['NOMBRES_COLUMNAS'];	
		}
		
		$BLOQUE_COL = explode("*_", $DATO[0]);
		
		foreach ($DATO_INI as $COLUMN_KEY) {		
				foreach ($BLOQUE_COL as $BLOQUE_COL_KEY) {		
							$COLUMN_ARR[] = $COLUMN_KEY[$BLOQUE_COL_KEY];	
				}
		}
		
        return $this->render('excelconsolvig',["DATO"=>$BLOQUE_COL, "COLUMN_ARR"=>$COLUMN_ARR]);
    }
		
	public function actionExcelpresupuestantic()
    {
		$this->layout=false;
        return $this->render('excelpresupuestantic');
    }
			
	public function actionExcelpresupuestfiltro()
    {
		$this->layout=false;
        return $this->render('excelpresupuestfiltro');
    }
	
	public function actionAjax()
    {

	
	
    }
	
	public function actionFuerza()
    {


		
	}
	
		public function actionEsm()
    {

	
	
    }
}
