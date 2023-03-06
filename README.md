# edt_symfony

## Installation

### Prérequis: 

[PHP](https://www.php.net/manual/fr/install.php)

[Symfony](https://symfony.com/doc/current/setup.html)

### Dépendences:

ORM: ```composer require symfony/orm-pack```

Maker: ```require --dev symfony/maker-bundle```

### Mise en place la base de donnée:

Dans notre cas nous utilisons MySQL.

Dans le fichier .env: ```DATABASE_URL="mysql://root:admin@127.0.0.1:3306/edt"```

Créer la base de donnée: ```php bin/console doctrine:database:create```

Créer les entités: ```php bin/console make:entity```

## Installation:

Lister les cours: ```localhost:8000/api/cours``` 
- Réponse: ```JSON``` ```HTTP_OK```

Lister les salles: ```localhost:8000/api/salles``` 
- Réponse: ```JSON``` ```HTTP_OK```

Accéder à l'interface d'administration: ```localhost:8000/admin```

Accéder à l'interface d'administration: ```localhost:8000/admin```

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
