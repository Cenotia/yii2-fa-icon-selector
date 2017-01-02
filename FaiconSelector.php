<?php
/* 
 * @link https://github.com/cenotia/yii2-faiconselector
 * @copyright Copyright (c) 2016 Cenotia Group * 
 * @license https://www.cenotia.com/licences * 
 */
/**
 * Yii2 wrapper of
 * widget for http://victor-valencia.github.io/bootstrap-iconpicker/
 * with additional options
 */
namespace cenotia\components\faiconSelector;



use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\helpers\Json;
use yii\web\JsExpression;
use yii\widgets\InputWidget;
use yii\bootstrap\ButtonDropdown;
use yii\bootstrap\ButtonGroup;


class FaiconSelector extends InputWidget
{
	/**
	 * @var string $iconset - present in the original jquery package
	 * glyphicon,ionicon,fontawesome,weathericon,mapicon,octicon,typicon,elusiveicon,materialdesign
	 */
	public $iconset = 'fontawesome';
	/**
	 * @var array $pickerOptions additional html options for picker button
	 */
	public $pickerOptions = ['class' => 'btn btn-default btn-sm'];

	/**
	 * @var array $containerOptions additional html options for container
	 */
	public $containerOptions = [];
        
    public $buttonOptions = ['class' => 'btn btn-default btn-sm iconpicker'];
    /**
     *
     * @var array
     * All fa values in array : orientation, icon, color, size 
     */
    protected $parts = [];
    
     /**
     * @var array
     * Labels for the widget's elements.
     * a value of false means that the corresponding element is not displayed.
     */
    public $labels = [
        'icon' => 'icon',  
        'size' => 'Size',
        'color' => 'color',
        'orientation' => 'Orientation',
        'animation' => 'animation',
        'stack' => 'Stack',   
    ];

    /**
    * @var array
    */
    public $size = [
        'fa-lg',
        'fa-2x',
        'fa-3x',
        'fa-4x',
        'fa-5x',
        'fa-fw',
        ];


    /**
    * @var array
    * aliceblue is class col-aliceblue. Css definition is in assets/css/faiconcolors.css
    * SVG color list from https://www.w3.org/TR/SVG11/types.html#ColorKeywords
    */

    public $colors = [
        "aliceblue","antiquewhite","aqua","aquamarine","azure","beige","bisque","black","blanchedalmond","blue","blueviolet","brown","burlyWood","cadetblue","chartreuse","chocolate","coral","cornflowerblue","cornsilk","crimson","cyan","darkblue","darkcyan","darkGoldenRod","darkGray","darkGrey","darkGreen","darkKhaki","darkMagenta","darkOliveGreen","darkorange","darkOrchid","darkRed","darkSalmon","darkSeaGreen","darkSlateblue","darkSlateGray","darkSlateGrey","darkTurquoise","darkviolet","deepPink","deepSkyblue","dimGray","dimGrey","dodgerblue","firebrick","floralWhite","forestGreen","fuchsia","Gainsboro","GhostWhite","Gold","GoldenRod","Gray","Grey","Green","GreenYellow","Honeydew","HotPink","IndianRed","Indigo","Ivory","Khaki","Lavender","Lavenderblush","LawnGreen","Lemonchiffon","Lightblue","Lightcoral","Lightcyan","LightGoldenRodYellow","LightGray","LightGrey","LightGreen","LightPink","LightSalmon","LightSeaGreen","LightSkyblue","LightSlateGray","LightSlateGrey","LightSteelblue","LightYellow","Lime","LimeGreen","Linen","Magenta","Maroon","MediumaquaMarine","Mediumblue","MediumOrchid","MediumPurple","MediumSeaGreen","MediumSlateblue","MediumSpringGreen","MediumTurquoise","MediumvioletRed","Midnightblue","Mintcream","MistyRose","Moccasin","NavajoWhite","Navy","OldLace","Olive","Olivedrab","Orange","OrangeRed","Orchid","PaleGoldenRod","PaleGreen","PaleTurquoise","PalevioletRed","PapayaWhip","PeachPuff","Peru","Pink","Plum","Powderblue","Purple","Red","Rosybrown","Royalblue","Saddlebrown","Salmon","Sandybrown","SeaGreen","SeaShell","Sienna","Silver","Skyblue","Slateblue","SlateGray","SlateGrey","Snow","SpringGreen","Steelblue","Tan","Teal","Thistle","Tomato","Turquoise","violet","Wheat","White","WhiteSmoke","Yellow","YellowGreen"
        ];

        /**
         * @var array
         * orientation
         * See: http://fontawesome.io/examples/#rotated-flipped
         */
        public $orientation = [
            'fa-rotate-90',
            'fa-rotate-180',
            'fa-rotate-270',
            'fa-flip-horizontal',
            'fa-flip-vertical',

        ];

