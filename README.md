# projet-23-o-travel-back

## First step:

Install:  
```composer install```

Creation of the skeleton:  
```composer create-project symfony/skeleton```

## Database creation:

We create the database otravel.
First we use:   
```composer require symfony/orm-pack```  
```composer require --dev symfony/maker-bundle```

We had a new file env.local, we select the good code line for our database:  
```mysql://db_user:db_password@127.0.0.1:3306/db_name?serverVersion=mariadb-10.5.8```  
We replace db-user and db_password and db_name by our user and password and database name.  
Here we use otravel for all.

Now, we can create the databe with the command:  
```bin/console doctrine:database:create```

We can use the command ```make:entity``` to create the table of the database one by one.  

After creating the database, we make the migration, we use the following command:  
```bin/console make:migration```  
```bin/console doctrine:migrations:migrate``` or the short version ```bin/console d:m:m```  

## Database relation:

Now, we can create the reltion for each tables.  
We use the command ```make:entity``` but this time we said that we want a ***relation***.  

After we had created the relations, we can make an other ```bin/console make:migration``` and a ```bin/console d:m:m```.  
We check in Mariadb and we see all the tables and relations created.  

## Fixtures  

Now we can procide withe the creation of the fixture to fulfil our database.  

we start by installing the orm-fixtures, with the following commands:  
```composer require --dev orm-fixtures```  
```composer require --dev doctrine/doctrine-fixtures-bundle```  

We create a truncate function to delete all data and id when we use the command ```bin/console doctrine:fixtures:load```.  

## API creation  

We begin by create an ApiController with the command: ```bin/console make controler```  

Install of Serialazer with the command: ```composer require symfony/serializer```  

We install serializer pack too, with the command: ```composer require symfony/serializer-pack```  

We can create now, the route for API.  

## NelmioCorsBundle installation  

We instal the NelmioCorsBundle to make the communication between the Front and the api in Back.  
First, we use the command: ```composer require nelmio/cors-bundle```  
Second, we check and adapt the file ```config/packages/nelmio_cors.yaml```, now we the Front can communicate with the Back.  

## Easyadmin installation  

We start by instal the bundle Easyadmin, we use the following command:  
```composer require easycorp/easyadmin-bundle```  

We create now the CRUD for the Users, we use the follwong command:  
```bin/console mak:crud``` but it's not working because we don't have install annotations, so we install it with ```composer require validator annotations```.   

We create the UsersController and the destinationsController.  

We create now the dashboards witht the command: ```bin/console make:admin:dashboard```.   

We create a personal 'home page' for the Back.  
We want to add the destinatiosn list and users, for thaht we use the follwing command ```bin/console make:admin:crud``` to create **DestinationsCrudController** and **UsersCrudController**. Now we can add icons to link the list of users and destination in the **DashboardController**.   

We need to install the package security with the command: ```composer require security```.  

## Connextion and security  

**Connection for the website**

We start by using the command : ```composer require security```.  

Now we can continue with the creation of th user controller, so we use:```bin/console make:user```.  
After that, we can proceed to a migration.  

We will on authentication with the command: ```bin/console make:auth```.  

We complete the creation:

```bash
bin/console make:auth

 What style of authentication do you want? [Empty authenticator]:
  [0] Empty authenticator
  [1] Login form authenticator
 > 1

 The class name of the authenticator to create (e.g. AppCustomAuthenticator):
 > LoginForm

 Choose a name for the controller class (e.g. SecurityController) [SecurityController]:
 > 

 Do you want to generate a '/logout' URL? (yes/no) [yes]:
 > 

 created: src/Security/LoginFormAuthenticator.php
 updated: config/packages/security.yaml
 created: src/Controller/SecurityController.php
 created: templates/security/login.html.twig

           
  Success! 
           

 Next:
 - Customize your new authenticator.
 - Finish the redirect "TODO" in the App\Security\LoginFormAuthenticator::onAuthenticationSuccess() method.
 - Check the user's password in App\Security\LoginFormAuthenticator::checkCredentials().
 - Review & adapt the login template: templates/security/login.html.twig.
```

We create a user in our databe, but before to save the user, we use the command: ``` bin/console security:has-password``` to have the password hased. Now, we cans save the user.  

**API securisation**

We can start to use JWT Lexit to secure our API.
We install the bundle **Lexit** with the command: ```composer require lexik/jwt-authentication-bundle```.  

We generate the SSL Keys:  
```bin/console lexik:jwt:generate-keypair```  

We need to modified the file **security.yaml** with the following script:
```
firewalls:
        login:
            pattern: ^/api/login
            stateless: true
            json_login:
                check_path: /api/login_check
                success_handler: lexik_jwt_authentication.handler.authentication_success
                failure_handler: lexik_jwt_authentication.handler.authentication_failure

        api:
            pattern:   ^/api
            stateless: true
            jwt: ~
```
and for the part **access_conrol**, we add the following route:
```
        - { path: ^/api/login, roles: PUBLIC_ACCESS }
        - { path: ^/api,       roles: IS_AUTHENTICATED_FULLY }
```  

We add the following route in the file **routes.yaml**:
```
api_login_check:
    path: /api/login_check
```
It's the route to have the token to be connect to the API.  

We add the following script for the file lexit_jwt_authentication.yaml:
```token_ttl: 36000 # in seconds, default is 3600```, we add time to use the api session with the token.  


## Install of the backoffice of Symfony  

Download the repositories "projet-23-o-travel-back" with the ssh link.  

Use the commmand: ```composer install```  
Create a file: .env.local, add the line : DATABASE_URL="mysql://otravel:otravel@127.0.0.1:3306/otravel?serverVersion=mariadb-10.5.8"
Check that you ahve in the file .env, the following line not comment: DATABASE_URL="mysql://db_user:db_password@127.0.0.1:3306/db_name?serverVersion=mariadb-10.5.8"  
Use the command: ```bin/console d:d:c```  
If it's not workin use the command: ```bin/console d:s:c```  

Now, that the dabase was create you can fulfil the database with fixture, use the command: ```bin/console d:f:l``` and say Yes!  

Before you can use the backoffice, you need to create an admin user, make it your database (MariaDb), but before you save it, you need to has the password with the following command: ``` bin/console security:has-password```, copy the result and add it in the database. Add a role like this ["ROLE_ADMIN"].  

Now you can start the backoffice, go the road "/admin", you will go to the login page and you will launch the backoffice.  
Launch local server with **php -S 0.0.0.0:8080 -t public**  