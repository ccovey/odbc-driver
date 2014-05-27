<?php namespace Foundation\Database\Driver\Grammars;

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

     /**
     * Compile a select query into SQL.
     *
     * @param  Illuminate\Database\Query\Builder
     * @return string
     */
    public function compileSelect(\Illuminate\Database\Query\Builder $query)
    {
        $components = $this->compileComponents($query);

        // If an offset is present on the query, we will need to wrap the query in
        // a big "ANSI" offset syntax block. This is very nasty compared to the
        // other database systems but is necessary for implementing features.
        if ($query->offset > 0)
        {
            return $this->compileAnsiOffset($query, $components);
        }

        return $this->concatenate($components);
    }

     /**
     * Create a full ANSI offset clause for the query.
     *
     * @param  Illuminate\Database\Query\Builder  $query
     * @param  array  $components
     * @return string
     */
    protected function compileAnsiOffset(\Illuminate\Database\Query\Builder $query, $components)
    {
        // An ORDER BY clause is required to make this offset query work, so if one does
        // not exist we'll just create a dummy clause to trick the database and so it
        // does not complain about the queries for not having an "order by" clause.
        if ( ! isset($components['orders']))
        {
            $components['orders'] = 'order by 1';
        }

        unset($components['limit']);

        // We need to add the row number to the query so we can compare it to the offset
        // and limit values given for the statements. So we will add an expression to
        // the "select" that will give back the row numbers on each of the records.
        $orderings = $components['orders'];

        $columns = (!empty($components['columns']) ? $components['columns'] . ', ': 'select');

        $components['columns'] = $this->compileOver($orderings, $columns);

        unset($components['orders']);

        // Next we need to calculate the constraints that should be placed on the query
        // to get the right offset and limit from our query but if there is no limit
        // set we will just handle the offset only since that is all that matters.
        $start = $query->offset + 1;

        $constraint = $this->compileRowConstraint($query);

        $sql = $this->concatenate($components);

        // We are now ready to build the final SQL query so we'll create a common table
        // expression from the query and get the records with row numbers within our
        // given limit and offset value that we just put on as a query constraint.
        return $this->compileTableExpression($sql, $constraint);
    }

    /**
     * Compile the over statement for a table expression.
     *
     * @param  string  $orderings
     * @return string
     */
    protected function compileOver($orderings, $columns)
    {
        return "{$columns} row_number() over ({$orderings}) as row_num";
    }

    protected function compileRowConstraint($query)
    {
        $start = $query->offset + 1;

        if ($query->limit > 0)
        {
            $finish = $query->offset + $query->limit;

            return "between {$start} and {$finish}";
        }

        return ">= {$start}";
    }

        /**
     * Compile a common table expression for a query.
     *
     * @param  string  $sql
     * @param  string  $constraint
     * @return string
     */
    protected function compileTableExpression($sql, $constraint)
    {
        return "select * from ({$sql}) as temp_table where row_num {$constraint}";
    }

    /**
     * Compile the "offset" portions of the query.
     *
     * @param  Illuminate\Database\Query\Builder  $query
     * @param  int  $offset
     * @return string
     */
    protected function compileOffset(\Illuminate\Database\Query\Builder $query, $offset)
    {
        return '';
    }
}