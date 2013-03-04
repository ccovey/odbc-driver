l4-odbc-driver
==============

Laravel 4 ODBC 

Installation
============

To Install this in your Laravel 4 app add

```json
require {
  "ccovey/odbc-driver": "*"
}
```

And then run 

`composer install`

This will download the required package from Packagist.org

Then in your app/config directory open app.php and find 

`'Illuminate\Database\DatabaseServiceProvider',`

And replace it with

`'Ccovey\ODBCDriver',`

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
            'grammar' => '',
            'username' => 'foo',
            'password' => 'bar',
        ),
    ),
```

Notes
==========

This currently only uses the Default Grammar, which is basically MySql grammar. I am going to pull the grammar depending on a `grammar` config option in the database config. If you would like to submit a PR for a grammar file please feel free to do so and I'll get those merged in asap!


