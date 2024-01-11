<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pokemon API using Laravel Sanctum</title>
</head>
<body>

<h1>Pokemon API using Laravel Sanctum</h1>

<p>Welcome to the Pokemon API project developed using Laravel Sanctum. This project serves as my submission for an interview task. If you'd like to test the API with fake data, follow the instructions below.</p>

<h2>Getting Started</h2>

<h3>Prerequisites</h3>

<p>Before running the project, make sure you have the following installed:</p>

<ul>
    <li><a href="https://www.php.net/manual/en/install.php">PHP</a></li>
    <li><a href="https://getcomposer.org/">Composer</a></li>
    <li><a href="https://nodejs.org/">Node.js</a></li>
    <li><a href="https://www.npmjs.com/">NPM</a></li>
</ul>

<h3>Installation</h3>


    <li>Clone the repository to your local machine:</li>

  <code>git clone https://github.com/your-username/pokemon-api.git</code>

    <li>Navigate to the project directory:</li>

 <code>cd pokemon-api</code>

    <li>Install PHP dependencies:</li>

   <code>composer install</code>

    <li>Install JavaScript dependencies:</li>

  <code>npm install</code>

    <li>Create a copy of the <code>.env.example</code> file and rename it to <code>.env</code>:</li>

    <code>cp .env.example .env</code>

    <li>Generate the application key:</li>

    <pre><code>php artisan key:generate</code></pre>

    <li>Set up your database configuration in the <code>.env</code> file.</li>

    <li>Run migrations and seed the database with fake data:</li>

    <code>php artisan migrate:fresh --seed</code>


<h3>Usage</h3>

<p>Start the development server:</p>

<pre><code>php artisan serve</code></pre>

<p>The API will be available at <a href="http://localhost:8000">http://localhost:8000</a>.</p>

<p>Feel free to explore the API endpoints and test it out with the provided fake data.</p>


<p>Thank you for checking out my Pokemon API project! If you have any questions or feedback, please don't hesitate to reach out.</p>

</body>
</html>
