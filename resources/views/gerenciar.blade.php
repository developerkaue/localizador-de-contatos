<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Gerenciar</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.inputmask/5.0.6/jquery.inputmask.min.js"></script>
</head>
<body>
    <nav class="bg-white shadow-lg">
        <div class="max-w-6xl mx-auto px-4">
            <div class="flex justify-between items-center w-full">
                <!-- Links à esquerda -->
                <div class="flex space-x-7">
                    <a href="/painel" class="flex items-center py-4 px-2">
                        <span class="font-semibold text-blue-500 text-lg ">Localizar</span>
                    </a>
                    <div class="hidden md:flex items-center space-x-1">
                        <a href="/gerenciar" class="px-2 text-blue-500 font-semibold border-b border-blue-500 inline-block">Gerenciar usuários</a>
                    </div>
                </div>
                <!-- Formulário de logout e botão de exclusão à direita -->
                <div class="flex items-center space-x-3">
                    <form method="POST" action="{{ route('logout') }}" class="flex items-center">
                        @csrf
                        <button type="submit" class="py-2 px-2 font-medium text-gray-500 rounded hover:bg-blue-500 hover:text-white transition duration-300">Logout</button>
                    </form>
                    <a href="{{ route('deleteConfirmation', Auth::user()->id) }}" class="py-2 px-2 font-medium text-white bg-red-500 rounded hover:bg-red-400 transition duration-300">Excluir Conta</a>
                </div>
            </div>
        </div>
    </nav>
    <div class="container mx-auto mt-8">
        <h2 class="text-xl text-blue-500 font-semibold">Usuários</h2>
        <div class="mt-8">
            <div class="flex flex-wrap -mx-4">
                <form id="filterForm" class="md:w-1/2 px-4">
                    <div class="flex items-center mb-3 space-x-2">
                        <input type="text" class="form-control flex-1 border rounded-lg px-4 py-2" placeholder="Digite o CPF" id="filterInput">
                        <button type="button" class="btn inline-block px-6 py-2 border-2 border-gray-300 text-gray-700 font-medium text-xs leading-tight uppercase rounded hover:bg-black hover:bg-opacity-5 focus:outline-none focus:ring-0 transition duration-150 ease-in-out" id="filterButton">Filtrar</button>
                        <button type="button" class="btn inline-block px-6 py-2 border-2 border-gray-300 text-gray-700 font-medium text-xs leading-tight uppercase rounded hover:bg-black hover:bg-opacity-5 focus:outline-none focus:ring-0 transition duration-150 ease-in-out" id="reloadForm">Reload</button>
                    </div>
                </form>
                <div class="md:w-1/2 px-4 py-1">
                    <div class="flex items-center mb-3 space-x-2"> <!-- Adicionado space-x-2 para alinhamento e consistência -->
                        <a href="/cadastroUser" class="btn inline-block px-6 py-2 border-2 border-gray-300 text-gray-700 font-medium text-xs leading-tight uppercase rounded hover:bg-black hover:bg-opacity-5 focus:outline-none focus:ring-0 transition duration-150 ease-in-out" id="cadastrarUsuario">Cadastrar</a>
                    </div>
                </div>
            </div>
        </div>
        <table class="table-auto w-full mt-4">
            <thead>
                <tr class="bg-gray-200 text-gray-600 uppercase text-sm leading-normal">
                    <th class="py-3 px-6 text-left">ID</th>
                    <th class="py-3 px-6 text-left">Nome</th>
                    <th class="py-3 px-6 text-left">CPF</th>
                    <th class="py-3 px-6 text-center">Ações</th>
                </tr>
            </thead>
            <tbody id="usersTableBody" class="text-gray-600 text-sm font-light">
                <!-- Os usuários serão inseridos aqui -->
            </tbody>
        </table>
        
        <div id="paginationControls" class="mt-4 flex justify-center space-x-1">
            <!-- Controles de paginação serão adicionados aqui -->
        </div>
    </div>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            // Seleciona todos os itens da lista de usuários
            const userItems = document.querySelectorAll("#usersTableBody tr");
    
            // Adiciona um event listener de clique ao nome de cada usuário na lista
            userItems.forEach(item => {
                const userName = item.querySelector("td").innerText;
                item.querySelector("td").addEventListener("click", function() {
                    // Obtém o ID do usuário clicado
                    const userId = item.dataset.userId;
                    // Exibe o ID do usuário no console
                    console.log(`ID do usuário ${userName}: ${userId}`);
                });
            });
        });
    
        $(document).ready(function() {
            // Aplica máscara de input ao campo CPF
            $('#filterInput').inputmask('999.999.999-99');
    
            // Evento de clique para recarregar o formulário e limpar o campo de filtro
            $('#reloadForm').click(function() {
                $('#filterInput').val('');
                loadUsers();
            });
    
            // Evento de clique para filtrar usuários pelo CPF
            $('#filterButton').click(function() {
                var cpf = $('#filterInput').val();
                fetch('/users/cpf/' + cpf)
                    .then(response => {
                        if (!response.ok) {
                            throw new Error('Erro na requisição.');
                        }
                        return response.json();
                    })
                    .then(user => {
                        $('#usersTableBody').empty();
                        const row = `
                            <tr class="bg-white border-b">
                                <td class="py-4 px-6 text-sm font-medium text-blue-900">${user.id}</td>
                                <td class="py-4 px-6 text-sm text-blue-500">${user.name}</td>
                                <td class="py-4 px-6 text-sm text-blue-500">${user.cpf}</td>
                                <td class="py-4 px-6 text-sm font-medium text-center">
                                    <button onclick="editUser(${user.id})" class="py-2 px-4 bg-blue-500 text-white rounded hover:bg-blue-700">Editar</button>
                                    <button onclick="deleteUser(${user.id})" class="py-2 px-4 bg-red-500 text-white rounded hover:bg-red-700 ml-2">Excluir</button>
                                </td>
                            </tr>
                        `;
                        $('#usersTableBody').append(row);
                    })
                    .catch(error => console.error('Error:', error));
            });
    
            // Carrega a lista de usuários inicialmente
            loadUsers();
        });
    
        let currentPage = 1;
        const recordsPerPage = 8;
    
        // Função para carregar usuários da API e atualizar a tabela
        function loadUsers() {
            fetch('{{ route('getUsersAdmin') }}')
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Erro na requisição.');
                    }
                    return response.json();
                })
                .then(adminUsers => {
                    const tableBody = document.getElementById('usersTableBody');
                    tableBody.innerHTML = ''; // Limpa as linhas existentes da tabela
    
                    // Adiciona novas linhas para cada usuário
                    adminUsers.forEach(user => {
                        const row = `
                            <tr class="bg-white border-b">
                                <td class="py-4 px-6 text-sm font-medium text-blue-900">${user.id}</td>
                                <td class="py-4 px-6 text-sm text-blue-500">${user.name}</td>
                                <td class="py-4 px-6 text-sm text-blue-500">${user.cpf}</td>
                                <td class="py-4 px-6 text-sm font-medium text-center">
                                    <button onclick="editUser(${user.id})" class="py-2 px-4 bg-blue-500 text-white rounded hover:bg-blue-700">Editar</button>
                                    <button onclick="deleteUser(${user.id})" class="py-2 px-4 bg-red-500 text-white rounded hover:bg-red-700 ml-2">Excluir</button>
                                </td>
                            </tr>
                        `;
                        tableBody.innerHTML += row;
                    });
    
                    // Atualiza os controles de paginação
                    updatePaginationControls(Math.ceil(adminUsers.length / recordsPerPage));
                })
                .catch(error => {
                    console.error('Error:', error);
                });
        }
    
        // Função para redirecionar para a página de edição do usuário
        function editUser(userId) {
            window.location.href = `/editUser/${userId}`;
        }
    
        // Função para excluir um usuário via API
        function deleteUser(userId) {
            fetch(`/deleteAdminUsers/${userId}`, {
                method: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
            })
            .then(response => {
                if (!response.ok) {
                    throw new Error('Falha na requisição: ' + response.statusText);
                }
                return response.text(); // Use .text() em vez de .json() para evitar erros de parsing
            })
            .then(data => {
                try {
                    const jsonData = JSON.parse(data); // Tenta fazer o parse do texto para JSON
                    console.log('Usuário excluído com sucesso:', jsonData);
                    loadUsers(); // Recarrega a lista de usuários após a exclusão
                } catch (error) {
                    // Se o parsing falhar, trata-se provavelmente de uma resposta HTML de erro
                    console.error('Erro ao processar a resposta:', data);
                }
            })
            .catch((error) => {
                console.error('Erro:', error);
            });
        }
    
        // Função para atualizar os controles de paginação
        function updatePaginationControls(totalPages) {
            $('#paginationControls').empty();
    
            for (let i = 1; i <= totalPages; i++) {
                const pageButton = `<button type="button" class="py-2 px-4 bg-gray-200 text-gray-700 rounded hover:bg-gray-300" onclick="goToPage(${i})">${i}</button>`;
                $('#paginationControls').append(pageButton);
            }
        }
    
        // Função para navegar entre as páginas de usuários
        function goToPage(pageNumber) {
            currentPage = pageNumber;
            loadUsers();
        }
    </script>
    
    
</body>
</html>
