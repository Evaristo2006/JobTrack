@extends('layouts.app')

@section('title', 'Metas')
@section('page-title', 'Metas')

@section('content')
<div class="page-header">
    <h2 class="page-title">Minhas Metas</h2>
    <a href="{{ route('goals.create') }}" class="btn-primary">+ Nova Meta</a>
</div>

<div class="table-container">
    <table>
        <thead>
            <tr>
                <th>Mês/Ano</th>
                <th>Meta</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            @forelse($goals as $goal)
                <tr>
                    <td><strong>{{ $goal->monthName }} de {{ $goal->year }}</strong></td>
                    <td>{{ $goal->target }} candidaturas</td>
                    <td>
                        <div style="display: flex; gap: 0.5rem;">
                            <a href="{{ route('goals.edit', $goal) }}" style="color: #0284ff; text-decoration: none; font-weight: 600;">Editar</a>
                            <form method="POST" action="{{ route('goals.destroy', $goal) }}" style="display: inline;" onsubmit="return confirm('Tem certeza?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" style="color: #ef4444; background: none; border: none; cursor: pointer; font-weight: 600;">Deletar</button>
                            </form>
                        </div>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="3" style="text-align: center; padding: 2rem;">Nenhuma meta encontrada</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>

@if($goals->hasPages())
    <div style="margin-top: 2rem; display: flex; justify-content: center;">
        {{ $goals->links() }}
    </div>
@endif
@endsection
