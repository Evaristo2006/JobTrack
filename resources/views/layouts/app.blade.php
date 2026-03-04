<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>@yield('title') - JobTracker</title>
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
                --color-primary: #0284ff;
                --color-secondary: #ffffff;
            }

            body {
                font-family: 'Figtree', sans-serif;
                background: #f8f9fa;
                color: #1a1a1a;
            }

            /* Sidebar */
            .sidebar {
                position: fixed;
                left: 0;
                top: 0;
                width: 260px;
                height: 100vh;
                background: linear-gradient(135deg, #0f0f1e 0%, #1a1a2e 100%);
                border-right: 1px solid rgba(2, 132, 255, 0.1);
                padding: 2rem 0;
                overflow-y: auto;
                z-index: 100;
            }

            .sidebar-logo {
                padding: 0 1.5rem;
                margin-bottom: 2rem;
                font-size: 1.5rem;
                font-weight: 700;
                color: #ffffff;
            }

            .sidebar-menu {
                list-style: none;
            }

            .sidebar-menu li {
                margin: 0.5rem 0;
            }

            .sidebar-menu a {
                display: flex;
                align-items: center;
                gap: 0.75rem;
                padding: 0.875rem 1.5rem;
                color: rgba(255, 255, 255, 0.7);
                text-decoration: none;
                transition: all 0.3s ease;
                font-weight: 500;
            }

            .sidebar-menu a:hover,
            .sidebar-menu a.active {
                background: rgba(2, 132, 255, 0.1);
                color: #ffffff;
                border-left: 3px solid #0284ff;
                padding-left: calc(1.5rem - 3px);
            }

            .sidebar-menu svg {
                width: 20px;
                height: 20px;
            }

            /* Top Navbar */
            .navbar {
                position: fixed;
                top: 0;
                left: 260px;
                right: 0;
                height: 64px;
                background: #ffffff;
                border-bottom: 1px solid #e0e0e0;
                display: flex;
                justify-content: space-between;
                align-items: center;
                padding: 0 2rem;
                z-index: 50;
            }

            .navbar-title h1 {
                font-size: 1.5rem;
                color: #1a1a1a;
                margin: 0;
            }

            .navbar-actions {
                display: flex;
                gap: 1rem;
                align-items: center;
            }

            .navbar-user {
                display: flex;
                align-items: center;
                gap: 0.75rem;
                color: #1a1a1a;
            }

            .btn-logout {
                background: #ef4444;
                color: white;
                border: none;
                padding: 0.5rem 1rem;
                border-radius: 6px;
                cursor: pointer;
                font-weight: 600;
                transition: all 0.3s ease;
            }

            .btn-logout:hover {
                background: #dc2626;
            }

            /* Main Content */
            .main-content {
                margin-left: 260px;
                margin-top: 64px;
                padding: 2rem;
                min-height: calc(100vh - 64px);
            }

            /* Buttons */
            .btn-primary {
                background: #0284ff;
                color: white;
                border: none;
                padding: 0.75rem 1.5rem;
                border-radius: 8px;
                cursor: pointer;
                font-weight: 600;
                transition: all 0.3s ease;
                text-decoration: none;
                display: inline-block;
            }

            .btn-primary:hover {
                background: #0070e0;
                transform: translateY(-2px);
                box-shadow: 0 4px 12px rgba(2, 132, 255, 0.3);
            }

            .btn-secondary {
                background: transparent;
                color: #0284ff;
                border: 1px solid #0284ff;
                padding: 0.75rem 1.5rem;
                border-radius: 8px;
                cursor: pointer;
                font-weight: 600;
                transition: all 0.3s ease;
                text-decoration: none;
                display: inline-block;
            }

            .btn-secondary:hover {
                background: rgba(2, 132, 255, 0.1);
            }

            .btn-danger {
                background: #ef4444;
                color: white;
                border: none;
                padding: 0.5rem 1rem;
                border-radius: 6px;
                cursor: pointer;
                font-weight: 600;
                transition: all 0.3s ease;
            }

            .btn-danger:hover {
                background: #dc2626;
            }

            /* Table */
            .table-container {
                background: white;
                border-radius: 12px;
                overflow: hidden;
                box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
            }

            table {
                width: 100%;
                border-collapse: collapse;
            }

            thead {
                background: #f8f9fa;
                border-bottom: 1px solid #e0e0e0;
            }

            th {
                padding: 1rem;
                text-align: left;
                font-weight: 600;
                color: #1a1a1a;
            }

            td {
                padding: 1rem;
                border-bottom: 1px solid #e0e0e0;
                color: #666;
            }

            tbody tr:hover {
                background: #f8f9fa;
            }

            /* Form */
            .form-group {
                margin-bottom: 1.5rem;
            }

            .form-label {
                display: block;
                font-weight: 600;
                color: #1a1a1a;
                margin-bottom: 0.5rem;
            }

            .form-input,
            .form-select,
            .form-textarea {
                width: 100%;
                padding: 0.75rem;
                border: 1px solid #e0e0e0;
                border-radius: 8px;
                font-family: inherit;
                font-size: 1rem;
                transition: all 0.3s ease;
            }

            .form-input:focus,
            .form-select:focus,
            .form-textarea:focus {
                outline: none;
                border-color: #0284ff;
                box-shadow: 0 0 0 3px rgba(2, 132, 255, 0.1);
            }

            .form-textarea {
                resize: vertical;
                min-height: 120px;
            }

            /* Cards */
            .card {
                background: white;
                border-radius: 12px;
                padding: 2rem;
                box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
            }

            .card-title {
                font-size: 1.5rem;
                font-weight: 700;
                color: #1a1a1a;
                margin-bottom: 1rem;
            }

            /* Alert */
            .alert {
                padding: 1rem;
                border-radius: 8px;
                margin-bottom: 1rem;
            }

            .alert-success {
                background: rgba(34, 197, 94, 0.1);
                border: 1px solid #22c55e;
                color: #15803d;
            }

            .alert-error {
                background: rgba(239, 68, 68, 0.1);
                border: 1px solid #ef4444;
                color: #b91c1c;
            }

            /* Header */
            .page-header {
                display: flex;
                justify-content: space-between;
                align-items: center;
                margin-bottom: 2rem;
            }

            .page-title {
                font-size: 2rem;
                font-weight: 700;
                color: #1a1a1a;
            }

            /* Responsive */
            @media (max-width: 768px) {
                .sidebar {
                    width: 200px;
                }

                .navbar,
                .main-content {
                    margin-left: 0;
                }

                .navbar {
                    left: 0;
                }

                .main-content {
                    margin-top: 64px;
                }
            }
        </style>
    </head>
    <body>
        <!-- Sidebar -->
        <aside class="sidebar">
            <div class="sidebar-logo">JobTracker</div>

            <ul class="sidebar-menu">
                <li>
                    <a href="{{ route('home.index') }}" class="@if(request()->routeIs('home.index')) active @endif">
                        <svg fill="currentColor" viewBox="0 0 20 20">
                            <path d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z"/>
                        </svg>
                        Dashboard
                    </a>
                </li>
                <li>
                    <a href="{{ route('applications.index') }}" class="@if(request()->routeIs('applications.*')) active @endif">
                        <svg fill="currentColor" viewBox="0 0 20 20">
                            <path d="M5.5 13a3.5 3.5 0 01-.369-6.98 4 4 0 117.753-1.3A4.5 4.5 0 1113.5 13H11V9.413l1.293 1.293a1 1 0 001.414-1.414l-3-3a1 1 0 00-1.414 0l-3 3a1 1 0 001.414 1.414L9 9.414V13H5.5z"/>
                        </svg>
                        Candidaturas
                    </a>
                </li>
                <li>
                    <a href="{{ route('interviews.index') }}" class="@if(request()->routeIs('interviews.*')) active @endif">
                        <svg fill="currentColor" viewBox="0 0 20 20">
                            <path d="M13 6a3 3 0 11-6 0 3 3 0 016 0zM18 8a2 2 0 11-4 0 2 2 0 014 0zM14 15a4 4 0 00-8 0v3h8v-3zM6 8a2 2 0 11-4 0 2 2 0 014 0zM16 18v-3a5.972 5.972 0 00-.75-2.906A3.005 3.005 0 0119 15v3h-3zM4.75 12.094A5.973 5.973 0 004 15v3H1v-3a3 3 0 013.75-2.906z"/>
                        </svg>
                        Entrevistas
                    </a>
                </li>
                <li>
                    <a href="{{ route('goals.index') }}" class="@if(request()->routeIs('goals.*')) active @endif">
                        <svg fill="currentColor" viewBox="0 0 20 20">
                            <path d="M2 11a1 1 0 011-1h2a1 1 0 011 1v5a1 1 0 01-1 1H3a1 1 0 01-1-1v-5zM8 7a1 1 0 011-1h2a1 1 0 011 1v9a1 1 0 01-1 1H9a1 1 0 01-1-1V7zM14 4a1 1 0 011-1h2a1 1 0 011 1v12a1 1 0 01-1 1h-2a1 1 0 01-1-1V4z"/>
                        </svg>
                        Metas
                    </a>
                </li>
                <li>
                    <a href="{{ route('statuses.index') }}" class="@if(request()->routeIs('statuses.*')) active @endif">
                        <svg fill="currentColor" viewBox="0 0 20 20">
                            <path d="M9 2a1 1 0 000 2h2a1 1 0 100-2H9z"/>
                            <path fill-rule="evenodd" d="M4 5a2 2 0 012-2 1 1 0 000-2H6a6 6 0 100 12H4a1 1 0 100 2 2 2 0 01-2-2V5zm15.707 4.293a1 1 0 00-1.414-1.414L12 12.586l-1.293-1.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"/>
                        </svg>
                        Status
                    </a>
                </li>
                <li>
                    <a href="{{ route('profile.edit') }}" class="@if(request()->routeIs('profile.*')) active @endif">
                        <svg fill="currentColor" viewBox="0 0 20 20">
                            <path d="M10 12a2 2 0 100-4 2 2 0 000 4z"/>
                            <path fill-rule="evenodd" d="M.458 10C1.732 5.943 5.522 3 10 3s8.268 2.943 9.542 7c-1.274 4.057-5.064 7-9.542 7S1.732 14.057.458 10zM14 10a4 4 0 11-8 0 4 4 0 018 0z"/>
                        </svg>
                        Perfil
                    </a>
                </li>
            </ul>
        </aside>

        <!-- Top Navbar -->
        <nav class="navbar">
            <div class="navbar-title">
                <h1>@yield('page-title', 'Dashboard')</h1>
            </div>
            <div class="navbar-actions">
                <div class="navbar-user">
                    <span>{{ Auth::user()->name }}</span>
                </div>
                <form method="POST" action="{{ route('logout') }}" style="margin: 0;">
                    @csrf
                    <button type="submit" class="btn-logout">Sair</button>
                </form>
            </div>
        </nav>

        <!-- Main Content -->
        <main class="main-content">
            @if ($errors->any())
                <div class="alert alert-error">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            @yield('content')
        </main>

        <script>
            // Auto-hide alerts after 5 seconds
            document.querySelectorAll('.alert').forEach(alert => {
                setTimeout(() => {
                    alert.style.display = 'none';
                }, 5000);
            });
        </script>
    </body>
</html>
