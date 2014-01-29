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

	public function createConnection($driver, \PDO $connection, $database, $tablePrefix ='', $name = NULL)
	{
		switch ($driver) {
            case 'mysql':
                return new MySqlConnection($connection, $database, $tablePrefix);

            case 'pgsql':
                return new PostgresConnection($connection, $database, $tablePrefix);

            case 'sqlite':
                return new SQLiteConnection($connection, $database, $tablePrefix);

            case 'sqlsrv':
                return new SqlServerConnection($connection, $database, $tablePrefix);
                
            case 'odbc':
                return new ODBCDriverConnection($connection, $database, $tablePrefix);
        }

        throw new \InvalidArgumentException("Unsupported driver [$driver]");
	}
}