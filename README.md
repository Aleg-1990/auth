## Insallation

Copy configuration file 

`config.php.dist` 

to 

`config.php` 

and set your database settings there

--

Create schema:

`php commands/install.php`

## Usage

Run web server:

`php -S localhost:8888 -t web/`

## Main information about application

 App - Main instance of the application.
 
 Db - Database connection holder

 Authentication - Class for login/register users.
 
 User - Instance of the users table in the database
 

### Improvements
 - App
   - create service container
 - Authentication
   - add storage provider
   - add user provider
 - Db
   - move config out of the file
   - create abstraction layer
 - ActiveRecord
   - create full-featured ORM, add migrations
 - index.php
   - split into controllers, actions
 - write unit tests