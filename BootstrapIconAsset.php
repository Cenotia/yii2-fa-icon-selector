<?php
/* 
 * @link https://github.com/cenotia/yii2-faiconselector
 * @copyright Copyright (c) 2016 Cenotia Group * 
 * @license https://www.cenotia.com/licences * 
 */
namespace cenotia\components\faiconSelector;

use Yii;
use yii\web\AssetBundle;

class BootstrapIconAsset extends AssetBundle
{
    public $sourcePath = '@bower/bootstrap-iconpicker';
   
    public $css=[
        'bootstrap-iconpicker/css/bootstrap-iconpicker.min.css'
        
    ];

    public $js= [
        'bootstrap-iconpicker/js/iconset/iconset-fontawesome-4.2.0.min.js',
        'bootstrap-iconpicker/js/bootstrap-iconpicker.min.js'
        
    ];

    public $depends
            = [
                    'yii\web\YiiAsset',
                    'yii\bootstrap\BootstrapAsset',
                    'yii\bootstrap\BootstrapPluginAsset',
            ];
    
   
}