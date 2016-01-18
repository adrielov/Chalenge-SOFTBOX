<?php

namespace App\Controllers;
use App\Lib\Controller;
use App\Models\ReleasesModel;
use App\Models\CategoryModel;
use App\Helpers\Utils;

class IndexController extends Controller {

	public function index() {
		$total_expense	=	Utils::formatNumber($this->someAll('expense','value'));
		$total_recipe	=	Utils::formatNumber($this->someAll('recipe','value'));
		$this->set("total_expense",$total_expense);
		$this->set("total_recipe",$total_recipe);
		return View('home');
	}

	public function someAll($type,$value) {
		$model 	=	new ReleasesModel();
		$model->type = $type;
		$result	= 	($model->getAll())?$model->getAll():array();
		$sumAll = array();
		foreach ($result as $item) {
			array_push($sumAll,$item[$value]);
		}
		
		return array_sum($sumAll);
	}
}