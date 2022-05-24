<?php

namespace Algvo\QueryBuilder;

use Aigletter\Contracts\Builder\QueryInterface;

class DbSqlLite implements \Aigletter\Contracts\Builder\DbInterface
{
    protected \SQLite3 $sql_lite_connection;

    public function __construct(\SQLite3 $sql_lite_connection)
    {
        $this->sql_lite_connection = $sql_lite_connection;
    }

    public function one(QueryInterface $query): object
    {
        return (object)$this->sql_lite_connection->querySingle($query, true);
    }


    public function all(QueryInterface $query): array
    {
        $result = [];
        $data = $this->sql_lite_connection->query($query);

        while ($row = $data->fetchArray(SQLITE3_ASSOC)) {
            $result[] = $row;
        }
        return $result;
    }
}