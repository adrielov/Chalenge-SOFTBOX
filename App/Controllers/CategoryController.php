<?php
namespace App\Controllers;

use App\Helpers\Request;
use App\Lib\Controller;
use App\Models\CategoryModel;
use App\Models\categorysModel;
use App\Application;

class CategoryController extends Controller {

	public function index() {
		$category     = 	new CategoryModel();
		$result       = $category->getAll();
		$this->set("categorys", $result);
		return View('category.index');
	}

	public function add() {
		if(Request::check(['name'],"POST")) {
			$category 				= 	new CategoryModel();
			$category->name 		= 	Request::get('name');
			$category->save();
			$this->set("success","A categoria {$category->name} foi adicionada.");
		}
		return View('category.new');
	}

	public function edit ($id) {
		$category        =   new CategoryModel();

		$category->id    =   (int)$id;

		if(Request::check(['name'],"POST")) {
			$category->id    =   (int)$id;
			$category->update->name          =   Request::get('name');
			$category->update();
			$this->set("success","Categoria atualizada com sucesso!");
		}

		$result =  $category->get();

		$this->set("category",$result);
		$this->set("id", $id);

		return View("category.edit");
	}

	public function delete ($id) {
		$user = new CategoryModel();
		$user->id = (int)$id;
		$user->delete();
		$this->redirect('category');

	}

	public function find() {
		$find       = new CategoryModel();
		$find->id   = (int)Request::get('find_value');
		$result     = $find->getAll();
		$this->set("categorys", $result);
		return View('category.index');
	}
}