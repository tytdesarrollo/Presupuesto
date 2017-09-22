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

class SiteController extends Controller
{
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
        return $this->render('adiciones');
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
		
	return $this->render('excel',["RAZON_SOCIAL"=>$RAZON_SOCIAL, "CABEZERA"=>$CABEZERA, "BLOQUE1_ARR"=>$BLOQUE1_ARR, "BLOQUE2_ARR"=>$BLOQUE2_ARR, "BLOQUE3_ARR"=>$BLOQUE3_ARR, "BLOQUE4_ARR"=>$BLOQUE4_ARR, "BLOQUE5_ARR"=>$BLOQUE5_ARR, "BLOQUE6_ARR"=>$BLOQUE6_ARR, "BLOQUE7_ARR"=>$BLOQUE7_ARR, "BLOQUE8_ARR"=>$BLOQUE8_ARR,"IN_PERIODO1"=>$IN_PERIODO1,"IN_PERIODO2"=>$IN_PERIODO2, "BLOQUE_F"=>$BLOQUE_F, "BLOQUE_H"=>$BLOQUE_H]);
    }
	public function actionPdf()
    {
        return $this->render('pdf');
    }
}
