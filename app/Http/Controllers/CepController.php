<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class CepController extends Controller
{
    public function getCep($cep)
    {
        $url = "https://viacep.com.br/ws/{$cep}/json/";
        $response = Http::get($url);

        if ($response->failed() || isset($response->json()['erro'])) {
            return response()->json(['error' => 'CEP não encontrado'], 404);
        }

        return response()->json($response->json());
    }
    
}
