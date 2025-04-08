<div align="center">
<img src="https://raw.githubusercontent.com/mpcgt/swaply/refs/heads/main/public/assets/img/icons-website/logo-white.webp" alt="Logo" />
  <br /><br />

**Swaply** vous aide à découvrir des **alternatives innovantes** aux **applications dominantes**, pour une **expérience plus libre et plus personnalisée**.

**Français** · [English](./src/locales/en/README.md) · [Code de conduite](./CODE_OF_CONDUCT.md) · [License](./LICENSE.md) 
</div>

> \[!IMPORTANT]
>
> **Mets une étoile**, Vous recevrez toutes les notifications de publication de GitHub sans délai ⭐️

## ✨ **Features**
* **Recherches d’alternatives :** Les utilisateurs peuvent rechercher des alternatives à des sites/applications spécifiques et obtenir des conseils sur les données personnelles.
* **Filtre de recherche :** Recherche par plateforme (Windows, Linux, Android, etc.) et par catégories (Divertissement, réseaux sociaux, communication, etc.).
* **Évaluations des utilisateurs :** Les utilisateurs peuvent laisser des avis avec des commentaires et des étoiles.
* **Suggestions d’alternatives :** Swaply propose des alternatives open-source, respectueuses de la vie privée, majoritairement créées dans l’Union Européenne et sans traceurs.

> ✨ more features will be added when Swaply evolve.

## 💻 **Technologies utilisés**
* **Front-end:** [TailwindCSS](https://tailwindui.com/)
* **Back-end:** [Docker](https://www.docker.com/), [Symfony](https://symfony.com/)
* **Database:** [MariaDB](https://mariadb.org/)

## ⚡ **Performance**

| **Critère**       | **Ordinateur** | **Téléphone** |
|-------------------|----------------|---------------|
| **Performance**   | 94%            | 69%           |
| **Accessibilité** | 93%           | 89%           |
| **Meilleures pratiques** | 93%       | 89%           |
| **SEO**           | 54%            | 54%           |


## ⌨️ **Clone**
Le cloner pour un développement local :

```fish
$ git clone https://github.com/mpcgt/swaply.git
$ cd swaply
$ composer install
$ npm install
$ cp .env .env.local
$ php bin/console doctrine:database:create
$ php bin/console doctrine:migrations:migrate
$ symfony serve
```
> [!NOTE]
>
> Lorsque vous allez cloner le projet, plusieurs fichiers seront manquants (.gitignore) tels que :
>
> - [x] Configuration de la base de données et dépendances (vous devrez les configurer vous-même).
> - [x] Dépendances, vous pouvez installer les modules avec NPM (regardez dans les importations au début de chaque fichier).
> - [x] Fichiers de configuration d'environnement (.env, .env.local, etc.) qui contiennent des informations sensibles comme les clés API et les configurations spécifiques à l'environnement.
> - [x] Fichiers de cache et de logs (dossiers /var et /vendor) qui sont générés automatiquement et ne doivent pas être versionnés.
> - [x] Fichiers de tests (phpunit.xml, .phpunit.result.cache) qui sont spécifiques à l'environnement de développement.
> - [x] Fichiers générés par les migrations de la base de données (doctrine_migration_*.sql) qui sont spécifiques à chaque instance de base de données.
>
> Prérequis
> PHP : Assurez-vous d'avoir PHP installé sur votre machine. Symfony nécessite généralement > PHP 8.1 ou supérieur.
> 
> Composer : Outil de gestion des dépendances pour PHP. Vous pouvez le télécharger et > > l'installer depuis getcomposer.org.
> 
> Symfony CLI : Outil en ligne de commande pour Symfony qui facilite la gestion des projets Symfony. Vous pouvez l'installer en suivant les instructions sur symfony.com.
> 
> Node.js et npm : Swaply utilise des outils front-end comme Webpack Encore, vous aurez besoin de Node.js et npm. Téléchargez-les depuis nodejs.org.
> 
> Base de données : Assurez-vous d'avoir un serveur de base de données installé (comme MySQL ou MariaDB) et en cours d'exécution.

> [!CAUTION]
> Remplacez IMMEDIATEMENT les images/logo de Swaply par vos propres images (ce que vous voulez).

## 📨 **Contact**
* **GitHub** : [GitHub](https://github.com/mpcgt/swaply/discussions/new/choose)
* **Email** : [Email](mailto:sgn.ntwk@gmail.com)

## 📜 **LICENSE**
Swaply a une license [GNU Affero General Public License v3.0](./LICENSE.md).