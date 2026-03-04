@extends('layouts.app')

@section('title', 'Dashboard')
@section('page-title', 'Dashboard')

@section('content')
<div class="page-header">
    <h2 class="page-title">Bem-vindo, {{ Auth::user()->name }}! 👋</h2>
</div>

{{-- 🟦 Cards de estatísticas --}}
<div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 1.5rem; margin-bottom: 2rem;">
    <div class="card" style="padding:1.5rem; border-radius:10px; box-shadow:0 4px 12px rgba(0,0,0,0.05);">
        <div style="display:flex; align-items:center; gap:1rem;">
            <div style="font-size:2rem; color:#0284ff;"><i class="fas fa-briefcase"></i></div>
            <div>
                <div style="font-size:0.875rem; color:#666;">Total de Candidaturas</div>
                <div style="font-size:2rem; font-weight:700; color:#0284ff;">{{ $totalApplications ?? 0 }}</div>
            </div>
        </div>
    </div>

    <div class="card" style="padding:1.5rem; border-radius:10px; box-shadow:0 4px 12px rgba(0,0,0,0.05);">
        <div style="display:flex; align-items:center; gap:1rem;">
            <div style="font-size:2rem; color:#facc15;"><i class="fas fa-hourglass-half"></i></div>
            <div>
                <div style="font-size:0.875rem; color:#666;">Em Análise</div>
                <div style="font-size:2rem; font-weight:700; color:#facc15;">{{ $analyzing ?? 0 }}</div>
            </div>
        </div>
    </div>

    <div class="card" style="padding:1.5rem; border-radius:10px; box-shadow:0 4px 12px rgba(0,0,0,0.05);">
        <div style="display:flex; align-items:center; gap:1rem;">
            <div style="font-size:2rem; color:#10b981;"><i class="fas fa-microphone"></i></div>
            <div>
                <div style="font-size:0.875rem; color:#666;">Entrevistas</div>
                <div style="font-size:2rem; font-weight:700; color:#10b981;">{{ $interviews ?? 0 }}</div>
            </div>
        </div>
    </div>

    <div class="card" style="padding:1.5rem; border-radius:10px; box-shadow:0 4px 12px rgba(0,0,0,0.05);">
        <div style="display:flex; align-items:center; gap:1rem;">
            <div style="font-size:2rem; color:#8b5cf6;"><i class="fas fa-check-circle"></i></div>
            <div>
                <div style="font-size:0.875rem; color:#666;">Aceitas</div>
                <div style="font-size:2rem; font-weight:700; color:#8b5cf6;">{{ $accepted ?? 0 }}</div>
            </div>
        </div>
    </div>
</div>

