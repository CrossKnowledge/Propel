FROM php:7.4-cli

RUN set -x -o errexit; \
    apt-get update; \
    apt-get install -y -q --no-install-recommends \
        git \
        unzip \
        zip \
    ; \
    docker-php-ext-install pdo_mysql; \
    # cleaning
    apt-get autoremove -y; \
    apt-get -y clean; \
    rm -rf \
        /var/lib/apt/lists/* \
        /tmp/* \
        /var/tmp/* \
        /usr/share/doc/*

ARG COMPOSER_VERSION=1.10.27
RUN set -x -o errexit ;\
    php -r "copy('https://raw.githubusercontent.com/composer/getcomposer.org/main/web/installer', 'composer-setup.php');" ;\
    php composer-setup.php --version="${COMPOSER_VERSION}" ;\
    rm -f composer-setup.php ;\
    mv composer.phar /usr/bin/composer ;\
    composer --version

ENV PATH="$PATH:/root/.composer/vendor/bin"

WORKDIR /var/www
