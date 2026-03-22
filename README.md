# Assignment : 04 - URL Shortener API
### Name : Mahamud Hasan
### Email: [rabbithasan@outlook.com](rabbithasan@outlook.com)

## This project focuses on building a secure RESTful URL Shortener API using Laravel Sanctum

## Token-based API authentication
- RESTful API architecture
- CRUD operations
- Authorization & ownership control
- Secure URL generation logic
- Return JSON responses only
- Follow proper HTTP status codes
- Generate and manage API tokens correctly

## Test Users
- dtrump@trump.com - somuchwinning
- mahamud@example.com - p@ssword

## Public Redirection Endpoint
- GET - /{short_code} - Redirect to original URL
- If short code exists → Redirect (302 Found)
- Increment clicks counter
- If expired → Return 410 Gone
- If not found → Return 404 Not Found

## Authentication Module (Laravel Sanctum)
- GET - api/register - registers a user with name/email/pass/pass_confirm
- POST - api/login - logs in a user with email/pass and hands out a tocken
- POSt - api/logout - logs out a user and revokes tocken

## User & Profile Management
### All routes protected using auth:sanctum. The following endpoints allow authenticated users to manage their own account
### Feature Method Endpoint Description
- GET - /api/user - Return authenticated user details
- PUT/PATCH - /api/user - Update an authenticated user name or email
- DELETE - /api/user - Delete an authenticated user and all associated shortened URLs

## URL Shortener Management (Core Feature)
### Each shortened URL belong to a specific user. Users can only access their own URLs.
### Feature Method Endpoint Description
- GET - /api/urls - Paginated list of authenticated user’s own shortened URLs
- POST - /api/urls - Shorten a given URL for an authenticated user
- GET - /api/urls/{id} - Shows a single URL for an authenticated user
- PUT/PATCH - /api/urls/{id} - Updates a single URL for an authenticated user
- DELETE - /api/urls/{id} - Delets a single URL for an authenticated user







<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## About Laravel

Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable and creative experience to be truly fulfilling. Laravel takes the pain out of development by easing common tasks used in many web projects, such as:

- [Simple, fast routing engine](https://laravel.com/docs/routing).
- [Powerful dependency injection container](https://laravel.com/docs/container).
- Multiple back-ends for [session](https://laravel.com/docs/session) and [cache](https://laravel.com/docs/cache) storage.
- Expressive, intuitive [database ORM](https://laravel.com/docs/eloquent).
- Database agnostic [schema migrations](https://laravel.com/docs/migrations).
- [Robust background job processing](https://laravel.com/docs/queues).
- [Real-time event broadcasting](https://laravel.com/docs/broadcasting).

Laravel is accessible, powerful, and provides tools required for large, robust applications.

## Learning Laravel

Laravel has the most extensive and thorough [documentation](https://laravel.com/docs) and video tutorial library of all modern web application frameworks, making it a breeze to get started with the framework. You can also check out [Laravel Learn](https://laravel.com/learn), where you will be guided through building a modern Laravel application.

If you don't feel like reading, [Laracasts](https://laracasts.com) can help. Laracasts contains thousands of video tutorials on a range of topics including Laravel, modern PHP, unit testing, and JavaScript. Boost your skills by digging into our comprehensive video library.

## Laravel Sponsors

We would like to extend our thanks to the following sponsors for funding Laravel development. If you are interested in becoming a sponsor, please visit the [Laravel Partners program](https://partners.laravel.com).

### Premium Partners

- **[Vehikl](https://vehikl.com)**
- **[Tighten Co.](https://tighten.co)**
- **[Kirschbaum Development Group](https://kirschbaumdevelopment.com)**
- **[64 Robots](https://64robots.com)**
- **[Curotec](https://www.curotec.com/services/technologies/laravel)**
- **[DevSquad](https://devsquad.com/hire-laravel-developers)**
- **[Redberry](https://redberry.international/laravel-development)**
- **[Active Logic](https://activelogic.com)**

## Contributing

Thank you for considering contributing to the Laravel framework! The contribution guide can be found in the [Laravel documentation](https://laravel.com/docs/contributions).

## Code of Conduct

In order to ensure that the Laravel community is welcoming to all, please review and abide by the [Code of Conduct](https://laravel.com/docs/contributions#code-of-conduct).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
