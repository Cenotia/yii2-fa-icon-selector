YII2 Fa Icon Selector
==================

![yii2-fa-icon-selector](https://cloud.githubusercontent.com/assets/1721936/21603984/10708d46-d1a1-11e6-997b-2d19fbdb6300.gif)


#### This widget can be attached to a model attribute in order to associate a FontAwesome icon to it with optional orientation, size and color.
####


## Prerequisite ##

This widget is a wrapper for [Bootstrap IconPicker](http://victor-valencia.github.io/bootstrap-iconpicker/) and concentrates only on the FontAwesome part and some of its helpers [Font Awesome](http://fontawesome.io/). 



## Installation ##

The preferred way to install **FaiconSelector** is through [Composer](https://getcomposer.org/). Either add the following to the require section of your `composer.json` file:

`"cenotia/yii2-fa-icon-selector": "dev-master"` 

Or run:

`$ php composer.phar require cenotia/yii2-fa-icon-selector "dev-master"` 

You can manually install **FaiconSelector** by [downloading the source in ZIP-format](https://github.com/cenotia/yii2-fa-icon-selector/archive/master.zip).

## Using FaiconSelector ##

**FaiconSelector** is a Yii 2.0 [InputWidget](http://www.yiiframework.com/doc-2.0/yii-widgets-inputwidget.html). Like any other InputWidget it can be associated with a `model` and an `attribute` (or with a `name` and a `value`).

**FaiconSelector** is in namespace `cenotia\components\faiconSelector`.

For instance, to associate **faiconSelector** with the attribute `'cat_icon'` in a form view, use code like this:

    use cenotia\components\faiconSelector\FaiconSelector;
        
	...
	<?php echo $form->field($model, 'cat_icon')->widget(FaiconSelector::className()) ?>
	...

	//The class string is what will be stored. Example: fa fa-bank fa-2x
	//So your field should be a varchar of 100 at least.
	//So you will just to display like this for example.

	...
	<i class="<?= $model->cat_icon ?>"></i>
	... 

#### options ####

De facto, [InputWidget properties](http://www.yiiframework.com/doc-2.0/yii-widgets-inputwidget.html) can also be used.

More options to be documented in coming versions.

