<?php

namespace app\models;
use Yii;
use yii\db\ActiveRecord;
use yii\db\Command;
use PDO;
use yii\base\Model;

class SpReportesMain extends Model{	

	
    public function procedimiento(){              

		$rows = Yii::$app->telmovil->createCommand("EXEC SP_REPORTES_MAIN");
    
        $result = $rows->queryAll();

        return $result;

    }	

    public function procedimiento2(){
    	$rows = Yii::$app->telmovil->createCommand("EXEC SP_REPORTES_FILTRO_MES @IN_FECHA_INI = '01-01-2015' , @IN_FECHA_FIN = '01-06-2015', @IN_MODALIDAD = 'DISP', @IN_FUERZA = '60000', @IN_VIGENCIA ='2015'");
    
        $result = $rows->queryAll();

        return $result;
    }
}