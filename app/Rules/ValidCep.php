<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Facades\Http;

class ValidCep implements Rule
{
    public function passes($attribute, $value)
    {
        $response = Http::get(url('/cep/' . $value));

        if ($response->failed() || isset($response->json()['error'])) {
            return false;
        }

        return true;
    }

    public function message()
    {
        return 'CEP não encontrado ou inválido.';
    }
}
