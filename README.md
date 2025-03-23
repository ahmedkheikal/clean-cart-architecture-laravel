<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

# Practice Laravel Project

This is a practice project built with Laravel, demonstrating the implementation of SOLID principles and clean architecture patterns. The project serves as a learning resource and reference implementation for best practices in Laravel development.

## Project Goals

- Implement SOLID principles (Single Responsibility, Open-Closed, Liskov Substitution, Interface Segregation, Dependency Inversion)
- Demonstrate clean architecture with clear separation of concerns
- Follow Laravel best practices and coding standards
- Provide a reference implementation for future projects

## Architecture Overview

This project follows clean architecture principles with the following layers:

- **Domain Layer**: Core business logic and entities
- **Application Layer**: Use cases and application services
- **Infrastructure Layer**: Framework-specific implementations, database, external services
- **Presentation Layer**: Controllers, views, and API endpoints

## SOLID Principles Implementation

- **Single Responsibility**: Each class has one responsibility and one reason to change
- **Open-Closed**: Code is open for extension but closed for modification
- **Liskov Substitution**: Derived classes can substitute base classes without affecting functionality
- **Interface Segregation**: Clients don't depend on interfaces they don't use
- **Dependency Inversion**: High-level modules don't depend on low-level modules; both depend on abstractions

## Getting Started

1. Clone the repository
2. Run `composer install`
3. Copy `.env.example` to `.env` and configure your environment
4. Run `php artisan key:generate`
5. Run database migrations: `php artisan migrate`
6. Serve the application: `php artisan serve`
