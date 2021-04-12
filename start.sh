export APP_ENV=dev

composer install
bin/console d:d:d --if-exists --force
bin/console doctrine:database:create
bin/console doctrine:schema:update --force
bin/console doctrine:fixtures:load --quiet -vvv

export APP_ENV=prod
#composer install --verbose --prefer-dist --no-progress --no-interaction --no-dev --optimize-autoloader --no-suggest --no-scripts --classmap-authoritative;

php -d "opcache.enable_cli=0" bin/console c:cle
chmod a+rw -R var/cache/prod/


ab -c 10 -H  "accept: application/ld+json" -n 10000 http://nginx:80/api/projects?page=1