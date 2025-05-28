FROM php:8.3-cli

# Install system packages and PHP extensions with cleanup
RUN apt-get update && apt-get install -y --no-install-recommends \
    git unzip zlib1g-dev libzip-dev tree \
    && docker-php-ext-install zip pdo pdo_mysql \
    && apt-get clean && rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/*

# Copy Composer binary from official Composer image
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# Set working directory and copy app code
WORKDIR /var/www
COPY . .
# Install PHP dependencies
RUN if [ -f "composer.json" ]; then \
        composer install --no-interaction --no-progress --prefer-dist; \
    fi

# Make sure propel-gen is executable
RUN chmod +x generator/bin/propel-gen

# Generate optimized autoload
RUN composer dump-autoload -o 2>/dev/null || true

# Create a simple test script
RUN echo '<?php\nrequire_once "runtime/lib/Propel.php";\necho "Propel loaded successfully!\n";' > test.php

CMD ["tail", "-f", "/dev/null"]
