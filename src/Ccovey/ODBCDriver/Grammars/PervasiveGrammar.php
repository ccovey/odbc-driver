<?php namespace Ccovey\ODBCDriver\Grammars;

use Illuminate\Database\Query\Grammars\SqlServerGrammar;

/**
* Pervasive SQL Grammar
*/
class PervasiveGrammar extends SqlServerGrammar
{
    /**
     * The keyword identifier wrapper format.
     *
     * @var string
     */
    protected $wrapper = '"%s"';    
}
