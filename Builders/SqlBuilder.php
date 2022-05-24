<?php
namespace Algvo\QueryBuilder;

use \Aigletter\Contracts\Builder\SqlBuilderInterface;
use \Aigletter\Contracts\Builder\BuilderInterface;

class SqlBuilder implements SqlBuilderInterface
{
    protected $columns;
    protected $conditions;
    protected $table;
    protected $limit;
    protected $offset;
    protected $order;

    public function select($columns): BuilderInterface
    {
        $this->columns = implode(',' , $columns);

        return $this;
    }

    public function where($conditions): BuilderInterface
    {
        $key_first = array_key_first($conditions);
        $this->conditions = $key_first . ' = \'' . $conditions[$key_first] . '\'';
        return $this;
    }

    public function table($table): BuilderInterface
    {
        $this->table = $table;
        return $this;
    }

    public function limit($limit): BuilderInterface
    {
        $this->limit = $limit;
        return $this;
    }

    public function offset($offset): BuilderInterface
    {
        $this->offset = $offset;
        return $this;
    }

    public function order($order): BuilderInterface
    {

        $key_first = array_key_first($order);
        $this->order = $key_first . ' ' . $order[$key_first];
        return $this;
    }

    public function build(): string
    {
        return 'SELECT ' . $this->columns .
            ' FROM ' . $this->table .
            ' WHERE ' . $this->conditions .
            ' ORDER BY ' . $this->order .
            ' LIMIT ' . $this->limit .
            ' OFFSET ' . $this->offset;

    }
}