<?php

namespace app\models;
use Yii;
use yii\db\ActiveRecord;
use yii\db\Command;
use PDO;
use yii\base\Model;

class SpModalidad extends Model{	

	
    public function procedimiento()
    {

		$rows = Yii::$app->telmovil->createCommand("EXEC SP_MODALIDAD");

$result = $rows->queryAll();

return $spmodalidad = array($result);

	}	
}