FROM phpdockerio/php74-fpm
WORKDIR /var/www

# Fix debconf warnings upon build
ENV DEBIAN_FRONTEND noninteractive
ARG DEBIAN_FRONTEND=noninteractive

# Install selected extensions and other stuff
RUN apt-get update \
    && apt-get -y --no-install-recommends install  php7.4-pgsql php7.4-gd \
    && apt-get clean; rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/* /usr/share/doc/*

# Install git
RUN apt-get update \
    && apt-get -y install git \
    && apt-get clean; rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/* /usr/share/doc/*

RUN apt-get update && apt-get install -y libmcrypt-dev

ADD . /var/www
RUN chown -R www-data:www-data /var/www

CMD ["php-fpm"]

EXPOSE 9000