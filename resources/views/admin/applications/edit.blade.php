@extends('layouts.app')

@section('title', 'Editar Candidatura')
@section('page-title', 'Editar Candidatura')

@section('content')
<div class="page-header">
    <h2 class="page-title">Editar Candidatura - {{ $application->company }}</h2>
</div>

<div class="card" style="max-width: 800px;">
    <form method="POST" action="{{ route('applications.update', $application) }}">
        @csrf
        @method('PATCH')

        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 2rem;">
            <div class="form-group">
                <label class="form-label" for="company">Empresa</label>
                <input type="text" id="company" name="company" class="form-input" value="{{ old('company', $application->company) }}" required>
                @error('company') <span style="color: #ef4444; font-size: 0.875rem;">{{ $message }}</span> @enderror
            </div>

            <div class="form-group">
                <label class="form-label" for="position">Cargo</label>
                <input type="text" id="position" name="position" class="form-input" value="{{ old('position', $application->position) }}" required>
                @error('position') <span style="color: #ef4444; font-size: 0.875rem;">{{ $message }}</span> @enderror
            </div>

            <div class="form-group">
                <label class="form-label" for="location">Localização</label>
                <input type="text" id="location" name="location" class="form-input" value="{{ old('location', $application->location) }}">
                @error('location') <span style="color: #ef4444; font-size: 0.875rem;">{{ $message }}</span> @enderror
            </div>

            <div class="form-group">
                <label class="form-label" for="type">Tipo</label>
                <select id="type" name="type" class="form-select">
                    <option value="">Selecione</option>
                    <option value="Full-time" @selected(old('type', $application->type) == 'Full-time')>Full-time</option>
                    <option value="Part-time" @selected(old('type', $application->type) == 'Part-time')>Part-time</option>
                    <option value="Freelancer" @selected(old('type', $application->type) == 'Freelancer')>Freelancer</option>
                    <option value="Estágio" @selected(old('type', $application->type) == 'Estágio')>Estágio</option>
                </select>
                @error('type') <span style="color: #ef4444; font-size: 0.875rem;">{{ $message }}</span> @enderror
            </div>

            <div class="form-group">
                <label class="form-label" for="salary">Salário</label>
                <input type="number" id="salary" name="salary" class="form-input" value="{{ old('salary', $application->salary) }}" step="0.01">
                @error('salary') <span style="color: #ef4444; font-size: 0.875rem;">{{ $message }}</span> @enderror
            </div>

            <div class="form-group">
                <label class="form-label" for="applied_at">Data da Candidatura</label>
                <input type="date" id="applied_at" name="applied_at" class="form-input" value="{{ old('applied_at', $application->applied_at->format('Y-m-d')) }}" required>
                @error('applied_at') <span style="color: #ef4444; font-size: 0.875rem;">{{ $message }}</span> @enderror
            </div>

            <div class="form-group">
                <label class="form-label" for="status_id">Status</label>
                <select id="status_id" name="status_id" class="form-select" required>
                    <option value="">Selecione um status</option>
                    @foreach($statuses as $status)
                        <option value="{{ $status->id }}" @selected(old('status_id', $application->status_id) == $status->id)>{{ $status->name }}</option>
                    @endforeach
                </select>
                @error('status_id') <span style="color: #ef4444; font-size: 0.875rem;">{{ $message }}</span> @enderror
            </div>
        </div>

        <div class="form-group" style="grid-column: 1 / -1;">
            <label class="form-label" for="job_url">URL da Vaga</label>
            <input type="url" id="job_url" name="job_url" class="form-input" value="{{ old('job_url', $application->job_url) }}">
            @error('job_url') <span style="color: #ef4444; font-size: 0.875rem;">{{ $message }}</span> @enderror
        </div>

        <div class="form-group" style="grid-column: 1 / -1;">
            <label class="form-label" for="notes">Notas</label>
            <textarea id="notes" name="notes" class="form-textarea">{{ old('notes', $application->notes) }}</textarea>
            @error('notes') <span style="color: #ef4444; font-size: 0.875rem;">{{ $message }}</span> @enderror
        </div>

        <div style="display: flex; gap: 1rem; margin-top: 2rem;">
            <button type="submit" class="btn-primary">Atualizar Candidatura</button>
            <a href="{{ route('applications.index') }}" class="btn-secondary">Cancelar</a>
        </div>
    </form>
</div>
@endsection
