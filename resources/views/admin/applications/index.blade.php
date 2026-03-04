@extends('layouts.app')

@section('title', 'Candidaturas')
@section('page-title', 'Candidaturas')

@section('content')
<div class="page-header" style="display:flex; justify-content: space-between; align-items: center; margin-bottom: 1.5rem;">
    <h2 class="page-title">Minhas Candidaturas</h2>
    <a href="{{ route('applications.create') }}" class="btn-primary" style="padding: 0.5rem 1rem; border-radius: 6px;">+ Nova Candidatura</a>
</div>

{{-- 🔎 Pesquisa e filtro --}}
<form method="GET" action="{{ route('applications.index') }}" style="margin-bottom: 1.5rem; display:flex; gap:0.5rem; flex-wrap:wrap;">
    <input type="text" name="search" placeholder="Pesquisar empresa, cargo ou CV..." value="{{ request('search') }}" style="padding:0.5rem; border-radius:4px; flex:1;">

    <select name="status" style="padding:0.5rem; border-radius:4px;">
        <option value="">Todos os Status</option>
        @foreach($statuses as $status)
            <option value="{{ $status->id }}" @if(request('status') == $status->id) selected @endif>{{ $status->name }}</option>
        @endforeach
    </select>

    <input type="date" name="date_from" value="{{ request('date_from') }}" style="padding:0.5rem; border-radius:4px;">
    <input type="date" name="date_to" value="{{ request('date_to') }}" style="padding:0.5rem; border-radius:4px;">

    <button type="submit" style="background:#0284ff; color:white; padding:0.5rem 1rem; border-radius:4px; border:none; cursor:pointer;">Filtrar</button>
</form>

<div class="table-container">
    <table style="width:100%; border-collapse: collapse;">
        <thead style="background:#f3f4f6;">
            <tr>
                <th style="padding:0.75rem; text-align:left;">Empresa</th>
                <th style="padding:0.75rem; text-align:left;">Cargo</th>
                <th style="padding:0.75rem; text-align:left;">Localização</th>
                <th style="padding:0.75rem; text-align:left;">Status</th>
                <th style="padding:0.75rem; text-align:left;">Data</th>
                <th style="padding:0.75rem; text-align:left;">Ações</th>
            </tr>
        </thead>
        <tbody>
            @forelse($applications as $app)
                <tr style="border-bottom:1px solid #e5e7eb;">
                    <td style="padding:0.75rem;"><strong>{{ $app->company }}</strong></td>
                    <td style="padding:0.75rem;">{{ $app->position }}</td>
                    <td style="padding:0.75rem;">{{ $app->location ?? 'N/A' }}</td>
                    <td style="padding:0.75rem;">
                        <span style="background: {{ $app->status->color ?? '#e0e0e0' }}20; color: {{ $app->status->color ?? '#666' }}; padding: 0.25rem 0.75rem; border-radius: 20px; font-size: 0.875rem;">
                            {{ $app->status->name ?? 'Sem Status' }}
                        </span>
                    </td>
                    <td style="padding:0.75rem;">{{ $app->applied_at->format('d/m/Y') }}</td>
                    <td style="padding:0.75rem;">
                        <div style="display:flex; gap:0.5rem; flex-wrap:wrap;">
                            <a href="{{ route('applications.show', $app) }}" style="color:#10b981; text-decoration:none; font-weight:600;">Ver</a>
                            <a href="{{ route('applications.edit', $app) }}" style="color:#0284ff; text-decoration:none; font-weight:600;">Editar</a>
                            @if($app->cv_path)
                                <a href="{{ asset('storage/'.$app->cv_path) }}" target="_blank" style="color:#8b5cf6; text-decoration:none; font-weight:600;">CV</a>
                            @endif
                            <form method="POST" action="{{ route('applications.destroy', $app) }}" style="display:inline;" onsubmit="return confirm('Tem certeza?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" style="color:#ef4444; background:none; border:none; cursor:pointer; font-weight:600;">Deletar</button>
                            </form>
                        </div>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" style="text-align:center; padding:2rem;">Nenhuma candidatura encontrada</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>

@if($applications->hasPages())
    <div style="margin-top:2rem; display:flex; justify-content:center;">
        {{ $applications->links() }}
    </div>
@endif
@endsection
