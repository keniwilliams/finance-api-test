<?php

namespace Database\Seeders;

use App\Models\Account;
use App\Models\User;
use App\Models\Transaction;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DemoSeeder extends Seeder
{
    public function run(): void
    {
        $user = User::factory()->create([
            'name'     => 'Demo User',
            'email'    => 'demo@example.com',
            'password' => Hash::make('password'),
        ]);

        $account = Account::create([
            'user_id'  => $user->id,
            'name'     => 'Main Account',
            'balance'  => 1000,
            'currency' => 'GBP',
        ]);

        Transaction::create([
            'account_id'     => $account->id,
            'type'           => 'deposit',
            'amount'         => 1000,
            'balance_before' => 0,
            'balance_after'  => 1000,
            'description'    => 'Initial deposit',
        ]);
    }
}
