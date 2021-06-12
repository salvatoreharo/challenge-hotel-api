# Requerimientos de ambiente
PHP 7       ()
sqlite      (normalmente incluido en PHP)
composer    (https://getcomposer.org/download/)
symfony     (https://symfony.com/download)

# Intrucciones de instalacion
1. composer install
2. clonar archivo .env.dist y nombrarlo .env
3. pbc doctrine:schema:create
4. php bin/console make:migration
5. php bin/console doctrine:migrations:migrate
6. php bin/console doctrine:fixtures:load
7. symfony serve (para iniciar servidor por default en localhost:8000)
7. Ver documentacion de API en http://localhost:8000/api