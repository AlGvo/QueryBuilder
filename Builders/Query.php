<?php

namespace Algvo\QueryBuilder;

class Query implements \Aigletter\Contracts\Builder\QueryInterface
{
    protected $columns;
    protected $conditions;
    protected $table;
    protected $limit;
    protected $offset;
    protected $order;


    public function __construct($columns,$table,$conditions,$limit,$offset,$order)
    {
        $this->columns = $columns;
        $this->table = $table;
        $this->conditions = $conditions;
        $this->limit = $limit;
        $this->offset = $offset;
        $this->order = $order;
    }

    public function toSql(): string
    {
        $select = 'SELECT ' . implode(',' , $this->columns);

        $table = ' FROM ' . $this->table;

        $conditions = $this->conditions;
        $key_first = array_key_first($conditions);
        $conditions = $key_first . ' = \'' . $conditions[$key_first] . '\'';
        $where = ' WHERE ' . $conditions;

        $order = $this->order;
        $key_first = array_key_first($order);
        $order = $key_first . ' ' . $order[$key_first];
        $order = ' ORDER BY ' . $order;

        $limit = ' LIMIT ' . $this->limit;

        $offset = ' OFFSET ' . $this->offset;

        return $select . $table . $where . $order . $limit . $offset;

    }
    public function __toString()
    {
        return $this->toSql();
    }
}