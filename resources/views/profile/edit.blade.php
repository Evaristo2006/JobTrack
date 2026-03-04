@extends('layouts.app')

@section('title', 'Meu Perfil')
@section('page-title', 'Meu Perfil')

@section('content')
<div class="page-header">
    <h2 class="page-title">Configurações da Conta</h2>
</div>

<div style="display: grid; grid-template-columns: 1fr 1fr; gap: 2rem; margin-bottom: 2rem;">
    <!-- Update Profile Form -->
    <div class="card">
        <h3 class="card-title">Informações Pessoais</h3>

        <form method="post" action="{{ route('profile.update') }}">
            @csrf
            @method('patch')

            <div class="form-group">
                <label class="form-label" for="name">Nome Completo</label>
                <input
                    type="text"
                    id="name"
                    name="name"
                    class="form-input"
                    value="{{ old('name', $user->name) }}"
                    required
                    autofocus
                    autocomplete="name"
                >
                @error('name')
                    <span style="color: #ef4444; font-size: 0.875rem;">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label class="form-label" for="email">Email</label>
                <input
                    type="email"
                    id="email"
                    name="email"
                    class="form-input"
                    value="{{ old('email', $user->email) }}"
                    required
                    autocomplete="username"
                >
                @error('email')
                    <span style="color: #ef4444; font-size: 0.875rem;">{{ $message }}</span>
                @enderror
            </div>

            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                <div style="background: rgba(59, 130, 246, 0.1); border: 1px solid #3b82f6; border-radius: 8px; padding: 1rem; margin-bottom: 1rem;">
                    <p style="color: #1e40af; font-weight: 600; margin-bottom: 0.5rem;">Seu email não foi verificado.</p>
                    <form method="post" action="{{ route('verification.send') }}" style="display: inline;">
                        @csrf
                        <button type="submit" class="btn-primary" style="padding: 0.5rem 1rem; font-size: 0.875rem;">Reenviar Email de Verificação</button>
                    </form>

                    @if (session('status') === 'verification-link-sent')
                        <p style="color: #22c55e; margin-top: 0.5rem;">Um novo link de verificação foi enviado para seu email.</p>
                    @endif
                </div>
            @endif

            <div style="display: flex; gap: 1rem; margin-top: 2rem;">
                <button type="submit" class="btn-primary">Salvar Alterações</button>

                @if (session('status') === 'profile-updated')
                    <span style="color: #22c55e; font-weight: 600;">✓ Perfil atualizado com sucesso!</span>
                @endif
            </div>
        </form>
    </div>

    <!-- Change Password Form -->
    <div class="card">
        <h3 class="card-title">Alterar Senha</h3>

        <form method="post" action="{{ route('profile.update') }}">
            @csrf
            @method('patch')

            <div class="form-group">
                <label class="form-label" for="current_password">Senha Atual</label>
                <input
                    type="password"
                    id="current_password"
                    name="current_password"
                    class="form-input"
                    autocomplete="current-password"
                >
                @error('current_password')
                    <span style="color: #ef4444; font-size: 0.875rem;">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label class="form-label" for="password">Nova Senha</label>
                <input
                    type="password"
                    id="password"
                    name="password"
                    class="form-input"
                    autocomplete="new-password"
                >
                @error('password')
                    <span style="color: #ef4444; font-size: 0.875rem;">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label class="form-label" for="password_confirmation">Confirmar Nova Senha</label>
                <input
                    type="password"
                    id="password_confirmation"
                    name="password_confirmation"
                    class="form-input"
                    autocomplete="new-password"
                >
                @error('password_confirmation')
                    <span style="color: #ef4444; font-size: 0.875rem;">{{ $message }}</span>
                @enderror
            </div>

            <div style="display: flex; gap: 1rem; margin-top: 2rem;">
                <button type="submit" class="btn-primary">Alterar Senha</button>
            </div>
        </form>
    </div>
</div>

<!-- Delete Account -->
<div class="card" style="border: 1px solid #ef4444;">
    <h3 class="card-title" style="color: #ef4444;">Zona de Perigo</h3>

    <div style="background: rgba(239, 68, 68, 0.1); border: 1px solid #ef4444; border-radius: 8px; padding: 1rem; margin-bottom: 1rem;">
        <h4 style="font-weight: 600; color: #b91c1c; margin-bottom: 0.5rem;">Deletar Conta</h4>
        <p style="color: #666; margin-bottom: 1rem;">Uma vez que você deletar sua conta, não há volta. Por favor, tenha certeza.</p>

        <button onclick="document.getElementById('delete-modal').style.display='block'" class="btn-danger">
            Deletar Conta
        </button>
    </div>
</div>

<!-- Delete Modal -->
<div id="delete-modal" style="display: none; position: fixed; top: 0; left: 0; right: 0; bottom: 0; background: rgba(0, 0, 0, 0.5); z-index: 1000; display: flex; align-items: center; justify-content: center;">
    <div class="card" style="max-width: 500px; width: 90%;">
        <h3 class="card-title">Deletar Conta</h3>
        <p style="color: #666; margin-bottom: 1rem;">Tem certeza que deseja deletar sua conta? Esta ação não pode ser desfeita.</p>

        <form method="post" action="{{ route('profile.destroy') }}">
            @csrf
            @method('delete')

            <div class="form-group">
                <label class="form-label" for="delete-password">Digite sua senha para confirmar:</label>
                <input
                    type="password"
                    id="delete-password"
                    name="password"
                    class="form-input"
                    placeholder="Sua senha"
                    required
                >
                @error('password', 'userDeletion')
                    <span style="color: #ef4444; font-size: 0.875rem;">{{ $message }}</span>
                @enderror
            </div>

            <div style="display: flex; gap: 1rem;">
                <button type="submit" class="btn-danger">Deletar Permanentemente</button>
                <button type="button" onclick="document.getElementById('delete-modal').style.display='none'" class="btn-secondary">Cancelar</button>
            </div>
        </form>
    </div>
</div>

<script>
    document.getElementById('delete-modal').addEventListener('click', (e) => {
        if (e.target === document.getElementById('delete-modal')) {
            document.getElementById('delete-modal').style.display = 'none';
        }
    });
</script>
@endsection
