<?php

namespace Algvo\QueryBuilder;

use Aigletter\Contracts\Builder\BuilderInterface;
use Aigletter\Contracts\Builder\QueryBuilderInterface;
use Aigletter\Contracts\Builder\QueryInterface;

class QueryBuilder implements QueryBuilderInterface
{

    protected $columns;
    protected $conditions;
    protected $table;
    protected $limit;
    protected $offset;
    protected $order;

    /**
     * @inheritDoc
     */
    public function select($columns): BuilderInterface
    {
        $this->columns = $columns;
        return $this;
    }

    /**
     * @inheritDoc
     */
    public function where($conditions): BuilderInterface
    {
        $this->conditions = $conditions;
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
        $this->order = $order;
        return $this;
    }

    public function build(): QueryInterface
    {
        return new Query(
            $this->columns,
            $this->table,
            $this->conditions,
            $this->limit,
            $this->offset,
            $this->order
        );
    }
}