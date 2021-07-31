# This docker image is a wordpress development environment

FROM wordpress:latest

# Install WP-CLI

RUN echo "Acquire::Check-Valid-Until \"false\";\nAcquire::Check-Date \"false\";" | cat > /etc/apt/apt.conf.d/10no--check-valid-until

RUN apt-get update 

RUN apt-get install less 

RUN curl -O https://raw.githubusercontent.com/wp-cli/builds/gh-pages/phar/wp-cli.phar &&\
    mv wp-cli.phar /usr/bin/wp &&\
    chmod ugo+x /usr/bin/wp &&\
    mkdir -p /var/www/.wp-cli &&\
    mkdir -p /.wp-cli &&\
    chown www-data:www-data /var/www/.wp-cli &&\
    chown www-data:www-data /.wp-cli

# Post install script / entrypoint
COPY docker/post-install.sh /usr/local/bin
COPY docker/theme-entrypoint.sh /usr/local/bin
RUN chmod ugo+rx /usr/local/bin/post-install.sh &&\
    chmod ugo+rx /usr/local/bin/theme-entrypoint.sh

RUN mkdir -p /var/www/html/wp-content/uploads &&\
    chown www-data:www-data /var/www/html/wp-content/uploads &&\
    mkdir -p /var/www/html/wp-content/themes &&\
    chown www-data:www-data /var/www/html/wp-content/themes &&\
    mkdir -p /var/www/html/wp-content/plugins &&\
    chown www-data:www-data /var/www/html/wp-content/plugins &&\
    chown -R www-data:www-data /var/www/html/wp-content

ENTRYPOINT ["theme-entrypoint.sh"]
CMD ["apache2-foreground"]
