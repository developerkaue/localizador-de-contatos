<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Editar usuario</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.inputmask/5.0.6/jquery.inputmask.min.js"></script>
</head>
<body>
    @if(session('alert'))
    <script>
        window.onload = function() {
            // Passa a mensagem de alerta para uma variável JavaScript e exibe um alerta
            var alertMessage = "{{ session('alert') }}";
            alert(alertMessage);
        };
    </script>
    @endif
            <!-- Cabeçalho -->
    <header class="text-center mb-8">
        <h1 class="text-4xl font-bold text-primary mt-4">Edite o seu contato!</h1>
        <p class="mt-4 text-lg text-gray-600">Edite as informacoes do seu contato:</p>
    </header>
    <div class="container mt-5">
        <form id="registerForm" action="{{ route('editUser', $user->id) }}" method="POST" class="needs-validation" novalidate>
            @csrf
            @method('PUT')
    
            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="name" class="form-label text-primary ">Nome:</label>
                        <input type="text" class="form-control" id="name" name="name" value="{{ $user->name }}" required>
                        <div class="invalid-feedback">
                            Por favor, insira um nome.
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="latitude" class="form-label text-primary ">Latitude:</label>
                        <input type="text" class="form-control" id="latitude" name="latitude" value="{{ $user->latitude }}" required>
                        <div class="invalid-feedback">
                            Por favor, insira uma latitude.
                        </div>
                    </div>
                </div>
            </div>
    
            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="longitude" class="form-label text-primary ">Longitude:</label>
                        <input type="text" class="form-control" id="longitude" name="longitude" value="{{ $user->longitude }}" required>
                        <div class="invalid-feedback">
                            Por favor, insira uma longitude.
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="celular" class="form-label text-primary ">Celular:</label>
                        <input type="text" class="form-control" id="celular" name="celular" value="{{ $user->celular }}" required>
                        <div class="invalid-feedback">
                            Por favor, insira um número de celular.
                        </div>
                    </div>
                </div>
            </div>
    
            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="cpf" class="form-label text-primary ">CPF:</label>
                        <input type="text" class="form-control" id="cpf" name="cpf" value="{{ $user->cpf }}" required readonly>
                        <div class="invalid-feedback">
                            Por favor, insira um CPF válido.
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="cep" class="form-label text-primary ">CEP:</label>
                        <input type="text" class="form-control" id="cep" name="cep" value="{{ $user->cep }}" required>
                        <div class="invalid-feedback">
                            Por favor, insira um CEP válido.
                        </div>
                    </div>
                </div>
            </div>
    
            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="endereco" class="form-label text-primary ">Endereço:</label>
                        <input type="text" class="form-control" id="endereco" name="endereco" value="{{ $user->endereco }}" required>
                        <div class="invalid-feedback">
                            Por favor, insira um endereço.
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="bairro" class="form-label text-primary ">Bairro:</label>
                        <input type="text" class="form-control" id="bairro" name="bairro" value="{{ $user->bairro }}" required>
                        <div class="invalid-feedback">
                            Por favor, insira um bairro.
                        </div>
                    </div>
                </div>
            </div>
    
            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="cidade" class="form-label text-primary ">Cidade:</label>
                        <input type="text" class="form-control" id="cidade" name="cidade" value="{{ $user->cidade }}" required>
                        <div class="invalid-feedback">
                            Por favor, insira uma cidade.
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="estado" class="form-label text-primary ">Estado:</label>
                        <input type="text" class="form-control" id="estado" name="estado" value="{{ $user->estado }}" required>
                        <div class="invalid-feedback">
                            Por favor, insira um estado.
                        </div>
                    </div>
                </div>
            </div>
    
            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="numero" class="form-label text-primary ">Número:</label>
                        <input type="text" class="form-control" id="numero" name="numero" value="{{ $user->numero }}" required>
                        <div class="invalid-feedback">
                            Por favor, insira um número.
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="complemento" class="form-label text-primary ">Complemento:</label>
                        <input type="text" class="form-control" id="complemento" name="complemento" value="{{ $user->complemento }}">
                        <div class="invalid-feedback">
                            Por favor, insira um complemento.
                        </div>
                    </div>
                </div>
            </div>
    
            <div class="mb-3">
                <a href="{{ url()->previous() }}" class="btn btn-secondary">Voltar</a>
                <button type="submit" class="btn btn-primary">Atualizar</button>
            </div>
        </form>
    </div>  
    <script>
        $('#cpf').inputmask('999.999.999-99', { clearMaskOnLostFocus: true });
        $('#celular').inputmask('(99) 99999-9999', { clearMaskOnLostFocus: true });
        $('#cep').inputmask('99999-999');
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