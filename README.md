l4-odbc-driver
==============

Laravel 4 ODBC

Installation
============

To Install this in your Laravel 4.1 app add

```json
require {
  "ccovey/odbc-driver-l4": "1.1.x"
}
```

And then run

`composer install`

This will download the required package from Packagist.org

Then in your app/config directory open app.php and find

`'Illuminate\Database\DatabaseServiceProvider',`

And replace it with

`'Ccovey\ODBCDriver\ODBCDriverServiceProvider',`

Finally be sure to add the odbc driver with connection information to the `config/database.php` file like so:

```php
'default' => 'mysql',
    'connections' => array(
        'mysql' => array(
            'driver' => 'mysql',
            'host' => 'localhost',
            'database' => 'database',
            'username' => 'root',
            'password' => '',
            'charset' => 'utf8',
            'collation' => 'utf8_unicode_ci',
            'prefix' => '',
        ),
        'sqlsrv' => array(
            'driver' => 'sqlsrv',
            'host' => 'localhost',
            'database' => 'database',
            'username' => 'root',
            'password' => '',
            'prefix' => '',
        ),
        'odbc' => array(
            'driver' => 'odbc',
            'dsn' => 'Driver={iSeries Access ODBC Driver};System=my_system_name;',
            'type' => 'DB2',
            'username' => 'foo',
            'password' => 'bar',
            'database' => '',
        ),
    ),
```

Note that database is a required value in the array.

Notes
==========

To add a custom grammar add your file to ODBCDriver/Grammars with the name you would like to use (currently there is a DB2 grammar file if you would like a reference). Then in your odbc config array add the class name to the grammar key. If you would like to submit a grammar for use in the package please submit a pull request and I will get it in asap.

If you would like to use a Laravel provided file just add that instead. For example if you want to use SQL Server Gramamr instead you can add like so:

```php
'odbc' => array(
    'driver' => 'odbc',
    'dsn' => 'some driver',
    'grammar' => 'SqlServerGrammar',
    'username' => 'foo',
    'password' => 'bar',
    'database' => '',
),


