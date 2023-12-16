FROM php:apache-bullseye

ENV APACHE_DOCUMENT_ROOT=/var/www/html/public
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf
RUN sed -ri -e 's!/var/www/!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/apache2.conf /etc/apache2/conf-available/*.conf

#Install Packages
RUN apt-get -y update && apt-get install -y libicu-dev libzip-dev zip libjpeg-dev libpng-dev libfreetype6-dev libwebp-dev
RUN docker-php-ext-configure intl
RUN docker-php-ext-configure gd --enable-gd --with-freetype --with-jpeg --with-webp
RUN docker-php-ext-install intl opcache pdo_mysql zip gd
RUN pecl install xdebug

#INI-Files
RUN mv $PHP_INI_DIR/php.ini-development $PHP_INI_DIR/php.ini
COPY opcache.ini $PHP_INI_DIR/conf.d/docker-php-ext-opcache.ini
COPY xdebug.ini $PHP_INI_DIR/conf.d/99-xdebug.ini
COPY apache.conf /etc/apache2/sites-enabled/000-default.conf
RUN a2enmod rewrite

#INSTALL APCU
RUN pecl install apcu-5.1.22 && docker-php-ext-enable apcu
RUN echo "extension=apcu.so" > /usr/local/etc/php/php.ini
RUN echo "apc.enable_cli=1" > /usr/local/etc/php/php.ini
RUN echo "apc.enable=1" > /usr/local/etc/php/php.ini
#APCU

# Install Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Install Symfony CLI
RUN curl -sS https://get.symfony.com/cli/installer | bash && mv /root/.symfony5/bin/symfony /usr/local/bin/symfony

# Install Utility
RUN apt-get install nano -y
RUN apt-get install mc -y

# History
RUN echo "symfony console fos:js-routing:dump --format=json --target=assets/js/routes/routes.json" >> ~/.bash_history
RUN echo "composer update" >> ~/.bash_history
RUN echo "symfony console" >> ~/.bash_history
RUN echo "symfony console make:migration" >> ~/.bash_history
RUN echo "symfony console doctrine:migrations:migrate" >> ~/.bash_history
