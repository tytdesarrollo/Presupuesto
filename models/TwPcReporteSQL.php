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

  $IN_CODIGO_OPN= 'AUT_PAG';
  $IN_FECHA_INI= '01-04-2015';
  $IN_FECHA_FIN= '30-06-2015';
  
		//$rows = Yii::$app->telmovil->createCommand("SELECT USUARIO FROM USUARIOS")->queryAll();

		$rows = Yii::$app->telmovil->createCommand("EXEC SP_REPORTE @IN_CODIGO_OPN =:IN_CODIGO_OPN, @IN_FECHA_INI =:IN_FECHA_INI, @IN_FECHA_FIN =:IN_FECHA_FIN");

$rows->bindParam(":IN_CODIGO_OPN", $IN_CODIGO_OPN, PDO::PARAM_STR);
$rows->bindParam(":IN_FECHA_INI", $IN_FECHA_INI, PDO::PARAM_STR);
$rows->bindParam(":IN_FECHA_FIN", $IN_FECHA_FIN, PDO::PARAM_STR);

//73925000

$result = $rows->queryAll();

return $twpcreportesql = array($result);

	}	
}