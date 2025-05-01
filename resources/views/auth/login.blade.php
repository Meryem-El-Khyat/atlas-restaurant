<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Atlas Restaurant - Connexion</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        body {
            background-color: #f8f9fa;
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .login-container {
            max-width: 400px;
            width: 100%;
            padding: 20px;
        }
        .card {
            border-radius: 10px;
            box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15);
        }
        .logo {
            text-align: center;
            margin-bottom: 20px;
        }
        .logo img {
            height: 80px;
        }
    </style>
</head>
<body>
    <div class="login-container">
        <div class="logo">
            <img src="{{ asset('images/logo.png') }}" alt="Atlas Restaurant Logo">
        </div>
        
        <div class="card">
            <div class="card-body p-4">
                <h4 class="card-title text-center mb-4">Connexion</h4>
                
                @if ($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif
                
                <form method="POST" action="{{ route('login.post') }}">
                    @csrf
                    
                    <div class="mb-3">
                        <label for="login" class="form-label">Nom d'utilisateur</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="fas fa-user"></i></span>
                            <input type="text" class="form-control" id="login" name="login" required autofocus>
                        </div>
                    </div>
                    
                    <div class="mb-3">
                        <label for="motdepasse" class="form-label">Mot de passe</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="fas fa-lock"></i></span>
                            <input type="password" class="form-control" id="motdepasse" name="motdepasse" required>
                        </div>
                    </div>
                    
                    <div class="mb-3 form-check">
                        <input type="checkbox" class="form-check-input" id="remember" name="remember">
                        <label class="form-check-label" for="remember">Mémoriser le mot de passe</label>
                    </div>
                    
                    <div class="d-grid">
                        <button type="submit" class="btn btn-primary">Connecter</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    
    <script>
        // Script pour mémoriser seulement le login (pas le mot de passe pour des raisons de sécurité)
        $(document).ready(function() {
            // Vérifier si le login est stocké
            if (localStorage.getItem('login')) {
                $('#login').val(localStorage.getItem('login'));
                $('#remember').prop('checked', true);
            }
            
            // Enregistrer le login lors de la soumission du formulaire
            $('form').submit(function() {
                if ($('#remember').is(':checked')) {
                    localStorage.setItem('login', $('#login').val());
                } else {
                    localStorage.removeItem('login');
                }
            });
        });
    </script>
</body>
</html>