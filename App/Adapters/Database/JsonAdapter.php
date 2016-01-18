<?php
namespace App\Adapters\Database;

use App\Adapters\Contracts\IDatabaseAdapter;
use App\Models\Model;
use App\Lib\Jps\Db;
use App\config;

class JsonAdapter implements IDatabaseAdapter {
    private $db;

    public function __construct() {
        $this->db   =   new Db(Config::get('database.providers.json.path'));
    }

    public function cleanModel(Model $model , $ignore = array()) {
        $model  = (object) array_filter( (array) $model );
        foreach ($model as $key => $value) {
            if(!in_array($key, $ignore)) {
                $newMode[$key] = $value;
            }
        }
        return $newMode;
    }

    public function save (Model $model) {
       
        $table      =   $model->getTable();
        $model      =   $this->cleanModel($model,['table','Adapter','update']);
        $model      =   array_filter( (array) $model );
        $obj        =   $this->db->setTable($table);
        $obj->insert((array) $model,['id']);
        $obj->persist();

        return true;
    }

    public function get (Model $model) {
        $table      =   $model->getTable();
        $model      =   $this->cleanModel($model,['table','Adapter','update']);
        unset($model['created_at']);
        $obj        =   $this->db->setTable($table);
        $result     =   $obj->find($model);
        
        return ($result)?$result[0]:;
    }


    public function getAll (Model $model) {
        $table      =   $model->getTable();
        $model      =   $this->cleanModel($model,['table','Adapter','update']);
        unset($model['created_at']);
        $obj        =   $this->db->setTable($table);
        $result     =   $obj->find($model);
        return ($result)?$result:;
    }

    public function update (Model $model) {
        $table              =   $model->getTable();
        $model              =   $this->cleanModel($model , ['table','Adapter','created_at']);
        $model['update']    = array_filter( (array) $model['update'] );
        $update = $model['update'];
        unset($model['update']);
        $search             = $model;
        $obj                = $this->db->setTable($table);
        $obj->update($search,$update);

        return $obj->persist();
    }

    public function delete (Model $model) {
        $table  =   $model->getTable();
        $model  =   $this->cleanModel($model , ['table','Adapter','created_at','update']);
        $obj    =   $this->db->setTable($table);
        $obj->delete($model);
        
        return $obj->persist();
    }

}