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

            @keyframes glow {
                0%, 100% { box-shadow: 0 0 20px rgba(93, 30, 245, 0.5); }
                50% { box-shadow: 0 0 40px rgba(93, 30, 245, 0.8); }
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

            @keyframes slideInLeft {
                from {
                    opacity: 0;
                    transform: translateX(-30px);
                }
                to {
                    opacity: 1;
                    transform: translateX(0);
                }
            }

            @keyframes pulse-glow {
                0%, 100% { opacity: 0.5; }
                50% { opacity: 1; }
            }

            @keyframes gradientShift {
                0%, 100% { background-position: 0% 50%; }
                50% { background-position: 100% 50%; }
            }

            .animate-float {
                animation: float 3s ease-in-out infinite;
            }

            .animate-glow {
                animation: glow 2s ease-in-out infinite;
            }

            .animate-slide-down {
                animation: slideInDown 0.8s ease-out;
            }

            .animate-slide-up {
                animation: slideInUp 0.8s ease-out;
            }

            .animate-slide-left {
                animation: slideInLeft 0.8s ease-out;
            }

            .animate-pulse-glow {
                animation: pulse-glow 2s ease-in-out infinite;
            }

            .gradient-bg {
                background: linear-gradient(-45deg, #5d1ef5, #0284fe, #5d1ef5, #0284fe);
                background-size: 400% 400%;
                animation: gradientShift 15s ease infinite;
            }

            /* Estilo dos botões */
            .btn-primary {
                background: linear-gradient(135deg, #5d1ef5, #0284fe);
                color: white;
                padding: 12px 32px;
                border-radius: 50px;
                font-weight: 600;
                border: none;
                cursor: pointer;
                transition: all 0.3s ease;
                box-shadow: 0 4px 15px rgba(93, 30, 245, 0.4);
            }

            .btn-primary:hover {
                transform: translateY(-3px);
                box-shadow: 0 8px 25px rgba(93, 30, 245, 0.6);
            }

            .btn-secondary {
                background: transparent;
                color: white;
                padding: 12px 32px;
                border: 2px solid #0284fe;
                border-radius: 50px;
                font-weight: 600;
                cursor: pointer;
                transition: all 0.3s ease;
            }

            .btn-secondary:hover {
                background: rgba(2, 132, 254, 0.1);
                box-shadow: 0 4px 15px rgba(2, 132, 254, 0.4);
            }

            /* Cards */
            .card-feature {
                background: rgba(255, 255, 255, 0.05);
                border: 1px solid rgba(93, 30, 245, 0.3);
                border-radius: 15px;
                padding: 30px;
                transition: all 0.3s ease;
                backdrop-filter: blur(10px);
            }

            .card-feature:hover {
                background: rgba(93, 30, 245, 0.1);
                border-color: rgba(93, 30, 245, 0.6);
                transform: translateY(-10px);
                box-shadow: 0 20px 40px rgba(93, 30, 245, 0.3);
            }

            /* Hero section */
            .hero-title {
                font-size: 3.5rem;
                font-weight: 700;
                line-height: 1.2;
                margin-bottom: 20px;
                background: linear-gradient(135deg, #5d1ef5, #0284fe);
                -webkit-background-clip: text;
                -webkit-text-fill-color: transparent;
                background-clip: text;
            }

            .hero-subtitle {
                font-size: 1.2rem;
                color: rgba(255, 255, 255, 0.7);
                margin-bottom: 40px;
                line-height: 1.6;
            }

            /* Navbar */
            .navbar {
                background: rgba(15, 23, 42, 0.8);
                backdrop-filter: blur(10px);
                border-bottom: 1px solid rgba(93, 30, 245, 0.2);
            }

            .logo {
                font-size: 1.5rem;
                font-weight: 700;
                background: linear-gradient(135deg, #5d1ef5, #0284fe);
                -webkit-background-clip: text;
                -webkit-text-fill-color: transparent;
                background-clip: text;
            }

            .nav-link {
                color: rgba(255, 255, 255, 0.7);
                transition: color 0.3s ease;
            }

            .nav-link:hover {
                color: #0284fe;
            }

            /* Feature icons */
            .icon-box {
                width: 60px;
                height: 60px;
                background: linear-gradient(135deg, #5d1ef5, #0284fe);
                border-radius: 12px;
                display: flex;
                align-items: center;
                justify-content: center;
                margin-bottom: 20px;
            }

            /* Estatísticas */
            .stat-item {
                text-align: center;
            }

            .stat-number {
                font-size: 2.5rem;
                font-weight: 700;
                background: linear-gradient(135deg, #5d1ef5, #0284fe);
                -webkit-background-clip: text;
                -webkit-text-fill-color: transparent;
                background-clip: text;
            }

            .stat-label {
                color: rgba(255, 255, 255, 0.6);
                margin-top: 10px;
            }

            /* Orb decorativo */
            .orb {
                position: absolute;
                border-radius: 50%;
                filter: blur(40px);
                opacity: 0.3;
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

            /* Footer */
            .footer {
                background: rgba(15, 23, 42, 0.8);
                border-top: 1px solid rgba(93, 30, 245, 0.2);
            }

            .social-links {
                display: flex;
                gap: 20px;
                justify-content: center;
                margin-bottom: 15px;
            }

            .social-links a {
                color: rgba(255, 255, 255, 0.6);
                transition: color 0.3s ease;
                text-decoration: none;
            }

            .social-links a:hover {
                color: #0284fe;
            }

            .footer-credit {
                text-align: center;
                color: rgba(255, 255, 255, 0.5);
                font-size: 0.9rem;
            }

            @media (max-width: 768px) {
                .hero-title {
                    font-size: 2.2rem;
                }

                .hero-subtitle {
                    font-size: 1rem;
                }
            }
        </style>
    </head>
    <body>
        <!-- Orbs decorativos -->
        <div class="orb orb-1"></div>
        <div class="orb orb-2"></div>

        <!-- Navbar -->
        <nav class="navbar sticky top-0 z-50">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between items-center h-16">
                    <div class="logo animate-slide-down">JobTracker</div>

                    @if (Route::has('login'))
                        <div class="flex gap-4 animate-slide-down">
                            @auth
                                <a href="{{ url('/dashboard') }}" class="btn-primary">Dashboard</a>
                            @else
                                @if (Route::has('register'))
                                    <a href="{{ route('register') }}" class="btn-primary">Registrar</a>
                                @endif
                            @endauth
                        </div>
                    @endif
                </div>
            </div>
        </nav>

        <!-- Hero Section -->
        <section class="relative min-h-screen flex items-center justify-center px-4 py-20">
            <div class="max-w-5xl mx-auto text-center relative z-10">
                <div class="animate-slide-down">
                    <h1 class="hero-title">
                        Gerenciar suas Candidaturas<br>Nunca foi tão Fácil
                    </h1>
                    <p class="hero-subtitle">
                        JobTracker: Organize, acompanhe e maximize suas oportunidades de emprego com uma plataforma intuitiva e poderosa.
                    </p>
                </div>

                <div class="flex gap-4 justify-center flex-wrap animate-slide-up" style="animation-delay: 0.2s;">
                    @auth
                        <a href="{{ route('home.index') }}" class="btn-primary">Acessar Dashboard</a>
                    @else
                        <a href="{{ route('register') }}" class="btn-primary">Começar Agora</a>
                        <a href="{{ route('login') }}" class="btn-secondary">Já tem conta?</a>
                    @endauth
                </div>
            </div>
        </section>

        <!-- Features Section -->
        <section class="relative py-20 px-4">
            <div class="max-w-6xl mx-auto">
                <div class="text-center mb-16 animate-slide-down">
                    <h2 class="text-4xl font-bold mb-6">
                        <span class="bg-gradient-to-r from-purple-500 to-blue-500 bg-clip-text text-transparent">
                            Recursos Poderosos
                        </span>
                    </h2>
                    <p class="text-gray-400 text-lg">Tudo que você precisa para gerenciar suas candidaturas com sucesso</p>
                </div>

                <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
                    <!-- Feature 1 -->
                    <div class="card-feature animate-slide-up" style="animation-delay: 0.1s;">
                        <div class="icon-box">
                            <svg class="w-8 h-8 text-white" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M10 3.5a6.5 6.5 0 100 13 6.5 6.5 0 000-13zM2 10a8 8 0 1116 0 8 8 0 01-16 0z"/>
                            </svg>
                        </div>
                        <h3 class="text-xl font-bold mb-3">Rastreamento Completo</h3>
                        <p class="text-gray-400">Acompanhe todas as suas candidaturas em um único lugar com status em tempo real.</p>
                    </div>

                    <!-- Feature 2 -->
                    <div class="card-feature animate-slide-up" style="animation-delay: 0.2s;">
                        <div class="icon-box">
                            <svg class="w-8 h-8 text-white" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M4 4a2 2 0 00-2 2v4a2 2 0 002 2V6h10a2 2 0 00-2-2H4zm2 6a2 2 0 012-2h8a2 2 0 012 2v4a2 2 0 01-2 2H8a2 2 0 01-2-2v-4zm6 4a2 2 0 100-4 2 2 0 000 4z"/>
                            </svg>
                        </div>
                        <h3 class="text-xl font-bold mb-3">Gerenciamento de Notas</h3>
                        <p class="text-gray-400">Adicione observações personalizadas e detalhes importantes sobre cada candidatura.</p>
                    </div>

                    <!-- Feature 3 -->
                    <div class="card-feature animate-slide-up" style="animation-delay: 0.3s;">
                        <div class="icon-box">
                            <svg class="w-8 h-8 text-white" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M5.5 13a3.5 3.5 0 01-.369-6.98 4 4 0 117.753-1.3A4.5 4.5 0 1113.5 13H11V9.413l1.293 1.293a1 1 0 001.414-1.414l-3-3a1 1 0 00-1.414 0l-3 3a1 1 0 001.414 1.414L9 9.414V13H5.5z"/>
                            </svg>
                        </div>
                        <h3 class="text-xl font-bold mb-3">Importação de Dados</h3>
                        <p class="text-gray-400">Importe suas candidaturas de forma rápida e organize tudo automaticamente.</p>
                    </div>

                    <!-- Feature 4 -->
                    <div class="card-feature animate-slide-up" style="animation-delay: 0.4s;">
                        <div class="icon-box">
                            <svg class="w-8 h-8 text-white" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M2 11a1 1 0 011-1h2a1 1 0 011 1v5a1 1 0 01-1 1H3a1 1 0 01-1-1v-5zM8 7a1 1 0 011-1h2a1 1 0 011 1v9a1 1 0 01-1 1H9a1 1 0 01-1-1V7zM14 4a1 1 0 011-1h2a1 1 0 011 1v12a1 1 0 01-1 1h-2a1 1 0 01-1-1V4z"/>
                            </svg>
                        </div>
                        <h3 class="text-xl font-bold mb-3">Estatísticas e Análises</h3>
                        <p class="text-gray-400">Visualize métricas detalhadas e acompanhe o progresso das suas candidaturas.</p>
                    </div>

                    <!-- Feature 5 -->
                    <div class="card-feature animate-slide-up" style="animation-delay: 0.5s;">
                        <div class="icon-box">
                            <svg class="w-8 h-8 text-white" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M10 12a2 2 0 100-4 2 2 0 000 4z"/>
                                <path fill-rule="evenodd" d="M.458 10C1.732 5.943 5.522 3 10 3s8.268 2.943 9.542 7c-1.274 4.057-5.064 7-9.542 7S1.732 14.057.458 10zM14 10a4 4 0 11-8 0 4 4 0 018 0z" clip-rule="evenodd"/>
                            </svg>
                        </div>
                        <h3 class="text-xl font-bold mb-3">Visão Geral</h3>
                        <p class="text-gray-400">Dashboard intuitivo para visualizar todas as suas candidaturas rapidamente.</p>
                    </div>

                    <!-- Feature 6 -->
                    <div class="card-feature animate-slide-up" style="animation-delay: 0.6s;">
                        <div class="icon-box">
                            <svg class="w-8 h-8 text-white" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M13 6a3 3 0 11-6 0 3 3 0 016 0zM18 8a2 2 0 11-4 0 2 2 0 014 0zM14 15a4 4 0 00-8 0v3h8v-3zM6 8a2 2 0 11-4 0 2 2 0 014 0zM16 18v-3a5.972 5.972 0 00-.75-2.906A3.005 3.005 0 0119 15v3h-3zM4.75 12.094A5.973 5.973 0 004 15v3H1v-3a3 3 0 013.75-2.906z"/>
                            </svg>
                        </div>
                        <h3 class="text-xl font-bold mb-3">Gerenciamento de Perfil</h3>
                        <p class="text-gray-400">Customize seu perfil e mantenha suas informações sempre atualizadas.</p>
                    </div>
                </div>
            </div>
        </section>

        <!-- Stats Section -->
        <section class="relative py-20 px-4">
            <div class="max-w-5xl mx-auto">
                <div class="grid md:grid-cols-4 gap-8 text-center">
                    <div class="stat-item animate-slide-up" style="animation-delay: 0.1s;">
                        <div class="stat-number">500+</div>
                        <div class="stat-label">Usuários Ativos</div>
                    </div>
                    <div class="stat-item animate-slide-up" style="animation-delay: 0.2s;">
                        <div class="stat-number">5K+</div>
                        <div class="stat-label">Candidaturas Gerenciadas</div>
                    </div>
                    <div class="stat-item animate-slide-up" style="animation-delay: 0.3s;">
                        <div class="stat-number">98%</div>
                        <div class="stat-label">Satisfação</div>
                    </div>
                    <div class="stat-item animate-slide-up" style="animation-delay: 0.4s;">
                        <div class="stat-number">24/7</div>
                        <div class="stat-label">Suporte</div>
                    </div>
                </div>
            </div>
        </section>

        <!-- CTA Section -->
        <section class="relative py-20 px-4">
            <div class="max-w-4xl mx-auto text-center">
                <div class="card-feature animate-slide-up">
                    <h2 class="text-4xl font-bold mb-6">
                        Pronto para Começar?
                    </h2>
                    <p class="text-gray-400 text-lg mb-8">
                        Transforme a forma como você gerencia suas candidaturas. Comece gratuitamente hoje mesmo!
                    </p>
                    <div class="flex gap-4 justify-center flex-wrap">
                        @auth
                            <a href="{{ url('../home.index') }}" class="btn-primary">Acessar Dashboard</a>
                        @else
                            <a href="{{ route('register') }}" class="btn-primary">Criar Conta Grátis</a>
                            <a href="{{ route('login') }}" class="btn-secondary">Fazer Login</a>
                        @endauth
                    </div>
                </div>
            </div>
        </section>

        <!-- Footer -->
        <footer class="footer mt-20">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
                <div class="text-center">
                    <div class="logo mb-6">JobTracker</div>

                    <!-- Redes Sociais -->
                    <div class="social-links">
                        <a href="https://github.com/DomingosSapalo1234" target="_blank" title="GitHub">
                            <svg class="w-6 h-6 inline" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M12 0c-6.626 0-12 5.373-12 12 0 5.302 3.438 9.8 8.207 11.387.599.111.793-.261.793-.577v-2.234c-3.338.726-4.033-1.416-4.033-1.416-.546-1.387-1.333-1.756-1.333-1.756-1.089-.745.083-.729.083-.729 1.205.084 1.839 1.237 1.839 1.237 1.07 1.834 2.807 1.304 3.492.997.107-.775.418-1.305.762-1.604-2.665-.305-5.467-1.334-5.467-5.931 0-1.311.469-2.381 1.236-3.221-.124-.303-.535-1.524.117-3.176 0 0 1.008-.322 3.301 1.23.957-.266 1.983-.399 3.003-.404 1.02.005 2.047.138 3.006.404 2.291-1.552 3.297-1.23 3.297-1.23.653 1.653.242 2.874.118 3.176.77.84 1.235 1.911 1.235 3.221 0 4.609-2.807 5.624-5.479 5.921.43.372.823 1.102.823 2.222v 3.293c0 .319.192.694.801.576 4.765-1.589 8.199-6.086 8.199-11.386 0-6.627-5.373-12-12-12z"/>
                            </svg>
                        </a>
                        <a href="https://www.linkedin.com" target="_blank" title="LinkedIn">
                            <svg class="w-6 h-6 inline" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433c-1.144 0-2.063-.926-2.063-2.065 0-1.138.92-2.063 2.063-2.063 1.14 0 2.064.925 2.064 2.063 0 1.139-.925 2.065-2.064 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.225 0z"/>
                            </svg>
                        </a>
                        <a href="https://www.twitter.com" target="_blank" title="Twitter">
                            <svg class="w-6 h-6 inline" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M23 3a10.9 10.9 0 01-3.14 1.53 4.48 4.48 0 00-7.86 3v1A10.66 10.66 0 013 4s-4 9 5 13a11.64 11.64 0 01-7 2s9 5 20 5a9.5 9.5 0 00-9-5.5c4.75 2.25 7-7 7-7a10.6 10.6 0 01-9.5 5M12 1v6m4-4l-4 4m0 0l-4-4"/>
                            </svg>
                        </a>
                    </div>

                    <!-- Projeto -->
                    <div class="mt-6 mb-4">
                        <p class="text-gray-400">
                            Projeto: <a href="https://github.com/DomingosSapalo1234" target="_blank" class="text-blue-400 hover:text-blue-300 transition">JobTracker no GitHub</a>
                        </p>
                    </div>

                    <!-- Créditos -->
                    <div class="footer-credit">
                        <p>Desenvolvido por Evaristo Firmino</p>
                        <p>&copy; 2026 JobTracker. Todos os direitos reservados.</p>
                    </div>
                </div>
            </div>
        </footer>

        <script>
            // Animar elementos ao scroll
            const observerOptions = {
                threshold: 0.1,
                rootMargin: '0px 0px -50px 0px'
            };

            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.style.opacity = '1';
                        entry.target.style.transform = 'translateY(0)';
                    }
                });
            }, observerOptions);

            document.querySelectorAll('.animate-slide-up, .card-feature, .stat-item').forEach(el => {
                el.style.opacity = '0';
                el.style.transform = 'translateY(20px)';
                el.style.transition = 'opacity 0.6s ease, transform 0.6s ease';
                observer.observe(el);
            });

            // Efeito parallax suave
            window.addEventListener('mousemove', (e) => {
                const orbs = document.querySelectorAll('.orb');
                const x = e.clientX / window.innerWidth;
                const y = e.clientY / window.innerHeight;

                orbs.forEach(orb => {
                    orb.style.transform = `translate(${x * 20}px, ${y * 20}px)`;
                });
            });
        </script>
    </body>
</html>
