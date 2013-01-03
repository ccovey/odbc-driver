l4-odbc-driver
==============

Laravel 4 ODBC 

Installation
============

To Install this in your Laravel 4 app add

`require {
  "ccovey/odbc-driver-l4": "*"
}`

And then run 

`composer install`

This will download the required package from Packagist.org

Then in your app/config directory open app.php and find 

`'Illuminate\Database\DatabaseServiceProvider',`

And replace it with

`'Ccovey\ODBCDriver',`

Finally be sure to add the odbc driver with connection information to the `config/database.php` file like so:

```'default' => 'mysql',
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
            'driver' => 'Driver={iSeries Access ODBC Driver};System=my_system_name;',
            'username' => 'foo',
            'password' => 'bar',
        ),
    ),```
    
    
