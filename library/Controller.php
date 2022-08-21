<?php

class Controller {

	public function loadModel($model)
	{

		include(MODEL.'/'.$model.'.php');

		$model = new $model();

		return $model;
	}


	public function loadView($viewname, $data = [])
	{
		extract($data);
		
		include(VIEW.'/'.$viewname.'.php');

	}

	public function redirect($url)
	{
		header('Location:'.$url);
	}

}