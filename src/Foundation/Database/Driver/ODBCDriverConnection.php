<?php namespace Foundation\Database\Driver;

use Illuminate\Database\Connection;
use Illuminate\Database\Schema\Grammars\Grammar;


class ODBCDriverConnection extends Connection
{
	/**
	 * @return Query\Grammars\Grammar
	 */
	protected function getDefaultQueryGrammar()
	{
		$grammarConfig = $this->getGrammarConfig();

		if ($grammarConfig) {
			$packageGrammar = "Foundation\\Database\\Driver\\Grammars\\" . $grammarConfig; 
			if (class_exists($packageGrammar)) {
				return $this->withTablePrefix(new $packageGrammar);
			}
			
			$illuminateGrammar = "Illuminate\\Database\\Query\\Grammars\\" . $grammarConfig;
			if (class_exists($illuminateGrammar)) {
				return $this->withTablePrefix(new $illuminateGrammar);
			}
		}

		return $this->withTablePrefix(new Grammar);
	}

	/**
	 * Default grammar for specified Schema
	 * @return Schema\Grammars\Grammar
	 */
	protected function getDefaultSchemaGrammar()
	{
		return $this->withTablePrefix(new Grammar);
	}

	protected function getGrammarConfig()
	{
		if ($this->getConfig('grammar')) {
			return $this->getConfig('grammar');
		}

		return false;
	}
}
