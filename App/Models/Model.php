<?php
namespace App\Models;

use App\Adapters\Contracts\IDatabaseAdapter;
use App\Factories\DatabaseAdapterFactory;
use App\Config;
use \DateTime;

abstract class Model {
    /** @var \App\Adapters\Contracts\IDatabaseAdapter */
    protected   $adapter = null;
    protected   $created_at;
    public      $update;
    
    public function __construct() {
        $adapter           = Config::get('database.engine');
        $this->created_at   = date('Y-m-d H:i:s');
        $this->update       = (object) array();
        $this->setAdapter(DatabaseAdapterFactory::create($adapter));
    }
    
    public function getTable() {
        return $this->table;
    }
    
    protected function setAdapter(IDatabaseAdapter $adapter) {
        $this->Adapter = $adapter;
    }
    
    public function save() {
        $this->Adapter->save($this);
    }
    
    public function get() {
        return $this->Adapter->get($this);
    }
    
    public function getall() {
        return $this->Adapter->getall($this);
    }

    public function update() {
        return $this->Adapter->update($this);
    }

    public function delete() {
        return $this->Adapter->delete($this);
    }
}