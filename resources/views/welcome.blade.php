<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>FlashCards</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Lexend+Deca:wght@200;300;400;500;600;700&display=swap" rel="stylesheet">

        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <script src="https://cdnjs.cloudflare.com/ajax/libs/autosize.js/4.0.2/autosize.min.js"></script>

        <!-- Styles -->
        @livewireStyles
    </head>
    <body class="bg-emerald-950 font-lexend">
        <div class="flex justify-center">
            <div class="w-full max-w-2xl mt-8 ml-2 mr-2">
                <div class="items-center mb-8">
                    <h1 class="text-2xl font-bold text-center text-white">FlashCards 🃏</h1>
                </div>
    
                <div class="grid grid-cols-2 mb-4 bg-white px-6 py-6 mb-4 rounded">
                    <button onclick="showForm('loginForm')" class="text-center bg-sky-600 text-white font-medium text-base py-2 px-4 rounded hover:bg-sky-700 mr-3">
                        Login</button>
                    <button onclick="showForm('registerForm')" class="text-center bg-stone-600 text-white font-medium text-base py-2 px-4 rounded hover:bg-stone-700 ml-3">
                        Register</button>
                </div>
                <div id="loginForm" style="display: none;">
                    @include('auth.login')
                </div>
                <div id="registerForm" style="display: none;">
                    @include('auth.register')
                </div>
            </div>
        </div>
        @livewireScripts
    
        <script>
            function showForm(formId) {
                var form = document.getElementById(formId);
                form.style.display = form.style.display === 'none' ? 'block' : 'none';
            }
        </script>
    </body>       
</html>
