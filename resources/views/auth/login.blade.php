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
            background-image: linear-gradient(rgba(255,255,255,0.9), rgba(255,255,255,0.9)), 
                              url('{{ asset("images/restaurant-bg.jpg") }}');
            background-size: cover;
            background-position: center;
        }
        .login-container {
            max-width: 400px;
            width: 100%;
            padding: 20px;
        }
        .card {
            border-radius: 10px;
            box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15);
            border: none;
        }
        .card-header {
            background-color: #3a1019;
            color: white;
            border-radius: 10px 10px 0 0 !important;
            padding: 1rem;
            text-align: center;
        }
        .logo {
            text-align: center;
            margin-bottom: 20px;
        }
        .logo img {
            height: 100px;
            transition: transform 0.3s ease;
        }
        .logo img:hover {
            transform: scale(1.05);
        }
        .btn-login {
            background-color: #ff7200;
            border: none;
            padding: 10px;
            font-weight: 500;
            transition: all 0.3s ease;
        }
        .btn-login:hover {
            background-color: #e56700;
            transform: translateY(-2px);
        }
        .input-group-text {
            background-color: #3a1019;
            color: white;
            border: none;
        }
        .form-control:focus {
            border-color: #ff7200;
            box-shadow: 0 0 0 0.25rem rgba(255, 114, 0, 0.25);
        }
        .alert-danger {
            background-color: rgba(214, 0, 21, 0.1);
            color: #d60015;
            border-left: 4px solid #d60015;
        }
        .form-check-input:checked {
            background-color: #3a1019;
            border-color: #3a1019;
        }
    </style>
</head>
<body>
    <div class="login-container">
        <div class="logo">
            <img src="{{ asset('images/logoo.jpg') }}" alt="Atlas Restaurant Logo">
        </div>
        
        <div class="card">
            <div class="card-header">
                <h4 class="mb-0"><i class="fas fa-sign-in-alt me-2"></i>Connexion</h4>
            </div>
            <div class="card-body p-4">
                @if ($errors->any())
                <div class="alert alert-danger mb-4">
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
                        <label for="login" class="form-label fw-medium">Nom d'utilisateur</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="fas fa-user"></i></span>
                            <input type="text" class="form-control" id="login" name="login" required autofocus>
                        </div>
                    </div>
                    
                    <div class="mb-3">
                        <label for="motdepasse" class="form-label fw-medium">Mot de passe</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="fas fa-lock"></i></span>
                            <input type="password" class="form-control" id="motdepasse" name="motdepasse" required>
                        </div>
                    </div>
                    
                    <div class="mb-3 form-check">
                        <input type="checkbox" class="form-check-input" id="remember" name="remember">
                        <label class="form-check-label" for="remember">Mémoriser le mot de passe</label>
                    </div>
                    
                    <div class="d-grid mt-4">
                        <button type="submit" class="btn btn-login py-2">
                            <i class="fas fa-sign-in-alt me-2"></i>Se connecter
                        </button>
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