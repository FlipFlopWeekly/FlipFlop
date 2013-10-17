FlipFlop
========

FlipFlop Weekly's website, where the magic happens.

## Développer sur le projet

Pour travailler sur le projet, les outils suivants sont nécessaires :

- git
- composer
- stack LAMP

### 1) Installation de git

[git](http://git-scm.com/) est installé par défaut sur la plupart des systèmes UNIX. Pour Windows, il est conseillé de tout d'abord installer [cygwin](http://www.cygwin.com/).

Lors de l'installation, le wizard de cygwin propose le téléchargement d'un certain nombre de paquets. Il est recommandé de prendre les paquets suivants (liste non exhaustive) :

- zsh, zip, whois, which, wget, vim, util-linux, unzip, tree, time, tar, sgrep, sed, screen, ruby, renameutils, python, ping, patch, openssl, openssh, nano, mysql, man, make, less, ImageMagick, gzip, grep, git, git-completion, gcc, findutils, file, emacs, dos2unix, diffutils, curl, cron, coreutils, bash-completion, bash

- NB : les seules vraiment essentielles sont which, wget, vim, util-linux, tree, openssl, openssh, nano, mysql, man, grep, git, gcc, dos2unix, et curl. Mais il est vivement conseillé d'en prendre et utiliser le plus possible.

### 2) Se prémunir contre les problèmes de proxy

Afin de spécifier aux utilitaires du terminal de passer par un proxy, il faut ajouter les lignes suivantes dans votre .bashrc, .bashrc, .bash_profile ou .profile :

```bash
  export http_proxy="http://ADRESSE_PROXY"
  export https_proxy=$http_proxy
  export HTTPS_PROXY_REQUEST_FULLURI=false
```

Une configuration similaire sera potentiellement également nécessaire pour chacun des utilitaires séparément (curl, wget, git). Ex :

```bash
  git config --global http.proxy %HTTP_PROXY%
``

### 3) Récupérer les sources du projet

```bash
  git clone https://github.com/FlipFlopWeekly/FlipFlop.git
  cd FlipFlop/
  git checkout -b dev origin/dev
```

Cette dernière commande créé et passe sur une branche locale `dev` suivant la branche distante `dev` hébergée sur le dépôt distant `origin` (GitHub).

Cette étape est cruciale car nous suivons un modèle de branche simpliste inspiré de [git flow](http://nvie.com/posts/a-successful-git-branching-model/).

### 4) Installer composer

Un `composer.phar` est fourni dans les sources du projet. Cette solution (crade) permet à quiconque d'utiliser composer sans avoir à l'installer. Pour les puristes, voir [le site officiel](http://getcomposer.org/).

### 5) Lancer composer

Tout d'abord, déterminer quel binaire PHP est utilisé dans le terminal, et quel php.ini

```bash
  which php
  php --ini
```

Pour votre santé mentale, il est conseillé que ce php et son .ini soient les mêmes que ceux utilisés dans votre stack LAMP.

Il est également conseillé que la version de PHP soit à jour. À l'heure actuelle, la dernière version stable est la 5.5.4.

Il faut ensuite éditer le php.ini pour activer les extensions curl et openssl en décommentant les lignes correspondantes.

Puis, depuis la racine du projet :

```bash
  php composer.phar update
  php composer.phar install
```

Il sera peut-être nécessaire de jouer avec les droits / caches :

```bash
  chown -R 755 app/
  rm -rf app/cache/*
```

### 6) Créer une base de données MySQL pour le site

Les informations de la base sont fournies (et modifiables) dans `app/config/parameters.yml`

Depuis la racine du projet, pour synchroniser le schéma de la base de donnée :

```bash
  app/console doctrine:schema:update --dump-sql
  app/console doctrine:schema:update --force
```
NOTE : La première commande permet de vérifier les requêtes qui vont être exécutées.

### 7) Mettre en place un VHOST

Selon l'environnement, utiliser l'un des VHOST dans `config_vhost/dev/` en le modifiant (en local) au besoin.

### 8) Configurer GIT

```bash
  git config core.autocrlf false
  git config core.filemode false
  git config user.name [usernameGIT]
  git config user.email [emailGIT]
```
[usernameGIT] et [emailGIT] doivent être remplacés par les informations de votre compte Github.

### 9) Lire la documentation projet

Une demande doit être faite afin d'avoir accès aux documents partagés afin de réaliser le projet.
Ces documents sont hébergés sur un espace Google Drive privé.

### 10) Go !

C'est parti pour le dev !
