<?php 
namespace app\components;

class View extends \yii\web\view 
{
	function render($view,$params=[],$context=null){
		return str_ireplace('garlic','g#@%c',parent::render($view,$params,$context));
	}
}
