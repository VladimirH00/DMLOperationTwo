<?php


namespace VladimirH00\DMLOperationTwo;


require_once "./interfaces/SqlWhereInterface.php";

use VladimirH00\DMLOperationTwo\interfaces\SqlWhereInterface as SqlWhereInterface;

class Where implements SqlWhereInterface
{
    /**
     * @var string - содержит  строку ограничений по выборке данных
     */
    protected $where;

    private function helpWhere($condition){
        $condition[1] = strtoupper($condition[1]);
        $index = 0;
        $len = count($condition[2]);
        $str = "";
        if ($condition[1] == "IN" || $condition[1] == "NOT IN") {
            $str .= "{$condition[0]} {$condition[1]} ( ";
            foreach ($condition[2] as $value) {
                $str .= "{$value}" . (++$index == $len ? "" : ",");
            }
            $str .= ")";
        } else {
            $str = "{$condition[0]} {$condition[1]} {$condition[2]}";
        }
        return $str;
    }

    public function __construct($condition)
    {
        if (!is_array($condition)) {
            throw new InvalidArgumentException("Condition is not an array.");
        }
        if (empty($condition)) {
            throw new InvalidArgumentException("The passed array cannot be empty.");
        }
        $this->where = $this->helpWhere($condition);
        return $this;
    }

    /**
     * @param array
     * @return object
     */
    public function andWhere($condition) // where(array(pole1, operand, values));
    {

        if (!is_array($condition)) {
            throw new InvalidArgumentException("Condition is not an array.");
        }
        if (empty($condition)) {
            throw new InvalidArgumentException("The passed array cannot be empty.");
        }
        if (!is_null($this->where)) {
            $this->where .= " AND ";
        }
        $this->where .= $this->helpWhere($condition);

        return $this;
    }

    /**
     * @param array
     * @return object
     */
    public function orWhere($condition) // where(array(pole1, operand, values));
    {
        if (!is_array($condition)) {
            throw new InvalidArgumentException("Condition is not an array.");
        }
        if (empty($condition)) {
            throw new InvalidArgumentException("The passed array cannot be empty.");
        }
        if (!is_null($this->where)) {
            $this->where .= " OR ";
        }
        $this->where .= $this->helpWhere($condition);

        return $this;
    }
    public function getRaw()
    {
        return $this->where;
    }

}