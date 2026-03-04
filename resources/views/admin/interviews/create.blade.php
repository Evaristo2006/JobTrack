@extends('layouts.app')

@section('title', 'Nova Entrevista')
@section('page-title', 'Nova Entrevista')

@section('content')
<div class="page-header">
    <h2 class="page-title">Registrar Nova Entrevista</h2>
</div>

<div class="card" style="max-width: 800px;">
    <form method="POST" action="{{ route('interviews.store') }}">
        @csrf

        <div class="form-group">
            <label class="form-label" for="application_id">Candidatura</label>
            <select id="application_id" name="application_id" class="form-select" required>
                <option value="">Selecione uma candidatura</option>
                @foreach($applications as $app)
                    <option value="{{ $app->id }}" @selected(old('application_id') == $app->id)>{{ $app->company }} - {{ $app->position }}</option>
                @endforeach
            </select>
            @error('application_id') <span style="color: #ef4444; font-size: 0.875rem;">{{ $message }}</span> @enderror
        </div>

        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 2rem;">
            <div class="form-group">
                <label class="form-label" for="interview_date">Data e Hora</label>
                <input type="datetime-local" id="interview_date" name="interview_date" class="form-input" value="{{ old('interview_date') }}" required>
                @error('interview_date') <span style="color: #ef4444; font-size: 0.875rem;">{{ $message }}</span> @enderror
            </div>

            <div class="form-group">
                <label class="form-label" for="type">Tipo de Entrevista</label>
                <select id="type" name="type" class="form-select">
                    <option value="">Selecione</option>
                    <option value="Telefônica" @selected(old('type') == 'Telefônica')>Telefônica</option>
                    <option value="Presencial" @selected(old('type') == 'Presencial')>Presencial</option>
                    <option value="Vídeo" @selected(old('type') == 'Vídeo')>Vídeo</option>
                </select>
                @error('type') <span style="color: #ef4444; font-size: 0.875rem;">{{ $message }}</span> @enderror
            </div>
        </div>

        <div class="form-group">
            <label class="form-label" for="feedback">Feedback</label>
            <textarea id="feedback" name="feedback" class="form-textarea">{{ old('feedback') }}</textarea>
            @error('feedback') <span style="color: #ef4444; font-size: 0.875rem;">{{ $message }}</span> @enderror
        </div>

        <div class="form-group">
            <label style="display: flex; align-items: center; gap: 0.5rem;">
                <input type="checkbox" name="passed" value="1" @checked(old('passed'))>
                <span class="form-label" style="margin: 0;">Aprovado?</span>
            </label>
            @error('passed') <span style="color: #ef4444; font-size: 0.875rem;">{{ $message }}</span> @enderror
        </div>

        <div style="display: flex; gap: 1rem; margin-top: 2rem;">
            <button type="submit" class="btn-primary">Salvar Entrevista</button>
            <a href="{{ route('interviews.index') }}" class="btn-secondary">Cancelar</a>
        </div>
    </form>
</div>
@endsection
