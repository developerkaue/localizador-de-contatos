<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

// 2|3NQCdhbMg91SdsscABaYoeyMa7hPY6OukRC3xmyk66fef134"
// 3|hpHqg4udPCLA6HvA1xGMUVoi32o6nZlxklevX0KD6be463dc
// 25|EscPyHd7S57C0G4AOR93f76Wx2FyD641PNPC8v0Abce64864

class AuthController extends Controller
{
    
        public function login(Request $request)
        {
            $credentials = $request->only('email', 'password');
            try {
                if (Auth::attempt($credentials)) {
                    // Access the authenticated user
                    $user = Auth::user();
        
                    // Create a token for the user
                    $token = $user->createToken('auth-token')->plainTextToken;
        
                    return redirect('/painel')->with('message', 'Login realizado com sucesso.');
                } else {
                    $message = 'Credenciais invalidas.';
                    return redirect()->back()->with('alert', $message)->withInput();
                }
            } catch (\Exception $e) {
                    return redirect()->back()->with('alert', 'Ocorreu um erro durante o login.')->withInput();
            }
        }
        
    
        public function logout(Request $request)
        {
            // Check if there's an authenticated user
            if ($user = $request->user()) {
                // Revogar o token de acesso atual do usuário, se existir
                $user->tokens()->where('name', 'auth-token')->delete();
                
                // Deslogar o usuário
                Auth::logout();
                
                // Redirecionar para a página inicial com mensagem de sucesso
                return redirect('/')->with('message', 'Logout realizado com sucesso.');
            }

            // Handle case where there's no authenticated user
            return response()->json([
                'message' => 'Esse usuário não tem acesso!'
            ], 401);
        }
    
    
}
