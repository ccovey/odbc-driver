<?php namespace Ccovey\ODBCDriver;

use Illuminate\Database\Connection;
use Illuminate\Database\Query\Grammars\Grammar as QueryGrammar;
use Illuminate\Database\Schema\Grammars\Grammar as SchemaGrammar;

class ODBCDriverConnection extends Connection
{
	/**
	 * @return Query\Grammars\Grammar
	 */
	protected function getDefaultQueryGrammar()
	{
		$grammarConfig = $this->getGrammarConfig();

		if ($grammarConfig) {
			$packageGrammar = "Ccovey\\ODBCDriver\\Grammars\\" . $grammarConfig;
			if (class_exists($packageGrammar)) {
				return $this->withTablePrefix(new $packageGrammar);
			}

			$illuminateGrammar = "Illuminate\\Database\\Query\\Grammars\\" . $grammarConfig;
			if (class_exists($illuminateGrammar)) {
				return $this->withTablePrefix(new $illuminateGrammar);
			}
		}

		return $this->withTablePrefix(new QueryGrammar);
	}

	/**
	 * Default grammar for specified Schema
	 * @return Schema\Grammars\Grammar
	 */
	protected function getDefaultSchemaGrammar()
	{
		return $this->withTablePrefix(new SchemaGrammar);
	}

	/**
	 * Get the default post processor instance.
	 *
	 * @return \Illuminate\Database\Query\Processors\Processor
	 */
	protected function getDefaultPostProcessor()
	{
		$processorConfig = $this->getProcessorConfig();

		if ($processorConfig) {
			$packageGrammar = "Ccovey\\ODBCDriver\\Processors\\" . $processorConfig;
			if (class_exists($packageGrammar)) {
				return new $packageGrammar;
			}

			$illuminateGrammar = "Illuminate\\Database\\Query\\Processors\\" . $processorConfig;
			if (class_exists($illuminateGrammar)) {
				return new $illuminateGrammar;
			}
		}

		return new \Illuminate\Database\Query\Processors\Processor;
	}

	protected function getGrammarConfig()
	{
		if ($this->getConfig('type')) {
			return $this->getConfig('type') . 'Grammar';
		}

		if ($this->getConfig('grammar')) {
			return $this->getConfig('grammar');
		}

		return false;
	}

	protected function getProcessorConfig()
	{
		if ($this->getConfig('type')) {
			return $this->getConfig('type') . 'Processor';
		}

		if ($this->getConfig('grammar')) {
			if( substr($this->getConfig('grammar'), -7) == 'Grammar')
			{
			return  substr($this->getConfig('grammar'), 0, -7) . 'Processor';
			}
			else
			{
				return $this->getConfig('grammar') . 'Processor';
			}
		}

		return false;
	}
}
