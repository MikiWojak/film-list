# Film Rate

## Table of content
- [App description](#app-description)
- [Tech stack](#tech-stack)
- [Database design and structure](#database-design-and-structure)
- [Installation](#installation)
- [Usage](#usage)
- [Features](#features)
- [Screenshots](#screenshots)

## App description
Film Rate is the web application to rate films. The user can rate film, modify and remove it. The admin can also manage films and users. The web application allows to login to existing account and register a new one.

## Tech stack
- Git
- Docker
- HTML
- CSS
- JavaScript
- PHP
- PostgreSQL
- Xdebug

## Database design and structure
### ERD Diagram
![image](dbErdDiagram.png)

### SQL dumps
- `db.sql` - Database schema, basic roles and users
- `dbSchema.sql` - Database schema only

## Installation
### Requirements
- Docker

### Process of installation
```shell
# Clone repository
git clone git@github.com:MikiWojak/film-rate.git

# Go to project directory
cd film-rate

# Copy config.php.example to create config.php
cp config.php.example config.php

# Add priviledges to public/uploads
(sudo) chmod 777 public/uploads

# Build docker images
# It might take 5-10 minutes
docker-compose build

# Install composer packages
docker-compose run --rm composer install

# Run docker containers in the background
docker-compose up -d

# Load SQL dump (e. g. `db.sql` - schema and basic data)
# On default settings
docker-compose exec -T db psql -U docker db < db.sql
```

## Usage
### Run web application
```shell
# Run docker containers in the background
docker-compose up -d
```

### Shut down web application
```shell
# Shut down docker containers
docker-compose down
```

### Web application
- Go to location http://localhost:8080
- You can use application as unauthorized [Guest](#guest), however your possibilities will be significantly limited
- Click Login icon:
  - Desktop - top right
  - Mobile - bottom right (tab bar)
- Login using one of these credentials:
  - User with role [Admin](#admin):
    - Email: **admin@filmrate.test**
    - Password: **Qwerty123!**
  - User with role [User](#user):
    - Email: **user@filmrate.test**
    - Password: **Qwerty123!**
- Now you can do actions permitted for specific role

### pgAdmin
- Go to location http://localhost:5050
- Login using credentials (default ones):
  - Email Address / Username: **admin@example.com**
  - Password: **admin**
- Register database server using *internal credentials* (default ones):
  - Host name/address: **db**
  - Port: **5432**
  - Maintenance database: **db**
  - Username: **docker**
  - Password: **docker**
- Now you can manage the database

### Unit tests
```shell
# Run unit tests
docker-compose run --rm phpunit
```

## Features
### Guest
(unauthorized)
- View films
- Search films by title
- View single film
- Login
- Register

### User
- View films
- Search films by title
- Filter films - only rated by logged user
- View single film
- Rate film, edit and remove rate
- Profile page

### Admin
All User's features, also:
- See all films
- Add, edit, remove film
- See all users
- Remove user

## Screenshots
### Desktop - Films
![image](screenshots/desktop-films.png)
### Desktop - Single film
![image](screenshots/desktop-single-film.png)
### Desktop - Register
![image](screenshots/desktop-register.png)
### Desktop - Login
![image](screenshots/desktop-login.png)
### Desktop - Rate film
![image](screenshots/desktop-rate-film.png)
### Desktop - Profile
![image](screenshots/desktop-profile.png)
### Desktop - Admin films
![image](screenshots/desktop-admin-films.png)
### Desktop - Admin add film
![image](screenshots/desktop-admin-add-film.png)

### Mobile - Films
![image](screenshots/mobile-films.png)
### Mobile - Single film
![image](screenshots/mobile-single-film.png)
### Mobile - Register
![image](screenshots/mobile-register.png)
### Mobile - Login
![image](screenshots/mobile-login.png)
### Mobile - Rate film
![image](screenshots/mobile-rate-film.png)
### Mobile - Profile
![image](screenshots/mobile-profile.png)
### Mobile - Admin films
![image](screenshots/mobile-admin-films.png)
![image](screenshots/mobile-admin-films-1.png)
### Mobile - Admin add film
![image](screenshots/mobile-admin-add-film.png)
