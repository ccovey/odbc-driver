<?php namespace Ccovey\ODBCDriver;

use Illuminate\Database;

class ODBCDriverConnection extends Database\Connection
{

	/**
	 * [getDefaultGrammar description]
	 * @return Query\Grammars\Grammar
	 */
	protected function getDefaultGrammar()
	{
		return $this->withTablePrefix(new Query\Grammars\Grammar);
	}

	/**
	 * Default grammar for specified Schema
	 * @return Schema\Grammars\Grammar
	 */
	protected function getDefaultSchemaGrammar()
	{
		return $this->withTablePrefix(new Schema\Grammars\Grammar);
	}
}