FROM php:8.3.4-fpm-alpine3.19

ENV RUN_DEPS \
    zlib \
    libzip \
    libpng \
    libjpeg-turbo \
    postgresql-libs

ENV BUILD_DEPS \
    zlib-dev \
    libzip-dev \
    libpng-dev \
    libjpeg-turbo-dev \
    postgresql-dev

ENV PHP_EXTENSIONS \
    opcache \
    zip \
    gd \
    bcmath \
    pgsql \
    pdo_pgsql

RUN apk add --no-cache --virtual .build-deps $BUILD_DEPS \
    && docker-php-ext-configure gd --with-jpeg \
    && docker-php-ext-install -j "$(nproc)" $PHP_EXTENSIONS \
    && apk del .build-deps

RUN apk add --no-cache --virtual .run-deps $RUN_DEPS

# Add xdebug
RUN apk add --no-cache --virtual .build-deps $PHPIZE_DEPS \
    && apk add --update linux-headers \
    && pecl install xdebug \
    && docker-php-ext-enable xdebug \
    && apk del -f .build-deps

# Install php-cli
RUN apk add --no-cache php-cli

# Install Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# Install PHPUnit via Composer
RUN composer global require phpunit/phpunit --prefer-dist

# Add Composer's global bin directory to the PATH
ENV PATH="/root/.composer/vendor/bin:${PATH}"

# Upload limit (ATM no limit)
RUN echo 'memory_limit = -1' >> /usr/local/etc/php/conf.d/docker-php-memlimit.ini;

# Copy the application code
COPY . /app

VOLUME ["/app"]
