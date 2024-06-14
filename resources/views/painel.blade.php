<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Painel</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.inputmask/5.0.6/jquery.inputmask.min.js"></script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAbDB3EPqN-1qMRfjOVge6wLLk18fbpvrs"></script>
</head>
<body class="bg-gray-100">
    <nav class="bg-white shadow-lg">
        <div class="max-w-6xl mx-auto px-4">
            <div class="flex justify-between items-center w-full">
                <!-- Links à esquerda -->
                <div class="flex space-x-7">
                    <a href="/painel" class="flex items-center py-4 px-2">
                        <span class="font-semibold text-blue-500 text-lg border-b border-blue-500">Localizar</span>
                    </a>
                    <div class="hidden md:flex items-center space-x-1">
                        <a href="/gerenciar" class="py-4 px-2 text-blue-500 font-semibold">Gerenciar usuários</a>
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
    <div class="container mx-auto mt-4">
        <div class="flex flex-wrap -mx-4">
            <div class="w-full md:w-1/2 px-4 mb-4 md:mb-0">
                <div class="px-2 mb-4">
                    <h2 class="text-xl text-blue-500 font-semibold">Encontre os seus contatos:</h2>
                </div>
                <div class="input-group relative flex items-stretch w-full mb-4">
                    <input type="text" class="form-control relative flex-auto min-w-0 block w-full px-3 py-1.5 text-base font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-green-600 focus:outline-none" placeholder="Digite o CPF" id="filterInput">
                    <button class="btn px-6 py-2.5 bg-green-500 text-white font-medium text-xs leading-tight uppercase rounded shadow-md hover:bg-green-600 hover:shadow-lg focus:bg-green-600 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-green-700 active:shadow-lg transition duration-150 ease-in-out" id="filterButton">Filtrar</button>
                    <button class="btn ml-2 px-6 py-2.5 bg-gray-500 text-white font-medium text-xs leading-tight uppercase rounded shadow-md hover:bg-gray-600 hover:shadow-lg focus:bg-gray-600 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-gray-700 active:shadow-lg transition duration-150 ease-in-out" id="reloadForm">Reload</button>
                </div>
                <div id="usersButtons" class="mb-3">
                    <!-- Botões dos usuários serão adicionados aqui -->
                </div>
                <div id="paginationControls" class="flex justify-center"></div>
            </div>
            <div class="w-full md:w-1/2 px-4 h-96">
                <h2 class="text-xl text-blue-500 font-semibold">Mapa</h2>
                <div id="map" class="w-full h-full bg-gray-300"></div>
                <button id="clearMarkersButton" class="mt-4 px-6 py-2.5 bg-red-500 text-white font-medium text-xs leading-tight uppercase rounded shadow-md hover:bg-red-600 hover:shadow-lg focus:bg-red-600 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-red-700 active:shadow-lg transition duration-150 ease-in-out">Limpar mapa</button>
            </div>
        </div>
    </div>
