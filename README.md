# Les-anglais
Projet Click&amp;Collect en équipe dans le cadre de notre formation à l'AFPA

**Procédure pour récupérer le projet :** 

1. Une fois le projet téléchargé, couper laragon, mettre à jour le PHP en allant sur ce site : https://windows.php.net/download#php-8.0 en version non-thread

2. Extraire l'archive dans laragon/bin/php dans un nouveau dossier portant le nom de la version du PHP

3. Paramétrer le PHP sur la dernière version et relancer laragon

4. Ouvrir le dossier du projet dans le terminal de laragon

5. Mettre à jour le composer : `composer self-update`

6. Construire le projet symfony : `composer install`

7. Avant de créer la BDD, mettre à jour le fichier .env en changeant le port sur la ligne du phpmyadmin : `DATABASE_URL="mysql://root@127.0.0.1:3306//Les-anglais?serverVersion=5.7"`

8. Puis dans le terminal tapez `php bin/console doctrine:database:create` 

9. Enfin, rentrez dans le terminal `php bin/console doctrine:migrations:migrate`

10. Pas de 10, c'est bon on peut commencer le projet


PLUS TARD, EN COURS DE PROJET : 

Création d'un controller : `php bin/console doctrine:make:controller EntitéController` en mettant le nom de l'entité à la place de "entité"

Création de form : `php bin/console doctrine:make:form EntitéType Entité` en mettant le nom de l'entité à la place de "entité"
