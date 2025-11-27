# Notes

- env
- keys
- passport
--``php artisan install:api --passport``
- models
-- Account, Transaction migrations created with model
--- e.g ``php artisan make:model Transaction -m``
-- User
--- add passprt
-- run migrations
-- run models
-- run seeder
- factory

------------------------------------

- config/auth
-- assign Passport to driver
- Requests
- Controllers
-- Transaction Controller
-- Account Controller
- Auth (Ownership)
-- test
-- test
- Providers
- API routes
-- account always checked by middleware Auth.
- Error handling
-- timing (Use laravel auth exception)
- Tests
-- .env.testing
-- ``php artisan test``
-- ``php artisan make:test AuthTest``
-- ``php artisan make:test AuthorizationTest``
