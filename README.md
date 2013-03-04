l4-odbc-driver
==============

Notes
=======
I have this working with the beta 3 current version of Laravel 4 and will commit and tag as 1.0 on 03/02/2013

Laravel 4 ODBC 

Installation
============

To Install this in your Laravel 4 app add

```json
require {
  "illuminate/app": "1.*",
  "ccovey/odbc-driver-l4": "*"
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
            'driver' => 'odbc'
            'dsn' => 'Driver={iSeries Access ODBC Driver};System=my_system_name;',
            'username' => 'foo',
            'password' => 'bar',
        ),
    ),
```

Notes
==========

This currently only uses the Default Grammar, which is basically MySql grammar. I am going to pull the grammar depending on a `grammar` config option in the database config. If you would like to submit a PR for a grammar file please feel free to do so and I'll get those merged in asap!

I have some ideas on how to get grammar based on the driver provided in the connection config array. Will take a bit to implement though. If you would like to submit a Grammar File please submit a pull request and I will add it in as possible.
