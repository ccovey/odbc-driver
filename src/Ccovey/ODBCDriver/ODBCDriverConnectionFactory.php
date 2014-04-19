<?php

namespace Ccovey\ODBCDriver;

use Illuminate\Database\Connectors\ConnectionFactory;
use Illuminate\Database\Connectors\MySqlConnector;
use Illuminate\Database\Connectors\PostgresConnector;
use Illuminate\Database\Connectors\SQLiteConnector;
use Illuminate\Database\Connectors\SqlServerConnector;
use Illuminate\Database\MySqlConnection;
use Illuminate\Database\PostgresConnection;
use Illuminate\Database\SQLiteConnection;
use Illuminate\Database\SqlServerConnection;

class ODBCDriverConnectionFactory extends ConnectionFactory
{
	public function createConnector(array $config)
	{
		if (!isset($config['driver'])) {
			throw new \InvalidArgumentException("A driver must be specified");
		}

		switch ($config['driver']) {
			case 'mysql':
				return new MySqlConnector;
			case 'pgsql':
				return new PostgresConnector;
			case 'sqlite':
				return new SQLiteConnector;
			case 'sqlsrv':
				return new SqlServerConnector;
			case 'odbc':
				return new ODBCDriverConnector;
		}

		throw new \InvalidArgumentException("Unsupported Driver [{$config['driver']}]");
	}

	public function createConnection($driver, \PDO $connection, $database, $prefix ='', array $config = array())
	{
		if ($this->container->bound($key = "db.connection.{$driver}"))
		{
			return $this->container->make($key, array($connection, $database, $prefix, $config));
		}

		switch ($driver) {
            case 'mysql':
                return new MySqlConnection($connection, $database, $prefix, $config);

            case 'pgsql':
                return new PostgresConnection($connection, $database, $prefix, $config);

            case 'sqlite':
                return new SQLiteConnection($connection, $database, $prefix, $config);

            case 'sqlsrv':
                return new SqlServerConnection($connection, $database, $prefix, $config);
                
            case 'odbc':
                return new ODBCDriverConnection($connection, $database, $prefix, $config);
        }

        throw new \InvalidArgumentException("Unsupported driver [$driver]");
	}
}
