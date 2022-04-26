# -------------------------
# Install PHP FPM
# -------------------------
FROM php:8.0-fpm-buster as php-build

RUN php -v
# ----------[END]----------


# -------------------------
# Install App Requirements
# -------------------------
RUN apt-get clean && \
    apt-get update -y && \
    pecl channel-update pecl.php.net && \
    apt-get install -y \
        apt-utils \
        openssl \
        libzip-dev \
        zip \
        unzip \
        git \
        zlib1g-dev \
        libicu-dev \
        g++ \
        libxml2-dev && \
    docker-php-ext-configure zip && \
    docker-php-ext-install zip && \
    docker-php-ext-configure intl && \
    docker-php-ext-install intl && \
    docker-php-ext-install bcmath && \
    docker-php-ext-install sockets && \
#    docker-php-ext-install sockets && \
    docker-php-ext-install soap && \
    docker-php-ext-configure soap

## Install PHP gd library
RUN apt-get install -y \
        libfreetype6-dev \
        libjpeg-dev \
        libjpeg62-turbo-dev \
        libpng-dev && \
    docker-php-ext-configure gd \
        --enable-gd \
        --with-freetype \
        --with-jpeg && \
    docker-php-ext-install -j$(nproc) gd && \
    php -i | grep -i gd
# ----------[END]----------

# -------------------------
# Install Mysql PDO
# -------------------------
#RUN docker-php-ext-install mysqli pdo pdo_mysql
# ----------[END]----------

# -------------------------
# Install Postgre PDO
# -------------------------
RUN apt-get install -y \
        libpq-dev \
        postgresql-client

RUN docker-php-ext-configure pgsql -with-pgsql=/usr/local/pgsql && \
    docker-php-ext-install -j$(nproc) pdo_pgsql && \
    docker-php-ext-install pdo pgsql
# ----------[END]----------


# -------------------------
# Install Redis
# -------------------------
RUN pecl channel-update https://pecl.php.net/channel.xml \
    && pecl install -o -f \
        ast-1.0.12 \
        redis-5.3.4 && \
    docker-php-ext-enable ast && \
    docker-php-ext-enable redis
# ----------[END]----------

# -------------------------
# Install Composer
# -------------------------
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

#WORKDIR /app
#
#COPY ./ ./
#
#RUN composer install \
#    --ignore-platform-reqs \
#    --optimize-autoloader \
#    --no-interaction \
#    --prefer-dist \
#    --no-plugins \
#    --no-scripts \
#    --no-suggest \
#    --no-dev
# ----------[END]----------

WORKDIR /app

# Add user for laravel application
RUN groupadd -g 1000 www
RUN useradd -u 1000 -ms /bin/bash -g www www
# Copy existing application directory contents
COPY . /app
# Copy existing application directory permissions
COPY --chown=www:www . /app

#RUN chown -R www:www \
#        /app/storage \
#        /app/bootstrap/cache

# -------------------------
# Cleanup
# -------------------------
RUN apt-get clean && \
    apt-get autoremove -y && \
    rm -rf /var/lib/apt/lists/* && \
    rm -rf /tmp/pear
# ----------[END]----------
