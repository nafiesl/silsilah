# Genealogy Application

English | [Indonesia](README.id.md)

![Laravel](https://laravel.com/assets/img/components/logo-laravel.svg)

[![Build Status](https://travis-ci.org/nafiesl/silsilah.svg?branch=master)](https://travis-ci.org/nafiesl/silsilah)
[![Coverage Status](https://coveralls.io/repos/github/nafiesl/silsilah/badge.svg?branch=master)](https://coveralls.io/github/nafiesl/silsilah?branch=master)

> **⚠️ Development in progress**  
> In development progress, any changes of table structure **will be updated** directly to corresponding **migration file**.

## About

Genealogy (Silsilah) application to record our family members.

## Features

This application uses Bahasa Indonesia and English based on `config.locale`.

### Logic Concept

1. A person can have one father
2. A person can have one mother
3. A person can have one parent (couple of mother and father)
4. A person can have 0 to many children
5. A person can have 0 to many spouses (husbands or wife)
6. A couple can have 0 to many children (based on parent_id)

### Family Member Entry

1. Enter Name and Gender
2. Set Father
3. Set Mother
4. Add Spouse
5. Add Child

### Person Attribute

1. Nickname
2. Gender
3. Fullname
4. Date of birth
5. Date of death (or at least year of death)
6. Address
7. Phone Number
8. Email

### Couple Attribute (TODO)

1. Husband
2. Wife
3. Marriage Date
4. Divorce Date
5. Address

## How to Install

### Server Requirements

This application can be installed on local server and online server with these specifications :

1. PHP 7.3 (and meet other [Laravel 8.x server requirements](https://laravel.com/docs/8.x/deployment#server-requirements)),
2. MySQL or MariaDB database,
3. SQlite (for automated testing).

### Manual Installation

1. Clone the repo and move to the application directory.

    ```bash
    git clone https://github.com/nafiesl/silsilah.git
    cd silsilah
    ```

2. Install dependencies:

    ```bash
    composer install
    ```

3. Create `.env` file:

    ```bash
    cp .env.example .env
    ```

4. Generate application key:

    ```bash
    php artisan key:generate
    ```

5. Setup database and adjust other environment variables configuration in the `.env` file.

6. Add admin email to the `.env` file (Optional):

    ```bash
    SYSTEM_ADMIN_EMAILS=admin@email.com;other_admin@email.com
    ```

7. Migrate database and link storage:

    ```bash
    php artisan migrate
    php artisan storage:link
    ```

8. Run the application:

    ```bash
    php artisan serve --host 0.0.0.0  --port=8000
    ```

Open the application in the browser at <http://localhost:8000>.

### Install with Docker

Make sure Docker and Docker Compose are installed.

```bash
make run-docker
```

or

```bash
docker-compose up -d
```

Open the application in the browser at <http://localhost:8000>.

## Testing

This application built with testing (TDD) using in-memory sqlite database.

```bash
vendor/bin/phpunit
```

## Contributing

Feel free to submit Issue for bugs or sugestions and Pull Request.

## Screenshots

### Family Tree

![Family Tree](public/images/02-pohon-keluarga.jpg "Family Tree")

This family tree view is using the [Horizontal Family Tree CSS](https://codepen.io/P233/pen/Kzbsi), thanks to [Peiwen Lu](https://codepen.io/P233/pen/Kzbsi).

### Family Chart

![Family Chart](public/images/03-bagan-keluarga.jpg "Family Chart")

### Search Family Member

![Search Family Member](public/images/01-cari-keluarga.jpg "Search Family Member")

### User Profile

![User Profile](public/images/04-profil.jpg "User Profile")

### Profile Form

![Profile Form](public/images/05-form-profil.jpg "Profile Form")

### Profil Edit Form

![Profil Edit Form](public/images/06-edit-profil.jpg "Profil Edit Form")

### Automated Testing

![Automated Testing](public/images/07-automated-testing.jpg "Automated Testing")

## License

Silsilah project is open-sourced software licensed under the [MIT license](LICENSE).
