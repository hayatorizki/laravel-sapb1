# Connect to SAP B1 using Laravel
Simple way to use Laravel library for SAP Business One Service Layer

## Required
- Laravel version 6.*
- Guzzle 7
- kkszymanowski/laravel-6-odbc
## Usage
Add this to .env file

```php
ASSET_URL=/assets

SL_URL=https://yourIP:Port
SL_PATH=/b1s/v1/


DB_ODBC_CONNECTION_STRING="odbc:DRIVER=HDBODBC;ServerNode=yourIP:Port;Database=DBname;UID=Username;PWD=Password"
DB_ODBC_HOST="yourIP:Port"
DB_ODBC_DATABASE="DBname"
DB_ODBC_USERNAME="Username"
DB_ODBC_PASSWORD="Password"
```

Add this to database.php

```php
    'connections' => [
        'myOdbcConnection' => [
            'driver'   => 'odbc',
            'dsn'      => env('DB_ODBC_CONNECTION_STRING'),
            'host'     => env('DB_ODBC_HOST'),
            'database' => env('DB_ODBC_DATABASE'),
            'username' => env('DB_ODBC_USERNAME'),
            'password' => env('DB_ODBC_PASSWORD'),
        ],

        // ...
    ],
```
And you are ready to go