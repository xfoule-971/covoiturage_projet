Application de Covoiturage – MVC PHP

1. Présentation du projet
Cette application web de covoiturage inter-sites a été développée en PHP selon une architecture MVC (Modèle – Vue – Contrôleur).
Elle permet à une entreprise disposant de plusieurs implantations géographiques de :
- mutualiser les trajets entre ses sites,
- réduire le nombre de véhicules utilisés,
- améliorer le taux d’occupation des trajets.

L’application propose :
- un espace public (consultation des trajets),
- un espace utilisateur (création et gestion de trajets),
- un espace administrateur (gestion globale).

2. Architecture technique
    Structure du projet
covoiturage-projet/
│
├── Core/
│   ├── Auth.php
│   ├── Autoloader.php
│   └── Db.php
│
├── Controller/
│   ├── AuthController.php
│   ├── TripController.php
│   └── AdminController.php
│
├── Models/
│   ├── UserModel.php
│   ├── TripModel.php
│   └── AgencyModel.php
│
├── Views/
│   ├── layout/
│   │   ├── header.php
│   │   └── footer.php
│   ├── auth/
│   │   └── login.php
│   ├── trips/
│   │   └── create.php
│   ├── admin/
│   │   ├── dashboard.php
│   │   ├── users.php
│   │   ├── agencies.php
│   │   ├── agency_form.php
│   │   └── trips.php
│   ├── home.php
│   └── home_user.php
│
├── Router/
│   └── Router.php
│
├── public/
│   ├── index.php
│   └── assets/
│       ├── style.css
│       └── icons/
│
├── README.md
└── .htaccess

3. Technologies utilisées
- PHP 8+
- MySQL / MariaDB
- PDO (requêtes préparées)
- Bootstrap 5 (responsive)
- Architecture MVC
- Sécurité CSRF
- Sessions PHP

4. Gestion des rôles
    Utilisateur :
        - Connexion sécurisée
        - Consultation des trajets
        - Création de trajets
        - Modification / suppression de ses propres trajets

    Administrateur :
        - Accès au tableau de bord admin
        - Liste des utilisateurs
        - Gestion complète des agences (CRUD)
        - Liste et suppression des trajets
        - Accès protégé par rôle (ADMIN)

5. Base de données
    Tables principales:
        - users
        - trips
        - agencies

Exemple de champs clés

    users:
        - id
        - firstname
        - lastname
        - email
        - password (hashé)
        - role (USER ou ADMIN)

    trips:
        - id                                                                                             
        - user_id
        - departure_agency_id
        - arrival_agency_id
        - departure_datetime
        - arrival_datetime
        - total_seats
        - available_seats

    agencies:
        - id
        - name

6. Sécurité
    Mots de passe hashés avec password_hash()
    Vérification avec password_verify()
    Protection CSRF sur tous les formulaires
    Accès admin protégé par rôle
    Sessions sécurisées
    Requêtes préparées (PDO)

7. Installation du projet
    Prérequis:
        - XAMPP / WAMP / MAMP
        - PHP ≥ 8.0
        - MySQL / MariaDB
        - Navigateur moderne
    
    Cloner ou copier le projet
        Placer le projet dans : "htdocs/covoiturage-projet"
    
    Configuration de la base de données
        Créer la base de données covoiturage_db, puis importer le script SQL.
        Configurer la connexion dans : "Core/Db.php"

    Lancer l’application
        Accéder à l’URL : "http://localhost/covoiturage-projet/public/"

8. Utilisation
    Visiteur:
        - Accès à la page d’accueil
        - Visualisation des trajets (infos limitées)
        - Invitation à se connecter pour plus de détails

    Utilisateur connecté:
        - Accès à l’espace personnel
        - Création de trajets
        - Visualisation complète des informations
        - Modification / suppression de ses trajets

    Administrateur:
        - Accès au dashboard
        - Gestion des utilisateurs
        - CRUD des agences
        - Suppression des trajets
        - Navigation dédiée dans la barre de menu

9. Responsive Design
    Interface entièrement responsive
    Navbar avec burger en mobile
    Tables scrollables horizontalement
    Boutons et actions accessibles sur mobile

10. Tests recommandés
    Connexion utilisateur
    Connexion administrateur
    Création / modification / suppression de trajets
    Création / modification / suppression d’agences
    Accès interdit aux pages admin pour les utilisateurs simples

11. Améliorations possibles
    Réservation de places
    Notifications email
    Pagination
    Recherche de trajets
    Historique utilisateur
    Gestion des rôles avancée

12. Auteur
    Projet développé dans le cadre d’un apprentissage avancé du PHP MVC, de la sécurité web et des bonnes pratiques backend.