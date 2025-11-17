<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use Exception;

class SupabaseAuthMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // 1. Pegar o token do header 'Authorization'
        $token = $request->bearerToken();

        if (!$token) {
            // Se não tiver token, bloqueia
            return response()->json(['error' => 'Token não fornecido.'], 401);
        }

        try {
            // 2. Pegar nossa chave secreta do config
            $secret = config('services.supabase.jwt_secret');

            if (!$secret) {
                // Se a chave secreta não estiver configurada, é um erro do servidor
                // ----- ERRO CORRIGIDO AQUI (removido o 't' extra) -----
                return response()->json(['error' => 'Configuração interna do servidor incompleta.'], 500);
            }

            // 3. Tentar decodificar o token
            // Se o token for inválido ou expirado, ele vai dar um erro (Exception)
            JWT::decode($token, new Key($secret, 'HS256'));

            // 4. Se chegou aqui, o token é válido! Deixa a requisição passar.
            return $next($request);

        } catch (Exception $e) {
            // 5. Se o token for inválido, bloqueia
            return response()->json(['error' => 'Token inválido ou expirado.'], 401);
        }
    }
}