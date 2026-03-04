@extends('layouts.app')

@section('title', 'Entrevistas')
@section('page-title', 'Entrevistas')

@section('content')
<div class="page-header">
    <h2 class="page-title">Minhas Entrevistas</h2>
    <a href="{{ route('interviews.create') }}" class="btn-primary">+ Nova Entrevista</a>
</div>

<div class="table-container">
    <table>
        <thead>
            <tr>
                <th>Empresa</th>
                <th>Cargo</th>
                <th>Data</th>
                <th>Tipo</th>
                <th>Resultado</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            @forelse($interviews as $interview)
                <tr>
                    <td><strong>{{ $interview->application->company }}</strong></td>
                    <td>{{ $interview->application->position }}</td>
                    <td>{{ $interview->interview_date->format('d/m/Y H:i') }}</td>
                    <td>{{ $interview->type ?? 'N/A' }}</td>
                    <td>
                        @if($interview->passed === null)
                            <span style="color: #666;">Pendente</span>
                        @elseif($interview->passed)
                            <span style="color: #22c55e; font-weight: 600;">✓ Aprovado</span>
                        @else
                            <span style="color: #ef4444; font-weight: 600;">✗ Rejeitado</span>
                        @endif
                    </td>
                    <td>
                        <div style="display: flex; gap: 0.5rem;">
                            <a href="{{ route('interviews.edit', $interview) }}" style="color: #0284ff; text-decoration: none; font-weight: 600;">Editar</a>
                            <form method="POST" action="{{ route('interviews.destroy', $interview) }}" style="display: inline;" onsubmit="return confirm('Tem certeza?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" style="color: #ef4444; background: none; border: none; cursor: pointer; font-weight: 600;">Deletar</button>
                            </form>
                        </div>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" style="text-align: center; padding: 2rem;">Nenhuma entrevista encontrada</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>

@if($interviews->hasPages())
    <div style="margin-top: 2rem; display: flex; justify-content: center;">
        {{ $interviews->links() }}
    </div>
@endif
@endsection