    /**
     * @var array
     * Not yet implemented
     *
     */     

    public $animation = [
        'fa-spin',
        'fa-pulse',
    ];

    public $fastack = [
        'fa-circle-o',
        'fa-square-o',
        'fa-square',
        'fa-circle',
        'fa-ban'
    ];

	/**
	 * @var array $clientOptions - iconpicker options
	 * (will be merged with defaultOptions @see getDefaultOptions() , so you can set only overrides)
	 * @see       http://victor-valencia.github.io/bootstrap-iconpicker/
	 **/
	public $clientOptions
		= [
			'rows'            => 5,
			'columns'         => 10,
			'placement'       => 'right',
			'align'           => 'center',
			'arrowClass'      => 'btn-primary',
			'header'          => true,
			'footer'          => true,
			'labelHeader'     => '{0} / {1}',
			'labelFooter'     => '{0} - {1}:[{2}]',
			'search'          => true,
			'searchText'      => 'Search icon',
			'selectedClass'   => 'btn-warning',
			'unselectedClass' => 'btn-default',
		];

	/**
	 * @var JsExpression $onSelectIconCallback
	 * @example
	 * onSelectIconCallback=>new JsExpression('function(e){
	 *    var icon = e.icon;
	 *    icon = "some "+icon;
	 *    $('#target').val(icon);
	 * }'),
	 */
	public $onSelectIconCallback;

	/**
	 * @var
	 */
	private $_id;
	/**
	 * @var string
	 */
	private $_default = 'fa-at';

	/**
	 * Default js-plugin options
	 *
	 * @return array
	 **/
	protected function getDefaultOptions()
	{
		return [
			'iconset'         => $this->iconset,
			'rows'            => 5,
			'columns'         => 10,
			'placement'       => 'right',
			'align'           => 'center',
			'arrowClass'      => 'btn-primary',
			'header'          => true,
			'footer'          => true,
			'labelHeader'     => '{0} / {1}',
			'labelFooter'     => '{0} - {1}:[{2}]',
			'search'          => true,
			'searchText'      => \Yii::t('cenotia/iconpicker', 'SEARCH_ICON'),
			'selectedClass'   => 'btn-warning',
			'unselectedClass' => 'btn-default',
		];
	}

	/**
	 *
	 */
	public function init()
	{
		//$this->registerTranslations();
		if (!isset($this->options['id']) && !$this->hasModel())
		{
			$this->options['id'] = 'iconpicker_' . $this->getId();
		}
		
                parent::init();
                
		$this->_id = $this->options['id'];
                
        //retrieve default or existing values
        if (!empty($this->model->{$this->attribute}))
        {
            $faclass = explode(' ',$this->model->{$this->attribute});
            $faclass = array_diff($faclass, array('fa',));

            foreach($faclass as $part)
            {
               if (in_array($part, $this->orientation)) $this->parts['orientation'] = $part;
               else if (in_array($part, $this->size)) $this->parts['size'] = $part;
               else if (in_array(substr($part,4), $this->colors)) $this->parts['color'] = $part;
               else if ($part<> '') $this->parts['icon'] = $part;

            }
        }
        else 
            $this->parts['icon'] = $this->_default;
               
                
		if ($this->hasModel() && !empty($this->model->{$this->attribute}))
		{
            $this->_default = $this->pickerOptions['data-icon'] = $this->model->{$this->attribute};
		}
		if (!$this->hasModel() && !empty($this->value))
		{
			$this->_default = $this->pickerOptions['data-icon'] = $this->value;
		}
		if (!isset($this->pickerOptions['id']))
		{
			$this->pickerOptions['id'] = $this->_id . '_jspicker';
		}
		$this->clientOptions = ArrayHelper::merge($this->getDefaultOptions(), $this->clientOptions);
		$this->registerAssets();
	}

	/**
	 * Register widget translations.
	 */
	public function registerTranslations()
	{
		if (!isset(\Yii::$app->i18n->translations['cenotia/component/faiconSelector'])
			&& !isset
			(\Yii::$app->i18n->translations['cenotia/component/faiconSelector/*'])
		)
		{
			\Yii::$app->i18n->translations['cenotia/component/faiconSelector'] = [
				'class'            => 'yii\i18n\PhpMessageSource',
				'basePath'         => '@cenotia/component/faiconSelector/messages',
				'forceTranslation' => true,
				'fileMap'          => [
					'cenotia/component/faiconSelector' => 'faiconSelector.php',
				],
			];
		}
	}

	

