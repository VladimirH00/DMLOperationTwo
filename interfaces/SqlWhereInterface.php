<?php


namespace VladimirH00\DMLOperationTwo\interfaces;


interface SqlWhereInterface
{
    public function andWhere($condition);
    public function orWhere($condition);
    public function getRaw();
}