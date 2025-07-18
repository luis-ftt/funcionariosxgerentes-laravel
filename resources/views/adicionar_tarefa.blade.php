<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Nova Tarefa - TaskFlow</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 text-gray-800">

  
  <header class="bg-white shadow p-4 flex justify-between items-center">
    <h1 class="text-2xl font-bold text-blue-600">📋 TaskFlow</h1>
    <a href="{{route('pg_principal')}}" class="text-blue-600 hover:underline">Voltar</a>
  </header>

  <main class="max-w-2xl mx-auto mt-10 bg-white p-6 rounded shadow">

    <h2 class="text-xl font-bold mb-4">Nova Tarefa</h2>

    
    <form action="{{route('TaskPost')}}" method="POST" class="space-y-4">
      @csrf      
      <div>
        <label for="title" class="block font-medium text-sm mb-1">Título <span class="text-red-500">*</span></label>
        <input type="text" id="title" name="title" required
          class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring focus:ring-blue-300">
      </div>

      
      <div>
        <label for="description" class="block font-medium text-sm mb-1">Descrição</label>
        <textarea id="description" name="description" rows="4"
          class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring focus:ring-blue-300"></textarea>
      </div>

      
      <div>
        <label for="status" class="block font-medium text-sm mb-1">Status</label>
        <select id="status" name="status"
          class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring focus:ring-blue-300">
          <option value="pendente" selected>Pendente</option>
          <option value="andamento">Em Andamento</option>
          <option value="concluida">Concluída</option>
        </select>
      </div>

      
      <div>
        <label for="priority" class="block font-medium text-sm mb-1">Prioridade</label>
        <select id="priority" name="priority"
          class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring focus:ring-blue-300">
          <option value="baixa" selected>🟢 Baixa</option>
          <option value="media">🟡 Média</option>
          <option value="alta">🔴 Alta</option>
        </select>
      </div>

      
      <div>
        <label for="due_date" class="block font-medium text-sm mb-1">Data de Vencimento</label>
        <input type="date" id="due_date" name="due_date"
          class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring focus:ring-blue-300">
      </div>

      <div>
        <label for="user_id" class="block font-medium text-sm mb-1">
            Enviar Para <span class="text-red-500">*</span>
        </label>
        <select id="user_id" name="user_id" required
            class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring focus:ring-blue-300">
            <option value="">-- Selecione um usuário --</option>
            @foreach($initialUsers as $user)
            <option value="{{ $user->id }}">{{ $user->name }} - ({{ $user->email }})</option>
            @endforeach
        </select>
        </div>

      
      <div class="pt-4">
        <button type="submit"
          class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 transition">
        Salvar Tarefa
        </button>
      </div>
    </form>

  </main>

  <link href="https://cdn.jsdelivr.net/npm/tom-select/dist/css/tom-select.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/tom-select/dist/js/tom-select.complete.min.js"></script>

<script>
  new TomSelect("#user_id", {
  valueField: 'id',
  labelField: 'name',
  searchField: 'name',
  maxOptions: 10,
  load: function(query, callback) {
    if (!query.length) return callback();
    fetch(`/api/users?q=${encodeURIComponent(query)}`)
      .then(response => response.json())
      .then(data => callback(data))
      .catch(() => callback());
  }
});
</script>

</body>
</html>
