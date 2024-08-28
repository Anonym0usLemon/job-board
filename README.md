# Project Name: Job Board
## Description: 
A job listing website where users can view job ads, post job ads, and apply for jobs. Developed using MVC architecture. Developed for reference when building vanilla PHP applications.

## Configuration Notes: 
Developed Locally on XAMPP, Appache server configurations were changed.
Document root in httpd.conf was set to ```/project_name/public``` so that Appache looks for the index in the public folder when you go to localhost in your browser. The directory setting in httpd.conf was also set to this value.

## Project Structure:
A Database class is defined in the root of the project folder ```/Database.php```. Database connection configurations are stored in ```/config/db.php```. 
### How to use: 
Instantiate a new database object in your controller and use the query method to get data. Pass the data as a second parameter to the loadView() function defined in ```/helpers.php``` in the root of the project folder. An example of this can be found in the home controller ```/controllers/home.php```