# Finance API -- Technical Test Solution

A secure financial API built with **Laravel 12** and **Laravel Passport
(OAuth2 Personal Access Tokens)**.\
Implements authentication, account management, transactions,
authorization, and feature tests.

## 1. Requirements

- PHP 8.2+
- Composer
- MySQL
- Laravel 12
- Laravel Passport 13.x

## 2. Installation

### Install dependencies

    composer install

### Environment setup

Copy `.env.example` → `.env` and configure:

    DB_CONNECTION=mysql
    DB_DATABASE=finance_api_test
    DB_USERNAME=root
    DB_PASSWORD=secret

### Generate application key

    php artisan key:generate

## 3. Database Setup

### Run migrations

    php artisan migrate:fresh

### Install Passport

    php artisan passport:install

## 4. Authentication

### Register a user

    POST /api/register

Returns user + token.

### Protected routes

Use header:

    Authorization: Bearer {token}

All protected routes use `auth:api`.

## 5. API Endpoints

### Authentication

|  Method   | Endpoint        | Description
| --------- | --------------- | -----------
|  POST     | /api/register   | Register + token

### Accounts

|  Method   | Endpoint        | Description
| --------- | --------------- | -----------
|  POST     | /api/accounts   |Create an account
|  GET      | /api/accounts   | List user accounts
|  GET      | /api/accounts/{id}|   View single account

### Transactions

|  Method   | Endpoint        | Description
| --------- | --------------- | -----------
|  POST     |/api/accounts/{id}/transactions | Deposit/withdraw
|  GET      |/api/accounts/{id}/transactions | Transaction history

## 6. Authorization Logic

- `auth:api` middleware\
- `$this->authorize()`\
- Policies enforce account ownership\
- Passport `actingAs()` used in tests

Rules: - No access to other users' accounts\

- Withdrawals blocked if balance insufficient

## 7. Validation

**Account creation** - name required\

- currency optional (GBP default)

**Transactions** - amount \> 0\

- type deposit/withdrawal\
- withdrawal checked against balance

## 8. Running Tests

    php artisan test

Covers: - registration\

- protected routes\
- authorization\
- insufficient funds

## 9. Code Quality

- PSR-12\
- Thin controllers\
- Form Requests\
- Policies
