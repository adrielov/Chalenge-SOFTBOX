<?php
namespace App\Lib\Jps;

class Db {
    /**
     * @var string
     */
    protected $dbDir;

    /**
     * @param string $dbDir
     */
    public function __construct($dbDir) {
        if (!is_dir($dbDir)) {
            mkdir($dbDir, 0700);
        }
        $this->dbDir = $dbDir;
    }

    /**
     * @param string $tableName
     * @return string
     */
    protected function getTableFilename($tableName) {
        return $this->dbDir . DIRECTORY_SEPARATOR . $tableName . '.json';
    }

    /**
     * @param string $tableName
     * @return array
     */
    public function setTable($tableName) {
        if (!$this->tableExists($tableName)) {
            $this->createTable($tableName);
        }
        
        return $this->getTable($tableName);
    }

    /**
     * @param string $tableName
     * @return bool
     */
    public function tableExists($tableName) {
        return is_readable($this->getTableFilename($tableName));
    }

    /**
     * @param string $tableName
     * @return Table
     */
    public function getTable($tableName) {
        if (!$this->tableExists($tableName)) {
            throw new \UnexpectedValueException(sprintf('Data file for table "%s" does not exist', $tableName));
        }
        return new Table($this->getTableFilename($tableName));
    }

    public function createTable($tableName) {
        if ($this->tableExists($tableName)) {
            throw new \UnexpectedValueException(sprintf('Table "%s" already exists', $tableName));
        }
        file_put_contents($this->getTableFilename($tableName), '[]');
    }
}
