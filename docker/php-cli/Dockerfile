FROM mirror.gcr.io/php:8.2-cli

COPY --from=mirror.gcr.io/mlocati/php-extension-installer /usr/bin/install-php-extensions /usr/local/bin/

RUN apt-get update && apt-get install -y libpq-dev unzip \
    && install-php-extensions @composer \
    && install-php-extensions intl-stable \
    && install-php-extensions gd-stable \
    && install-php-extensions pdo_pgsql \
    && install-php-extensions pgsql

COPY ./php/* /usr/local/etc/php/conf.d/

WORKDIR /app

### timezone ###
ARG TZ
RUN ln -snf /usr/share/zoneinfo/$TZ /etc/localtime && echo $TZ > /etc/timezone
RUN echo "\ndate.timezone = $TZ" >> $PHP_INI_DIR/php.ini
### timezone ###

ARG DOCKER_USER=default_user
RUN addgroup $DOCKER_USER && useradd -m -g $DOCKER_USER $DOCKER_USER
USER $DOCKER_USER