<script>
    // Função para adicionar event listener aos itens da tabela de usuários
    function addUserItemClickListeners() {
        const userItems = document.querySelectorAll("#usersTableBody tr");

        userItems.forEach(item => {
            const userName = item.querySelector("td").innerText;
            item.querySelector("td").addEventListener("click", function() {
                const userId = item.dataset.userId;
                console.log(`ID do usuário ${userName}: ${userId}`);
            });
        });
    }

    // Função para inicializar o input mask
    function initializeInputMask() {
        $('#filterInput').inputmask('999.999.999-99');
    }

    // Função para recarregar a lista de usuários
    function setupReloadButton() {
        $('#reloadForm').click(function() {
            $('#filterInput').val('');
            loadUsers();
        });
    }

    // Função para filtrar usuários por CPF
    function setupFilterButton() {
        $('#filterButton').click(function() {
            const cpf = $('#filterInput').val();
            fetch(`/users/cpf/${cpf}`)
                .then(response => {
                    if (!response.ok) throw new Error('Erro na requisição.');
                    return response.json();
                })
                .then(user => {
                    $('#usersButtons').empty();
                    const button = `
                        <button type="button" class="px-4 py-2 m-2 hover:bg-blue-800 border border-gray-300 text-white bg-blue-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500 rounded-md"
                            data-user-id="${user.id}" data-lat="${user.latitude}" data-lng="${user.longitude}">
                            ${user.name}
                        </button>`;
                    $('#usersButtons').append(button);
                })
                .catch(error => console.error('Erro:', error));
        });
    }

    // Variáveis globais de controle de paginação
    let currentPage = 1;
    const recordsPerPage = 8;

    // Função para carregar usuários
    function loadUsers() {
        fetch('{{ route('getUsersAdmin') }}')
            .then(response => {
                if (!response.ok) throw new Error('Erro na requisição.');
                return response.json();
            })
            .then(adminUsers => {
                adminUsers.sort((a, b) => a.name.localeCompare(b.name));

                const totalPages = Math.ceil(adminUsers.length / recordsPerPage);
                const start = (currentPage - 1) * recordsPerPage;
                const end = start + recordsPerPage;
                const paginatedUsers = adminUsers.slice(start, end);

                updateUserButtons(paginatedUsers);
                updatePaginationControls(totalPages);
            })
            .catch(error => console.error('Erro:', error));
    }

    // Função para atualizar os botões de usuários na UI
    function updateUserButtons(users) {
        $('#usersButtons').empty();
        users.forEach(user => {
            const button = `
                <button type="button" class="px-4 py-2 m-2 hover:bg-blue-800 border border-gray-300 text-white bg-blue-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500 rounded-md" 
                    data-user-id="${user.id}" data-lat="${user.latitude}" data-lng="${user.longitude}">
                    ${user.name}
                </button>`;
            $('#usersButtons').append(button);
        });
    }

    // Função para atualizar os controles de paginação na UI
    function updatePaginationControls(totalPages) {
        $('#paginationControls').empty();
        for (let i = 1; i <= totalPages; i++) {
            const pageButton = `
                <button type="button" class="btn btn-secondary me-1" onclick="goToPage(${i})">
                    ${i}
                </button>`;
            $('#paginationControls').append(pageButton);
        }
    }

    // Função para navegar para uma página específica
    function goToPage(pageNumber) {
        currentPage = pageNumber;
        loadUsers();
    }

    // Array para armazenar todos os marcadores
    let markers = [];

    // Evento de clique nos botões de usuários
    $(document).on('click', '#usersButtons button', function() {
        const latitude = $(this).data('lat');
        const longitude = $(this).data('lng');
        const userName = $(this).text();

        const location = { lat: parseFloat(latitude), lng: parseFloat(longitude) };

        const newMarker = new google.maps.Marker({
            position: location,
            map: map,
            title: userName
        });

        markers.push(newMarker);
        map.setCenter(location);

        console.log('Latitude:', latitude);
        console.log('Longitude:', longitude);
    });

    // Função para limpar todos os marcadores do mapa
    function clearMarkers() {
        markers.forEach(marker => marker.setMap(null));
        markers = [];
    }

    // Evento de clique no botão para limpar todos os marcadores
    $('#clearMarkersButton').click(function() {
        clearMarkers();
    });

    // Variável global para o mapa
    let map;

    // Função para inicializar o mapa
    async function initMap() {
        const { Map } = await google.maps.importLibrary("maps");

        map = new Map(document.getElementById("map"), {
            center: { lat: -34.397, lng: 150.644 },
            zoom: 8,
        });
    }

    // Função principal para inicializar o documento
    function initializeDocument() {
        addUserItemClickListeners();
        initializeInputMask();
        setupReloadButton();
        setupFilterButton();
        loadUsers();
        initMap();
    }

    // Inicializa o documento
    $(document).ready(initializeDocument);

</script>        
</body>
</html>





