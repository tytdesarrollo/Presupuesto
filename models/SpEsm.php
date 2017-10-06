<?php

namespace app\models;
use Yii;
use yii\db\ActiveRecord;
use yii\db\Command;
use PDO;
use yii\base\Model;

class SpEsm extends Model{	

	
    public function procedimiento()
    {

  $IN_MODALIDAD= 'DISP';
  $IN_VIGENCIA= '2015';
  $IN_FUERZA= '60000';

		$rows = Yii::$app->telmovil->createCommand("EXEC SP_ESM @IN_MODALIDAD =:IN_MODALIDAD, @IN_VIGENCIA =:IN_VIGENCIA, @IN_FUERZA =:IN_FUERZA");

$rows->bindParam(":IN_MODALIDAD", $IN_MODALIDAD, PDO::PARAM_STR);
$rows->bindParam(":IN_VIGENCIA", $IN_VIGENCIA, PDO::PARAM_STR);
$rows->bindParam(":IN_FUERZA", $IN_FUERZA, PDO::PARAM_STR);

$result = $rows->queryAll();

return $spesm = array($result);

	}	
}