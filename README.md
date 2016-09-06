# LicAPI
A PHP API to manage license info

## What is LicAPI?

LicAPI is an script that allows you to manage, verify and return data from your licenses.

## Demo:

You can see a demo of the script at [https://demo.miguelpiedrafita.com/licapi/logs.php](https://demo.miguelpiedrafita.com/licapi/logs.php) or test the verification function at [https://demo.miguelpiedrafita.com/licapi/test.html](https://demo.miguelpiedrafita.com/licapi/test.html) or by GET at [https://demo.miguelpiedrafita.com/licapi/api.php?license=](https://demo.miguelpiedrafita.com/licapi/api.php?license=).

Valid license: test
## Requirements:

- PHP >4.1
- MySQL database

## Installation:

- Upload all the files to your server.
- Create a MySQL Database.
- Import database info from licapi.sql.
- Open config.php, fill your database info and change
```php
$debug = false;
``` 

to
```php
$debug = true;
```
- Run the script with license test (do api.php?license=test).
- If the script doesn't show any errors, you're OK!
- **REMEMBER TO TURN $debug BACK TO false!!!**
- Change the demo info in database with your own custom info.
- Enjoy!

## Credits:

- Miguel Piedrafita - Script
- PHP
- MySQLi

Copyright (C) Miguel Piedrafita. Use of this work is subject to Mozilla Public License 2.0
