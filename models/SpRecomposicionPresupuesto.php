<?php

namespace app\models;
use Yii;
use yii\db\ActiveRecord;
use yii\db\Command;
use PDO;
use yii\base\Model;

class SpRecomposicionPresupuesto extends Model{	

	  
    public function procedimiento($fechaIni,$fechaFin,$vigencia,$fuerza,$modalidad){
        $IN_FECHA_INI= $fechaIni;
        $IN_FECHA_FIN= $fechaFin;
        $IN_MODALIDAD= $modalidad;
        $IN_FUERZA= $fuerza;        
        $IN_VIGENCIA= $vigencia;

    	$rows = Yii::$app->telmovil->createCommand("EXEC SP_RECOMPOSICION_PRESUPUESTO @IN_FECHA_INI = :IN_FECHA_INI , @IN_FECHA_FIN = :IN_FECHA_FIN, @IN_MODALIDAD =:IN_MODALIDAD, @IN_FUERZA =:IN_FUERZA, @IN_VIGENCIA =:IN_VIGENCIA");

        $rows->bindParam(":IN_FECHA_INI", $IN_FECHA_INI, PDO::PARAM_STR);
        $rows->bindParam(":IN_FECHA_FIN", $IN_FECHA_FIN, PDO::PARAM_STR);
        $rows->bindParam(":IN_MODALIDAD", $IN_MODALIDAD, PDO::PARAM_STR);
        $rows->bindParam(":IN_FUERZA", $IN_FUERZA, PDO::PARAM_STR);
        $rows->bindParam(":IN_VIGENCIA", $IN_VIGENCIA, PDO::PARAM_INT);
    
        $result = $rows->queryAll();

        return $result;
    }
}