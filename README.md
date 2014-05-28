Laravel 4 ODBC 
============

## Requirements
- PHP 5.3+
- Laravel 4.1.*

## Installation
L4ODBC can be install using composer by adding below line into your existing `composer.json` under require section and executing `composer update` in your Laravel project root folder.

```json
"wajatimur/odbc-driver": "dev-master"
```

Then you need to bootstrap the driver by declaring the service provider registration in you `app.php` file under `app\config` path from Laravel project root folder.

`'Foundation\Database\Driver\ODBCDriverServiceProvider',`

## Configuration
Finally be sure to add the odbc driver with connection information to the `config/database.php` file like so:

```php
    'connections' => array(

        // .. Existing config here ..

        'odbc' => array(
            'driver' => 'odbc',
            'dsn' => 'Driver={iSeries Access ODBC Driver};System=my_system_name;',
            'grammar' => 'DB2',
            'username' => 'foo',
            'password' => 'bar',
            'database' => '',
        ),
    ),
```

## Extending
To create a custom grammar just add your file to `Grammars` folder within the package. Below is the basic template to create a custom grammar.

```php
namespace Foundation\Database\Driver\Grammars;

use Illuminate\Database\Query\Grammars\Grammar;

class MyCustomGrammar extends {
    // .. Add your override method here ..
}

```

### Using Custom Grammer
To use the custom grammar, jusct change the grammar key in you database config base on you grammar file name. If you have a custom grammar with file name `MyCustomGrammar`, the grammar key should be as below.

```php
'odbc' => array(
    'driver' => 'odbc',
    'dsn' => 'some driver',
    'grammar' => 'MyCustomGrammar',
    'username' => 'foo',
    'password' => 'bar',
    'database' => '',
),
```

If you would like to use a Laravel provided grammar file just add that instead. For example if you want to use SQL Server Gramamr, you can use the `SqlServerGrammar` as key in your database config. Others grammar provided by Laravel listed below.

- MySqlGrammar
- SqlServerGrammar
- SQLiteGrammar
- PostgresGrammar

If you would like to submit a grammar for use in the package please submit a pull request and I will get it in asap.






