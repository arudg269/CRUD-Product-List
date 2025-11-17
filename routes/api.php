<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
*/

// ----- A ROTA DEVE ESTAR APENAS AQUI -----
// "Envelopa" o grupo de rotas com o porteiro 'supabase.auth'
Route::middleware('supabase.auth')->group(function () {

    // Agora, só quem tiver um token válido pode acessar o CRUD de produtos
    Route::apiResource('products', ProductController::class);

});