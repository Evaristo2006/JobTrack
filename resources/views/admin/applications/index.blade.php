@extends('layouts.app')

@section('title', 'Candidaturas')
@section('page-title', 'Candidaturas')

@section('content')
<div class="page-header">
    <h2 class="page-title">Minhas Candidaturas</h2>
    <a href="{{ route('applications.create') }}" class="btn-primary">+ Nova Candidatura</a>
</div>

<div class="table-container">
    <table>
        <thead>
            <tr>
                <th>Empresa</th>
                <th>Cargo</th>
                <th>Localização</th>
                <th>Status</th>
                <th>Data</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            @forelse($applications as $app)
                <tr>
                    <td><strong>{{ $app->company }}</strong></td>
                    <td>{{ $app->position }}</td>
                    <td>{{ $app->location ?? 'N/A' }}</td>
                    <td>
                        <span style="background: {{ $app->status->color ?? '#e0e0e0' }}20; color: {{ $app->status->color ?? '#666' }}; padding: 0.25rem 0.75rem; border-radius: 20px; font-size: 0.875rem;">
                            {{ $app->status->name ?? 'Sem Status' }}
                        </span>
                    </td>
                    <td>{{ $app->applied_at->format('d/m/Y') }}</td>
                    <td>
                        <div style="display: flex; gap: 0.5rem;">
                            <a href="{{ route('applications.edit', $app) }}" style="color: #0284ff; text-decoration: none; font-weight: 600;">Editar</a>
                            <form method="POST" action="{{ route('applications.destroy', $app) }}" style="display: inline;" onsubmit="return confirm('Tem certeza?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" style="color: #ef4444; background: none; border: none; cursor: pointer; font-weight: 600;">Deletar</button>
                            </form>
                        </div>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" style="text-align: center; padding: 2rem;">Nenhuma candidatura encontrada</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>

@if($applications->hasPages())
    <div style="margin-top: 2rem; display: flex; justify-content: center;">
        {{ $applications->links() }}
    </div>
@endif
@endsection
