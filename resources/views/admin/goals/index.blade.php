@extends('layouts.app')

@section('title', 'Metas')
@section('page-title', 'Metas')

@section('content')
<div class="page-header" style="display:flex; justify-content: space-between; align-items: center; margin-bottom: 1.5rem;">
    <h2 class="page-title">Minhas Metas</h2>
    <div style="display:flex; gap:0.5rem;">
        
        <a href="{{ route('goals.create') }}" class="btn-primary" style="padding:0.5rem 1rem; border-radius:6px;">+ Nova Meta</a>
    </div>
</div>

<div class="table-container" style="margin-bottom:2rem;">
    <table style="width:100%; border-collapse: collapse;">
        <thead style="background:#f3f4f6;">
            <tr>
                <th style="padding:0.75rem; text-align:left;">Mês/Ano</th>
                <th style="padding:0.75rem; text-align:left;">Meta</th>
                <th style="padding:0.75rem; text-align:left;">Progresso</th>
                <th style="padding:0.75rem; text-align:left;">Ações</th>
            </tr>
        </thead>
        <tbody>
            @forelse($goals as $goal)
                <tr style="border-bottom:1px solid #e5e7eb;">
                    <td style="padding:0.75rem;"><strong>{{ \Carbon\Carbon::create()->month($goal->month)->format('F') }} de {{ $goal->year }}</strong></td>
                    <td style="padding:0.75rem;">{{ $goal->target }} candidaturas</td>
                    <td style="padding:0.75rem; width: 300px;">
                        <div style="display:flex; flex-direction:column;">
                            <div style="font-size:0.875rem; margin-bottom:0.25rem;">
                                {{ $goal->progress_count ?? 0 }} / {{ $goal->target }} ({{ $goal->progress_percent ?? 0 }}%)
                            </div>
                            <div style="background:#e5e7eb; height:10px; border-radius:5px; width:100%;">
                                <div style="background:#10b981; height:100%; border-radius:5px; width: {{ $goal->progress_percent ?? 0 }}%; transition: width 0.5s;"></div>
                            </div>
                        </div>
                    </td>
                    <td style="padding:0.75rem;">
                        <div style="display: flex; gap: 0.5rem; flex-wrap:wrap;">
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
                    <td colspan="4" style="text-align: center; padding: 2rem;">Nenhuma meta encontrada</td>
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

{{-- 🔥 Gráfico de metas (placeholder, pode usar Chart.js depois) --}}
@if(!empty($chartLabels))
    <div style="margin-top:3rem;">
        <h3 style="margin-bottom:1rem;">Últimos 6 meses</h3>
        <div id="chart-goals" style="width:100%; height:300px; background:#f9fafb; display:flex; align-items:center; justify-content:center; border-radius:8px;">
            <!-- Aqui você pode renderizar o gráfico via JS usando chartLabels, chartTargets, chartProgress -->
            <p style="color:#9ca3af;">Gráfico placeholder</p>
        </div>
    </div>
@endif
@endsection
