# How to run phpunit tests

For reference: https://propelorm.org/Propel/cookbook/working-with-unit-tests.html

Use separate docker containers to run tests, because this package requires own database to test its functionality.

### Build and start containers

```shell
docker-compose up
```

### Install dependencies
```shell
docker-compose exec php bash -c "composer install"
```

### Prepare test databases
```shell
docker-compose exec mysql sh -c "mysql -u root -proot < /var/www/test/init_db.sql"
```

### Prepare tests
```shell
docker-compose exec php bash -c "/var/www/test/reset_tests.sh"
```

Note that getting errors like these is OK:
```
BUILD FAILED
Propel/generator/build.xml:95:15: No project directory specified
```

### Run tests:

```bash
docker-compose exec php bash -c "vendor/bin/phpunit"
```
