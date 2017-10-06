<?php

namespace app\models;
use Yii;
use yii\db\ActiveRecord;
use yii\db\Command;
use PDO;
use yii\base\Model;

class SpCabeceraReportes extends Model{	

	  
    public function procedimiento($opcion,$fechaIni,$fechaFin,$vigencia,$fuerza,$modalidad){
       	$IN_OPCION = $opcion; //'OPCION1';
		$IN_FECHA_INI = $fechaIni;//'01-01-2015';
		$IN_FECHA_FIN = $fechaFin;//'01-06-2015';
		$IN_VIGENCIA = $vigencia;//'2015';
		$IN_FUERZA = $fuerza;//'50000';
		$IN_MODALIDAD = $modalidad;//'DISP';
	

    	$rows = Yii::$app->telmovil->createCommand("EXEC SP_CABECERA_RECOMPOSICION 	@IN_OPCION = :IN_OPCION, @IN_FECHA_INI = :IN_FECHA_INI, @IN_FECHA_FIN = :IN_FECHA_FIN, 	@IN_VIGENCIA = :IN_VIGENCIA, @IN_FUERZA = :IN_FUERZA, @IN_MODALIDAD = :IN_MODALIDAD");

    	$rows->bindParam(":IN_OPCION", $IN_OPCION, PDO::PARAM_STR);
        $rows->bindParam(":IN_FECHA_INI", $IN_FECHA_INI, PDO::PARAM_STR);
        $rows->bindParam(":IN_FECHA_FIN", $IN_FECHA_FIN, PDO::PARAM_STR);
        $rows->bindParam(":IN_VIGENCIA", $IN_VIGENCIA, PDO::PARAM_INT);        
        $rows->bindParam(":IN_FUERZA", $IN_FUERZA, PDO::PARAM_STR);
        $rows->bindParam(":IN_MODALIDAD", $IN_MODALIDAD, PDO::PARAM_STR);
    
        $result = $rows->queryAll();

        return $result;
    }

    public function procedimiento2(){       

        $rows = Yii::$app->telmovil->createCommand(" EXEC SP_CABECERA_EJECUCION_PRESUPUESTAL");

        $result = $rows->queryAll();

        return $result;
    }

    public function procedimiento3($opcion){

        if($opcion === 1){
            $rows = Yii::$app->telmovil->createCommand(" EXEC SP_FUERZA");        
        }elseif($opcion === 2){
            $rows = Yii::$app->telmovil->createCommand(" EXEC SP_MODALIDAD");        
        }elseif($opcion === 3){
            $rows = Yii::$app->telmovil->createCommand(" EXEC SP_VIGENCIA");        
        }   

        $result = $rows->queryAll(); 

        return $result;   
        
    }
}

