<?php

namespace app\models;
use Yii;
use yii\db\ActiveRecord;
use yii\db\Command;
use PDO;
use yii\base\Model;

class SpFuerza extends Model{	

	
    public function procedimiento()
    {

		$rows = Yii::$app->telmovil->createCommand("EXEC SP_FUERZA");

$result = $rows->queryAll();

return $spfuerza = array($result);

	}	
}