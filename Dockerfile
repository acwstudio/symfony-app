FROM joseluisq/php-fpm:8.4
RUN apk add --no-cache bash
RUN curl -1sLf 'https://dl.cloudsmith.io/public/symfony/stable/setup.alpine.sh' | bash
RUN apk add symfony-cli
RUN apk add shadow && usermod -u 1000 www-data && groupmod -g 1000 www-data