{{-- 🟦 Ações rápidas --}}
<div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 1.5rem;">
    <div class="card action-card" style="text-align:center; padding:2rem; border-radius:10px; box-shadow:0 4px 12px rgba(0,0,0,0.05); transition:all 0.3s ease;">
        <a href="{{ route('applications.create') }}" style="text-decoration:none; color:inherit;">
            <div style="font-size:3rem; color:#0284ff; margin-bottom:0.5rem;"><i class="fas fa-plus-circle"></i></div>
            <h3 style="font-weight:600; margin-bottom:0.25rem;">Nova Candidatura</h3>
            <p style="color:#666; font-size:0.875rem;">Registre uma nova candidatura</p>
        </a>
    </div>

    <div class="card action-card" style="text-align:center; padding:2rem; border-radius:10px; box-shadow:0 4px 12px rgba(0,0,0,0.05); transition:all 0.3s ease;">
        <a href="{{ route('applications.index') }}" style="text-decoration:none; color:inherit;">
            <div style="font-size:3rem; color:#0284ff; margin-bottom:0.5rem;"><i class="fas fa-clipboard-list"></i></div>
            <h3 style="font-weight:600; margin-bottom:0.25rem;">Minhas Candidaturas</h3>
            <p style="color:#666; font-size:0.875rem;">Veja e gerencie suas candidaturas</p>
        </a>
    </div>

    <div class="card action-card" style="text-align:center; padding:2rem; border-radius:10px; box-shadow:0 4px 12px rgba(0,0,0,0.05); transition:all 0.3s ease;">
        <a href="{{ route('interviews.index') }}" style="text-decoration:none; color:inherit;">
            <div style="font-size:3rem; color:#10b981; margin-bottom:0.5rem;"><i class="fas fa-microphone-alt"></i></div>
            <h3 style="font-weight:600; margin-bottom:0.25rem;">Entrevistas</h3>
            <p style="color:#666; font-size:0.875rem;">Gerencie suas entrevistas</p>
        </a>
    </div>

    <div class="card action-card" style="text-align:center; padding:2rem; border-radius:10px; box-shadow:0 4px 12px rgba(0,0,0,0.05); transition:all 0.3s ease;">
        <a href="{{ route('goals.index') }}" style="text-decoration:none; color:inherit;">
            <div style="font-size:3rem; color:#8b5cf6; margin-bottom:0.5rem;"><i class="fas fa-bullseye"></i></div>
            <h3 style="font-weight:600; margin-bottom:0.25rem;">Metas</h3>
            <p style="color:#666; font-size:0.875rem;">Defina e acompanhe suas metas</p>
        </a>
    </div>
</div>

{{-- 🔹 Gráficos --}}
<div style="display: grid; grid-template-columns: 1fr; gap: 2rem; margin-top: 2rem;">
    {{-- Metas últimos 6 meses --}}
    <div class="card" style="padding:1.5rem; border-radius:10px; box-shadow:0 4px 12px rgba(0,0,0,0.05);">
        <h3 style="margin-bottom:1rem;">Progresso das Metas (últimos 6 meses)</h3>
        <canvas id="goalsChart" height="120"></canvas>
    </div>

    {{-- Candidaturas diárias --}}
    <div class="card" style="padding:1.5rem; border-radius:10px; box-shadow:0 4px 12px rgba(0,0,0,0.05);">
        <h3 style="margin-bottom:1rem;">Candidaturas Diárias (últimos 30 dias)</h3>
        <canvas id="dailyChart" height="120"></canvas>
    </div>
</div>

{{-- 🔹 Pequeno hover para os action cards --}}
<style>
    .action-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 20px rgba(0,0,0,0.1);
    }
</style>

{{-- 🔹 Font Awesome --}}
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" rel="stylesheet">

{{-- 🔹 Chart.js --}}
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    // 🔹 Gráfico de Metas
    const goalsCtx = document.getElementById('goalsChart').getContext('2d');
    new Chart(goalsCtx, {
        type: 'bar',
        data: {
            labels: @json($chartLabels),
            datasets: [
                {
                    label: 'Meta',
                    data: @json($chartTargets),
                    backgroundColor: '#8b5cf6'
                },
                {
                    label: 'Concluído',
                    data: @json($chartProgress),
                    backgroundColor: '#10b981'
                }
            ]
        },
        options: {
            responsive: true,
            plugins: {
                legend: { position: 'top' },
                title: { display: true, text: 'Progresso das Metas' }
            },
            scales: {
                y: { beginAtZero: true }
            }
        }
    });

    // 🔹 Gráfico diário de candidaturas
    const dailyCtx = document.getElementById('dailyChart').getContext('2d');
    new Chart(dailyCtx, {
        type: 'line',
        data: {
            labels: @json($dailyLabels),
            datasets: [{
                label: 'Candidaturas por dia',
                data: @json($dailyApplications),
                fill: true,
                borderColor: '#0284ff',
                backgroundColor: 'rgba(2, 132, 255, 0.2)',
                tension: 0.3
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: { display: true, position: 'top' },
                title: { display: true, text: 'Candidaturas Diárias' }
            },
            scales: {
                y: { beginAtZero: true }
            }
        }
    });
</script>
@endsection
