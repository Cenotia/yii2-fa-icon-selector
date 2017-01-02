<?php
/* 
 * @link https://github.com/cenotia/yii2-faiconselector
 * @copyright Copyright (c) 2016 Cenotia Group * 
 * @license https://www.cenotia.com/licences * 
 */
namespace cenotia\components\faiconSelector;

use Yii;
use yii\web\AssetBundle;

class FaiconselectorAsset extends AssetBundle
{
    public $sourcePath = '@frontend/widgets/';
    //public $baseUrl = '@web';
   
    public $css=[
        'assets/css/faiconcolors.css'
    ];

    public $js= [
        
    ];

    public $depends
            = [
                    'yii\web\YiiAsset',
                    'yii\bootstrap\BootstrapAsset',
                    'yii\bootstrap\BootstrapPluginAsset',
            ];
    
   
}