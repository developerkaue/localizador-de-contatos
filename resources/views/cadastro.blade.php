<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Usuário</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.inputmask/5.0.6/jquery.inputmask.min.js"></script>
    <!-- Link para o Font Awesome (Ícones) -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <style>
        .input-field {
            padding-right: 2.5rem; /* Espaço para o ícone */
        }
        .input-icon {
            position: absolute;
            right: 0.75rem; /* Posicionamento do ícone */
            top: 50%;
            transform: translateY(-50%);
            pointer-events: none; /* Evita interferência com o clique no input */
        }
    </style>
</head>
<body class="bg-gray-100">
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
            <h1 class="text-4xl font-bold text-blue-500 mt-4">Falta pouco!</h1>
            <p class="mt-4 text-lg text-gray-600">Cadastre-se ja e gerencie seus contatos de forma simples e eficiente.</p>
        </header>
        
        <div class="bg-white p-8 rounded-lg shadow-md w-full max-w-xl mx-auto">
            <h1 class="text-2xl font-bold text-blue-500 mt-4 mb-6 text-center">Cadastro de Usuário</h1>
            <form action="{{ route('register') }}" method="POST" class="space-y-4">
                @csrf
                <div class="flex flex-wrap -mx-3">
                    <div class="w-full md:w-1/2 px-3 mb-6 relative">
                        <label for="name" class="block text-blue-500 text-sm font-bold mb-2">Nome:</label>
                        <div class="relative">
                            <input type="text" id="name" name="name" class="input-field appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" required>
                            <span class="input-icon text-gray-400">
                                <i class="fas fa-user"></i>
                            </span>
                        </div>
                    </div>
                    <div class="w-full md:w-1/2 px-3 mb-6 relative">
                        <label for="email" class="block text-blue-500 text-sm font-bold mb-2">E-mail:</label>
                        <div class="relative">
                            <input type="email" id="email" name="email" class="input-field appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" required>
                            <span class="input-icon text-gray-400">
                                <i class="fas fa-envelope"></i>
                            </span>
                        </div>
                    </div>
                    <div class="w-full md:w-1/2 px-3 mb-6 relative">
                        <label for="celular" class="block text-blue-500 text-sm font-bold mb-2">Celular:</label>
                        <div class="relative">
                            <input type="text" id="celular" name="celular" class="input-field appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" required>
                            <span class="input-icon text-gray-400">
                                <i class="fas fa-mobile-alt"></i>
                            </span>
                        </div>
                    </div>
                    <div class="w-full md:w-1/2 px-3 mb-6 relative">
                        <label for="password" class="block text-blue-500 text-sm font-bold mb-2">Senha:</label>
                        <div class="relative">
                            <input type="password" id="password" name="password" class="input-field appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" required>
                            <span class="input-icon text-gray-400">
                                <i class="fas fa-lock"></i>
                            </span>
                        </div>
                    </div>
                </div>
                <div class="flex justify-center mt-6">
                    <a href="/" class="button bg-green-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline mr-4">Voltar</a>
                    <button type="submit" class="button bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                        Cadastrar
                    </button>
                </div>
            </form>
        </div>
    </div>
    <script>
        $('#celular').inputmask('(99) 99999-9999', { clearMaskOnLostFocus: true });
    </script>
</body>
</html>
