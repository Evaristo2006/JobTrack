@extends('layouts.app')

@section('title', 'Nova Meta')
@section('page-title', 'Nova Meta')

@section('content')
<div class="page-header">
    <h2 class="page-title">Registrar Nova Meta</h2>
</div>

<div class="card" style="max-width: 600px;">
    <form method="POST" action="{{ route('goals.store') }}">
        @csrf

        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 2rem;">
            <div class="form-group">
                <label class="form-label" for="month">Mês</label>
                <select id="month" name="month" class="form-select" required>
                    <option value="">Selecione</option>
                    @for($i = 1; $i <= 12; $i++)
                        <option value="{{ $i }}" @selected(old('month') == $i)>{{ ['Janeiro', 'Fevereiro', 'Março', 'Abril', 'Maio', 'Junho', 'Julho', 'Agosto', 'Setembro', 'Outubro', 'Novembro', 'Dezembro'][$i-1] }}</option>
                    @endfor
                </select>
                @error('month') <span style="color: #ef4444; font-size: 0.875rem;">{{ $message }}</span> @enderror
            </div>

            <div class="form-group">
                <label class="form-label" for="year">Ano</label>
                <input type="number" id="year" name="year" class="form-input" value="{{ old('year', now()->year) }}" required>
                @error('year') <span style="color: #ef4444; font-size: 0.875rem;">{{ $message }}</span> @enderror
            </div>
        </div>

        <div class="form-group">
            <label class="form-label" for="target">Meta de Candidaturas</label>
            <input type="number" id="target" name="target" class="form-input" value="{{ old('target') }}" min="1" required>
            @error('target') <span style="color: #ef4444; font-size: 0.875rem;">{{ $message }}</span> @enderror
        </div>

        <div style="display: flex; gap: 1rem; margin-top: 2rem;">
            <button type="submit" class="btn-primary">Salvar Meta</button>
            <a href="{{ route('goals.index') }}" class="btn-secondary">Cancelar</a>
        </div>
    </form>
</div>
@endsection
