{{-- <div x-data="{ open: false }" class="mb-4">
    <div class="flex justify-between items-center">
        @auth
            <h1 class="text-2xl font-bold text-left text-white">{{ Auth::user()->name }}'s FlashCards 🃏</h1>
        @endauth
        <button @click="open = !open" class="px-2 py-1 text-white rounded hover:text-white hover:bg-gray-700 focus:outline-none focus:bg-gray-700 md2:hidden">
            <span x-show="!open">Menu</span>
            <span x-show="open">Close</span>
        </button>
        <button class="px-2 py-1 text-white rounded hover:text-white hover:bg-gray-700 focus:outline-none focus:bg-gray-700 hidden md2:inline-flex" @click="open = !open">
            <span x-show="!open">Menu</span>
            <span x-show="open">Close</span>
        </button>
    </div>

    <!-- Mobile Menu -->
    <div :class="{'block': open, 'hidden': !open}" class="md2:hidden space-y-4" @click.away="open = false">
        <!-- Add menu items here -->
        <a href="{{ route('cards') }}" class="text-center bg-white text-black font-medium text-base py-2 px-4 rounded hover:bg-teal-600 hover:text-white">
            Cards</a>
        <a href="{{ route('groups') }}" class="text-center bg-white text-black font-medium text-base py-2 px-4 rounded hover:bg-teal-600 hover:text-white">
            Groups</a>
        @auth
            <a href="{{ route('profile.edit', Auth::user()) }}" class="text-black text-center font-medium text-base py-2 px-4 rounded hover:bg-teal-600 hover:text-white bg-white">
                Profile
            </a>
        @endauth
        <form method="POST" action="{{ route('logout') }}" class="text-center text-white text-base bg-red-500 py-2 px-4 rounded hover:bg-rose-600">
            @csrf
            <button type="submit">Logout</button>
        </form>
    </div>

    <!-- Desktop Menu -->
    <div :class="{'flex': open, 'hidden': !open}" class="hidden md2:flex md2:space-x-4" @click.away="open = false">
        <!-- Add menu items here -->
        <a href="{{ route('cards') }}" class="text-center bg-white text-black font-medium text-base py-2 px-4 rounded hover:bg-teal-600 hover:text-white">
            Cards</a>
        <a href="{{ route('groups') }}" class="text-center bg-white text-black font-medium text-base py-2 px-4 rounded hover:bg-teal-600 hover:text-white">
            Groups</a>
        @auth
            <a href="{{ route('profile.edit', Auth::user()) }}" class="text-black text-center font-medium text-base py-2 px-4 rounded hover:bg-teal-600 hover:text-white bg-white">
                Profile
            </a>
        @endauth
        <form method="POST" action="{{ route('logout') }}" class="text-center text-white text-base bg-red-500 py-2 px-4 rounded hover:bg-rose-600">
            @csrf
            <button type="submit">Logout</button>
        </form>
    </div>
</div> --}}






<div class="flex justify-center mb-4">
    @auth
        <h1 class="text-2xl font-bold text-left text-white">{{ Auth::user()->name }}'s FlashCards 🃏</h1>
    @endauth
</div>

{{-- <!-- Desktop menu -->
<div x-data="{ open: false }" class="md2:flex md2:items-center mb-4">
    <button @click="open = !open" class="hidden md2:inline-block px-2 py-1 text-white rounded hover:text-white hover:bg-gray-700 focus:outline-none focus:bg-gray-700">
        <span x-show="!open">Menu</span>
        <span x-show="open">Close</span>
    </button>
    <nav :class="{'md2:flex md2:justify-between': open, 'hidden': !open}" class="flex flex-col md2:flex-row">
        <a href="#" class="text-center bg-white text-black font-medium text-base py-2 px-4 rounded hover:bg-teal-600 hover:text-white mr-4">
            Button 1
        </a>
        <a href="#" class="text-center bg-white text-black font-medium text-base py-2 px-4 rounded hover:bg-teal-600 hover:text-white mr-4">
            Button 2
        </a>
    </nav>
</div>

<!-- Mobile menu -->
<div x-data="{ open: false }" class="md2:hidden mb-4">
    <button @click="open = !open" class="px-2 py-1 text-white rounded hover:text-white hover:bg-gray-700 focus:outline-none focus:bg-gray-700">
        <span x-show="!open">Menu</span>
        <span x-show="open">Close</span>
    </button>
    <nav :class="{'block': open, 'hidden': !open}" class="flex flex-col">
        <a href="#" class="text-center bg-white text-black font-medium text-base py-2 px-4 rounded hover:bg-teal-600 hover:text-white mr-4">
            Button 1
        </a>
        <a href="#" class="text-center bg-white text-black font-medium text-base py-2 px-4 rounded hover:bg-teal-600 hover:text-white mr-4">
            Button 2
        </a>
    </nav>
</div> --}}







<div class="grid grid-cols-4 mb-4">
    <a href="{{ route('cards') }}" class="text-center bg-white text-black font-medium text-base py-2 px-4 rounded hover:bg-teal-600 hover:text-white mr-4">
        Cards</a>
    <a href="{{ route('groups') }}" class="text-center bg-white text-black font-medium text-base py-2 px-4 rounded hover:bg-teal-600 hover:text-white mr-4">
        Groups</a>
    @auth
        <a href="{{ route('profile.edit', Auth::user()) }}" class="text-black text-center font-medium text-base py-2 px-4 rounded hover:bg-teal-600 hover:text-white bg-white mr-4">
            Profile
        </a>
    @endauth
    <form method="POST" action="{{ route('logout') }}" class="text-center text-white text-base bg-red-500 py-2 px-4 rounded hover:bg-rose-600">
        @csrf
        <button type="submit">Logout</button>
    </form>
</div>
