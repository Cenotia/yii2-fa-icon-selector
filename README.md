YII2 Fa Icon Selector
==================

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

**FaiconSelector** is in namespace `cenotia\FaiconSelector`.

For instance, to associate **faiconSelector** with the attribute `'cat_icon'` in a form view, use code like this:

    use cenotia\components\faiconSelector\FaiconSelector;
        
	...
	<?php echo $form->field($model, 'cat_icon')->widget(FaiconSelector::className()) ?>
	...

	//what will be stored is the class content generated. For example : fa fa-bank fa-2x
	//So you will just to display like this for example.

	...
	<i class="<?= $model->cat_icon ?>"></i>
	... 

#### options ####

De facto, [InputWidget properties](http://www.yiiframework.com/doc-2.0/yii-widgets-inputwidget.html) can also be used.

More options to be documented in coming versions.

