<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <title>Sistema inicial</title>
</head>
<body>
    <header class="border border-blue-900 bg-blue-600 shadow-sm">
        <div class="flex justify-between p-3">
            <div>TaskFlow</div>
            <div class="">
                <span class="m-5 border border-blue-900 rounded-md bg-blue-300 p-2"><a href="{{route('registerView')}}" class="underline hover:text-sm transition-all duration-200 ease hover:no-underline">
                    Registrar</a></span>
                <span class="border border-blue-900 rounded-md bg-blue-300 p-2"><a href="{{route('loginView')}}" class="underline hover:text-sm transition-all duration-200 ease hover:no-underline">
                    Login</a></span>
            </div>
        </div>
    </header>
    <main>
        <div>
            <div class="flex justify-center flex-col items-center">
                <h1 class="text-5xl mt-3">TaskFlow</h1>
                <p class="mt-5 text-gray-500 text-shadow-sm">Sistema de tarefas para empresas</p>
            </div>
            <div class="h-full">

            </div>
            <div class="flex justify-center items-center h-100 flex-col">
                <p class="shadow p-5 border-none rounded-md">
                    Organizão em 1º lugar
                </p>
                
            </div>
        </div>
    </main>
</body>
</html>