<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreAccountRequest;
use App\Models\Account;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;


class AccountController extends Controller
{
    use AuthorizesRequests;
    
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): JsonResponse
    {
        $accounts = $request->user()
            ->accounts()
            ->orderBy('created_at', 'desc')
            ->get();

        return response()->json($accounts);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreAccountRequest $request): JsonResponse
    {
        $data = $request->validated();

        $account = $request->user()->accounts()->create([
            'name'     => $data['name'],
            'currency' => $data['currency'] ?? 'GBP',
        ]);

        return response()->json($account, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, Account $account): JsonResponse
    {
        $this->authorize('view', $account);

        return response()->json($account);
    }

}
