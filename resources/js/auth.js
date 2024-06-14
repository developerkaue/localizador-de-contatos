import axios from 'axios';

document.addEventListener('DOMContentLoaded', function() {
    const loginForm = document.getElementById('loginForm');
    loginForm.addEventListener('submit', async function(e) {
        e.preventDefault();

        const email = document.getElementById('email').value;
        const password = document.getElementById('password').value;

        try {
            const response = await axios.post('/api/v1/login', {
                email: email,
                password: password
            });

            const data = response.data;
            console.log('Login successful', data);

            // Redirecionar o usuário para a URL fornecida
            window.location.href = data.redirect_url;
        } catch (error) {
            alert('Login failed: ' + error.message);
        }
    });
});
