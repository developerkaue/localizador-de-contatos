<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Confirmação de Exclusão de Conta</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-6 offset-md-3">
                <div class="card">
                    <div class="card-header text-primary">
                        <h5>Confirmação de Exclusão de Conta</h5>
                    </div>
                    <div class="card-body">
                        <p>Por favor, confirme a exclusão da sua conta digitando sua senha abaixo:</p>
                        <form id="deleteAccountForm">
                            @csrf
                            <div class="form-group">
                                <label for="password">Senha:</label>
                                <input type="password" class="form-control" id="password" name="password">
                            </div>
                            <a href="{{ url()->previous() }}" class="btn btn-secondary">Voltar</a>
                            <button id="deleteAccountBtn" type="button" class="btn btn-danger">Confirmar Exclusão</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.0.6/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
        window.logoutUrl = "{{ route('logout') }}";
        document.getElementById('deleteAccountBtn').addEventListener('click', function() {
            if (confirm('Tem certeza que deseja excluir sua conta? Esta ação é irreversível.')) {
                var form = document.getElementById('deleteAccountForm');
                var password = document.getElementById('password').value;
                var userId = "{{ Auth::user()->id }}";
    
                var csrfTokenElement = document.querySelector('meta[name="csrf-token"]');
                var csrfToken = csrfTokenElement ? csrfTokenElement.getAttribute('content') : '';
    
                fetch('/users/' + userId, {
                    method: 'DELETE',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': csrfToken
                    },
                    body: JSON.stringify({
                        password: password
                    })
                })
                .then(response => {
                    if (response.ok) {
                        // Crie um formulário dinâmico e envie para fazer logout
                        var form = document.createElement('form');
                        form.method = 'POST';
                        form.action = window.logoutUrl;
                        document.body.appendChild(form);

                        var csrfInput = document.createElement('input');
                        csrfInput.type = 'hidden';
                        csrfInput.name = '_token';
                        csrfInput.value = csrfToken;
                        form.appendChild(csrfInput);

                        form.submit();
                        window.location.href = "http://127.0.0.1:8000/";
                    } else {
                        alert('Erro ao excluir a conta. Verifique sua senha e tente novamente.');
                    }
                })
            }
        });
    </script>
</body>
</html>