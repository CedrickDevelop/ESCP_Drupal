#Local Docker Compose

## Dependency :
This Docker Compose stack needs Adimeo's local docker environnement. It can be found there : https://github.com/Core-Techs-Git/adimeo_docker_local

## Docker Compose global commands

### Start stack (in background with "-d")
    docker-compose up -d

### Stop stack
    docker-compose down

##DB common commands

### To dump DB
    docker exec cp22_escp_php sh -c 'exec drush sql:dump --structure-tables-list=cache,cache_*,sessions,watchdog --result-file=../dump.sql'

### To restore DB dump
    docker exec -i cp22_escp_db sh -c 'exec mysql -uroot -proot cp22_escp' < $PWD/dump.sql

### To restore DB dump with drush
    docker exec -it cp22_escp_php sh
    drush sql:drop
    drush sql:cli
    source /chemin_dump/dump.sql
    exit
    drush cr
(si erreur "Failed to open file dump.sql', error: 2" => mettre chemin absolu de la DB)

## Composer and Drush common commands

### Access PHP container shell
    docker exec -it cp22_escp_php sh

### Launch Composer commands
    docker exec cp22_escp_php composer install
    docker exec cp22_escp_php composer require drupal/module_name
    ...

### Launch Drush commands
    docker exec cp22_escp_php drush cr
    docker exec cp22_escp_php drush updb
    ...
