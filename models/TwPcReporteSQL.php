<?php

namespace app\models;
use Yii;
use yii\db\ActiveRecord;
use yii\db\Command;
use PDO;
use yii\base\Model;

class TwPcReporteSQL extends Model{	

	
    public function procedimiento()
    {


  
		$rows = Yii::$app->telmovil->createCommand("SELECT USUARIO FROM USUARIOS")->queryAll();



return $twpcreportesql = array($rows);

	}	
}