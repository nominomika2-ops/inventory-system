# Inventory Management System - Project Overview

## 1. What the Project Does

The Inventory Management System is a Laravel-based web application used to manage products, categories, suppliers, and stock.

## 2. Main Modules

| Module | Description |
|---|---|
| Authentication | User login and logout |
| Dashboard | Displays inventory information |
| Products | Manage products |
| Categories | Manage product categories |
| Suppliers | Manage suppliers |
| Stock Management | Manage stock in and stock out |
| Reports | View inventory reports |
| Users | Manage users and roles |
| Profile | Manage user profile |

## 3. Main Database Tables

| Table | Purpose |
|---|---|
| users | Stores user details and roles |
| products | Stores product information |
| categories | Stores product categories |
| suppliers | Stores supplier information |
| product_details | Stores additional product details |
| product_supplier | Connects products and suppliers |

## 4. User Roles

**Admin**
- Access authorized modules.
- Manage products, categories, suppliers, and users.
- Manage inventory and reports.

**Staff**
- View inventory information.
- Perform permitted stock operations.
- Cannot access Admin-only functions.

## 5. Technologies Used

- PHP
- Laravel
- MySQL / MariaDB
- HTML and CSS
- Bootstrap
- JavaScript
- Git and GitHub

## 6. How to Run the Project

1. Clone the project from GitHub.
2. Run `composer install`.
3. Copy `.env.example` to `.env`.
4. Configure database details in `.env`.
5. Run `php artisan key:generate`.
6. Create the MySQL database.
7. Run `php artisan migrate --seed`.
8. Run `php artisan storage:link`.
9. Run `php artisan serve`.
10. Open `http://127.0.0.1:8000` in the browser.

## 7. Development Workflow

1. Pull the latest changes.
2. Create a feature branch.
3. Develop the assigned feature.
4. Test changes locally.
5. Commit changes.
6. Push the branch and create a Pull Request.
7. Review and merge the changes.
