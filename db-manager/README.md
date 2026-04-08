# Database Manager

A Laravel-based web application for managing business data with CSV/Excel import, duplicate detection, and merging capabilities.

## Features

- 📊 **Business Data Management**: Store and manage business records
- 📤 **CSV/Excel Import**: Upload and process CSV or Excel files
- 🔍 **Duplicate Detection**: Automatically identify duplicate records using smart hashing
- 🔗 **Merge Functionality**: Merge duplicate records with master-slave relationships
- 📈 **Reporting**: Generate statistics and reports on your data
- 🎨 **Modern UI**: Clean interface built with Tailwind CSS

## Requirements

- PHP 8.1 or higher
- MySQL 5.7+ or MariaDB 10.3+
- Composer
- Node.js & npm (for asset compilation)

## Installation

1. **Clone the repository:**
   ```bash
   git clone https://github.com/yourusername/db-manager.git
   cd db-manager
   ```

2. **Install PHP dependencies:**
   ```bash
   composer install
   ```

3. **Install Node dependencies:**
   ```bash
   npm install
   ```

4. **Environment Setup:**
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```

5. **Database Setup:**
   - Create a MySQL database
   - Update `.env` file with your database credentials:
     ```
     DB_CONNECTION=mysql
     DB_HOST=127.0.0.1
     DB_PORT=3306
     DB_DATABASE=your_database_name
     DB_USERNAME=your_username
     DB_PASSWORD=your_password
     ```

6. **Run Migrations:**
   ```bash
   php artisan migrate
   ```

## Running the Application

**Important:** Due to compatibility issues with `php artisan serve` on some Windows setups, use this command:

```bash
cd public
php -S 127.0.0.1:8080 index.php
```

Then visit: http://127.0.0.1:8080

## Usage

1. **Import Data**: Go to `/import` to upload CSV/Excel files
2. **View Businesses**: Browse all business records at `/businesses`
3. **Find Duplicates**: Check for duplicates at `/businesses/duplicates`
4. **Merge Records**: Merge duplicate entries as needed
5. **Generate Reports**: View statistics at `/businesses/report`

## File Format for Import

Your CSV/Excel files should contain these columns:
- `name` (required)
- `email`
- `phone`
- `address`
- `city`
- `state`
- `zip_code`
- `website`

## API Endpoints

- `GET /` - Home page (redirects to businesses)
- `GET /businesses` - List all businesses
- `GET /businesses/duplicates` - Show duplicate records
- `POST /businesses/merge` - Merge duplicate records
- `GET /businesses/report` - Generate reports
- `GET /import` - Import form
- `POST /import` - Process file upload

## Built With

- **Laravel 12** - PHP Framework
- **MySQL** - Database
- **Tailwind CSS** - Styling
- **maatwebsite/excel** - Excel/CSV processing
- **Eloquent ORM** - Database operations

## License

This project is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).

In order to ensure that the Laravel community is welcoming to all, please review and abide by the [Code of Conduct](https://laravel.com/docs/contributions#code-of-conduct).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
