@extends('layouts.app')

@section('title', 'Dashboard')
@section('page-title', 'Dashboard')

@section('content')
<div class="page-header">
    <h2 class="page-title">Bem-vindo, {{ Auth::user()->name }}! 👋</h2>
</div>

<div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 1.5rem; margin-bottom: 2rem;">
    <div class="card">
        <div style="font-size: 0.875rem; color: #666; margin-bottom: 0.5rem;">Total de Candidaturas</div>
        <div style="font-size: 2rem; font-weight: 700; color: #0284ff;">{{ $totalApplications ?? 0 }}</div>
    </div>
    <div class="card">
        <div style="font-size: 0.875rem; color: #666; margin-bottom: 0.5rem;">Em Análise</div>
        <div style="font-size: 2rem; font-weight: 700; color: #0284ff;">{{ $analyzing ?? 0 }}</div>
    </div>
    <div class="card">
        <div style="font-size: 0.875rem; color: #666; margin-bottom: 0.5rem;">Entrevistas</div>
        <div style="font-size: 2rem; font-weight: 700; color: #0284ff;">{{ $interviews ?? 0 }}</div>
    </div>
    <div class="card">
        <div style="font-size: 0.875rem; color: #666; margin-bottom: 0.5rem;">Aceitas</div>
        <div style="font-size: 2rem; font-weight: 700; color: #0284ff;">{{ $accepted ?? 0 }}</div>
    </div>
</div>

<div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 1.5rem;">
    <div class="card" style="text-align: center; cursor: pointer; transition: all 0.3s ease;" onmouseover="this.style.transform='translateY(-5px)'" onmouseout="this.style.transform='translateY(0)'">
        <a href="{{ route('applications.create') }}" style="text-decoration: none; color: inherit;">
            <div style="font-size: 2.5rem; margin-bottom: 0.5rem;">📝</div>
            <h3 style="font-weight: 600; color: #1a1a1a; margin-bottom: 0.25rem;">Nova Candidatura</h3>
            <p style="color: #666; font-size: 0.875rem;">Registre uma nova candidatura</p>
        </a>
    </div>

    <div class="card" style="text-align: center; cursor: pointer; transition: all 0.3s ease;" onmouseover="this.style.transform='translateY(-5px)'" onmouseout="this.style.transform='translateY(0)'">
        <a href="{{ route('applications.index') }}" style="text-decoration: none; color: inherit;">
            <div style="font-size: 2.5rem; margin-bottom: 0.5rem;">📋</div>
            <h3 style="font-weight: 600; color: #1a1a1a; margin-bottom: 0.25rem;">Minhas Candidaturas</h3>
            <p style="color: #666; font-size: 0.875rem;">Veja e gerencie suas candidaturas</p>
        </a>
    </div>

    <div class="card" style="text-align: center; cursor: pointer; transition: all 0.3s ease;" onmouseover="this.style.transform='translateY(-5px)'" onmouseout="this.style.transform='translateY(0)'">
        <a href="{{ route('interviews.index') }}" style="text-decoration: none; color: inherit;">
            <div style="font-size: 2.5rem; margin-bottom: 0.5rem;">🎤</div>
            <h3 style="font-weight: 600; color: #1a1a1a; margin-bottom: 0.25rem;">Entrevistas</h3>
            <p style="color: #666; font-size: 0.875rem;">Gerencie suas entrevistas</p>
        </a>
    </div>

    <div class="card" style="text-align: center; cursor: pointer; transition: all 0.3s ease;" onmouseover="this.style.transform='translateY(-5px)'" onmouseout="this.style.transform='translateY(0)'">
        <a href="{{ route('goals.index') }}" style="text-decoration: none; color: inherit;">
            <div style="font-size: 2.5rem; margin-bottom: 0.5rem;">🎯</div>
            <h3 style="font-weight: 600; color: #1a1a1a; margin-bottom: 0.25rem;">Metas</h3>
            <p style="color: #666; font-size: 0.875rem;">Defina e acompanhe suas metas</p>
        </a>
    </div>
</div>
@endsection
