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
<p>Asigne el valor de la redución.</p>
<div class="row">
	<div class="col-xs-12 col-sm-6">
		<div class="form-group">
			<label for="rdn" class="control-label">Reducción</label>
			<div class="input-group">
				<span class="input-group-addon">$</span>
				<input type="text" class="form-control" id="rdn">
			</div>
		</div>
	</div>
</div>