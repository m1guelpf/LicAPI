# LicAPI
A PHP API to manage license info

## What is LicAPI?

LicAPI is an script that allows you to check if your product's license is valid and get all the info from the license.

## Requirements:

- PHP >4.1
- MySQL database

## Installation:

1. Upload all the files to your server.
2. Create a MySQL Database.
3. Import database info from licapi.sql.
4. Open config.php, fill your database info and change $debug = false; to $debug = true;
5. Run the script with license test (do api.php?license=test).
6. If the script doesn't show any errors, you're OK!
7. REMEMBER TO TURN $debug BACK TO false!!!
8. Change the demo info in database with your own custom info.
9. Enjoy!

## Credits:

- Miguel Piedrafita - Script
- PHP
- MySQLi

Copyright (C) Miguel Piedrafita. Use of this work is subject to license.
