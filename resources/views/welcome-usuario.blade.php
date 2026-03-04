

@section('content')
<div class="container mt-5">
    <div class="alert alert-success">
        <h1>Bem-vindo, {{ Auth::user()->name }}!</h1>
        <p>Você está logado com sucesso.</p>
        <a href="{{ route('logout') }}"
           onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
           class="btn btn-danger">Sair</a>

        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
            @csrf
        </form>
    </div>
</div>
@endsection
