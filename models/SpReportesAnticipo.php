<?php

namespace app\models;
use Yii;
use yii\db\ActiveRecord;
use yii\db\Command;
use PDO;
use yii\base\Model;

class SpReportesAnticipo extends Model{	

	  
    public function procedimiento($fechaIni,$fechaFin,$vigencia){
        $IN_FECHA_INI= $fechaIni;
        $IN_FECHA_FIN= $fechaFin;
        $IN_VIGENCIA= $vigencia;

    	$rows = Yii::$app->telmovil->createCommand("EXEC SP_REPORTES_ANTICIPO @IN_FECHA_INI = :IN_FECHA_INI , @IN_FECHA_FIN = :IN_FECHA_FIN, @IN_VIGENCIA =:IN_VIGENCIA");

        $rows->bindParam(":IN_FECHA_INI", $IN_FECHA_INI, PDO::PARAM_STR);
        $rows->bindParam(":IN_FECHA_FIN", $IN_FECHA_FIN, PDO::PARAM_STR);
        $rows->bindParam(":IN_VIGENCIA", $IN_VIGENCIA, PDO::PARAM_INT);
    
        $result = $rows->queryAll();

        return $result;
    }
}