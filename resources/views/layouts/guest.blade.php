<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>JobTracker - Gerenciador de Candidaturas</title>
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700&display=swap" rel="stylesheet" />
        <script src="https://cdn.tailwindcss.com"></script>
        <style>
            * {
                margin: 0;
                padding: 0;
                box-sizing: border-box;
            }

            :root {
                --color-primary: #5d1ef5;
                --color-secondary: #0284fe;
            }

            body {
                font-family: 'Figtree', sans-serif;
                background: linear-gradient(135deg, #0f172a 0%, #1e1b4b 50%, #1e3a8a 100%);
                color: #fff;
                overflow-x: hidden;
            }

            /* Animações */
            @keyframes float {
                0%, 100% { transform: translateY(0px); }
                50% { transform: translateY(-20px); }
            }

            @keyframes slideInDown {
                from {
                    opacity: 0;
                    transform: translateY(-30px);
                }
                to {
                    opacity: 1;
                    transform: translateY(0);
                }
            }

            @keyframes slideInUp {
                from {
                    opacity: 0;
                    transform: translateY(30px);
                }
                to {
                    opacity: 1;
                    transform: translateY(0);
                }
            }

            .animate-slide-down {
                animation: slideInDown 0.8s ease-out;
            }

            .animate-slide-up {
                animation: slideInUp 0.8s ease-out;
            }

            /* Orb decorativo */
            .orb {
                position: absolute;
                border-radius: 50%;
                filter: blur(40px);
                opacity: 0.2;
            }

            .orb-1 {
                width: 300px;
                height: 300px;
                background: #5d1ef5;
                top: -50px;
                right: -50px;
                animation: float 6s ease-in-out infinite;
            }

            .orb-2 {
                width: 250px;
                height: 250px;
                background: #0284fe;
                bottom: 50px;
                left: -50px;
                animation: float 5s ease-in-out infinite reverse;
            }

            /* Logo */
            .logo {
                font-size: 1.5rem;
                font-weight: 700;
                background: linear-gradient(135deg, #5d1ef5, #0284fe);
                -webkit-background-clip: text;
                -webkit-text-fill-color: transparent;
                background-clip: text;
            }

            /* Card de Autenticação */
            .auth-card {
                background: rgba(15, 23, 42, 0.7);
                backdrop-filter: blur(10px);
                border: 1px solid rgba(93, 30, 245, 0.3);
                border-radius: 20px;
                padding: 40px;
                max-width: 450px;
                width: 100%;
                box-shadow: 0 8px 32px rgba(93, 30, 245, 0.15);
            }

            .auth-card h2 {
                font-size: 1.875rem;
                font-weight: 700;
                margin-bottom: 10px;
                background: linear-gradient(135deg, #5d1ef5, #0284fe);
                -webkit-background-clip: text;
                -webkit-text-fill-color: transparent;
                background-clip: text;
            }

            .auth-card p {
                color: rgba(255, 255, 255, 0.6);
                margin-bottom: 30px;
                font-size: 0.95rem;
            }

            /* Inputs */
            .form-group {
                margin-bottom: 20px;
            }

            .form-label {
                display: block;
                color: rgba(255, 255, 255, 0.8);
                font-weight: 600;
                margin-bottom: 8px;
                font-size: 0.95rem;
            }

            .form-input {
                width: 100%;
                background: rgba(255, 255, 255, 0.05);
                border: 1px solid rgba(93, 30, 245, 0.3);
                border-radius: 10px;
                padding: 12px 16px;
                color: white;
                font-size: 0.95rem;
                transition: all 0.3s ease;
            }

            .form-input::placeholder {
                color: rgba(255, 255, 255, 0.4);
            }

            .form-input:focus {
                outline: none;
                background: rgba(93, 30, 245, 0.1);
                border-color: #0284fe;
                box-shadow: 0 0 0 3px rgba(2, 132, 254, 0.1);
            }

            .form-input:hover {
                border-color: rgba(93, 30, 245, 0.5);
            }

            /* Checkbox */
            .checkbox-wrapper {
                display: flex;
                align-items: center;
                gap: 8px;
                margin: 20px 0;
            }

            .checkbox-wrapper input[type="checkbox"] {
                width: 18px;
                height: 18px;
                cursor: pointer;
                accent-color: #0284fe;
                border-radius: 4px;
            }

            .checkbox-wrapper label {
                color: rgba(255, 255, 255, 0.7);
                cursor: pointer;
                font-size: 0.9rem;
            }

            /* Botões */
            .btn-primary {
                background: linear-gradient(135deg, #5d1ef5, #0284fe);
                color: white;
                padding: 12px 32px;
                border-radius: 10px;
                font-weight: 600;
                border: none;
                cursor: pointer;
                transition: all 0.3s ease;
                width: 100%;
                font-size: 0.95rem;
            }

            .btn-primary:hover {
                transform: translateY(-2px);
                box-shadow: 0 8px 25px rgba(2, 132, 254, 0.4);
            }

            .btn-primary:active {
                transform: translateY(0);
            }

            /* Links */
            .auth-link {
                color: #0284fe;
                text-decoration: none;
                transition: color 0.3s ease;
                font-weight: 500;
                font-size: 0.9rem;
            }

            .auth-link:hover {
                color: #5d1ef5;
                text-decoration: underline;
            }

            /* Divisor de Ação */
            .auth-footer {
                margin-top: 25px;
                text-align: center;
                color: rgba(255, 255, 255, 0.6);
                font-size: 0.9rem;
            }

            .auth-footer a {
                color: #0284fe;
                text-decoration: none;
                font-weight: 600;
                transition: color 0.3s ease;
            }

            .auth-footer a:hover {
                color: #5d1ef5;
            }

            /* Mensagens de Erro */
            .error-message {
                color: #ef4444;
                font-size: 0.85rem;
                margin-top: 6px;
                display: flex;
                align-items: center;
                gap: 6px;
            }

            .error-input {
                border-color: #ef4444 !important;
                background: rgba(239, 68, 68, 0.05) !important;
            }

            /* Mensagens de Sucesso */
            .success-message {
                background: rgba(34, 197, 94, 0.1);
                border: 1px solid rgba(34, 197, 94, 0.3);
                border-radius: 10px;
                padding: 12px 16px;
                color: #86efac;
                margin-bottom: 20px;
                font-size: 0.9rem;
            }

            /* Info Message */
            .info-message {
                background: rgba(59, 130, 246, 0.1);
                border: 1px solid rgba(59, 130, 246, 0.3);
                border-radius: 10px;
                padding: 15px;
                color: #93c5fd;
                margin-bottom: 25px;
                font-size: 0.9rem;
                line-height: 1.5;
            }

            /* Navbar Simples */
            .navbar-auth {
                background: rgba(15, 23, 42, 0.8);
                backdrop-filter: blur(10px);
                border-bottom: 1px solid rgba(93, 30, 245, 0.2);
                padding: 1rem;
                margin-bottom: 3rem;
            }

            .navbar-auth-content {
                max-width: 7xl;
                margin: 0 auto;
                display: flex;
                justify-content: space-between;
                align-items: center;
            }

            .navbar-auth-links {
                display: flex;
                gap: 1rem;
            }

            /* Layout Principal */
            .auth-container {
                min-height: 100vh;
                display: flex;
                flex-direction: column;
                align-items: center;
                justify-content: center;
                padding: 2rem 1rem;
                position: relative;
            }

            @media (max-width: 640px) {
                .auth-card {
                    padding: 30px 20px;
                }

                .auth-card h2 {
                    font-size: 1.5rem;
                }

                .btn-primary {
                    padding: 10px 20px;
                    font-size: 0.9rem;
                }
            }
        </style>
    </head>
    <body>
        <!-- Orbs decorativos -->
        <div class="orb orb-1"></div>
        <div class="orb orb-2"></div>

        <!-- Navbar Simples -->
        <nav class="navbar-auth">
            <div class="navbar-auth-content">
                <div class="logo animate-slide-down">JobTracker</div>
                <div class="navbar-auth-links animate-slide-down">
                    <a href="{{ url('/') }}" class="auth-link">← Voltar</a>
                </div>
            </div>
        </nav>

        <!-- Container Principal -->
        <div class="auth-container animate-slide-up">
            {{ $slot }}
        </div>
    </body>
</html>
