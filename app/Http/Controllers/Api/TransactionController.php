<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreTransactionRequest;
use App\Models\Account;
use App\Models\Transaction;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class TransactionController extends Controller
{
    use AuthorizesRequests;

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request, Account $account): JsonResponse
    {
        $this->authorize('view', $account);

        $transactions = $account->transactions()->paginate(15);

        return response()->json($transactions);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTransactionRequest $request, Account $account): JsonResponse
    {
        $this->authorize('update', $account);

        $data = $request->validated();

        $transaction = DB::transaction(function () use ($account, $data) {
            // Lock the account row to avoid race conditions
            $account = Account::whereKey($account->id)->lockForUpdate()->firstOrFail();

            $amount = (float) $data['amount'];

            $balanceBefore = (float) $account->balance;
            $balanceAfter  = $balanceBefore;

            if ($data['type'] === 'deposit') {
                $balanceAfter += $amount;
            } else { // withdrawal
                if ($amount > $balanceBefore) {
                    abort(response()->json([
                        'message' => 'Insufficient funds for withdrawal.',
                    ], 422));
                }

                $balanceAfter -= $amount;
            }

            $account->update(['balance' => $balanceAfter]);

            return Transaction::create([
                'account_id'     => $account->id,
                'type'           => $data['type'],
                'amount'         => $amount,
                'balance_before' => $balanceBefore,
                'balance_after'  => $balanceAfter,
                'description'    => $data['description'] ?? null,
            ]);
        });

        return response()->json($transaction, 201);
    }

    // /**
    //  * Display the specified resource.
    //  */
    // public function show(string $id)
    // {
    //     //
    // }

    // /**
    //  * Update the specified resource in storage.
    //  */
    // public function update(Request $request, string $id)
    // {
    //     //
    // }

    // /**
    //  * Remove the specified resource from storage.
    //  */
    // public function destroy(string $id)
    // {
    //     //
    // }
}
