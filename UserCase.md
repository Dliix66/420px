NewB User Case
=============

Ce fichier décrit les différents **User Case** pour le site **NewB** !

---------

Création de compte
-----------
> **Succès:**

> - Ouvrir la page d'accueil de NewB
> - Cliquer sur le bouton *s'enregistrer* en haut à droite
> - Remplir tous les champs avec des données valides :
> 
>> - Le champ *Email* doit contenir une adresse mail valide
>> - Le champ *Mot de passe* doit contenir au moins 4 caractères
>> - Le champ *Confirmer le mot de passe* doit être identique au champ précédent
>> - Les champ *Nom* et *Prénom* doivent être remplis avec des caractères alphabetiques et des espaces
>> - Le champ *Téléphone* doit être votre numéro de téléphone portable. 
>
> - Cliquer sur *Valider*
> - Vous vous retrouver sur la page de *Connexion*

----

> **Champ(s) manquant(s):**

> - Ouvrir la page d'accueil de NewB
> - Cliquer sur le bouton *s'enregistrer* en haut à droite
> - Remplir certains champs avec des données valides
> - Cliquer sur *Valider*
> - Un message vous spécifiant les données manquantes apparait.

 ----

> **Mots de Passe différents:**

> - Ouvrir la page d'accueil de NewB
> - Cliquer sur le bouton *s'enregistrer* en haut à droite
> - Remplir tous les champs avec des données valides :
> 
>> - Le champ *Email* doit contenir une adresse mail valide
>> - Le champ *Mot de passe* doit contenir au moins 4 caractères
>> - Les champ *Nom* et *Prénom* doivent être remplis avec des caractères alphabetiques et des espaces
>> - Le champ *Téléphone* doit être votre numéro de téléphone portable.
>
> - Le champ *Confirmer le mot de passe* doit être différent du champ *Mot de Passe*
> - Un message *Les mots de passe ne correspondent pas* apparaît



----------

Log In
---------

> **Succès:**

> - Ouvrir la page d'accueil de NewB
> - Cliquer sur le bouton *se connecter* en haut à droite
> - Remplir tous les champs avec des données valides :
> 
>> - Le champ *Email* doit contenir une adresse mail valide
>> - Le champ *Mot de passe* doit contenir le mot de passe associé au mail spécifié
>
> - Cliquer sur *Valider*
> - Vous vous retrouver sur la page d'*Accueil* en étant connecté au compte associé

----

> **Erreur:**

> - Ouvrir la page d'accueil de NewB
> - Cliquer sur le bouton *se connecter* en haut à droite
> - Remplir tous les champs avec des données de compte invalides
> - Cliquer sur *Valider*
> - Un message d'erreur *combinaison invalide* apparaît


Déconnexion
-----------
> **Succès:**

> - Ouvrir Une page de NewB
> - Cliquer sur le bouton *de déconnecter* en haut à droite
> - Vous vous retrouver sur la page de *Connexion* en étant en mode visiteur

----
Déconnexion
-----------
> **Succès:**

> - Se connecter sur un compte administrateur
> - Ouvrir la page `/admin` de *NewB*
> - Vous vous retrouver sur le panel *Administrateur*

------
> **Erreur:**

> - Se connecter sur un compte non-administrateur ou en mode visiteur
> - Ouvrir la page `/admin` de *NewB*
> - Vous vous retrouver sur la page *Connexion* en mode visiteur

----

Admin
-----------
> **Rétrograder:**

> - Se connecter sur un compte administrateur
> - Accéder au pannel Administrateur
> - Dans la liste *Admins*, cliquer sur le bouton *Rétrograder* en face de l'utilisateur que vous souhaitez rétrograder.

------
> **Promouvoir:**

> - Se connecter sur un compte administrateur
> - Accéder au pannel Administrateur
> - Dans la liste *Utilisateurs*, cliquer sur le bouton *Promouvoir* en face de l'utilisateur que vous souhaitez promouvoir.

