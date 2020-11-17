FROM kaotu/image-laravel:latest

WORKDIR /app
ENV APPLICATION_ROOT /app

COPY artisan $APPLICATION_ROOT
COPY package.json $APPLICATION_ROOT
COPY phpunit.xml $APPLICATION_ROOT
COPY server.php $APPLICATION_ROOT
COPY webpack.mix.js $APPLICATION_ROOT

COPY /bootstrap $APPLICATION_ROOT/bootstrap
COPY /config $APPLICATION_ROOT/config
COPY /public $APPLICATION_ROOT/public
COPY /resources $APPLICATION_ROOT/resources
COPY /storage $APPLICATION_ROOT/storage

COPY /docker/api/entrypoint.sh $APPLICATION_ROOT/docker/api/entrypoint.sh
RUN chmod +x $APPLICATION_ROOT/docker/api/entrypoint.sh

COPY /app $APPLICATION_ROOT/app
COPY /database $APPLICATION_ROOT/database
COPY /routes $APPLICATION_ROOT/routes
COPY /tests $APPLICATION_ROOT/tests
COPY composer.json $APPLICATION_ROOT

RUN composer update --no-scripts
RUN composer install --no-scripts

RUN chmod 775 -R $APPLICATION_ROOT
RUN chmod 775 -R $APPLICATION_ROOT/storage/logs