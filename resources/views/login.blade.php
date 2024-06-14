<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <!-- Link para o Tailwind CSS -->
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <!-- Link para o Font Awesome (Ícones) -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <!-- Estilos personalizados opcionais -->
    <style>
        /* Estilos personalizados para a página de login */
        .login-form-container {
            max-width: 400px;
            margin: auto;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .login-logo {
            font-size: 2rem;
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
            <h1 class="text-4xl font-bold text-blue-500 mt-4">Chegou a hora!</h1>
            <p class="mt-4 text-lg text-gray-600">Entre e gerencie seus contatos de forma simples e eficiente.</p>
        </header>
        <div class="bg-white p-8 rounded-lg login-form-container">
            <h1 class="text-3xl font-bold text-blue-600 mb-6 text-center">Login</h1>
            <form id="loginForm" action="{{route('login')}}" method="POST">
                @csrf
                <div class="mb-4">
                    <label for="email" class="block text-sm font-bold text-blue-600 mb-2">E-mail</label>
                    <div class="relative">
                        <input type="email" id="email" name="email"
                            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                            required>
                        <span
                            class="absolute right-3 top-2 text-gray-400 hover:text-gray-600 cursor-pointer transition-colors duration-300">
                            <i class="fas fa-envelope"></i>
                        </span>
                    </div>
                </div>
                <div class="mb-6">
                    <label for="password" class="block text-sm font-bold text-blue-600 mb-2">Senha</label>
                    <div class="relative">
                        <input type="password" id="password" name="password"
                            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 mb-3 leading-tight focus:outline-none focus:shadow-outline"
                            required>
                        <span
                            class="absolute right-3 top-2 text-gray-400 hover:text-gray-600 cursor-pointer transition-colors duration-300">
                            <i class="fas fa-lock"></i>
                        </span>
                    </div>
                    <a href="{{ route('password.request') }}" class="text-blue-500 hover:underline">Esqueceu sua senha?</a>
                </div>
                <div class="flex items-center justify-between">
                    <a href="/" class="button bg-green-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline mr-4">Voltar</a>
                    <button type="submit"
                        class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline transition-colors duration-300">
                        Entrar
                    </button>
                </div>
            </form>
        </div>
    </div>
</body>

</html>
