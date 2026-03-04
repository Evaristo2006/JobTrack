@extends('layouts.app')

@section('title', 'Editar Status')
@section('page-title', 'Editar Status')

@section('content')
<div class="page-header">
    <h2 class="page-title">Editar Status: {{ $status->name }}</h2>
</div>

<div class="card" style="max-width: 600px;">
    <form method="POST" action="{{ route('statuses.update', $status) }}">
        @csrf
        @method('PATCH')

        <div class="form-group">
            <label class="form-label" for="name">Nome do Status</label>
            <input
                type="text"
                id="name"
                name="name"
                class="form-input"
                value="{{ old('name', $status->name) }}"
                placeholder="Ex: Em Análise, Aprovado, Rejeitado"
                required
            >
            @error('name')
                <span style="color: #ef4444; font-size: 0.875rem;">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-group">
            <label class="form-label" for="color">Cor (Hexadecimal)</label>
            <div style="display: flex; gap: 1rem; align-items: flex-start;">
                <input
                    type="color"
                    id="color"
                    name="color"
                    class="form-input"
                    value="{{ old('color', $status->color ?? '#0284ff') }}"
                    style="width: 80px; height: 50px; cursor: pointer;"
                >
                <div>
                    <input
                        type="text"
                        id="color-hex"
                        class="form-input"
                        value="{{ old('color', $status->color ?? '#0284ff') }}"
                        placeholder="#0284ff"
                        readonly
                        style="width: 150px;"
                    >
                    <p style="color: #666; font-size: 0.875rem; margin-top: 0.5rem;">Selecione a cor ou digite o código hexadecimal</p>
                </div>
            </div>
            @error('color')
                <span style="color: #ef4444; font-size: 0.875rem;">{{ $message }}</span>
            @enderror
        </div>

        <div style="display: flex; gap: 1rem; margin-top: 2rem;">
            <button type="submit" class="btn-primary">Atualizar Status</button>
            <a href="{{ route('statuses.index') }}" class="btn-secondary">Cancelar</a>
        </div>
    </form>
</div>

<script>
    const colorInput = document.getElementById('color');
    const colorHex = document.getElementById('color-hex');

    colorInput.addEventListener('change', (e) => {
        colorHex.value = e.target.value;
    });

    colorInput.addEventListener('input', (e) => {
        colorHex.value = e.target.value;
    });
</script>
@endsection
