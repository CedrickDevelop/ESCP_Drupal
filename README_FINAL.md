##Instructions du TP3

    Pour ce projet, veuillez trouver les specs SFD - ESCP - Exercice.pdf

##Pour ouvrir et etudier le projet :

    > Décompresser le fichier files.zip que vous pouvez trouver à :

    https://adimeo-my.sharepoint.com/:u:/p/cpommier/ERCLRVgx1PpEp8ygVn4nfXABiWgdrgBATxGpMgI_jV4JMQ?e=Z4YXMG
     copier le dossier files dans le dossier web/sites/default

    > Pour la base de donnée, le fichier dump.sql se trouve à l'adresse suivante :
    https://adimeo-my.sharepoint.com/:u:/p/cpommier/ET-K73w3F-VCs-9pZfD1t-wBxn_rrPPg2_GSb0EcGk-SJg?e=V3oq0e

    vous pouvez restaurer la base de donnée avec Drush en effectuant les commandes suivantes :
    drush sql:drop drush sql:cli mysql> source /chemin_dump/dump.sql
    (si erreur "Failed to open file dump.sql', error: 2" => mettre chemin absolu de la DB) exit drush cr vous pouvez restaurer en utilisant Docker en effectuant les commandes suivantes docker exec -i cp22_saulnier_db sh -c 'exec mysql -uroot -proot cp22_saulnier' < $PWD/dump.sql

##Branches git

    >Pour la création du back office j'ai travaillé sur une seule branche car je suis seul sur le projet
    >J'ai utilisé une deuxième branche lorsque j'ai du retravailler du code

## Creation des paragraphes
    >Image et texte
    Le texte peut avoir une longueur de 600 caractères max. (par défaut 255 caractères me semble un peu court)

    >Fichier
    Je n'autorise pas la visualisation du fichier sur le site pour ne pas polluer le visuel.
    Les fichiers autorisés sont .txt et .pdf
    pas de tailler maximum de transfert car non indiqué

## Creation des entités nodes

    > Article
    Ne sont par défaut pas promu en page d'accueil et sans révisions, les articles sont indexés avec un indice de 0.5

    > Author
    Biographie à 600 caractères max.
    Le libellé pour le nom de l'auteur est Nom meme si le nom machine est titre. Pour une meilleure compréhension du rôle de ce champ coté UX

    >Modules
    Pourl les noms des modules j'ai utilisé le nom des bundles pour que ce soit plus simple à reconnaitre


## Page de taxonomie
    Je charge les nodes publiés et non publiés car dans les specs p.34b il n'est pas précisé publiés


## Global
    Le Form pour classer par date est distribué sur la page de liste des articles et la page des taxonomy
    Le block thématique placé sur la page de liste des articles et de taxonomy s'adapte aux 2 pages


    Pour les éléments previous et next de la page des articles je ne peux pas mettre de cache car sinon il y aurait un probleme d'ouverture des pages, j'ai ainsi créé un cach tag.
    Ce serait la meme page qui serait ouverte après chaque mise en cache. Meme chose pour les pages qui peuvent filtrer sur un formulaire.

## Metatags :

    Contenus  : balises de base + open graph + twitter cards + image google
- article : titre + field chapo + images + liens
  - auteurs : titre + field chapo + images + liens
  - page de liste des articles : titre + field chapo + images + liens
  - accueil : le titre sutout parce que je n'ai aps mis de description précise avec token car il n'y a pas de champ à promprement parler dans la page d'accueil mais beaucoup de références à des entités
  - thematique : le titre et field chapo dans les descriptions
  - media document en fonction des tokens disponibles
  - media video pareil
  - media image pareil

  Pas fait car non utile :
- les reseaux sociaux

## Le WYSIWIG
    J'ai tout fait. Pour les liens je n'ai pas saisi l'objectif

## Rabbit Hole et Siet Map
    Les themes affichent une page donc je les ai référencées dans le site map xml.
    Pour les réseaux sociaux il n'y a pas de page affichée donc pas de referencement en site map xml.

##LE BACK
    Je suis assez satisfait du travail fournit.
    J'ai essayé au maximum de travailler mes appels en gateway, de nettoyer mon code, de travailler le cache...
    De plus durant ce tp j'ai essayé au maximum de travailler les render array. Par exemple le render array pour le titre de la page d'accueil qui n'était pas évident à mettre en place.

    Concernant les algo, j'ai essayé de simplifier mes méthodes avec un maximum d'outils drupalien.
    J'ai tout de même beaucoup travaillé en php.


## LAYOUT et templates
    Les layout ne sont pas tous complètement terminés.
    J'ai entré un maximum de conditions "if" lorsque les éléments ne sont pas obligatoires à entrer par le contributeur.
    De même pour les boucles "for" concernant l'affichage du nombre d'éléments, je les ai remplies au maximum.

## INTEGRATION
    J'ai intégré les pages demandés.
    J'ai globalement manqué de temps pour faire l'intégration que j'ai débuté jeudi avec encore un peu de back à faire.
    L'intégration n'est pas exceptionnelle mais pour les pages de liste et de recherche correspond globalement à la demande des specs.
    J'ai de plus intégré le footer qui s'est avéré non utile (le jeudi soir).

    Par ailleurs je n'ai aps intégré totalement le paragraphe suggestions (travail en cours)


## GLOBALEMENT
Je pense qu'il m'aurait fallu plus de temps pour bien travailler chaque détail et finir mon intégration.
J'ai accentué mon temps de travail sur le back (8 jours) et pas assez sur le front(2jours).

Par contre je suis content d'avoir appris beaucoup de chose sur les constructions en drupal.
La recherche m'a permit de vraiment progresser.
J'ai tout de même privilégié la qualité à la quantité de mes réalisations





