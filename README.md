# <div align="center">SAE3-01 - Site de Recette MarnEat</div>
<div align="center">
  <img src="public/img/marneat.png" alt="MarnEat Logo" style="border-radius: 20px;">
</div>

## Auteurs - Crevet Romain (crev0004), Lahousse Quentin(laho0011), Nicart Nathan (nica0018)

## Présentation du projet

Marn'Eat est une application conviviale conçue pour les amateurs de cuisine qui cherchent 
l'inspiration dans la préparation de leurs repas. Développée par Crevet Romain, Lahousse Quentin et Nicart Nathan,
ce projet a vu le jour dans le cadre d'un sujet de la sae3-01 proposé aux étudiants en 2 ème année de BUT Informatique à l'IUT de Reims (2023-2024).

## Remerciements Spéciaux
Nous souhaitons exprimer nos sincères remerciements à Noé Nizet, qui a gracieusement réalisé le fond de l'application.

<a href="https://www.linkedin.com/in/no%C3%A9-nizet-570526252/">Noé Nizet - LinkedIn</a>

## Accès à l'application
* Vous pouvez retrouver le rendu de l'application directement en <a href="http://10.31.33.59/">cliquant ici</a>. 


* Pour se connecter à la bdd <a href="http://10.31.33.59/phpmyadmin/">cliquez ici</a>
__user : admin__
__mdp : iutinfo__

**NB : Il faut être connecté au VPN du département info**

Enfin, pour se connecter en tant qu'utilisateur, on vous à créer votre compte admin :
__user : cham0027__
__mdp : test__
## Installation / Configuration du projet

### Installation de symfony

**Windows** <br>
<a href="https://symfony.com/download">Télécharger l'éxécutable sur le site de Symfony</a>

**Linux** 
1. _Placez-vous dans un répertoire de travail_
2. Installer l'éxécutable symfony avec la commande suivante :
```shell
wget https://get.symfony.com/cli/installer -O - | bash
```
3. Modifiez votre « .bashrc » (à la racine de votre compte) afin qu'il contienne la ligne suivante :

``export PATH="$HOME/.symfony5/bin:$PATH"``

4. Ensuite, chargez les modifications de ce dernier.
```shell
source ~/.bashrc
```
5. Vérifiez le bon fonctionnement de l'exécutable « symfony »
```shell
symfony self:version
```

6. Contrôlez la compatibilité du système avec la commande :
```shell
symfony check:requirements  --verbose
```

Retour attendu de la console
```shell
Symfony Requirements Checker
~~~~~~~~~~~~~~~~~~~~~~~~~~~~

> PHP is using the following php.ini file:
/etc/php/8.0/cli/php.ini

> Checking Symfony requirements:

[OK] iconv() must be available
[OK] json_encode() must be available
[OK] session_start() must be available
[OK] ctype_alpha() must be available
[OK] token_get_all() must be available
[OK] simplexml_import_dom() must be available
[OK] detect_unicode must be disabled in php.ini
[OK] xdebug.show_exception_trace must be disabled in php.ini
[OK] xdebug.scream must be disabled in php.ini
[OK] PCRE extension must be available
[OK] string functions should not be overloaded
[OK] xdebug.max_nesting_level should be above 100 in php.ini
[OK] PCRE extension should be at least version 8.0 (10.4 installed)
[OK] PHP-DOM and PHP-XML modules should be installed
[OK] mb_strlen() should be available
[OK] utf8_decode() should be available
[OK] filter_var() should be available
[OK] posix_isatty() should be available
[OK] intl extension should be available
[OK] intl extension should be correctly configured
[OK] intl ICU version should be at least 4+
[OK] intl.error_level should be 0 in php.ini
[OK] a PHP accelerator should be installed
[OK] short_open_tag should be disabled in php.ini
[OK] magic_quotes_gpc should be disabled in php.ini
[OK] register_globals should be disabled in php.ini
[OK] session.auto_start should be disabled in php.ini
[OK] xdebug.max_nesting_level should be above 100 in php.ini
[OK] "memory_limit" should be greater than "post_max_size".
[OK] "post_max_size" should be greater than "upload_max_filesize".
[OK] PDO should be installed
[OK] PDO should have some drivers installed (currently available: mysql, sqlite)


                                              
 [OK]                                         
 Your system is ready to run Symfony projects 
                                              

Note  The command console can use a different php.ini file
~~~~  than the one used by your web server.
      Please check that both the console and the web server
      are using the same PHP version and configuration.
```

### Style de codage 

Si ce n'est pas déjà fait, installez composer en suivant les consignes disponibles sur le site de <a href="http://cutrona/installation-configuration/composer/">Monsieur Cutrona</a>.

### PHP CS FIXER

_Qu'est-ce que PHP CS Fixer ?_ <br>
Comme son nom l'indique, PHP CS Fixer est un « fixer », c'est-à-dire un réparateur. Il s'utilise en ligne de commande et corrige les fichiers qui lui sont soumis.



1) Rechercher <<**fixer**>> dans les paquets **Composer** :
   ````shell
   composer search fixer
   ````   

2) Demandez la dépendance de développement sur «**friendsofphp/php-cs-fixer**» :
   ````shell
   composer require friendsofphp/php-cs-fixer --dev
   ````
=> Observez les répercussions sur le contenu du fichier « composer.json »

**NB : La commande composer require … ajoute des paquets dans la partie « require » du fichier « composer.json » et installe ces paquets dans le répertoire « vendor ». Lors du clonage d'un dépôt Git, vous devez demander l'installation des paquets avec composer install. Cette commande mettra également à jour l'auto-chargement.**

