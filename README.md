### Usage
`php -S localhost:8888 -t web/`

### Used
 App - Main instance of the application.
 
 Db - Database connection holder

 Authentication - Class for login/register users.
 
 User - Instance of the users table in the database
 

### Improvements
 - App
   - create service container
 - Authentication
   - add storage provider(not only session)
   - add user provider
 - Db
   - move config out of the file

