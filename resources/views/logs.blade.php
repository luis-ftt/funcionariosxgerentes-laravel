<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Logs de Atividades</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-50 min-h-screen p-8">

    <div class="max-w-7xl mx-auto bg-white p-6 rounded shadow">
        <h1 class="text-4xl font-bold mb-8 text-gray-800">Logs de Atividades</h1>
        <a href="{{route('pg_principal')}}" class="text-blue-600 hover:underline">Voltar</a>

        <div id="no-logs-message" class="text-gray-600 text-center py-12 hidden">
            Nenhum log registrado até o momento.
        </div>
        
        <table id="logs-table" class="min-w-full border border-gray-300 rounded overflow-hidden table-auto">
            <thead class="bg-gray-100">
                <tr>
                    <th class="border-b border-gray-300 text-left px-4 py-3">ID</th>
                    <th class="border-b border-gray-300 text-left px-4 py-3">Usuário</th>
                    <th class="border-b border-gray-300 text-left px-4 py-3">Título da Tarefa</th>
                    <th class="border-b border-gray-300 text-left px-4 py-3">Ação</th>
                    <th class="border-b border-gray-300 text-left px-4 py-3">Status</th>
                    <th class="border-b border-gray-300 text-left px-4 py-3">Prioridade</th>
                    <th class="border-b border-gray-300 text-left px-4 py-3">Data de Vencimento</th>
                    <th class="border-b border-gray-300 text-left px-4 py-3">Data do Log</th>
                </tr>
            </thead>
            <tbody id="logs-body" class="text-gray-700">
                @foreach ($logs as $log)
                <tr>
                    <td class="border-b border-gray-300 text-left px-4 py-3">{{$log->id}}</td>
                    <td class="border-b border-gray-300 text-left px-4 py-3">{{$log->user_name}}</td> <!-- Exemplo -->
                    <td class="border-b border-gray-300 text-left px-4 py-3">{{$log->description}}</td>
                    <td class="border-b border-gray-300 text-left px-4 py-3">{{$log->action}}</td>
                    <td class="border-b border-gray-300 text-left px-4 py-3">{{$log->status}}</td>
                    <td class="border-b border-gray-300 text-left px-4 py-3">{{$log->priority}}</td>
                    <td class="border-b border-gray-300 text-left px-4 py-3">{{$log->created_at->format('d/m/Y')}}</td>
                    <td class="border-b border-gray-300 text-left px-4 py-3">{{$log->updated_at->format('d/m/Y')}}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

</body>
</html>
