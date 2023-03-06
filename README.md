# edt_symfony

### Installation

liste des commandes: 

composer require symfony/orm-pack
composer require --dev symfony/maker-bundle
php bin/console doctrine:database
php bin/console doctrine:database:create
php bin/console make:entity -n Avis
php bin/console make:entity -n Professeur
php bin/console make:entity -n Matiere
php bin/console make:entity -n Cours
php bin/console make:entity -n Salle
composer require symfony/form symfony/validator symfony/twig-bundle sensio/framework-extra-bundle
php bin/console make:controller ProfesseurController
php bin/console make:form ProfesseurController
composer require easycorp/easyadmin-bundle symfony/security-bundle
php bin/console make:admin:crud