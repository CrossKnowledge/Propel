# How to run phpunit tests

For reference: https://propelorm.org/Propel/cookbook/working-with-unit-tests.html

### 1. Use separate containers because this package requires own database to test its functionality.

Minimal docker configuration for tests:

`docker-compose.yml:`

```yml
services:
  php:
    build:
      context: .
      dockerfile: Dockerfile
    volumes:
      - ./src:/var/www
    depends_on:
      - mysql
    networks:
      - app-network
    command: tail -f /dev/null

  mysql:
    image: mysql:8.0
    environment:
      MYSQL_ROOT_PASSWORD: root
      MYSQL_DATABASE: php7
      MYSQL_USER: user
      MYSQL_PASSWORD: password
    volumes:
      - mysql-data:/var/lib/mysql
    networks:
      - app-network

networks:
  app-network:
    driver: bridge

volumes:
  mysql-data:
```

`.env:`

```dotenv
COMPOSE_PROJECT_NAME=propel1-test-php74
```

`Dockerfile:`

```Dockerfile
FROM php:7.4-cli

RUN apt-get update && apt-get install -y \
    git \
    unzip \
    zip \
    && docker-php-ext-install pdo_mysql

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

ENV PATH="$PATH:/root/.composer/vendor/bin"

WORKDIR /var/www

```

### 2. Clone the repo

```bash
cd src && git clone git@github.com:CrossKnowledge/Propel.git 
```

### 3. Update configs:

in all `Propel/test/fixtures/**/build.properties`:

```diff
- propel.database.url = mysql:dbname=test
+ propel.database.url = mysql:host=mysql;dbname=test
```

```diff
- #propel.database.password = [db password]
+ propel.database.password = root
```

in all `Propel/test/fixtures/**/runtime-conf.xml`:

```diff
- <dsn>mysql:dbname=test</dsn>
+ <dsn>mysql:host=mysql;dbname=test</dsn>
```

```diff
- <password></password>
+ <password>root</password>
```

in `phpunit.xml.dist`:

```diff
<phpunit backupGlobals="false"
...
bootstrap="test/bootstrap.php">
	<php>
	    <ini name="error_reporting" value="E_ALL"/>
	</php>
...
```

### 4. Enter php container:

```bash
docker-compose exec php bash
```

### 5. Prepare tests

```bash
./test/reset_tests.sh
```

Note that getting errors like these is OK:

```
BUILD FAILED
Propel/generator/build.xml:95:15: No project directory specified
```

### 6. Install phpunit

```bash
composer require phpunit/phpunit:~4.2
```

### 7. Run tests:

```bash
vendor/bin/phpunit
```
