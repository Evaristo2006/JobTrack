<!DOCTYPE html>
<html>
<head>
    <title>Relatório de Metas</title>
    <style>
        body { font-family: sans-serif; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #ccc; padding: 8px; text-align: center; }
        th { background-color: #eee; }
        .progress-bar {
            height: 15px;
            background-color: #4CAF50;
            text-align: center;
            color: white;
        }
    </style>
</head>
<body>
    <h2>Relatório de Metas - {{ auth()->user()->name }}</h2>

    <table>
        <thead>
            <tr>
                <th>Mês/Ano</th>
                <th>Meta</th>
                <th>Candidaturas</th>
                <th>Progresso (%)</th>
            </tr>
        </thead>
        <tbody>
            @foreach($goals as $goal)
            <tr>
                <td>{{ $goal->month }}/{{ $goal->year }}</td>
                <td>{{ $goal->target }}</td>
                <td>{{ $goal->progress_count }}</td>
                <td>{{ $goal->progress_percent }}%</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
