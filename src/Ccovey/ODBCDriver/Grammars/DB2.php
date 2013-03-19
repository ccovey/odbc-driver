<?php namespace Ccovey\ODBCDriver\Grammars;

use Illuminate\Database\Query\Grammars\Grammar;

/**
* DB2 Grammar
*/
class DB2 extends Grammar
{
     /**
     * Compile the "limit" portions of the query.
     *
     * @param  Illuminate\Database\Query\Builder  $query
     * @param  int  $limit
     * @return string
     */
    protected function compileLimit(\Illuminate\Database\Query\Builder $query, $limit)
    {
        return "FETCH FIRST $limit ROWS ONLY";
    }
}