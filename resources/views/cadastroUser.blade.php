<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Usuário</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.inputmask/5.0.6/jquery.inputmask.min.js"></script>
</head>
<body class="bg-gray-100 flex items-center justify-center h-screen">
    @if(session('alert'))
    <script>
        window.onload = function() {
            // Passa a mensagem de alerta para uma variável JavaScript e exibe um alerta
            var alertMessage = "{{ session('alert') }}";
            alert(alertMessage);
        };
    </script>
    @endif
    <div class="max-w-6xl mx-auto px-4 py-8">
        <!-- Cabeçalho -->
        <header class="text-center mb-8">
            <h1 class="text-4xl font-bold text-blue-500 mt-4">Cadastro!</h1>
            <p class="mt-4 text-lg text-gray-600">Cadastre o seu contato para ter seu gerenciamento completo:</p>
        </header>
        <div class="bg-white p-8 rounded-lg shadow-md w-full max-w-lg mx-auto">
            <form id="registerForm" action="{{ route('usersAdmin') }}" method="POST">
                @csrf
                <div class="flex flex-wrap -mx-3">
                    <div class="w-full md:w-1/2 px-3 mb-6">
                        <label for="name" class="block text-gray-700 text-sm font-bold mb-2">Nome:</label>
                        <input type="text" id="name" name="name" class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" required>
                    </div>
                    <div class="w-full md:w-1/2 px-3 mb-6">
                        <label for="celular" class="block text-gray-700 text-sm font-bold mb-2">Celular:</label>
                        <input type="text" id="celular" name="celular" class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" required>
                    </div>
                    <div class="w-full md:w-1/2 px-3 mb-6">
                        <label for="cpf" class="block text-gray-700 text-sm font-bold mb-2">CPF:</label>
                        <input type="text" id="cpf" name="cpf" class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" required>
                    </div>
                    <div class="w-full md:w-1/2 px-3 mb-6">
                        <label for="cep" class="block text-gray-700 text-sm font-bold mb-2">CEP:</label>
                        <input type="text" id="cep" name="cep" class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" required>
                    </div>
                    <div class="w-full md:w-1/2 px-3 mb-6">
                        <label for="endereco" class="block text-gray-700 text-sm font-bold mb-2">Endereço:</label>
                        <input type="text" id="endereco" name="endereco" class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" required>
                    </div>
                    <div class="w-full md:w-1/2 px-3 mb-6">
                        <label for="bairro" class="block text-gray-700 text-sm font-bold mb-2">Bairro:</label>
                        <input type="text" id="bairro" name="bairro" class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" required>
                    </div>
                    <div class="w-full md:w-1/2 px-3 mb-6">
                        <label for="cidade" class="block text-gray-700 text-sm font-bold mb-2">Cidade:</label>
                        <input type="text" id="cidade" name="cidade" class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" required>
                    </div>
                    <div class="w-full md:w-1/2 px-3 mb-6">
                        <label for="estado" class="block text-gray-700 text-sm font-bold mb-2">Estado:</label>
                        <input type="text" id="estado" name="estado" class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" required>
                    </div>
                    <div class="w-full md:w-1/2 px-3 mb-6">
                        <label for="numero" class="block text-gray-700 text-sm font-bold mb-2">Número:</label>
                        <input type="text" id="numero" name="numero" class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" required>
                    </div>
                    <div class="w-full md:w-1/2 px-3 mb-6">
                        <label for="complemento" class="block text-gray-700 text-sm font-bold mb-2">Complemento:</label>
                        <input type="text" id="complemento" name="complemento" class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500">
                    </div>
                    <div class="w-full md:w-1/2 px-3 mb-6">
                        <label for="latitude" class="block text-gray-700 text-sm font-bold mb-2">Latitude:</label>
                        <input type="text" id="latitude" name="latitude" class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500">
                    </div>
                    <div class="w-full md:w-1/2 px-3 mb-6">
                        <label for="longitude" class="block text-gray-700 text-sm font-bold mb-2">Longitude:</label>
                        <input type="text" id="longitude" name="longitude" class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500">
                    </div>
                </div>
                <div class="flex space-x-4">
                    <a href="/gerenciar" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">Voltar</a>
                    <form method="POST" action="{{ route('register') }}">
                        <button id="btnEnviar" type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                            Cadastrar
                        </button>
                    </form>
                </div>
            </form>
        </div>
    </div>
    <script>
        $('#cpf').inputmask('999.999.999-99', { clearMaskOnLostFocus: true });
        $('#celular').inputmask('(99) 99999-9999', { clearMaskOnLostFocus: true });
        $('#cep').inputmask('99999-999', { clearMaskOnLostFocus: true });
        $(document).ready(function() {
            var ultimoCepValidado = '';
            var timeout = null; // Variável para armazenar o timeout

            $('#cep').blur(function() {
                var cep = $(this).val();
                clearTimeout(timeout); // Limpa o timeout anterior para evitar chamadas múltiplas

                // Define um atraso antes de validar o CEP
                timeout = setTimeout(function() {
                    if(cep !== '' && cep !== ultimoCepValidado) {
                        validarCep(cep);
                        ultimoCepValidado = cep;
                    }
                }, 200); // Atraso de 500ms
            });
        });

        function validarCep(cep) {
            $.ajax({
                type: 'GET',
                url: '/cep/' + cep,
                success: function(response) {
                    if (response.error) {
                        alert(response.error);
                        limparCamposEndereco();
                    } else {
                        $('#endereco').val(response.logradouro);
                        $('#bairro').val(response.bairro);
                        $('#cidade').val(response.localidade);
                        $('#estado').val(response.uf);
                    }
                },
                error: function(xhr, status, error) {
                    alert('Erro ao validar CEP. Por favor, tente novamente.');
                    limparCamposEndereco();
                }
            });
        }

        function limparCamposEndereco() {
            $('#cep').val('');
            $('#endereco').val('');
            $('#bairro').val('');
            $('#cidade').val('');
            $('#estado').val('');
        }

    </script>
</body>
</html>
