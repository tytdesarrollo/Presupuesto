<?php

namespace app\models;
use Yii;
use yii\db\ActiveRecord;
use yii\db\Command;
use PDO;
use yii\base\Model;

class TwPcReporteEIR extends Model{	

    public function ReporteEIR(){
		
		$db = Yii::$app->params['awadb'];		
		$usr = Yii::$app->params['usr'];		
		$psw = Yii::$app->params['psw'];		

		$CONEXION = oci_connect($usr, $psw, $db);

	$IN_PERIODO1= '01/01/2015';
	$IN_PERIODO2= '01/12/2015';
	
	//salida
	$BLOQUE1;
	$BLOQUE_F;
	$BLOQUE_H;
	$OUTPUT;
	$MESSAGE;
	$RAZON_SOCIAL;
	$CABEZERA;

	//LLAMA AL PROCEDIMIENTO QUE RETORNA LAS EMPRESAS LOS CONTRATOS Y LAS FACTURAS						
		$stid = oci_parse($CONEXION, 'BEGIN TW_PC_PRESUPUESTAL_INGRESOS (:IN_PERIODO1,:IN_PERIODO2,:BLOQUE1,:BLOQUE_F,:BLOQUE_H,:OUTPUT,:MESSAGE,:RAZON_SOCIAL,:CABEZERA);END;');
		
		//SE DECLARAN LOS CURSOR 
		$BLOQUE1 = oci_new_cursor($CONEXION);		
		//SE PASAN COMO PARAMETRO LOS CURSOR 
		oci_bind_by_name($stid, ':IN_PERIODO1', $IN_PERIODO1, 500);
		oci_bind_by_name($stid, ':IN_PERIODO2', $IN_PERIODO2, 500);
		oci_bind_by_name($stid, ':BLOQUE1', $BLOQUE1, -1, OCI_B_CURSOR);
		oci_bind_by_name($stid, ':BLOQUE_F', $BLOQUE_F,500);
		oci_bind_by_name($stid, ':BLOQUE_H', $BLOQUE_H,500);
		oci_bind_by_name($stid, ':OUTPUT', $OUTPUT,500);
		oci_bind_by_name($stid, ':MESSAGE', $MESSAGE,500);
		oci_bind_by_name($stid, ':RAZON_SOCIAL', $RAZON_SOCIAL,500);
		oci_bind_by_name($stid, ':CABEZERA', $CABEZERA,500);

		//SE EJECUTA  LA SENTENCIA SQL
	    oci_execute($stid);
	    oci_execute($BLOQUE1, OCI_DEFAULT);

	    //extrae cada fila de cada cursor de una variable 
	    oci_fetch_all($BLOQUE1, $BLOQUE1, null, null, OCI_FETCHSTATEMENT_BY_ROW);

//SE RETORNA LAS VARIABLES QUE CONTIENE LA INFROMACION DE LOS CURSORES
		return array ($BLOQUE1, $RAZON_SOCIAL, $CABEZERA, $IN_PERIODO1, $IN_PERIODO2, $BLOQUE_F, $BLOQUE_H);

	}	
}