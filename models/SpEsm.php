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

  $IN_MODALIDAD= Yii::$app->session['modalidad'];
  $IN_VIGENCIA= Yii::$app->session['vigencia'];
  $IN_FUERZA= Yii::$app->session['codFrz'];

		$rows = Yii::$app->telmovil->createCommand("EXEC SP_ESM @IN_MODALIDAD =:IN_MODALIDAD, @IN_VIGENCIA =:IN_VIGENCIA, @IN_FUERZA =:IN_FUERZA");
		/*$rows = Yii::$app->telmovil->createCommand("SELECT TOP 3 (E.CODI_ESM),E.NOM_ESM
	FROM AUDI_ESM E
	WHERE E.TX_FUERZA = :IN_FUERZA
	AND E.TX_MODALIDAD = :IN_MODALIDAD
	AND E.VIGENCIA = :IN_VIGENCIA");*/

$rows->bindParam(":IN_MODALIDAD", $IN_MODALIDAD, PDO::PARAM_STR);
$rows->bindParam(":IN_VIGENCIA", $IN_VIGENCIA, PDO::PARAM_STR);
$rows->bindParam(":IN_FUERZA", $IN_FUERZA, PDO::PARAM_STR);

$result = $rows->queryAll();

return $spesm = array($result);

	}	
}