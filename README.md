<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

# Information System for Customer Department

This project represents an information system developed for the customer department of the employment agency. The system is designed to process data about customers, products, services provided, the cost of ordered advertising packages, and customer media plans. It also allows generating reports upon manager's request, such as a list of advertising products with costs (by product type), calculation receipt, media plan, service costs, etc.

## Project Structure

- **Database Migrations:** Database migrations to create tables.
- **Models:** Data models for working with database tables.
- **Controllers:** Controllers for handling requests and interacting with models.
- **Routes:** Routes for defining API entry points.
- **Tests:** Tests for checking system functionality.
- **Views:** Views for displaying data to users (if required).
- **Readme.md:** Project documentation.

## Installation

1. Clone the repository to your local computer.
2. Install dependencies by running `composer install` command.
3. Configure the `.env` file according to your database configuration.
4. Run database migrations using `php artisan migrate` command.
5. Start the server by running `php artisan serve` command.

## Usage

1. Create a new customer by providing their details.
2. Add an order by selecting the required products, services, and media plan.
3. Get reports upon manager's request for analysis and calculations.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
