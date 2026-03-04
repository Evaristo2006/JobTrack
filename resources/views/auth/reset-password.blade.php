<x-guest-layout>
    <div class="auth-card">
        <h2>Redefinir Senha</h2>
        <p>Digite sua nova senha para redefinir sua conta</p>

        <form method="POST" action="{{ route('password.store') }}">
            @csrf

            <!-- Password Reset Token -->
            <input type="hidden" name="token" value="{{ $request->route('token') }}">

            <!-- Email Address -->
            <div class="form-group">
                <label for="email" class="form-label">Email</label>
                <input
                    id="email"
                    type="email"
                    name="email"
                    class="form-input @error('email') error-input @enderror"
                    value="{{ old('email', $request->email) }}"
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
                <label for="password" class="form-label">Nova Senha</label>
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

            <button type="submit" class="btn-primary" style="margin-top: 20px;">
                Redefinir Senha
            </button>
        </form>

        <div class="auth-footer">
            Voltar ao <a href="{{ route('login') }}">Login</a>
        </div>
    </div>
</x-guest-layout>