=> Constatez l'apparition du fichier « composer.lock »

**NB : Le fichier « composer.lock » contient les versions précises des paquets installés par Composer. Il permet de remettre un projet dans un état fonctionnel en installant les versions des paquets utilisées par le développeur, par exemple lors du clonage d'un dépôt Git. Il est donc primordial d'inclure ce fichier dans votre dépôt Git.**

=> Ajoutez le fichier « composer.lock » à l'index git puis effectuez un nouveau commit

Vérifiez le bon fonctionnement de PHP CS Fixer :
````shell
php vendor/bin/php-cs-fixer
````


## Ajout de scripts Composer pour faciliter l'utilisation de PHP CS Fixer

Dans le fichier « **composer.json** », ajoutez les lignes suivantes à la fin du fichier (**toujours dans l'accolade script**) :

````shell
  "start": "symfony serve",
  "test:cs": "php-cs-fixer fix --dry-run --diff",
  "fix:cs": "php-cs-fixer fix"
  ````

NB
* « **test:cs** » lancera la commande de vérification du code
* « **fix:cs** » qui lancera la commande de correction du code
* « **start** » lancera le serveur Web de Test sans restriction de durée d'éxécution

=> Pour vérifier que les deux scripts introduits fonctionne bien, il suffit d'introduire **volontairement une non-conformité dans une ligne de code.**

## Paquet twig/intl-exra

```shell
composer require twig/intl-extra
```

## Tests Codeception

### Test:codeception
Nettoie le répertoire "_output" et le code généré par Codeception et lance les tests de Codeception

```shell
        "test:codeception": ["codecept clean",
        "codecept run"
        ],
```

### Test
Lance le script composer qui teste la mise en forme du code 'test:cs' et le script des tests avec codeception 'test:codeception'

```shell
        "test": [
            "@test:cs",
            "@test:codeception"
        ],
```
## Base de données  
  
## Creation de la base de données 
  
Pour créer la base de données il faut :  
- 1 Copier le fichier '.env' et le renommer '.env.local'
- 2 Configurer une DATABASE_URL selon le modèle :
```shell
DATABASE_URL "mysql://user:password@server:port/dbname"
```
Choisir le db_name que vous voulez utiliser pour nommer votre base de données.  
Créer ensuite une migration si ce n'est pas deja fait avec la commande suivante :  
```shell
php bin/console make:migration
```

Une fois le fichier créer et la migration créer, pour générer la base de données, il faut utiliser les commandes suivantes :   

Creation de la base de données sur le serveur :  
```shell
php bin/console doctrine:database:create
```  
  
Creation des entités de la base de données avec la migration :  
```shell
php bin/console doctrine:migrations:migrate
```    
  
Et voilà votre base de données est créé, pour la mettre à jour en fonction des changements,
recréer une migration et la migrer vers la base de données avec les commandes :  
```shell
php bin/console make:migration
```
```shell
php bin/console doctrine:migrations:migrate
```    
## Configuration de la Base de données
* 1 Copier le fichier '.env' et le renommer '.env.local'
* 2 Configurer une DATABASE_URL selon le modèle :
```shell
DATABASE_URL "mysql://user:password@server:port/dbname"
```
* 3 Tester si la Base de donnée est fonctionnelle : <br>
```shell
bin/console doctrine:query:sql "SELECT * FROM table"
```

## MakerBundle
### Création entité
```shell
bin/console make:entity NameOfYoureEntity
```

On nous demandera à la suite de cette commande :
* 1 Le nom de la propriété
* 2 Son type
* Sa taille

=> Observer le fichier généré dans 'src/Entity' & dans 'src/Repository'
### Création de contrôleur
```shell
bin/console make:controller NameOfYoureController
```

=> Observer le fichier généré dans 'src/Controller' & 'templates/contact'

## Création des fixtures et rôles 

````shell
bin/console make:factory
````

## Générez une nouvelle version de la base de données
````shell
composer db
````

## Création de Test fonctionnel
**NB : a démarche des tests liés à la consultation de la base de données est ici incomplète (voire incorrecte) puisque nous nous appuyons sur la base de données de développement. Ceci vous permet néanmoins de prévoir les tests et la démarche sera rectifiée par la suite.**
* 1 Copiez votre fichier d'environnement de test « .env.test » en « .env.test.local »
* 2 Définissez la variable contenant le chemin d'accès à la base de données comme dans l'environnement de développement
* 3 Ajoutez ce nouveau fichier d'environnement dans le fichier de configuration de Codeception « codeception.yml »
* 4 Mettez en commentaire la propriété « dbname_suffix » de « when@test.doctrine.dbal » du fichier « config/packages/doctrine.yaml » pour éviter d'ajouter « _test » à la fin du nom de la base de données de test
* 5 Générez une classe de « Cest » pour l'action « index() » du « ContactController » :
```shell
vendor/bin/codecept generate:cest Controller Contact\\Index
```

Où **Contact** est le nom du **Controller** et **Index** et le nom de la méthode

**NB Codeception enregistre dans le répertoire « tests/_output » le corps de la réponse HTTP des ressources impliquées dans des tests échoués. Consultez ces contenus, ceci facilite grandement la recherche des erreurs !**

## Création du BackOffice
Pour le backOffice, nous allons utiliser le bundle EasyAdmin

Installer EasyAdmin dans le projet :

````shell
composer require admin
````

Créer un tableau de bord 
````shell
php bin/console make:admin:dashboard
````

=> Il est maintenant possible d'accéder à la ressource '/admin'.