	/**
	 * Registers the needed assets
	 */
	public function registerAssets()
	{
		$view = $this->getView();
                BootstrapIconAsset::register($view);
                FaiconselectorAsset::register($view);
		$targetId = $this->_id;
		$iconPickerId = $this->pickerOptions['id'];
                
        if (isset($this->parts['icon']))
            $iconValue = $this->parts['icon'];
        else 
            $iconValue = $this->_default;
                
                
		$this->clientOptions = ArrayHelper::merge($this->clientOptions, [
			'icon' => $iconValue,
		]);
                
		$this->clientOptions = Json::encode($this->clientOptions);
                
                $jsParts = Json::encode($this->parts);
                
                
                $js[] 
                     = <<<JS
            var parts = {$jsParts};
                
            function report() {
                var c = Object.keys(parts).map(function(v, i, a) { return parts[v]; }).join(' '),
                c2 =  c;    
                    $('#cenotia-icon-text').html('<i class=\"fa ' + c + '\"></i> fa ' + c);
                    $("#{$targetId}").val('fa '+c);    
                }                 
            
            $('#ce-col li').click(function(e) { parts.color = $(this).text().trim(); report(); });
            $('#sp-dd-ori li').click(function(e) { parts.orientation = $(this).text().trim(); report(); });
            $('#sp-dd-size li').click(function(e) { parts.size = $(this).text().trim(); report(); });

JS;
                        
                $js[]
			= <<<JS
           $("#{$iconPickerId}").iconpicker({$this->clientOptions});
           $("#cenotia-icon-text").html('<i class="{$iconValue}"></i> {$iconValue}');
           
JS;
		$callback = null;
		if (!empty($this->onSelectIconCallback))
		{
			$callback = $this->onSelectIconCallback instanceof JsExpression
				? $this->onSelectIconCallback->__toString()
				: $this->onSelectIconCallback;
		}
		
                $js[] = ($callback)
			? <<<JS
           $("#{$iconPickerId}").on('change', function(e) {
                parts.icon = $(this).text().trim();
                var callback = {$callback};
                callback(e);
            });
JS
			:
			<<<JS
                       
            $("#{$iconPickerId}").on('change', function(e) {
                //$("#{$targetId}").val('fa '+e.icon);
                parts.icon = 'fa '+e.icon;
                report();
            });
                report();
JS;
                
                
		$view->registerJs(implode("\n", $js));
                
	}

	/**
	 * @return string bootstrap-picker button with hiddenInput field where we put selected value
	 */
	public function run()
	{

		if ($this->hasModel())
		{
			$inp = Html::activeHiddenInput($this->model, $this->attribute, $this->options);
		}
		else
		{
			$inp = Html::hiddenInput($this->name, $this->value, $this->options);
		}
		$displayAttr = Html::tag('p', null, [ 'id' => 'cenotia-icon-text']);
                $picker = Html::button(\Yii::t('cenotia/component/faiconSelector', 'Choose icon'), $this->pickerOptions);
                $pickerOpt = $this->renderdropdowns();

		return Html::tag('div', $displayAttr. $picker . '&nbsp;&nbsp;  <strong>options</strong> ' . $pickerOpt. $inp, $this->containerOptions);
	}
        
    protected function renderColor()    {
        return $this->labels['color'] ? ButtonDropdown::widget([
            'label' => $this->labels['color'],
            'options' => $this->buttonOptions,
            'dropdown' => [
                'options' => ['class'=>'scrollable-menu btn-default'],
                'id' => 'ce-col',
                'encodeLabels' => false,
                'items' => array_merge(["<li>&nbsp;</li>"], array_map(function($data) {
                    return "<li class='ce-colc col-".strtolower($data)."'>col-{$data}</li>";
                }, $this->colors))
            ]
        ]) : '';
    }

    protected function renderOrientation()    {
        return $this->labels['orientation'] ? ButtonDropdown::widget([
            'label' => $this->labels['orientation'],
            'options' => $this->buttonOptions,
            'dropdown' => [
                'options' => ['class'=>'scrollable-menu'],
                'id' => 'sp-dd-ori',
                'encodeLabels' => false,
                'items' => array_merge(["<li>&nbsp;</li>"], array_map(function($data) {
                    return "<li><i class='fa fa-fw fa-grav {$data}'></i> {$data}</li>";
                }, $this->orientation))
            ]
        ]) : '';
    }

    protected function renderSize()    {
        return $this->labels['size'] ? ButtonDropdown::widget([
            'label' => $this->labels['size'],
            'options' => $this->buttonOptions,
            'dropdown' => [
                'options' => ['class'=>'scrollable-menu'],
                'id' => 'sp-dd-size',
                'encodeLabels' => false,
                'items' => array_merge(["<li>&nbsp;</li>"], array_map(function($data) {
                    return "<li><i class='fa fa-fw fa-grav {$data}'></i> {$data}</li>";
                }, $this->size))
            ]
        ]) : '';
    }
    
    
    protected function renderdropdowns()    {
        return ButtonGroup::widget([
            'buttons' => [
                $this->renderColor(),
                $this->renderOrientation(),
                $this->renderSize(),
            ]
        ]);
    }
}