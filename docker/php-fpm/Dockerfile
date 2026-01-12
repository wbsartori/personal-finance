FROM php:8.4-fpm

RUN apt-get update && apt-get install -y \
    git \
    curl \
    zip \
    unzip \
    nano \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    sqlite3 \
    libsqlite3-dev \
    zlib1g-dev \
    libzip-dev \
    libpq-dev \
    npm \
    nodejs \
    libicu-dev \
    && docker-php-ext-install pdo pdo_sqlite pdo_pgsql zip intl \
    && apt-get clean \
    && rm -rf /var/lib/apt/lists/*

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

RUN curl -fsSL https://deb.nodesource.com/setup_18.x | bash - \
    && apt-get install -y nodejs

WORKDIR /var/www

COPY . /var/www

RUN mv "$PHP_INI_DIR/php.ini-development" "$PHP_INI_DIR/php.ini" && \
  sed -E -i -e 's/max_execution_time = 30/max_execution_time = 120/' "$PHP_INI_DIR/php.ini" && \
  sed -E -i -e 's/memory_limit = 128M/memory_limit = 512M/' "$PHP_INI_DIR/php.ini" && \
  sed -E -i -e 's/post_max_size = 8M/post_max_size = 64M/' "$PHP_INI_DIR/php.ini" && \
  sed -E -i -e 's/upload_max_filesize = 2M/upload_max_filesize = 64M/' "$PHP_INI_DIR/php.ini"

RUN pecl install xdebug && docker-php-ext-enable xdebug

COPY entrypoint.sh /usr/local/bin/entrypoint.sh
RUN chmod +x /usr/local/bin/entrypoint.sh

RUN usermod -u 1000 www-data
RUN groupmod -g 1000 www-data

ENTRYPOINT ["/usr/local/bin/entrypoint.sh"]
