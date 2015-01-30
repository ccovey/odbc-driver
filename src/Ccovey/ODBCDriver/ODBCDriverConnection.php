<?php namespace Ccovey\ODBCDriver;

use Illuminate\Database\Connection;
use Illuminate\Database\Query\Grammars\Grammar;
use Illuminate\Database\Query\Processors\Processor;
use Ccovey\ODBCDriver\Processors\DB2Processor;

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

		return $this->withTablePrefix(new Grammar);
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
		if ($this->getConfig('grammar')) {
			return $this->getConfig('grammar');
		}

		return false;
	}
	
	protected function getProcessorConfig()
	{
		if ($this->getConfig('processor')) {
			return $this->getConfig('processor');
		}

		return false;
	}
	
	
	/**
	 * Get the default post processor instance.
	 *
	 * @return \Illuminate\Database\Query\Processors\PostgresProcessor
	 */
	protected function getDefaultPostProcessor()
	{
		$processorConfig = $this->getProcessorConfig();
		
		if ($processorConfig) {
			$packageProcessor = "Ccovey\\ODBCDriver\\Processors\\" . $processorConfig; 
			if (class_exists($packageProcessor)) {
				return new $packageProcessor;
			}
			
			$illuminateProcessor = "Illuminate\\Database\\Query\\Processors\\" . $processorConfig;
			if (class_exists($illuminateProcessor)) {
				return new $illuminateProcessor;
			}
		}
		
		return new Processor;
	}
}
