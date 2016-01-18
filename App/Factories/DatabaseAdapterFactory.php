<?php
namespace App\Factories;

use App\Factories\Contracts\IFactory;
use App\Adapters\Database\JsonAdapter;
use App\Adapters\Database\PdoAdapter;

class DatabaseAdapterFactory implements IFactory {
	
    public static function create($Adapter) {
        switch ($Adapter) {
            case 'pdo': return new PdoAdapter();
            case 'json': return new JsonAdapter();
            default: throw new UnexpectedValueException();
        }
    }
}