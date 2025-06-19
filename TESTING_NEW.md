# How to run phpunit tests

For reference: https://propelorm.org/Propel/cookbook/working-with-unit-tests.html

Use separate docker containers to run tests, because this package requires its own database to test functionality.

## Quick Setup

### Build and start containers

```shell
docker-compose up -d
```

The MySQL container will automatically import any `.sql` files from the `test/` directory during initialization.

### Install dependencies
```shell
docker-compose exec php composer install
```

### Generate test fixtures and models (REQUIRED)
```shell
docker-compose exec php bash -c "/var/www/test/reset_tests.sh"
```

**Important**: This script generates PHP model classes using your new CK namespace and creates test database tables. You MUST run this after any schema changes or namespace modifications.

Note that getting errors like these is OK:
```
BUILD FAILED
Propel/generator/build.xml:95:15: No project directory specified
```

### Run tests:

```bash
docker-compose exec php vendor/bin/phpunit
```

## Manual Database Setup (if needed)

If you need to manually reset the test database:

```shell
# Stop containers to reset MySQL data
docker-compose down -v

# Restart (will auto-import test data again)
docker-compose up -d

# Or manually import if needed
docker-compose exec mysql mysql -u root -proot < /var/www/test/init_db.sql
```

## Test Your Namespace Implementation

To specifically test your XMLElement namespace changes:

```bash
# Test autoloading
docker-compose exec php php -r "
require 'vendor/autoload.php';
echo 'Testing CK\\Generator\\Lib\\Model\\XMLElement: ';
echo class_exists('CK\\Generator\\Lib\\Model\\XMLElement') ? 'SUCCESS' : 'FAILED';
echo PHP_EOL;
"

# Run PHPUnit tests
docker-compose exec php vendor/bin/phpunit --filter XMLElement
```