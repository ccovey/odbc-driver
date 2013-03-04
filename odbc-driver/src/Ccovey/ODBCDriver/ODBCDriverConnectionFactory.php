<?php namespace Ccovey\ODBCDriver;

use Illuminate\Database;

class ODBCDriverConnectionFactory extends Database\Connectors\ConnectionFactory
{
	public function createConnector(array $config)
	{
		if (!isset($config['driver'])) {
			throw new \InvalidArgumentException("A driver must be specified");
		}

		switch ($config['driver']) {
			case 'mysql':
				return new Database\Connectors\MySqlConnector;
			case 'pgsql':
				return new Database\Connectors\PostgresConnector;
			case 'sqlite':
				return new Database\Connectors\SQLiteConnector;
			case 'sqlsrv':
				return new Database\Connectors\SqlServerConnector;
			case 'odbc':
				return new ODBCDriverConnector;
		}

		throw new \InvalidArgumentException("Unsupported Driver [{$config['driver']}]");
	}

	public function createConnection($driver, \PDO $connection, $database, $tablePrefix ='', $name = NULL)
	{
		switch ($driver) {
            case 'mysql':
                return new Database\MySqlConnection($connection, $database, $tablePrefix);

            case 'pgsql':
                return new Database\PostgresConnection($connection, $database, $tablePrefix);

            case 'sqlite':
                return new Database\SQLiteConnection($connection, $database, $tablePrefix);

            case 'sqlsrv':
                return new Database\SqlServerConnection($connection, $database, $tablePrefix);
                
            case 'odbc':
                return new ODBCDriverConnection($connection, $database, $tablePrefix);
        }

        throw new \InvalidArgumentException("Unsupported driver [$driver]");
	}
}