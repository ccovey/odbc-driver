<?php

namespace Ccovey\ODBCDriver;

use Illuminate\Database\Connectors as Connectors;

class ODBCConnector extends Connectors\Connector implements Connectors\ConnectorInterface {

    /**
     * Establish a database connection.
     *
     * @param  array  $options
     * @return PDO
     */
    public function connect(array $config) {
        $dsn = $this->getDsn($config);

        // We need to grab the PDO options that should be used while making the brand
        // new connection instance. The PDO options control various aspects of the
        // connection's behavior, and some might be specified by the developers.
        $options = $this->getOptions($config);

        $connection = $this->createConnection($dsn, $config, $options);

        return $connection;
    }

    /**
     * Create a DSN string from a configuration.
     *
     * @param  array   $config
     * @return string
     */
    protected function getDsn(array $config) {
        // First we will create the basic DSN setup as well as the port if it is in
        // in the configuration options. This will give us the basic DSN we will
        // need to establish the PDO connections and return them back for use.
        extract($config);

        $dsn = "odbc:{$dsn}; {$username}; {$password};";

        return $dsn;
    }
}