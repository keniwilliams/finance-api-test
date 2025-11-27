# Development Notes

These notes document decisions, issues encountered, and resolutions
during implementation --- strictly technical and suitable for
submission.

------------------------------------------------------------------------

## Passport Integration

- Using Laravel 12 with Passport 13.x (latest compatible).

- Passport migrations included once; duplicates avoided by not
    republishing.

- Test environment uses MySQL (as per .env) --- not sqlite.

- Feature tests require a personal access client; created in test
    `setUp()` via:

        Artisan::call('passport:client', ['--personal' => true, '--name' => 'Test Personal Client', '--no-interaction' => true]);

------------------------------------------------------------------------

## Authentication Flow

- Registration issues resolved by ensuring token creation only after
    Passport clients exist.
- Added `HasApiTokens` to User model.
- Ensured `/api` routes use `auth:api` middleware for Passport guard.

------------------------------------------------------------------------

## Authorization

- `$this->authorize()` requires `AuthorizesRequests` trait in
    controllers.
- Policies enforce ownership rules for Accounts and Transactions.
- Wrong-user access returns `403` as expected.

------------------------------------------------------------------------

## Transactions Logic

- Validated `deposit` and `withdrawal` via Form Requests.

- Withdrawal guard condition:

        if ($amount > $account->balance) return 422 with message.

------------------------------------------------------------------------

## Routing

- Used real protected route `/api/accounts` for protected-route test.
- No test-only routes included in production.

------------------------------------------------------------------------

## Testing

Covers: - Registration & token issuance - Protected route access -
Incorrect account access (403) - Insufficient funds (422) - Uses
`Passport::actingAs()` for authenticated requests

All tests pass.
