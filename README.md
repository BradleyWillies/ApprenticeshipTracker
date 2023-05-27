Project startup steps:
1. start xampp-controller and start MySQL and Apache
2. use phpStorm as an IDE
3. in phpStorm terminal: "php artisan serve" to start the development server
4. in phpStorm terminal: "npm run dev"

Admin
- To view the MySQL database go to http://localhost/phpmyadmin
- To access the application go to http://127.0.0.1:8000/dashboard or http://127.0.0.1:8000/register etc...

To run all tests
- php artisan test

To run all database seeders
- php artisan db:seed

To import modules from csv
- php artisan import:module-grades

To refresh the database and seed
- php artisan migrate:fresh --seed
