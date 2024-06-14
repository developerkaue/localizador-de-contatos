<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bem-vindo ao Sistema de Contatos</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100">

    <div class="max-w-6xl mx-auto px-4 py-8">

        <!-- Cabeçalho -->
        <header class="text-center mb-8">
            <h1 class="text-4xl font-bold text-blue-500">Bem-vindo ao Sistema de Contatos</h1>
            <p class="mt-4 text-lg text-gray-600">Gerencie seus contatos de forma simples e eficiente.</p>
        </header>

        <!-- Funcionalidades Principais -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">

            <!-- Cadastro e Login -->
            <div class="p-6 bg-white rounded-lg shadow-lg flex flex-col justify-between">
                <h2 class="text-2xl font-bold text-blue-500 mb-4">Cadastre-se ou Faça Login</h2>
                <p class="text-gray-600 mb-4">Cadastre-se para gerenciar seus contatos ou faça login se já possui uma conta.</p>
                <div class="space-y-4">
                    <a href="/cadastro" class="bg-green-500 hover:bg-green-700 text-white font-bold py-3 px-6 rounded-lg focus:outline-none focus:shadow-outline transition duration-300 block text-center">
                        Criar Conta
                    </a>
                    <a href="/logar" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-3 px-6 rounded-lg focus:outline-none focus:shadow-outline transition duration-300 block text-center">
                        Entrar no Sistema
                    </a>
                </div>
            </div>

            <!-- Funcionalidades Detalhadas -->
            <div class="p-6 bg-white rounded-lg shadow-lg">
                <h2 class="text-2xl font-bold text-blue-500 mb-4">Principais Funcionalidades</h2>
                <ul class="text-gray-600 space-y-4">
                    <li>
                        <span class="font-bold text-blue-400">Cadastro e Gerenciamento de Contatos:</span> Registre novos contatos e edite/exclua informações existentes.
                    </li>
                    <li>
                        <span class="font-bold text-blue-400">Sistema de Ajuda para Endereço:</span> Informe UF, cidade e trecho do endereço para sugestões automáticas de endereços.
                    </li>
                    <li>
                        <span class="font-bold text-blue-400">Filtro de Contatos:</span> Pesquise contatos pelo nome ou CPF para localizar rapidamente na lista.
                    </li>
                    <li>
                        <span class="font-bold text-blue-400">Integração com Mapa:</span> Visualize a localização geográfica dos contatos marcados com um "pin" no mapa.
                    </li>
                    <li>
                        <span class="font-bold text-blue-400">Exclusão de Conta:</span> Remova sua própria conta, excluindo todos os dados associados.
                    </li>
                </ul>
            </div>

        </div>

    </div>

</body>
</html>
