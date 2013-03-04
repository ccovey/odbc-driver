<?php namespace Ccovey\ODBCDriver;

use Illuminate\Database;

/**
*
*/
class ODBCDriverConnector extends Database\Connectors\Connector implements Database\Connectors\ConnectorInterface
{
	public function connect(array $config)
	{
		$dsn = $this->getDsn($config);
		
        $options = $this->getOptions($config);

        $connection = $this->createConnection($dsn, $config, $options);

        return $connection;
	}

	protected function getDsn(array $config) {
        extract($config);

        $dsn = "odbc:{$dsn}; {$username}; {$password};";

        return $dsn;
    }
}