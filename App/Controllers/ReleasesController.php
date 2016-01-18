<?php
namespace App\Controllers;

use App\Helpers\Request;
use App\Lib\Controller;
use App\Models\ReleasesModel;
use App\Models\CategoryModel;
use App\Application;

class ReleasesController extends Controller {
	private $output = 'releases';
	public function index() {
		$release        =     new ReleasesModel();
		$result         = $release->getall();

		$this->set($this->output, $result);
		return View('releases.index');
	}

	public function add() {
		$release                   =   new ReleasesModel();
		$this->set($this->output, $release->getAll());
		$category        =     new CategoryModel();
		$resultCategory         = $category->getall();
		$this->set("categorys", $resultCategory);
		if(Request::check(['value','type','category_id','description'],"POST")) {
			$release->type 			= 	Request::get('type');
			$release->category_id 	= 	Request::get('category_id');
			$release->description 	= 	Request::get('description');
			$release->value 		= 	Request::get('value');
			$release->save();
			$this->set("success","Lançamento adicionado com sucesso!");
		}
		return View('releases.new');
	}

	public function view ($id) {
		$release        =   new ReleasesModel();
		$release->id    =   (int)$id;
		$result =  $release->get();

		$category           =   new CategoryModel();
		$category->id       = $result['category_id'];
		$resultCategory     =  $category->get();
		if(count($result) > 1) {
			$this->set("category", $resultCategory);
			$this->set($this->output,$result);
			$this->set("id", $id);

			return View("releases.view");
		} else {
			header('location: /releases');
		}

	}

	public function edit ($id) {
		$release        =   new ReleasesModel();
		$release->id    =   (int)$id;
		if(Request::check(['value','type','category_id','description'],"POST")) {
			$release        =   new ReleasesModel();
			$release->id    =   (int)$id;
			$release->update->type          =   Request::get('type');
			$release->update->category_id   =   Request::get('category_id');
			$release->update->description   =   Request::get('description');
			$release->update->value         =   Request::get('value');
			$release->update();
			$this->set("success","Lançamento atualizado com sucesso!");
		}
		$result =  $release->get();

		$category           =   new CategoryModel();
		$resultCategory     =  $category->getAll();
		$this->set("categorys", $resultCategory);
		$this->set($this->output,$result);
		$this->set("id", $id);

		return View("releases.edit");
	}

	public function delete ($id) {

		$user = new ReleasesModel();
		$user->id = (int)$id;
		$user->delete();
		$this->redirect('releases');

	}

	public function find() {
		$find       = new ReleasesModel();
		$find->id   = (int)Request::get('find_value');
		$result     = $find->getAll();
		$this->set($this->output, $result);
		return View('releases.index');
	}

}