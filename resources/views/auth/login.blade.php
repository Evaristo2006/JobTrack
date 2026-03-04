<x-guest-layout>
    <div class="auth-card">
        <h2>Bem-vindo de Volta</h2>
        <p>Acesse sua conta para gerenciar suas candidaturas</p>

        <!-- Session Status -->
        @if (session('status'))
            <div class="success-message">
                {{ session('status') }}
            </div>
        @endif

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <!-- Email Address -->
            <div class="form-group">
                <label for="email" class="form-label">Email</label>
                <input
                    id="email"
                    type="email"
                    name="email"
                    class="form-input @error('email') error-input @enderror"
                    value="{{ old('email') }}"
                    required
                    autofocus
                    autocomplete="username"
                    placeholder="seu@email.com"
                />
                @error('email')
                    <div class="error-message">
                        <span>✕</span>
                        <span>{{ $message }}</span>
                    </div>
                @enderror
            </div>

            <!-- Password -->
            <div class="form-group">
                <label for="password" class="form-label">Senha</label>
                <input
                    id="password"
                    type="password"
                    name="password"
                    class="form-input @error('password') error-input @enderror"
                    required
                    autocomplete="current-password"
                    placeholder="••••••••"
                />
                @error('password')
                    <div class="error-message">
                        <span>✕</span>
                        <span>{{ $message }}</span>
                    </div>
                @enderror
            </div>

            <!-- Remember Me -->
            <div class="checkbox-wrapper">
                <input
                    id="remember_me"
                    type="checkbox"
                    name="remember"
                />
                <label for="remember_me">Lembrar-me neste navegador</label>
            </div>

            <!-- Ações -->
            <div style="display: flex; gap: 15px; align-items: center; justify-content: space-between; margin-top: 25px;">
                @if (Route::has('password.request'))
                    <a href="{{ route('password.request') }}" class="auth-link">Esqueceu a senha?</a>
                @endif

                <button type="submit" class="btn-primary" style="width: auto; padding: 12px 40px;">
                    Entrar
                </button>
            </div>
        </form>

        <div class="auth-footer">
            Não tem conta? <a href="{{ route('register') }}">Criar Conta</a>
        </div>
    </div>
</x-guest-layout>
