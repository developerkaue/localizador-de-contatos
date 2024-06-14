<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Http\Controllers\CepController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class CepControllerUnitTest extends TestCase
{
    /** @test */
    public function it_returns_data_for_valid_cep()
    {
        // Simulando um CEP válido
        $cep = '01001000'; // CEP da Av. Paulista em São Paulo

        // Mock da resposta da requisição HTTP
        Http::fake([
            'https://viacep.com.br/ws/' . $cep . '/json/' => Http::response([
                'cep' => '01001-000',
                'logradouro' => 'Avenida Paulista',
                'bairro' => 'Bela Vista',
                'localidade' => 'São Paulo',
                'uf' => 'SP',
                'ibge' => '3550308',
                'gia' => '1004',
                'ddd' => '11',
                'siafi' => '7107',
            ], 200),
        ]);

        // Instanciar a CepController
        $controller = new CepController();

        // Chamar o método getCep com o CEP válido
        $request = Request::create('/api/cep/' . $cep);
        $response = $controller->getCep($cep);

        // Verificar se o status da resposta é 200 (OK)
        $this->assertEquals(200, $response->getStatusCode());

        // Verificar se os dados do CEP estão presentes na resposta JSON
        $responseData = json_decode($response->getContent(), true);
        $this->assertArrayHasKey('cep', $responseData);
        $this->assertEquals('01001-000', $responseData['cep']);
        $this->assertEquals('Avenida Paulista', $responseData['logradouro']);
        $this->assertEquals('Bela Vista', $responseData['bairro']);
        $this->assertEquals('São Paulo', $responseData['localidade']);
        $this->assertEquals('SP', $responseData['uf']);
        $this->assertEquals('3550308', $responseData['ibge']);
        $this->assertEquals('1004', $responseData['gia']);
    }

    /** @test */
    public function it_returns_error_for_invalid_cep()
    {
        // Simulando um CEP inválido
        $cep = '99999999';

        // Mock da resposta da requisição HTTP
        Http::fake([
            'https://viacep.com.br/ws/' . $cep . '/json/' => Http::response(['erro' => true], 404),
        ]);

        // Instanciar a CepController
        $controller = new CepController();

        // Chamar o método getCep com o CEP inválido
        $request = Request::create('/api/cep/' . $cep);
        $response = $controller->getCep($cep);

        // Verificar se o status da resposta é 404 (Not Found)
        $this->assertEquals(404, $response->getStatusCode());

        // Verificar se a mensagem de erro está presente na resposta JSON
        $responseData = json_decode($response->getContent(), true);
        $this->assertArrayHasKey('error', $responseData);
        $this->assertEquals('CEP não encontrado', $responseData['error']);
    }
}
