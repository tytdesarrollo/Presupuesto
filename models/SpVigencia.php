<?php

namespace app\models;
use Yii;
use yii\db\ActiveRecord;
use yii\db\Command;
use PDO;
use yii\base\Model;

class SpVigencia extends Model{	

	
    public function procedimiento()
    {

		$rows = Yii::$app->telmovil->createCommand("EXEC SP_VIGENCIA");

$result = $rows->queryAll();

return $spvigencia = array($result);

	}	
}