<?php

use App\Http\Controllers\SiteController;
use App\Http\Controllers\NodeController;
use App\Http\Controllers\BlockController;
use App\Http\Controllers\ThemeController;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;

Route::middleware('api')->group(function () {
    Route::post('/login', function (Request $request) {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ]);

        if (!Auth::attempt($credentials)) {
            return response()->json(['message' => 'Invalid credentials'], 401);
        }

        $user = Auth::user();
        $token = $user->createToken('default')->plainTextToken;

        return response()->json([
            'token' => $token,
            'user' => $user,
        ]);
    });

    Route::post('/register', function (Request $request) {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'remember_token' => Str::random(10),
        ]);

        $token = $user->createToken('api')->plainTextToken;

        return response()->json([
            'user' => $user,
            'token' => $token,
        ], 201);
    });

});
Route::middleware('auth:sanctum')->prefix('sites')->group(function () {
    Route::get('/', [SiteController::class, 'index']);
    Route::post('/', [SiteController::class, 'store']);
});



Route::middleware('auth:sanctum')->group(function () {
    Route::get('/nodes', [NodeController::class, 'index']);
    Route::post('/nodes', [NodeController::class, 'store']);
    Route::put('/nodes/{nid}', [NodeController::class, 'update']);
    Route::delete('/nodes/{node}', [NodeController::class, 'destroy']);
});


Route::middleware('auth:sanctum')->group(function () {
    Route::apiResource('blocks', BlockController::class)->except(['show']);
});

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/themes', [ThemeController::class, 'index']);
    Route::get('/themes/{theme}', [ThemeController::class, 'show']);
});
