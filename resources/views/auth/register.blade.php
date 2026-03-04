<x-guest-layout>
    <div class="auth-card">
        <h2>Criar Conta</h2>
        <p>Comece a gerenciar suas candidaturas agora</p>

        <form method="POST" action="{{ route('register') }}">
            @csrf

            <!-- Name -->
            <div class="form-group">
                <label for="name" class="form-label">Nome Completo</label>
                <input
                    id="name"
                    type="text"
                    name="name"
                    class="form-input @error('name') error-input @enderror"
                    value="{{ old('name') }}"
                    required
                    autofocus
                    autocomplete="name"
                    placeholder="Seu nome"
                />
                @error('name')
                    <div class="error-message">
                        <span>✕</span>
                        <span>{{ $message }}</span>
                    </div>
                @enderror
            </div>

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
                    autocomplete="new-password"
                    placeholder="••••••••"
                />
                @error('password')
                    <div class="error-message">
                        <span>✕</span>
                        <span>{{ $message }}</span>
                    </div>
                @enderror
            </div>

            <!-- Confirm Password -->
            <div class="form-group">
                <label for="password_confirmation" class="form-label">Confirmar Senha</label>
                <input
                    id="password_confirmation"
                    type="password"
                    name="password_confirmation"
                    class="form-input @error('password_confirmation') error-input @enderror"
                    required
                    autocomplete="new-password"
                    placeholder="••••••••"
                />
                @error('password_confirmation')
                    <div class="error-message">
                        <span>✕</span>
                        <span>{{ $message }}</span>
                    </div>
                @enderror
            </div>

            <!-- Botão -->
            <button type="submit" class="btn-primary" style="margin-top: 20px;">
                Criar Conta
            </button>
        </form>

        <div class="auth-footer">
            Já tem conta? <a href="{{ route('login') }}">Fazer Login</a>
        </div>
    </div>
</x-guest-layout>
