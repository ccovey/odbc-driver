<?php
/**
 * Description of ConnectionFactory
 *
 * @author cody
 */
namespace Ccovey\ODBCDriver;

use Illuminate\Database as Database;

class ConnectionFactory {

    public function createConnector(array $config) {
        if (!isset($config['driver'])) {
            throw new \InvalidArgumentException("A driver must be specified.");
        }

        switch ($config['driver']) {
            case 'mysql':
                return new Database\MySqlConnector;

            case 'pgsql':
                return new Database\PostgresConnector;

            case 'sqlite':
                return new Database\SQLiteConnector;

            case 'sqlsrv':
                return new Database\SqlServerConnector;
                
            case 'odbc':
                return new ODBCConnector;
        }
        throw new \InvalidArgumentException("Unsupported driver [{$config['driver']}]");
    }

    /**
     * Create a new connection instance.
     *
     * @param  string  $driver
     * @param  PDO     $connection
     * @param  string  $tablePrefix
     * @return Illuminate\Database\Connection
     */
    protected function createConnection($driver, PDO $connection, $tablePrefix) {
        switch ($driver) {
            case 'mysql':
                return new Database\MySqlConnection($connection, $tablePrefix);

            case 'pgsql':
                return new Database\PostgresConnection($connection, $tablePrefix);

            case 'sqlite':
                return new Database\SQLiteConnection($connection, $tablePrefix);

            case 'sqlsrv':
                return new Database\SqlServerConnection($connection, $tablePrefix);
                
            case 'odbc':
                return new ODBCConnection($connection, $tablePrefix);
        }

        throw new \InvalidArgumentException("Unsupported driver [$driver]");
    }
}
