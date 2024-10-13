
## Railway Deployment Guide

This guide will help you deploy your Railway app to the Railway platform.

### Steps 
1 - Create a new project on Railway and select the MySQL database.
2- Within that project create new services for the backend and select the github repo.
3- Add the environment variables in the Railway dashboard.
4- Add this build command in environment variables:

    `NIXPACKS_BUILD_CMD="npm run build && composer install && php artisan migrate --force && php artisan optimize:clear && php artisan storage:link && php artisan passport:keys && php artisan key:generate"`

5 - Deploy the backend service.

6 - Go to Settings > network > generate public URL and copy the URL.

7 - After that click on that and change the port to : 8080

8 - Api Ready for use.


### Remote Database Connection 
1- You can use the remote database with in local machine go to the mysql service and then copy the credentials and use them.
