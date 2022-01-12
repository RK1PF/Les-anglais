# Les-anglais
Projet Click&amp;Collect en équipe dans le cadre de notre formation à l'AFPA

Procédure pour récupérer le projet : 

une fois le projet téléchargé, couper laragon, mettre à jour le PHP en allant sur ce site : 

https://windows.php.net/download#php-8.1

Extraire l'archive dans laragon/bin/php dans un nouveau dossier portant le nom de la version du PHP

Paramétrer le PHP sur la dernière version et relancer laragon

Ouvrir le dossier du projet dans le terminal de laragon

Mettre à jour le composer : composer self-update

Construire le projet symfony : composer install



Avant de créer la BDD, mettre à jour le fichier .env en changeant le port sur la ligne du phpmyadmin : DATABASE_URL="mysql://root@127.0.0.1:3306//Les-anglais?serverVersion=5.7"

Puis dans le terminal tapez : php bin/console doctrine:database:create 

