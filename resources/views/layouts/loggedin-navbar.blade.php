<div class="flex justify-center mb-4">
    @auth
        <h1 class="text-2xl font-bold text-left text-white">{{ Auth::user()->name }}'s FlashCards 🃏</h1>
    @endauth
</div>              

<div class="grid grid-cols-4 mb-4">
    <a href="{{ route('cards') }}" class="text-center bg-white text-black font-medium text-base py-2 px-4 rounded hover:bg-teal-600 hover:text-white mr-4">
        Cards</a>
    <a href="{{ route('groups') }}" class="text-center bg-white text-black font-medium text-base py-2 px-4 rounded hover:bg-teal-600 hover:text-white mr-4">
        Groups</a>
    @auth
        <a href="{{ route('profile.edit', Auth::user()) }}" class="text-black text-center font-medium text-base py-2 px-4 rounded hover:bg-teal-600 hover:text-white bg-white mr-4">
            Profile
        </a>
        <form method="POST" action="{{ route('logout') }}" class="text-center text-white text-base bg-red-500 py-2 px-4 rounded hover:bg-rose-600">
            @csrf
            <button type="submit">Logout</button>
        </form>
    @endauth
</div>