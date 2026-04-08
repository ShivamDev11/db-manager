# DB Manager

A Laravel application for managing business data with import, merge, and analysis features.

## Features

- Business database management
- Business import functionality
- Duplicate detection and merging
- Business reporting
- User authentication

## Requirements

- PHP 8.2 or higher
- MySQL 5.7 or higher
- Composer
- Node.js & npm

## Installation

1. **Clone the repository:**
   ```bash
   git clone https://github.com/ShivamDev11/db-manager.git
   cd db-manager
   ```

2. **Copy environment file:**
   ```bash
   cp .env.example .env
   ```

3. **Install PHP dependencies:**
   ```bash
   composer install
   ```

4. **Generate application key:**
   ```bash
   php artisan key:generate
   ```

5. **Install Node.js dependencies:**
   ```bash
   npm install
   ```

6. **Build frontend assets:**
   ```bash
   npm run build
   ```

7. **Configure your database:**
   - Edit `.env` file and set your MySQL credentials:
     ```
     DB_CONNECTION=mysql
     DB_HOST=127.0.0.1
     DB_PORT=3306
     DB_DATABASE=laravel
     DB_USERNAME=root
     DB_PASSWORD=
     ```

8. **Run migrations:**
   ```bash
   php artisan migrate
   ```

9. **Start the application:**
   ```bash
   php artisan serve
   ```

   The app will be available at `http://localhost:8000`

## Usage

- Access the application at `http://localhost:8000`
- Upload and import business data
- Manage and merge duplicate records
- Generate business reports

## Development

For development with auto-rebuild of assets:
```bash
npm run dev
```

Then in another terminal:
```bash
php artisan serve
```

## License

This project is open source and available under the MIT License.

In order to ensure that the Laravel community is welcoming to all, please review and abide by the [Code of Conduct](https://laravel.com/docs/contributions#code-of-conduct).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
