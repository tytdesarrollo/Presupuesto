<?php

namespace app\models;
use Yii;
use yii\db\ActiveRecord;
use yii\db\Command;
use PDO;
use yii\base\Model;

class SpInsertReduc extends Model{	

	
    public function procedimiento($c1,$c2,$c3,$c4,$c5,$c6,$c7,$c8)
    {
    	$IN_NUM_DOCU = $c1;//'7788,7788';
		$IN_FEC_MOV = $c2;//'2015-06-28,2015-06-28';
		$IN_FEC_AUT = $c3;//'2015-06-25,2015-06-25';
		$IN_COD_FUERZA = $c4;//'70000,60000';
		$IN_MODA = $c5;//'DISP,DISP';
		$IN_VIG = $c6;//'2015,2015';
		$IN_COD_ESM = $c7;//'1007,1114';
		$IN_VAL_AUTO = $c8;//'8888888,77777777';		

		$rows = Yii::$app->telmovil->createCommand("EXEC SP_INSERT_REDUCCION @IN_NUM_DOCU = :IN_NUM_DOCU,
																			@IN_FEC_MOV = :IN_FEC_MOV,
																			@IN_FEC_AUT = :IN_FEC_AUT,
																			@IN_COD_FUERZA = :IN_COD_FUERZA,
																			@IN_MODA = :IN_MODA,
																			@IN_VIG = :IN_VIG,
																			@IN_COD_ESM  = :IN_COD_ESM ,
																			@IN_VAL_AUTO = :IN_VAL_AUTO");

		$rows->bindParam(":IN_NUM_DOCU", $IN_NUM_DOCU, PDO::PARAM_STR);
        $rows->bindParam(":IN_FEC_MOV", $IN_FEC_MOV, PDO::PARAM_STR);
        $rows->bindParam(":IN_FEC_AUT", $IN_FEC_AUT, PDO::PARAM_STR);
        $rows->bindParam(":IN_COD_FUERZA", $IN_COD_FUERZA, PDO::PARAM_STR);        
        $rows->bindParam(":IN_MODA", $IN_MODA, PDO::PARAM_STR);
        $rows->bindParam(":IN_VIG", $IN_VIG, PDO::PARAM_STR);
        $rows->bindParam(":IN_COD_ESM", $IN_COD_ESM , PDO::PARAM_STR);
        $rows->bindParam(":IN_VAL_AUTO", $IN_VAL_AUTO, PDO::PARAM_STR);


		$result = $rows->queryAll();

		return ($result);

	}	
}