----

> **Ajouter une techno (Succès) : **

> - Se connecter sur un compte administrateur
> - Accéder au pannel Administrateur
> - Remplir le champ *Techno* avec la technologie désirée
> - Cliquer sur le bouton *Ajouter* à droite du champ
> - Le champ *Techno* est vidé.

----

> **Ajouter une techno (Erreur) : **

> - Se connecter sur un compte administrateur
> - Accéder au pannel Administrateur
> - Cliquer sur le bouton *Ajouter* à droite du champ *Techno* sans remplir ce dernier
> - Un message vous demandant de remplir ce champ apparaît

----

> **Ajouter un groupe (Succès) : **

> - Se connecter sur un compte administrateur
> - Accéder au pannel Administrateur
> - Remplir le champ *Groupe* avec la technologie désirée
> - Cliquer sur le bouton *Ajouter* à droite du champ
> - Le champ *Groupe* est vidé.

----

> **Ajouter un groupe (Erreur) : **

> - Se connecter sur un compte administrateur
> - Accéder au pannel Administrateur
> - Cliquer sur le bouton *Ajouter* à droite du champ *Groupe* sans remplir ce dernier
> - Un message vous demandant de remplir ce champ apparaît

----

Projet
--------

> **Créer un projet (Succès) : **

> - Se connecter sur un compte
> - Cliquer sur *Mes Projet* en haut à droite
> - Cliquer sur *Nouveau Projet*
> - Remplir les champs avec des données valides:
> 
>> - Les champs *Nom* et *Description* doivent être remplis avec des caractères ASCII
>> - Les champs *Début* et *Fin* doivent être remplis avec une date
>
> - Cliquer sur le bouton *Valider*
> - Cliquer sur *Mes Projets* en haut à droite
> - Vôtre nouveau projet apparaît dans *Mes Projets:*

----
> **Ajouter un projet (Erreur) : **

> - Se connecter sur un compte
> - Cliquer sur *Mes Projet* en haut à droite
> - Cliquer sur *Nouveau Projet*
> - Cliquer sur le bouton *Valider* en omettant de remplir un des champs
> - Un message d'erreur apparaît

----
> **Supprimer un projet : **

> - Se connecter sur un compte
> - Cliquer sur *Mes Projet* en haut à droite
> - Cliquer sur le nom du projet à supprimer
> - Cliquer sur le bouton *Supprimer*
> - Vous êtes redirigé sur la page *Mes Projets*

----

Utilisateur:
=========

> **Editer son compte:**

> - Se connecter à son compte
> - Cliquer sur *Édition* en haut à droite
> - Remplir les champs à éditer
> - Appuyer sur *Valider*

----
> **Ajouter une Techno à mon compte:**

> - Se connecter à son compte
> - Cliquer sur *Édition* en haut à droite
> - Dans la liste *Technos. disponible(s)* cliquer sur la techno désirée
> - La techno choisie passe dans la liste *Techno. maîtrisée(s)*

----
> **Supprimer une Techno de mon compte:**

> - Se connecter à son compte
> - Cliquer sur *Édition* en haut à droite
> - Dans la liste *Techno. maîtrisée(s)* cliquer sur la techno désirée
> - La techno choisie passe dans la liste *Technos. disponible(s)*

----
> **Ajouter un Groupe à mon compte:**

> - Se connecter à son compte
> - Cliquer sur *Édition* en haut à droite
> - Dans la liste *Groupe(s) disponible(s)* cliquer sur le groupe désiré
> - Le groupe choisi passe dans la liste *Groupe(s) maîtrisé(s)*

----
> **Supprimer un Groupe de mon compte:**

> - Se connecter à son compte
> - Cliquer sur *Édition* en haut à droite
> - Dans la liste *Groupe(s) maîtrisé(s)* cliquer sur le groupe désiré
> - Le groupe choisi passe dans la liste *Groupe(s) disponible(s)*