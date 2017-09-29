<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace app\assets;

use yii\web\AssetBundle;

/**
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'css/site.css',
		'css/fullcalendar.css',
    ];
    public $js = [
		'js/classie.js',
		'js/mlpushmenu.js',
		'js/moment.min.js',
		'js/fullcalendar.min.js',
		'http://code.jquery.com/ui/1.12.1/jquery-ui.min.js',
		'js/menuppto.js',
		'js/datepicker-es.js',
		'js/mdselect.js',
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapPluginAsset',
		'yii\bootstrap\BootMaterialCssAsset',
        'yii\bootstrap\BootMaterialJsAsset',
		'yii\flickity\flickityPluginAsset',
    ];
}
