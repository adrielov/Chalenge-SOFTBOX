<?php

namespace App\Controllers;
use App\Lib\Controller;
use App\Models\ReleasesModel;
use App\Models\CategoryModel;
use App\Helpers\Utils;
use App\Helpers\Request;

class ReportController extends Controller {

    public function index() {
    	$category        =     new CategoryModel();
        $resultCategory         = $category->getall();
        $this->set("categorys", $resultCategory);

        $release        =     new ReleasesModel();
        if(Request::check(['category_id'],"POST")) {
	        $release->category_id 	= 	(int) Request::get('category_id');
    	}
    	
        $result         = $release->getall();
        
        $this->set("releases", $result);

        return View('report.index');
    }
}