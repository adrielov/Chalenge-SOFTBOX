<?php
namespace App\Models;

class CategoryModel extends Model {
    protected $table = 'Categorys';
    
    /** @var int */
    public $id;
    
    /** @var string */
    public $name;
}