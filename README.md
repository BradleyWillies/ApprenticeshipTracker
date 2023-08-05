# Apprenticeship Tracker
Welcome to Apprenticeship Tracker! This README file provides step-by-step instructions on how to set up the project on your local machine and start developing.

[Live Website](https://apprenticeship-tracker-p4ygr.ondigitalocean.app/)


## Prerequisites
Before you begin, make sure you have the following software installed:

- [git](https://git-scm.com/downloads)
- [PHP](https://www.php.net/downloads.php) (minimum version 8.0.3)
- [Composer](https://getcomposer.org/download/)
- [MySQL](https://dev.mysql.com/downloads/installer/)
- [XAMPP](https://www.apachefriends.org/index.html) or any other local server environment of your choice
- [PHPStorm](https://www.jetbrains.com/phpstorm/download/#section=windows) (optional, you can use any other code editor of your preference)
- Database development tool, such as [MySQL Workbench](https://dev.mysql.com/downloads/workbench/) 


## Setup Instructions
1. Clone the repository:\
`git clone https://github.com/BradleyWillies/ApprenticeshipTracker.git`\
cd to the project folder

2. Install Composer dependencies:\
`composer install`

3. Install npm packages:\
`npm install`

4. Configure Environment:\
Use the existing environment variables or copy the .env.example file to create a new .env file:\
`cp .env.example .env`\
Open .env in a text editor and update the database settings according to your local environment (database name, username, password).\
Change the 'APP_URL' to '//127.0.0.1:8000'.

5. Generate the key for the environment file, it will define the value for 'APP_KEY':\
`php artisan key:generate`

6. Start the MySQL database:\
In the XAMPP controller click "Start" next to MySQL.\
You can use any local database tool to view and edit the database, e.g. MySQL Workbench.

7. Run Migrations:\
`php artisan migrate`\
Type 'yes' when it asks to create the database with the name you provided in your .env file.

8. Seed the Database (Optional):\
`php artisan db:seed`


## Development
1. Start the Development Server:\
`php artisan serve`

2. Compile assets for the Development Server:\
Start a new console in the project folder directory.\
`npm run dev`

3. Access the Application:\
Open your web browser and navigate to http://127.0.0.1:8000/ to access the application.\
The application web address for the Development Server should be provided next to APP_URL when you execute "npm run dev".

4. Login with seeded user accounts:\
Find the emails of users in the "users" database table, and the default password is 12345678

5. Run all Laravel tests:\
Start a new console in the project folder directory.\
`php artisan test`\
This will also import some example modules for user id 6, which is an apprentice.


## Contact
For any questions or feedback, please reach out to [Bradley Willies](mailto:bradley.willies@gmail.com)