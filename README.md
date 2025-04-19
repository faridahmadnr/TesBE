# KUR Jogja Backend

[![DeepSource](https://app.deepsource.com/gh/agungkes/kur-jogja-backend.svg/?label=active+issues&show_trend=true&token=4lskwfhwPmXmShTJ4-Kf5aAv)](https://app.deepsource.com/gh/agungkes/kur-jogja-backend/)

## Overview

This repository contains the backend codebase for the **KUR Jogja** project. It utilizes Laravel for application logic and Laravel Sail for managing the local development environment.

For more details on Laravel Sail, refer to the [official documentation](https://laravel.com/docs/sail).

---

## Table of Contents

1. [Local Development](#local-development)
2. [Development Server](#start-the-development-server)
3. [Running Tests](#run-tests)
4. [Database Migration and Seeding](#run-migration-and-seeder)
5. [Data Import from Old Database](#run-data-import-from-the-old-database)
6. [Features](#features)
    - [Blameable](#blameable)
    - [Encryption of Sensitive Data](#encrypt-sensitive-information)

---

## Local Development

This project uses Laravel Sail for managing the local development stack. The links below provide access to essential tools and services during development:

-   **Application**: [http://localhost](http://localhost)
-   **Preview Emails via Mailpit**: [http://localhost:8025](http://localhost:8025)
-   **MeiliSearch Administration Panel**: [http://localhost:7700](http://localhost:7700)
-   **MinIO Administration Panel**: [http://localhost:9000](http://localhost:9000)

---

## Start the Development Server

To start the local development server, use the following command:

```bash
./vendor/bin/sail up
```

To run the server in the background, add the -d flag:

```bash
./vendor/bin/sail up -d
```

## Run Tests

To execute the test suite, run:

```bash
./vendor/bin/sail test
```

## Run Migration and Seeder

Run the following command to perform database migrations and seed the database:

```bash
./vendor/bin/sail php artisan module:migrate-fresh --seed
```

## Run Data Import from the Old Database

```bash
./vendor/bin/sail php artisan app:migrate-data
```

### Requirements

1. PHP > v7.4
2. Composer
3. NodeJS
4. See more requirement from laravel [here](https://laravel.com/docs/7.x)
5. Minio

### Installation

1. Clone this repository to your local computer
2. Copy .env.example to .env
3. Fill .env with your own configuration
4. Run `php artisan key:generate` if needed
5. Run `php artisan migrate --seed` to execute migration and seeder data

### Environment Configuration (.env)

To run this project locally, create a .env file in the root directory and fill in the following environment variables:

```env
# Port number the server will run on
APP_URL=
FRONTEND_URL= // must be same as your frontend

# Base URL of the application (useful for redirects or callbacks)
BASE_URL=http://localhost:3000

# Database configuration
DB_HOST=localhost
DB_PORT=5432
DB_USER=your_db_user
DB_PASSWORD=your_db_password
DB_NAME=your_db_name

# Captcha
CAPTCHA_KEY= // secret captcha

# Security
HASHID_SALT= // random generated
```

## Using Docker

1. Clone this repository
2. Run `docker compose up -d`
3. Wait for all service is ready and running
4. Generate key inside app using `docker compose exec app php artisan key:generate`
5. Run migration inside app service using command `docker compose exec app php artisan migrate:fresh --seed`

## Features

### Blameable

Tracks the user responsible for creating, updating, or deleting records. To implement blameable fields in your migration:

```php
$table->foreign('created_by')->references('id')->on('users')->onDelete('cascade');
$table->foreign('updated_by')->references('id')->on('users')->onDelete('cascade');
$table->foreign('deleted_by')->references('id')->on('users')->onDelete('cascade');
```

For more details, see the Blameable Documentation.

### Encrypt Sensitive Information

Sensitive data is encrypted to ensure security. IMPORTANT: The application key (APP_KEY) is crucial. Losing or changing it will result in the loss of encrypted data.

Example of encrypted fields:

```php
protected $casts = [
    'passport_number' => 'encrypted',
];
```

Make sure your .env file contains a valid APP_KEY, such as:

```bash
APP_KEY=base64:QikAJAlo0evYLq2RYFxGv/PRrSIfJcNDj2qiFRp1oUs=
```
