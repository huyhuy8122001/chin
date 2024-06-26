FROM php:apache
RUN apt-get update && apt upgrade -y
RUN docker-php-ext-install mysqli pdo pdo_mysql && docker-php-ext-enable mysqli
ADD ./ /var/www/html
EXPOSE 80
EXPOSE 443