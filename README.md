# Intrucciones de instalacion
composer install
Configurar archivo .env
pbc doctrine:schema:create
php bin/console make:migration
php bin/console doctrine:migrations:migrate
php bin/console doctrine:fixtures:load
symfony serve


# Documentacion de API
Disponible en la ruta {host}/api