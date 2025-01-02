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
