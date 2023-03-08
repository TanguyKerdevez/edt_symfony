# edt_symfony

[Voir le README](https://github.com/TanguyKerdevez/edt_symfony)

## Installation

### Prérequis: 

[PHP](https://www.php.net/manual/fr/install.php)

[Symfony](https://symfony.com/doc/current/setup.html)

[MySql](https://dev.mysql.com/downloads/installer)
##
### Dépendences:

ORM: ```composer require symfony/orm-pack```

Maker: ```require --dev symfony/maker-bundle```
##
### Mise en place:

- Récupérez l'archive de ce projet, en format .zip.
- Extrayez-la dans un dossier de votre choix
- Ouvrez votre terminal dans ```edt/public``` et entrez la commande: ```php -S localhost:8000```
##
## Points d'entrées:

**Lister les cours**: ```GET``` ```http://localhost:8000/api/cours```
- Réponse: ```JSON``` ```HTTP_OK```
##
**Lister les salles**: ```GET``` ```http://localhost:8000/api/salles``` 
- Réponse: ```JSON``` ```HTTP_OK```
##
**Accéder à l'interface d'administration**: ```http://localhost:8000/admin```
##
## Fonctionnalités ajoutées:

**Avis pour les cours**: un cours peut avoir plusieurs avis, régigés par les éleves.
##
### Routes ajoutées

**Lister les cours pour un jour**: ```GET``` ```http://localhost:8000/api/cours/{yyyy-mm-dd}``` 
- Réponse: ```JSON``` ```HTTP_OK```
##
**Lister les avis pour un cours**: ```GET``` ```http://localhost:8000/api/cours/{id}/avis``` 
- Réponse: ```JSON``` ```HTTP_OK```
##
**Créer un avis pour un cours**: ```POST``` ```http://localhost:8000/api/cours/{id}/avis``` 
- Réponse: ```JSON``` ```HTTP_CREATED```
##
**Modifier un avis pour un cours**: ```PATCH``` ```http://localhost:8000/api/cours/{id}/avis``` 
- Réponse: ```JSON``` ```HTTP_OK```
##
**Supprimer un avis pour un cours**: ```DELETE``` ```http://localhost:8000/api/cours/{id}/avis``` 
- Réponse: ```JSON``` ```HTTP_NO_CONTENT```
##
