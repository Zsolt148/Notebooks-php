# Notebooks-php development

### Configuration ###

- NodeJS https://nodejs.org/en/
- Composer https://getcomposer.org/

1. Clone the project

2. Go to the folder application using cd command on your cmd or terminal

3. Run ```composer install --ignore-platform-reqs``` and ```npm install```

4. Open your config/config.php file and change the database name (DB_DATABASE) to whatever you have, username (DB_USERNAME) and password (DB_PASSWORD) field correspond to your configuration.

5. Import notebooks.sql

6. Run ```npm run dev``` (Run ```npm run watch``` for development) (Run ```npm run build``` for production)

### Recommended development hosting ###

1. Go to your xampp extra folder. Ex.: D:\xampp\apache\conf\extra
2. Open httpd-vhosts.conf
3. Add: ```<VirtualHost *:80>
     ServerName notebooks.test
     DocumentRoot "C:\xampp\htdocs\Notebooks-php\public"
     <Directory "C:\xampp\htdocs\Notebooks-php\public">
         DirectoryIndex index.php
         AllowOverride All
	      Order allow,deny
	      Allow from all
	      Options Indexes FollowSymLinks
     </Directory>
   </VirtualHost>```

   NOTE! The "path to project" has to point to the public folder in the project (e.g.: "C:\xampp\htdocs\Notebooks-php\public")!
4. Open C:\Windows\System32\drivers\etc
5. Add ```127.0.0.1 notebooks.test```
6. Restart xampp and go to http://notebooks.test in a browser

### Admin ###

Admin URL: /admin

##### Default credentials
##### `email: admin@admin.com`
##### `password: admin`


