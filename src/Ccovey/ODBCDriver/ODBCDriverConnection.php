<?php namespace Ccovey\ODBCDriver;

use Illuminate\Database\Connection;
use Illuminate\Database;

class ODBCDriverConnection extends Connection
{
	/**
	 * @return Query\Grammars\Grammar
	 */
	protected function getDefaultQueryGrammar()
	{
		$grammarConfig = $this->getGrammarConfig();

		if ($grammarConfig) {
			$packageGrammar = "Illuminate\\Database" . $grammarConfig;
			if (class_exists($packageGrammar)) {
				return $this->withTablePrefix(new $packageGrammar);
			}

			$illuminateGrammar = "Illuminate\\Database\\Query\\Grammars\\" . $grammarConfig;
			if (class_exists($illuminateGrammar)) {
				return $this->withTablePrefix(new $illuminateGrammar);
			}
		}

		return $this->withTablePrefix(new Query\Grammars\Grammar);
	}

	/**
	 * Default grammar for specified Schema
	 * @return Schema\Grammars\Grammar
	 */
	protected function getDefaultSchemaGrammar()
	{
        $grammarConfig = $this->getGrammarConfig();
		if ($grammarConfig) {
			$packageGrammar = "Illuminate\\Database" . $grammarConfig;
			if (class_exists($packageGrammar)) {
				return $this->withTablePrefix(new $packageGrammar);
			}

			$illuminateGrammar = "Illuminate\\Database\\Schema\\Grammars\\" . $grammarConfig;
			if (class_exists($illuminateGrammar)) {
				return $this->withTablePrefix(new $illuminateGrammar);
			}
		}
		return $this->withTablePrefix(new Schema\Grammars\Grammar);
	}

	protected function getGrammarConfig()
	{
		if ($this->getConfig('grammar')) {
			return $this->getConfig('grammar');
		}

		return false;
	}
}
