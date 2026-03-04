<x-guest-layout>
    <div class="auth-card">
        <h2>Recuperar Senha</h2>
        <p>Digite seu email para receber instruções de recuperação</p>

        @if (session('status'))
            <div class="success-message">
                {{ session('status') }}
            </div>
        @endif

        <form method="POST" action="{{ route('password.email') }}">
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

            <button type="submit" class="btn-primary" style="margin-top: 20px;">
                Enviar Link de Recuperação
            </button>
        </form>

        <div class="auth-footer">
            Lembrou a senha? <a href="{{ route('login') }}">Fazer Login</a>
        </div>
    </div>
</x-guest-layout>
