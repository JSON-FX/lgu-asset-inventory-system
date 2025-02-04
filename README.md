# Laravel Project

## Introduction
This is a Laravel-based web application built to manage property assets, inventory, etc. It provides features like CRUD operations, role management, reporting.

## Features
- Register
- Login
- Admin Dashboard
- Add Edit Update Delete Asset

## Prerequisites
Before starting, ensure you have:
- Git installed
- PHP installed
- Node.js/NPM installed
- MySQL database server running
- For Windows Imagick installed and ;extension=gd in php.ini enabled

## Installation

1. Clone the repository:
   ```bash
   git clone https://github.com/JSON-FX/lgu-asset-inventory-system.git
   ```

2. Navigate to the project directory:
   ```bash
   cd lgu-asset-inventory-system
   ```

3. Install PHP dependencies:
   ```bash
   composer install 
   ```

4. Install JavaScript dependencies:
   ```bash
   npm install
   ```

5. Copy the `.env.example` file to `.env`:
   ```bash
   cp .env.example .env
   ```

6. Configure the `.env` file:
   - Set your database credentials.
   - Configure other settings as needed (e.g., mail, cache).

7. Generate the application key:
   ```bash
   php artisan key:generate
   ```

8. Run database migrations:
   ```bash
   php artisan migrate
   ```

9. Seed the database (optional):
   ```bash
   php artisan db:seed
   ```
   - import the employee.sql  first before running php artisan serve located at the database/seeders/employee.sql it will serve as Users List

10. Storage Link:
    ```bash
    php artisan storage:link
    ```

11. Start the development server:
    ```bash
    php artisan serve
    ```

12. Access the application in your browser at:
    ```
    http://127.0.0.1:8000
    ```

## Usage
 if you use  xampp  as a server then enable the  Imagick to generate image for QRcode follow the youtube video provided for specific version
 https://www.youtube.com/watch?v=qZ9_rq6c9uY&ab_channel=MuruganS 
 
### Roles and Permissions
- Admin (ID: 1) has full access to all features.
- Other users may have restricted access based on roles.

### Key Commands
- Clear cache:
  ```bash
  php artisan cache:clear
  ```
- Run tests:
  ```bash
  php artisan test
  ```

## Deployment
1. Set up your production server with the necessary requirements (PHP, MySQL, etc.).
2. Push the application code to the server.
3. Set the `.env` file with production settings.
4. Run migrations and seeders if necessary:
   ```bash
   php artisan migrate --seed
   ```
5. Compile assets for production:
   ```bash
   npm run prod
   ```
6. Set correct permissions for storage and bootstrap/cache:
   ```bash
   chmod -R 775 storage bootstrap/cache
   ```



## Contact
For any inquiries, please contact LGU-MIS-QUEZON at lgu.quezon.bukidnon@gmail.com.
