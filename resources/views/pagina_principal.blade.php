<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="csrf-token" content="{{csrf_token()}}"/>
  <title>TaskFlow - Painel</title>
  @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100 text-gray-800">

  <header class="bg-white shadow p-4 flex justify-between items-center">
    <h1 class="text-2xl font-bold text-blue-600">📋 TaskFlow</h1>
    <h3>Conta: <span class=" text-2xl">
      {{$user->email}}
      @if($user->admin == 1)
      <span class="text-sm flex justify-center items-center text-red-500">Administrador</span>
      @endif
      </span></h3>
      @if ($user->admin == 1)
    <a href="{{route('TaskView')}}" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 transition">
      Nova Tarefa
    </a>
    @endif
  </header>

  <div class="flex min-h-screen">

   
    <aside class="w-64 bg-white p-4 border-r border-none hidden md:block">
      <h2 class="text-lg font-semibold mb-2">Filtros</h2>

      <div class="mb-4">
        <h3 class="font-medium text-sm mb-1">Status</h3>
        <ul class="space-y-1">
          <li><a href="#" onclick="loadTasks(event, 'status=pendente')" class="text-gray-700 hover:underline">Pendente</a></li>
          <li><a href="#" onclick="loadTasks(event, 'status=andamento')" class="text-gray-700 hover:underline">Em Andamento</a></li>
          <li><a href="#" onclick="loadTasks(event, 'status=concluida')" class="text-gray-700 hover:underline">Concluidos</a></li>
          <li><a href="#" onclick="loadTasks(event, 'status=todos')" class="text-gray-700 hover:underline">Mostrar Todos</a></li>
        </ul>
      </div>

      <div class="mb-4">
        <h3 class="font-medium text-sm mb-1">Prioridade</h3>
        <ul class="space-y-1">
          <li><a href="#" onclick="loadTasks(event, 'priority=alta')" class="text-red-600 hover:underline">Alta</a></li>
          <li><a href="#" onclick="loadTasks(event, 'priority=media')" class="text-yellow-600 hover:underline">Média</a></li>
          <li><a href="#" onclick="loadTasks(event, 'priority=baixa')"  class="text-green-600 hover:underline">Baixa</a></li>
        </ul>
      </div>
      @if ($user->admin == 1)
      <div class="mb-4">
        <h3 class="font-medium text-sm mb-1">Admin</h3>
        <ul class="space-y-1">
          <li><a href="{{route('logs')}}" class=" hover:underline">Logs</a></li>
        </ul>
      </div>
      @endif
      <div class="mb-4">
        <h3 class="font-medium text-sm mb-1">Encerrar sessão</h3>
       <form method="POST" action="{{ route('logout', ['id' => $user->id]) }}">
        @csrf
        <button type="submit" class="text-gray-900 hover:underline">Sair</button>
    </form>
      </div>
    </aside>

   
    <main class="flex-1 p-6">

      <h2 class="text-xl font-bold mb-4">Minhas Tarefas</h2>

    
      <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
        
    </main>
  </div>

  

  <script src="{{ asset('js/filter.js') }}"></script>
</body>
</html>
