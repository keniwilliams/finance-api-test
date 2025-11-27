# Development Notes

## Environment

- Laravel 12
- Passport 12.x (API authentication)
- MySQL (local)
- PHPUnit tests included

## Key Work Completed

- Models, migrations and relations (Users, Accounts, Transactions)
- Passport OAuth2 setup with personal access tokens
- Authorization rules for account ownership
- Validation rules for withdrawals / insufficient funds
- Feature tests for auth, authorization, transactions

## Issues Encountered

- Passport version mismatch and migration conflicts
- Resetting DB with `migrate:fresh` multiple times
- Tests needing a fresh personal access client
- Role of `Passport::actingAs()` in feature tests

## Final Result

All required tests are passing.
