<?php

namespace Tests\Feature;

use App\Models\Account;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravel\Passport\Passport;
use Tests\TestCase;

class AuthorizationTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function user_cannot_view_another_users_account(): void
    {
        $owner = User::factory()->create();
        $other = User::factory()->create();

        $account = Account::factory()->create([
            'user_id' => $owner->id,
            'balance' => 100,
        ]);

        Passport::actingAs($other);

        $response = $this->getJson("/api/accounts/{$account->id}");

        $response->assertStatus(403);
    }

    /** @test */
    public function user_cannot_withdraw_more_than_balance(): void
    {
        $user = User::factory()->create();

        $account = Account::factory()->create([
            'user_id' => $user->id,
            'balance' => 50,
        ]);

        Passport::actingAs($user);

        $response = $this->postJson("/api/accounts/{$account->id}/transactions", [
            'type'   => 'withdrawal',
            'amount' => 100,
        ]);

        $response->assertStatus(422)
            ->assertJson([
                'message' => 'Insufficient funds for withdrawal.',
            ]);
    }
}
