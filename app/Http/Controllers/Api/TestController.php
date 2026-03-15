<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Test;
use Illuminate\Http\JsonResponse;

class TestController extends Controller
{
    /**
     * List all tests with id, code, and short_hand. Open endpoint (no auth).
     */
    public function index(): JsonResponse
    {
        $tests = Test::query()
            ->orderBy('code')
            ->get(['id', 'code', 'short_hand']);

        return response()->json([
            'data' => $tests,
        ]);
    }
}
