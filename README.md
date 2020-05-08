# Car Details Task

## Software Requirements
 - MySql 5.7
 - PHP 7.3
 
## Instalation
- create new database in mySql. i.e ```classic-trader```
- copy ```.env.dist``` into ```.env``` file
- set ```DATABASE_URL``` parameters in ```.env``` file
- run ```composer install```
- run ```php bin/console doctrine:schema:update --force```

### Run Project On Local System
- run ```php bin/console server:run```

### Run Project From Docker
- run next command to find ip address    
`docker inspect -f '{{range .NetworkSettings.Networks}}{{.IPAddress}}{{end}}' classic-trader-nginx` 
- use this ip address to see project

    
- [FOSUserBundle](https://symfony.com/doc/2.0/bundles/FOSUserBundle/index.html) is used for user authentications.
- [SB Admin 2](https://startbootstrap.com/themes/sb-admin-2/) is used as layout template
- Project is not covered with tests