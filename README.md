# Initial Setup

## 1. Clone the repository
Find a location on your computer where you want to store the project. A directory made for projects is generally a good choice.

Launch a bash console there and clone the project.

`git clone https://github.com/sandeshpangrekar9/task-app.git`

## 2. cd into the project
You will need to be inside the project directory that was just created, so cd into it.

`cd project_name`

## 3. Install composer dependencies
Whenever you clone a new Laravel project you must now install all of the project dependencies. This is what actually installs Laravel itself, among other necessary packages to get started.

`composer install`

## 4. Install NPM dependencies
Similarly to composer, npm manages javascript, css, and node packages, so make sure to install those dependencies also.

`npm install`

## 5. Copy the .env file
.env files are not generally committed to source control for security reasons. But there is a .env.example which is a template of the .env file that the project requires.

So you should make a copy of the .env.example file and name it .env so that you can setup your local deployment configuration in the next few steps.

`cp .env.example .env`

## 6. Generate an app encryption key
Laravel requires you to have an app encryption key which is generally randomly generated and stored in your .env file. The app will use this encryption key to encode various elements of your application from cookies to password hashes and more.

Laravel’s command line tools thankfully make it easy to generate this. Run this command in the terminal to generate that key.

`php artisan key:generate`

## 7. In the .env file, add database information to allow Laravel to connect to the database
You will need to allow Laravel to connect to the database that you just created in the previous step. To do this, you must add the connection credentials in the .env file and Laravel will handle the connection from there.

In .env file, update env variables as below. This will allow you to run migrations in the next step.

    DB_CONNECTION=mysql

    DB_HOST=127.0.0.1

    DB_PORT=3306

    DB_DATABASE=taskapp

    DB_USERNAME=root

    DB_PASSWORD=

## 8. Migrate the database
Once your credentials are in the .env file, now you can migrate your database. This will create all the necessary tables in your database.

`php artisan migrate`

## 9. Run Database Seeder
In order to insert required data into the database, we need to run seeders using below mentioned command:-

`php artisan db:seed`

## 10. Create npm build
To create npm build, run below command:-

`npm run build`


# During Development

## Compiling assets
To compile all sass and js assets using webpack/vite, run the following command.

`npm run dev`

To create npm build, run below command:-

`npm run build`

## Local development server
To run a local development server you may run the following command. This will start a development server at **http://localhost:8000**.

`php artisan serve`