<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\ContactForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\helpers\Url;

$this->title = 'Adiciones';
?>
<div class="content__title-opration">
	<h2 class="fnt__Medium text-center"><?= Html::encode($this->title) ?></h2>
</div>
<p>Asigne el valor de la adición.</p>
<div class="row">
	<div class="col-xs-12 col-sm-6">
		<div class="form-group">
			<label for="adn" class="control-label">Adición</label>
			<div class="input-group">
				<span class="input-group-addon">$</span>
				<input type="text" class="form-control" id="adn">
			</div>
		</div>
	</div>
</div>