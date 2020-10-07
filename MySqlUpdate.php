<?php


namespace VladimirH00\DMLOperationTwo;


require_once "./interfaces/SqlBaseInterface.php";
require_once "./interfaces/SqlUpdateInterface.php";
require_once "./interfaces/SqlWhereInterface.php";
require_once "Where.php";

use VladimirH00\DMLOperationTwo\interfaces\SqlBaseInterface as SqlBaseInterface;
use VladimirH00\DMLOperationTwo\interfaces\SqlUpdateInterface as SqlUpdateInterface;
use VladimirH00\DMLOperationTwo\interfaces\SqlWhereInterface as SqlWhereInterface;
use InvalidArgumentException;

/**
 * Класс для получения готового Update запроса к Mysql
 * Class MySqlUpdate
 * @package VladimirH00\SqlDml
 */
class MySqlUpdate implements SqlUpdateInterface, SqlBaseInterface
{

    /**
     * @var string - содержит название таблицы
     */
    private $table;

    private $where;

    /**
     * @var string - содержит строку замены старых данных на новые
     */
    private $set;

    /**
     * @inheritDoc
     */
    public function from($tables)
    {
        if (is_array($tables)) {
            $this->table ="";
            $index = 0;
            $len = count($tables);
            foreach ($tables as $table=>$value) {
                $this->table .= "`{$table}` as $value" . (++$index == $len ? "" : ",");
            }
        } else {
            $this->table = $tables;
        }
        return $this;
    }

    public function where(SqlWhereInterface $condition){
        $this->where = $condition->getRaw();
        return $this;
    }

    /**
     * @inheritDoc
     */
    public function getRaw()
    {
        if (is_null($this->table) || is_null($this->where) || is_null($this->set)) {
            throw new InvalidArgumentException("All the necessary data was not transmitted.");
        }
        return "UPDATE {$this->table} SET {$this->set} WHERE {$this->where}";
    }

    /**
     * @inheritDoc
     */
    public function set($columns)
    {
        if (is_array($columns)) {
            $index = 0;
            $len = count($columns);
            foreach ($columns as $key=>$value) {
                $this->set .= "`{$key}` = {$value}" . (++$index == $len ? "" : ",");
            }
        } else {
            $this->set = $columns;
        }
        return $this;
    }

}