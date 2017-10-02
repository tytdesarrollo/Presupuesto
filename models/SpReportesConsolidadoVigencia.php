<?php

namespace app\models;
use Yii;
use yii\db\ActiveRecord;
use yii\db\Command;
use PDO;
use yii\base\Model;

class SpReportesConsolidadoVigencia extends Model{	

	
    public function procedimiento()
    {

  $IN_FECHA_INI= '01-01-2015';
  $IN_FECHA_FIN= '30-06-2015';
  $IN_MODALIDAD= 'DISP';
  $IN_FUERZA= '60000';
  $IN_VIGENCIA= '2015';

		$rows = Yii::$app->telmovil->createCommand("EXEC SP_REPORTES_CONSOLIDADO_VIGNECIA @IN_FECHA_INI =:IN_FECHA_INI, @IN_FECHA_FIN =:IN_FECHA_FIN, @IN_MODALIDAD =:IN_MODALIDAD, @IN_FUERZA =:IN_FUERZA, @IN_VIGENCIA =:IN_VIGENCIA");

$rows->bindParam(":IN_FECHA_INI", $IN_FECHA_INI, PDO::PARAM_STR);
$rows->bindParam(":IN_FECHA_FIN", $IN_FECHA_FIN, PDO::PARAM_STR);
$rows->bindParam(":IN_MODALIDAD", $IN_MODALIDAD, PDO::PARAM_STR);
$rows->bindParam(":IN_FUERZA", $IN_FUERZA, PDO::PARAM_STR);
$rows->bindParam(":IN_VIGENCIA", $IN_VIGENCIA, PDO::PARAM_INT);

$result = $rows->queryAll();

return $spreportesconvig = array($result);

	}	
}