@extends('layouts.app')

@section('title', 'Detalhes da Candidatura')
@section('page-title', 'Detalhes da Candidatura')

@section('content')
<div class="page-header" style="display:flex; justify-content: space-between; align-items: center; margin-bottom: 1.5rem;">
    <h2 class="page-title">{{ $application->company }} - {{ $application->position }}</h2>
    <a href="{{ route('applications.index') }}" class="btn-primary" style="padding: 0.5rem 1rem; border-radius: 6px;">← Voltar</a>
</div>

<div style="background:#fff; padding:1.5rem; border-radius:8px; box-shadow:0 2px 6px rgba(0,0,0,0.05);">
    <p><strong>Empresa:</strong> {{ $application->company }}</p>
    <p><strong>Cargo:</strong> {{ $application->position }}</p>
    <p><strong>Localização:</strong> {{ $application->location ?? 'N/A' }}</p>
    <p><strong>Tipo:</strong> {{ $application->type ?? 'N/A' }}</p>
    <p><strong>Salário:</strong> {{ $application->salary ? 'R$ '.number_format($application->salary, 2, ',', '.') : 'N/A' }}</p>
    <p><strong>Status:</strong>
        <span style="background: {{ $application->status->color ?? '#e0e0e0' }}20; color: {{ $application->status->color ?? '#666' }}; padding: 0.25rem 0.75rem; border-radius: 20px; font-size: 0.875rem;">
            {{ $application->status->name ?? 'Sem Status' }}
        </span>
    </p>
    <p><strong>Data da Candidatura:</strong> {{ $application->applied_at->format('d/m/Y') }}</p>
    <p><strong>Notas:</strong> {{ $application->notes ?? 'Nenhuma' }}</p>
    @if($application->job_url)
        <p><strong>Link da Vaga:</strong> <a href="{{ $application->job_url }}" target="_blank" style="color:#0284ff;">{{ $application->job_url }}</a></p>
    @endif
    @if($application->cv_path)
        <p><strong>CV:</strong> <a href="{{ asset('storage/'.$application->cv_path) }}" target="_blank" style="color:#8b5cf6;">Abrir CV</a></p>
    @endif

    <div style="margin-top:1.5rem; display:flex; gap:0.5rem;">
        <a href="{{ route('applications.edit', $application) }}" class="btn-primary" style="padding:0.5rem 1rem; border-radius:6px;">Editar</a>

        <form method="POST" action="{{ route('applications.destroy', $application) }}" onsubmit="return confirm('Tem certeza que deseja deletar esta candidatura?');">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn-danger" style="padding:0.5rem 1rem; border-radius:6px; background:#ef4444; color:#fff; border:none;">Deletar</button>
        </form>
    </div>
</div>
@endsection
