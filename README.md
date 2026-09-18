# SCE

Content and Member Management System, built with Laravel to manage editorial content, users, plans, subscriptions, clients, and performance reporting.

## Overview

SCE is a web platform for publishing content on a public portal, with an administrative area for managing categories, posts, permissions, plans, members, and system metrics. The application combines Laravel for business logic and Vite/Vue for the user interface, along with REST endpoints for internal consumption and integrations.

### Main technologies

- PHP 8.3+
- Laravel 13
- Vue 3 + Vite
- Bootstrap 5
- Sanctum for API authentication
- Spatie Permission
- Spatie Activity Log
- Laravel-compatible database (MySQL/PostgreSQL)

## Key features

- Public portal with homepage, categories, and content listing
- Post management, ratings, and categories
- User and member registration and administration
- First-access flow and account activation
- Client, plan, and subscription management
- Admin dashboard with statistics and reports
- Role-based permission control
- Comments, ratings, and engagement tracking
- Activity logging and system auditing
- REST API for data access and integrations

## Project structure

```text
app/                  # Application logic, models, controllers, providers
config/               # Laravel configuration
bootstrap/            # Application bootstrap
Database/
  factories/
  migrations/
  seeders/
public/               # Public assets and frontend build output
resources/
  css/
  js/
  views/              # Blade templates
routes/
  api.php             # API routes
  web.php             # Web application routes
html-sce/             # Legacy static HTML frontend
storage/
  app/
  framework/
  logs/
tests/                # Automated tests
```

## Requirements

Before starting, make sure you have:

- PHP 8.3 or higher
- Composer
- Node.js 18+ and npm
- A local or configured database for the environment

## Local setup

1. Clone the repository:

```bash
git clone <repository-url>
cd sce
```

2. Install PHP dependencies:

```bash
composer install
```

3. Install frontend dependencies:

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

6. Configure the database and environment variables in `.env`.

7. Run database migrations:

```bash
php artisan migrate
```

8. Optionally, link storage:

```bash
php artisan storage:link
```

9. Start the application:

```bash
php artisan serve
```

10. In a second terminal, run the frontend in development mode:

```bash
npm run dev
```

The app is usually available at:

- http://localhost:8000

## Admin access

The administration area is available after authentication and is generally reached through:

- /login
- /admin/dashboard

Administrative modules include categories, posts, plans, clients, members, permissions, logs, and settings.

## Production build

```bash
npm run build
php artisan optimize
```

## API

The application exposes REST endpoints under the `/api` prefix. Examples include:

- `/api/categories`
- `/api/all-category-type`
- `/api/all-posts`
- `/api/posts/top`
- `/api/all-plans`
- `/api/links`
- `/api/comments`
- `/api/ratings`

Protected routes use Laravel Sanctum authentication.

## Testing

To run the test suite:

```bash
php artisan test
```

## Useful commands

```bash
php artisan migrate:fresh --seed
php artisan route:list
php artisan make:controller NameController
php artisan make:model NameModel
php artisan storage:link
```

## Notes

- The project contains a main Laravel application and a set of static pages in `html-sce/`.
- The active business logic and primary navigation are concentrated in `app/`, `routes/`, and `resources/`.
- The system was designed as a content portal with administrative management and subscription/cadastro modules.

## License

This project is distributed under the MIT license.
