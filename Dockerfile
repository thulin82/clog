FROM php:7.4-apache
RUN apt-get update -y
RUN apt-get install zip unzip git -y
RUN docker-php-ext-install pdo pdo_mysql mysqli
RUN pecl install xdebug-2.8.1 \
	&& docker-php-ext-enable xdebug
RUN a2enmod rewrite
#Install Composer
RUN php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');"
RUN php composer-setup.php --install-dir=. --filename=composer
RUN mv composer /usr/local/bin/
COPY . /var/www/html/
WORKDIR /var/www/html
RUN composer install
EXPOSE 80