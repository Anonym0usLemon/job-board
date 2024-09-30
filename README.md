# Project Name: Job Board
## Description: 
A job listing website where users can view job ads, post job ads, and apply for jobs. Developed using MVC architecture.

## To Run Locally: 
Clone the project and change the following Appache server configurations.
- Set document root in httpd.conf to ```/project_name/public``` so that Appache looks for the index in the public folder when you go to localhost in the browser. 
- Set the directory setting in httpd.conf to this value as well.

## Features:
### Login and Register 
Users can create accounts and login to create, update, and delete job listings.
### Protected Routes (middleware) 
Users can only access certain routes if they are logged in
