
# Quick PHP API (QPA)
Quick PHP API a.k.a QPA, is a lightweight, fast, customizable, open-source framework-like. Created by Jx32 (Jorge Fernandez), inspired by the Spring ecosystem.

Please feel free to open a Pull request or Issue at https://github.com/Jx32/php-quick-api for any improvement or issue found.

## 0. Minimum requirements

 1. PHP version 8+
 2. PDO extension enabled, see https://www.php.net/manual/en/pdo.installation.php

## 1. Quick start
### 1.1 Environment setup
#### 1.1.1 Database credentials
TBD
#### 1.1.2 Environment variables
TBD

### 1.2 Creating an entrypoint controller
TBD

### 1.3 Creating services
TBD

### 1.4 Creating DAOs
TBD

## 2. Project structure
This is the suggested project structure for your projects, you are free to modify it as your business requirements. Please take a moment to read it.

    api/
	    v1/
		    Here you could put the .php which would be the entrypoint for your different API operations (POST/GET/DELETE/etc).
		    Example: user.php
		v2/
			Also you could create as many versions directories as you want.
			
	controller/
		Here you could put your entrypoint controllers.
		Controllers will handle the entrypoint requests.
		Example: user-controller.php
		
	service/
		Services will contain the business logic. It could perform single/multiple calls to another DAOs or services.
		Example: user-service.php
		
	dao/
		Here you could put your DAOs in order to access/modify database information or even call another RESTful service.
		Example: user-dao.php
		
	database/
		You could use the built-in file "global-database-statements.json" to put your database statements.
		As PDO is used, you could use bind variables on those.
		Example: select * from users where id = ?
		
	exception/
		Here you could create your own custom business exceptions. Or use the built-in ones.
		Example: resource-not-found-exception.php
		
	filter/
		Here you could put any custom filter to change, view or validate the response or request in a filter chain.
		See "Filters" section on this Wiki for further info.
		
	model/
		Here you could put your database models.

	request/
		Here are many built-in classes to process incoming requests and responses.

## 3. Incoming requests life-cycle
Here's the suggested life-cycle **for every incoming request**:
![PHP Quick API suggested lifecycle](https://i.imgur.com/BS6vSBf.png)

## 4. Filters
### 4.1 Environment filter
TBD
### 4.2 Advisor filter
TBD
### 4.3 Security filter
TBD
### 4.4 Entrypoint controller filter
TBD
### 4.5 Custom filters
TBD

## 5. Exceptions
### 5.1 Custom exceptions
TBD
### 5.2 Exception handling
TBD

## 6. Best practices
TBD

## 7. Contributors
Currently this project is maintained by Jx32.