@extends('layouts.app')

@section('title', 'Status')
@section('page-title', 'Gerenciar Status')

@section('content')
<div class="page-header">
    <h2 class="page-title">Status das Candidaturas</h2>
    <a href="{{ route('statuses.create') }}" class="btn-primary">+ Novo Status</a>
</div>

<div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(300px, 1fr)); gap: 1.5rem;">
    @forelse($statuses as $status)
        <div class="card">
            <div style="display: flex; justify-content: space-between; align-items: start; margin-bottom: 1rem;">
                <div>
                    <h3 style="font-weight: 700; color: #1a1a1a; margin-bottom: 0.5rem;">{{ $status->name }}</h3>
                    <div style="display: flex; align-items: center; gap: 0.5rem;">
                        <div style="width: 20px; height: 20px; border-radius: 4px; background: {{ $status->color ?? '#e0e0e0' }};"></div>
                        <span style="color: #666; font-size: 0.875rem;">{{ $status->color ?? '#e0e0e0' }}</span>
                    </div>
                </div>
                <div style="display: flex; gap: 0.5rem;">
                    <a href="{{ route('statuses.edit', $status) }}" style="color: #0284ff; text-decoration: none; font-weight: 600; padding: 0.5rem; border-radius: 6px; transition: all 0.3s ease;" onmouseover="this.style.background='rgba(2, 132, 255, 0.1)'" onmouseout="this.style.background='transparent'">Editar</a>
                    <form method="POST" action="{{ route('statuses.destroy', $status) }}" style="display: inline;" onsubmit="return confirm('Tem certeza que deseja deletar este status?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" style="color: #ef4444; background: none; border: none; cursor: pointer; font-weight: 600; padding: 0.5rem; border-radius: 6px; transition: all 0.3s ease;" onmouseover="this.style.background='rgba(239, 68, 68, 0.1)'" onmouseout="this.style.background='transparent'">Deletar</button>
                    </form>
                </div>
            </div>

            <div style="padding-top: 1rem; border-top: 1px solid #e0e0e0;">
                <p style="color: #666; font-size: 0.875rem;">ID: <strong>{{ $status->id }}</strong></p>
            </div>
        </div>
    @empty
        <div style="grid-column: 1 / -1; text-align: center; padding: 3rem; background: white; border-radius: 12px;">
            <p style="color: #666; font-size: 1.1rem;">Nenhum status encontrado</p>
            <a href="{{ route('statuses.create') }}" class="btn-primary" style="margin-top: 1rem;">Criar Primeiro Status</a>
        </div>
    @endforelse
</div>
@endsection
