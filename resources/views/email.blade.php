<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.0.1/dist/tailwind.min.css" rel="stylesheet">
    <title>Forgot Password</title>
</head>
<body class="bg-gray-100">
    <div class="min-h-screen flex items-center justify-center">
        <div class="max-w-md w-full bg-white p-8 rounded-lg shadow-md">
            <h2 class="text-2xl font-bold mb-6">Forgot Password</h2>
            @if (session('status'))
                <div class="bg-green-100 text-green-800 p-4 rounded mb-4">
                    {{ session('status') }}
                </div>
            @endif
            <form id="forgot-password-form">
                <div class="mb-4">
                    <label for="email" class="block text-gray-700">Email Address</label>
                    <input type="email" id="email" name="email" class="w-full p-2 border border-gray-300 rounded mt-1">
                </div>
                <button type="submit" class="w-full bg-blue-500 text-white p-2 rounded">Send Password Reset Link</button>
            </form>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#forgot-password-form').on('submit', function(event) {
                event.preventDefault();

                $.ajax({
                    url: "{{ route('password.email') }}",
                    type: "POST",
                    data: {
                        email: $('#email').val(),
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(response) {
                        alert('Password reset link sent to your email.');
                    },
                    error: function(xhr) {
                        alert('Failed to send password reset link.');
                    }
                });
            });
        });
    </script>
</body>
</html>
