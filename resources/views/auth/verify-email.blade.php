<x-guest-layout>
    <div class="auth-card">
        <h2>Verificar Email</h2>
        <p>Sua conta foi criada com sucesso!</p>

        <div class="info-message">
            Obrigado por se cadastrar! Antes de começar, você precisa verificar seu endereço de email clicando no link que enviamos para você. Se não receber o email, ficaremos felizes em enviar outro.
        </div>

        @if (session('status') == 'verification-link-sent')
            <div class="success-message">
                Um novo link de verificação foi enviado para o email informado durante o cadastro.
            </div>
        @endif

        <div style="display: flex; gap: 15px; flex-direction: column;">
            <form method="POST" action="{{ route('verification.send') }}">
                @csrf
                <button type="submit" class="btn-primary">
                    Reenviar Email de Verificação
                </button>
            </form>

            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="btn-primary" style="background: transparent; border: 1px solid #0284fe; color: #0284fe;">
                    Sair
                </button>
            </form>
        </div>
    </div>
</x-guest-layout>
