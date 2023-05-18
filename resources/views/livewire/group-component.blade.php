<div class="flex justify-center">
    <div class="w-full max-w-xl mt-8 ml-2 mr-2">
        <div class="flex justify-between items-center mb-8">
            <h1 class="text-2xl font-bold text-left text-white">FlashCard Groups 🎴</h1>
            <a href="{{ route('welcome') }}" class="bg-teal-700 text-white font-medium text-base py-2 px-4 rounded hover:bg-teal-800">
                Make FlashCards
            </a>
        </div>

        <form class="bg-white shadow-md rounded px-6 pt-6 pb-6 mb-4" wire:submit.prevent="createOrUpdateGroup">
            <input type="text" wire:model="groupTitle" placeholder="Group Title" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline mb-4">
            <input type="text" wire:model="search" placeholder="Search Flash Cards" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline mb-4">

            <div style="height: 200px; overflow-y: scroll;" class="shadow border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline mb-4 bg-white">
                @foreach($flashcards as $flashcard)
                    <div>
                        <input type="checkbox" wire:model="selectedFlashCards" value="{{ $flashcard->id }}">
                        {{ $flashcard->question }}
                    </div>
                @endforeach
            </div>

            <div class="flex items-center justify-between">
                <button wire:click="createOrUpdateGroup" type="submit" class="bg-blue-500 hover:bg-blue-600 text-white font-md py-2 px-4 rounded mt-4">
                    Save Group
                </button>
                <button wire:click="cancelEditing" class="bg-yellow-600 hover:bg-yellow-700 text-white font-md py-2 px-4 rounded mt-4">Clear</button>
            </div>
        </form>

        <div class="relative mb-4">
            <input 
                type="text" 
                wire:model="search" 
                placeholder="Search Groups ..." 
                class="shadow placeholder:text-gray-300 appearance-none border rounded w-full py-2 px-3 text-white leading-tight focus:outline-none focus:shadow-outline pl-8 bg-transparent border-white"
            >
        </div>
            
        @if(strlen($search) > 0)
            <div class="mb-4">
                <span class="text-white">{{ count($groups) }} groups found</span>
                <button 
                    class="bg-yellow-600 hover:bg-yellow-700 text-white font-md py-2 px-4 rounded ml-2"
                    wire:click="clearSearch"
                >
                    Clear search
                </button>
            </div>
        @endif
        

        @foreach($groups as $group)
        <div class="bg-gray-200 rounded px-6 pt-4 pb-4 mb-4">
            <div>
                <div class="flex items-center justify-between">
                    <h2 class="font-bold text-lg text-black">{{ $group->name }}</h2>
                    <button wire:click="expand({{ $group->id }})" class="ml-4 w-8 h-8 flex items-center justify-center">
                        @if($expandedGroup === $group->id)
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="h-4 w-4 text-black">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 15l7-7 7 7"></path>
                            </svg>
                        @else
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="h-4 w-4 text-black">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                            </svg>
                        @endif
                    </button>
                </div>
            </div>
            
            @if($expandedGroup === $group->id)
                @foreach($group->flashcards as $flashcard)
                <div class="bg-white shadow-md rounded px-4 pt-2 pb-2 mb-4 mt-4">
                    <div class="flex items-center justify-between">
                        <p class="font-bold text-lg">{{ $flashcard->question }}</p>
                        <button wire:click="expandFlashCard({{ $flashcard->id }})" class="ml-4 w-8 h-8 flex items-center justify-center">
                            @if($expandedFlashCard === $flashcard->id)
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="h-4 w-4 text-black">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 15l7-7 7 7"></path>
                                </svg>
                            @else
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="h-4 w-4 text-black">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                </svg>
                            @endif
                        </button>
                    </div>
                    @if($expandedFlashCard === $flashcard->id)
                        <p class="text-gray-700 text-lg font-light mt-2 mb-4">{{ $flashcard->answer }}</p>
                    @endif
                </div>
            @endforeach

            <div class="flex items-center justify-between mt-4 mb-2">
                <button wire:click="startEditing({{ $group->id }})" class="bg-blue-500 hover:bg-blue-600 text-white font-md py-2 px-4 rounded mr-2">
                    Edit
                </button>
                <button wire:click="deleteGroup({{ $group->id }})" class="bg-rose-600 hover:bg-red-700 text-white font-md py-2 px-4 rounded">
                    Delete Group
                </button>
            </div>
        @endif
    </div>
    @endforeach
</div>
</div>

