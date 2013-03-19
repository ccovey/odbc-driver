<?php namespace Ccovey\ODBCDriver;

use Illuminate\Database;

class ODBCDriverConnection extends Database\Connection
{
	/**
	 * [getDefaultGrammar description]
	 * @return Query\Grammars\Grammar
	 */
	protected function getDefaultQueryGrammar()
	{
		$grammar = $this->getGrammarConfig();

		if ($grammar) {
			$grammar = "Ccovey\\ODBCDriver\\Grammars\\" . $grammar;

			return $this->withTablePrefix(new $grammar);
		}

		return $this->withTablePrefix(new Database\Query\Grammars\Grammar);
	}

	/**
	 * Default grammar for specified Schema
	 * @return Schema\Grammars\Grammar
	 */
	protected function getDefaultSchemaGrammar()
	{
		return $this->withTablePrefix(new Schema\Grammars\Grammar);
	}

	protected function getGrammarConfig()
	{
		if (\Config::has('database.connections.odbc.grammar')) {
			return \Config::get('database.connections.odbc.grammar');
		}

		return false;
	}
}