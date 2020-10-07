<?php


namespace VladimirH00\DMLOperationTwo;



require_once "./interfaces/SqlBaseInterface.php";
require_once "Where.php";

use VladimirH00\DMLOperationTwo\interfaces\SqlBaseInterface as SqlBaseInterface;


use InvalidArgumentException;
use VladimirH00\DMLOperationTwo\interfaces\SqlWhereInterface;

/**
 * Класс для составления Delete запроса к MySql
 * Class MySqlDelete
 * @package VladimirH00\SqlDml
 */
class MySqlDelete implements SqlBaseInterface
{


    /**
     * @var string -содержит название таблицы
     */
    private $table;


    private $where;

    /**
     * @inheritDoc
     */
    public function from($tables)
    {
        if (is_array($tables)) {
            $index = 0;
            $len = count($tables);
            foreach ($tables as $table) {
                $this->table .= $table . (++$index == $len ? "" : ",");
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
        if (is_null($this->table)) {
            throw new InvalidArgumentException("All the necessary data was not transmitted.");
        }
        $str = "DELETE FROM {$this->table}";
        if (is_null($this->where)) {
            return $str;
        } else {
            return "{$str} WHERE {$this->where}";
        }
    }


}