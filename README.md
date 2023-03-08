# edt_symfony

[Voir le README](https://github.com/TanguyKerdevez/edt_symfony)

## Installation

### Prérequis: 

[PHP](https://www.php.net/manual/fr/install.php)

[Symfony](https://symfony.com/doc/current/setup.html)

[MySql](https://dev.mysql.com/downloads/installer)

### Dépendences:

ORM: ```composer require symfony/orm-pack```

Maker: ```require --dev symfony/maker-bundle```

## Points d'entrées:

Lister les cours: ```GET``` ```localhost:8000/api/cours``` 
- Réponse: ```JSON``` ```HTTP_OK```

Lister les cours pour un jour: ```GET``` ```localhost:8000/api/cours/{yyyy-mm-dd}``` 
- Réponse: ```JSON``` ```HTTP_OK```

Lister les avis pour un cours: ```GET``` ```localhost:8000/api/cours/{id}/avis``` 
- Réponse: ```JSON``` ```HTTP_OK```

Créer un avis pour un cours: ```POST``` ```localhost:8000/api/cours/{id}/avis``` 
- Réponse: ```JSON``` ```HTTP_CREATED```

Lister les salles: ```GET``` ```localhost:8000/api/salles``` 
- Réponse: ```JSON``` ```HTTP_OK```

Accéder à l'interface d'administration: ```localhost:8000/admin```
