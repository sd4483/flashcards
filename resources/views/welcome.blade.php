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

                <!--Example FlashCard-->

                <div>
                    <p class="text-xl text-white mb-3 font-medium">Make simple Flashcards to study for exams or to learn anything you want to learn. An example flashcard 👇</p> 
                    

                    <div class="bg-white shadow-md rounded px-6 pt-4 pb-4 mb-4"> 
                        <p class="font-bold text-lg">What is blockchain?</p>
                        <p class="text-gray-700 text-base font-light mt-2">A blockchain stores transactions in the form of blocks which are linked together in a Distributed Ledger. 
                            This ledger is essentially immutable and connected over a peer-to-peer network.<br><br>
                            It consists of a genesis block, main chain and orphan blocks.<br><br>
                            Each block contains a cryptographic hash of the previous block, a timestamp and transaction data.</p>
                    </div>
                </div>

                <!--Login/Register Form-->
    
                <div class="grid grid-cols-2 bg-white px-6 pt-6 pb-3 rounded-t">
                    <button id="loginButton" onclick="showForm('loginForm', 'registerForm')" class="text-center font-medium text-base py-2 px-4 rounded mr-6">
                        Log in</button>
                    <button id="registerButton" onclick="showForm('registerForm', 'loginForm')" class="text-center font-medium text-base py-2 px-4 rounded ml-6">
                        Register</button>
                </div>
                <div id="loginForm" style="display: block;">
                    @include('auth.login')
                </div>
                <div id="registerForm" style="display: none;">
                    @include('auth.register')
                </div>
            </div>
        </div>
        @livewireScripts
    
        <script>
            function showForm(formIdToShow, formIdToHide) {
                var formToShow = document.getElementById(formIdToShow);
                var formToHide = document.getElementById(formIdToHide);
                formToShow.style.display = 'block';
                formToHide.style.display = 'none';
        
                // Update the button classes depending on the form being shown
                if (formIdToShow === 'loginForm') {
                    document.getElementById('loginButton').classList.remove('bg-black');
                    document.getElementById('loginButton').classList.remove('text-white');
                    document.getElementById('registerButton').classList.add('bg-black');
                    document.getElementById('registerButton').classList.add('text-white');
                } else {
                    document.getElementById('registerButton').classList.remove('bg-black');
                    document.getElementById('registerButton').classList.remove('text-white');
                    document.getElementById('loginButton').classList.add('bg-black');
                    document.getElementById('loginButton').classList.add('text-white');
                }
            }
            
            // Initialize the button classes
            showForm('loginForm', 'registerForm');
        </script>
    </body>           
</html>
