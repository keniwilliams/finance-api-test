# Development Notes

## Environment

- Laravel 12
- Passport 12.x (API authentication)
- MySQL (local)
- PHPUnit tests included

## Key Work Done

Implemented models, migrations, and relationships for Users, Accounts, and Transactions

- Integrated Laravel Passport 12 for API authentication
- Added basic authorization checks to ensure users can only access their own accounts
- Implemented transaction validation (including insufficient funds handling)
- Updated controllers to pass all provided feature tests
- Resolved multiple migration conflicts and versioning issues related to Passport
- Ensured project builds cleanly and tests run successfully

## Issues Encountered

- Passport version mismatch and migration conflicts
- Resetting DB with `migrate:fresh` multiple times
- Tests needing a fresh personal access client
- Role of `Passport::actingAs()` in feature tests

## Final Result

All required tests are passing.
