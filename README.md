```diff
@@ PROJET DRUPAL @@

! Présentation
Ce projet de travail sur 2 semaines correspond à la création d'un site internet multilingue, avec un bon référencement monté avec :
Drupal 9  qui se base sur Symfony 4 et twig 2 avec une intégration en html, css/scss, javascript.
Les modules sont créés avec une architecture MVC et utilisation de classes abstraites, d'interfaces, d'héritages entre classes.

! L'architecture des modules est faite en MVC :
Récupération des nodes : 
+ Database --> Gateway --> Manager --> ManagerInterface --> hook --> twig 
Récupération des taxonomies : 
+ Database --> Gateway --> Manager Abstract --> Manager term qui étend le manager abstract --> hook --> twig
Les classes sont déclarées par le service ou par le container, selon les besoins pour faciliter le fonctionnement
nb: passage par le hook selon les besoins

! Utilisation de plusieurs modules et création de patchs
Search Api pour créer une page de recherche (comme amazon) avec utilisation de serveur et database
EntityBrowser pour améliorer l'expérience contributeur
Paragraphs pour améliorer la contribution de contenus
Pathauto pour gérer les chemins de page
Métatags et open graph pour le référencement
...etc

! Plusieurs types de plugins Blocks:
Newsletter + Menu + Titre

+ Plusieurs types de Formulaires:
Select pour filtrer sur les pages et la page de recherche

+ Intégration
Javascript et Jquery utilisés sous forme de librairies
Le css buildé à partir de scss avec Gulp
Twig avec intégration simple d'algo php

Ce projet concentre bien d'autres fonctionnalités qui mériteraient d'échanger pour les décrire précisément.









