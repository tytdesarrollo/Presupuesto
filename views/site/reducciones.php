<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\ContactForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\helpers\Url;

$this->title = 'Reducciones';
?>
<div class="content__title-opration">
	<h2 class="fnt__Medium text-center"><?= Html::encode($this->title) ?></h2>
</div>
<div class="row">
	<div class="col-xs-3 col-sm-2">
		<div class="form-group label-floating"><label for="codESM" class="control-label">Código</label><input type="text" class="form-control" id="codESM"></div>
	</div>
	<div class="col-xs-9 col-sm-10">
		<div class="form-group label-floating"><label for="dscESM" class="control-label">Fuerza</label><input type="text" class="form-control" id="dscESM"></div>
	</div>
</div>
<div class="row">
	<div class="col-xs-3 col-sm-2">
		<div class="form-group label-floating"><label for="codESM" class="control-label">ESM</label><input type="text" class="form-control" id="codESM"></div>
	</div>
	<div class="col-xs-9 col-sm-10">
		<div class="form-group label-floating"><label for="dscESM" class="control-label">Descripción</label><input type="text" class="form-control" id="dscESM"></div>
	</div>
</div>
<div class="row">
	<div class="col-xs-12 col-sm-6">
		<div class="form-group">
			<label for="rdn" class="control-label">Valor de la reducción</label>
			<div class="input-group">
				<span class="input-group-addon">$</span>
				<input type="text" class="form-control" id="rdn">
			</div>
		</div>
	</div>
</div>