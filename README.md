# SCE

SCE is a Laravel-based content management and membership platform for publishing posts, managing categories, users, subscriptions, comments, and reports. The project includes a public frontend, an admin dashboard, and a REST API for internal or external integrations.

## Overview

This application was built with:

- Laravel 13
- PHP 8.3+
- Vue 3 + Vite
- Bootstrap 5
- Sanctum for API authentication
- Spatie permission and activity log packages
- MySQL/PostgreSQL-compatible database support through Laravel

## Features

- Public site with homepage, categories, and post listing
- Post management with categories and rating/classification metadata
- User registration and account management
- Member access flow and first-time activation
- Admin dashboard with statistics and reports
- Subscription and plan management
- Client and member administration
- Permission and role system
- Comments, ratings, and moderation support
- Activity logging and audit trails
- API endpoints for categories, posts, plans, clients, links, and dashboard data

## Project Structure

```text
app/
  Http/Controllers/      # HTTP and API controllers
  Models/                # Eloquent models
  Providers/             # App service providers
config/                  # Framework configuration
database/
  factories/
  migrations/
  seeders/
public/                  # Publicly served files
resources/
  js/                    # Vue front-end assets
  css/                   # Styles and compiled assets
  views/                 # Blade templates
routes/
  api.php                # API routes
  web.php                # Web routes
storage/
  app/
  framework/
  logs/
tests/                  # PHPUnit tests
```

## Requirements

Before running the project, ensure you have installed:

- PHP 8.3 or higher
- Composer
- Node.js 18+ and npm
- A local database, if the app is configured to use one

## Local Setup

1. Clone the repository:

```bash
git clone <repository-url>
cd sce
```

2. Install PHP dependencies:

```bash
composer install
```

3. Install JavaScript dependencies:

```bash
npm install
```

4. Create the environment file:

```bash
cp .env.example .env
```

5. Generate the application key:

```bash
php artisan key:generate
```

6. Configure the database in `.env` if needed for your environment.

7. Run the migrations:

```bash
php artisan migrate
```

8. Start the application:

```bash
php artisan serve
```

9. In another terminal, run the frontend assets:

```bash
npm run dev
```

The app is typically available at:

- http://localhost:8000

## Build for Production

```bash
npm run build
php artisan optimize
```

## Admin Access

Once the application is set up, log in through the admin area and use the configured user roles and permissions system to manage:

- Categories
- Posts
- Plans and subscriptions
- Clients and members
- Permissions and users
- Settings and reporting

## API

The project exposes REST-like endpoints under the `api` route prefix. Examples include:

- `/api/categories`
- `/api/all-posts`
- `/api/posts/top`
- `/api/plans`
- `/api/comments`
- `/api/ratings`

Authentication for protected API routes uses Laravel Sanctum.

## Testing

Run the test suite with:

```bash
php artisan test
```

## Useful Commands

```bash
php artisan migrate:fresh --seed
php artisan make:controller NameController
php artisan route:list
php artisan storage:link
```

## License

This project is distributed under the MIT license.

## Notes

This repository contains both a full Laravel application and a custom front-end with static HTML assets under the `html-sce/` directory. The active app logic is primarily handled by the Laravel application in the `app/`, `routes/`, and `resources/` folders.
