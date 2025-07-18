<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <title>Entrar na Conta</title>
</head>
<body class="bg-gray-100 flex items-center justify-center h-screen">
    <div class="bg-white p-8 rounded shadow-md w-full max-w-sm">
        <div><a href="{{route('inicio')}}" class="inline-block p-3"><svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-5">
        <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5 3 12m0 0 7.5-7.5M3 12h18" />
        </svg></a>
        </div>
        @if($errors->any())
            <span class=" text-red-800">{{ $errors->first() }}</span>
        @endif
        @if(session('success'))
            <span class=" text-green-800">{{ session('success') }}</span>
        @endif
        <h2 class="text-2xl font-semibold mb-6 text-center">Entrar</h2>
        <form action="{{route('loginPost')}}" method="POST">
            @csrf
            <div class="mb-4">
                <label class="block text-gray-700 mb-1" for="email">Email</label>
                <input type="email" id="email" name="email" class="w-full px-4 py-2 border rounded focus:outline-none focus:ring-2 focus:ring-blue-400" required>
            </div>
            <div class="mb-6">
                <label class="block text-gray-700 mb-1" for="password">Senha</label>
                <input type="password" id="password" name="password" class="w-full px-4 py-2 border rounded focus:outline-none focus:ring-2 focus:ring-blue-400" required>
            </div>
            <button type="submit" class="w-full bg-blue-500 text-white py-2 rounded hover:bg-blue-600">Entrar</button>
        </form>
        <p class="text-sm text-center text-gray-600 mt-4">
            Não tem uma conta?
            <a href="/register" class="text-blue-500 hover:underline">Registrar</a>
        </p>
    </div>
</body>
</html>
