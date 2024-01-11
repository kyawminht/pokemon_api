Pokemon API using Laravel Sanctum
Welcome to the Pokemon API project developed using Laravel Sanctum. This project serves as my submission for an interview task. If you'd like to test the API with fake data, follow the instructions below.

Getting Started
Prerequisites
Before running the project, make sure you have the following installed:

PHP
Composer
Node.js
NPM
Installation
Clone the repository to your local machine:

bash
Copy code
git clone https://github.com/your-username/pokemon-api.git
Navigate to the project directory:

bash
Copy code
cd pokemon-api
Install PHP dependencies:

bash
Copy code
composer install
Install JavaScript dependencies:

bash
Copy code
npm install
Create a copy of the .env.example file and rename it to .env:

bash
Copy code
cp .env.example .env
Generate the application key:

bash
Copy code
php artisan key:generate
Set up your database configuration in the .env file.

Run migrations and seed the database with fake data:

bash
Copy code
php artisan migrate:fresh --seed
Usage
Start the development server:

bash
Copy code
php artisan serve
The API will be available at http://localhost:8000.

Feel free to explore the API endpoints and test it out with the provided fake data.


Thank you for checking out my Pokemon API project! If you have any questions or feedback, please don't hesitate to reach out.
