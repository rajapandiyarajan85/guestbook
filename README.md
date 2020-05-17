# README #

This README would normally document whatever steps are necessary to get your application up and running.

### GuestBook App ###

* A simple guest book application to manage users content with addition to approval from admin for the same. 
* Version - 1.0

### Prerequisite set up ###

* Summary of set up
  To run the application below are the pre-requisites 
	* PHP 7.1.29 or higher
	* pdo_mysql PHP extension enabled;
	* Mysql 5.X.X or above
	* XAMPP or WAMP or LAMP - server to run application
	* other options to have built in web server:
		 * composer require symfony/web-server-bundle --dev
		 * php bin/console server:start
* Configuration
	Use composer require symfony/apache-pack for rewrite rules if you don't have settings in .htaccess
	For path kindly modify the below changes in apache config
	<VirtualHost *>
	   DocumentRoot "<app public path>"
	   ServerName <any domain>
	   <Directory <app public path>>
		AllowOverride All
		Order Allow,Deny
		Allow from All
	    </Directory>
	</VirtualHost>
* Dependencies
	* PHP
	* MYSQL DB
	* COMPOSER
	* Symfony packages
* Database configuration
	Step 1: 
	Create Mysql User in your local DB:
	CREATE USER 'guest'@'localhost' IDENTIFIED BY '5@74A2iTTN5MZM-';
	GRANT ALL PRIVILEGES ON *.* TO 'guest'@'localhost' WITH GRANT OPTION;
	
	Step 2: 
	php bin/console doctrine:database:create  // to create DB based on .env configuration
	
	Step 3: 
	php bin/console doctrine:schema:update --force  // create tables and so
	
	Step 4: 
	php bin/console doctrine:fixtures:load  // create dummy data in DB -  For this app created username / password in user table
	
* How to run tests
	TO DO

### Contribution guidelines ###

* Writing tests
	TO DO


### Who do I talk to? ###

We have used many useful packages annotations, apache-pack, Maker-bundle, Form, Repository. 

### To Do ###
More unit tests
More restrictions with users and page access
Effective cache

Hope this app helpful to begin good with Symfony. Thanks for your time. 
