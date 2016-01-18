<?php
namespace App\Models;

class ReleasesModel extends Model {
    protected $table = 'Releases';
    
    /** @var int */
    public $id;
        
    /** @var int */
    public $category;

    /** @var string */
    public $type;

    /** @var string */
    public $description;

    /** @var float */
    public $value;
}