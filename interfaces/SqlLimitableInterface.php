<?php
namespace VladimirH00\DMLOperationTwo\interfaces;
/**
 * Интерфейс задающий  лимит для запроса
 * Interface SqlLimitableInterface
 * @package VladimirH00\SqlDml
 */

interface SqlLimitableInterface
{
    /**
     * @params int $limit
     * @return object $this
     */
    public function limit($limit);
}