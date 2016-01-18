<?php
namespace App\Adapters\Contracts;

use App\Models\Model;

interface IDatabaseAdapter {
	/*
	* @Method save model
	* @param Model
	*/
    public function save(Model $model);
}