<?php

namespace VladimirH00\DMLOperationTwo\interfaces;

/**
 * Интерфейс с общими методами запросов к SQL
 * Interface SqlBaseInterface
 * @package VladimirH00\SqlDml
 */

interface SqlBaseInterface
{
    /**
     * @params array|string $table - строка или массив содержащий название таблицы SQL
     * @param $table
     * @return $this
     */
    public function from($table);

    /**
     * @param SqlWhereInterface $condition
     * @return $this
     */
    public function where(SqlWhereInterface $condition);

    /**
     * получение строки сформированного запроса
     * @return string
     */
    public function getRaw();
}