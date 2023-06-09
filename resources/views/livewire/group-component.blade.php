<div class="flex justify-center">
    <div class="w-full max-w-2xl mt-4 ml-2 mr-2">

        @include('layouts.loggedin-navbar')

        <div class="text-base font-medium text-white mb-4 text-center">Create Groups 📑</div>

        <form id="groupform" class="bg-white shadow-md rounded px-6 pt-6 pb-6 mb-4" wire:submit.prevent="createOrUpdateGroup">
            <input type="text" wire:model="groupTitle" placeholder="Group Title" class="shadow appearance-none border-inherit rounded w-full py-2 px-3 text-gray-800 leading-tight focus:outline-none focus:shadow-outline mb-4">
            
            <input type="text" wire:model="flashCardSearch" placeholder="Search Flash Cards" class="shadow appearance-none border-inherit rounded w-full py-2 px-3 text-gray-800 leading-tight focus:outline-none focus:shadow-outline mb-4">

            <div style="height: 200px; overflow-y: scroll;" class="shadow border rounded w-full py-2 px-3 text-gray-800 leading-tight focus:outline-none focus:shadow-outline bg-white">
                @foreach($flashcards as $flashcard)
                    <div>
                        <input type="checkbox" wire:model="selectedFlashCards" value="{{ $flashcard->id }}">
                        {{ $flashcard->question }}
                    </div>
                @endforeach
            </div>
            
            <div class="flex items-center justify-between">
                <button wire:click="createOrUpdateGroup" type="submit" class="bg-blue-500 hover:bg-blue-600 text-white font-md py-2 px-4 rounded mt-6">
                    Save Group
                </button>
                <button wire:click="cancelEditing" class="bg-yellow-600 hover:bg-yellow-700 text-white font-md py-2 px-4 rounded mt-4">Clear</button>
            </div>
        </form>

        <div class="relative mb-4">
            <input 
                type="text" 
                wire:model="groupSearch" 
                placeholder="Search Groups ..." 
                class="shadow placeholder:text-gray-300 appearance-none border rounded w-full py-2 px-3 text-white leading-tight focus:outline-none focus:shadow-outline pl-8 bg-transparent border-white"
            >
        </div>
        
        <!-- searching groups -->
        @if(strlen($groupSearch) > 0)
            <div class="mb-4">
                <span class="text-white">{{ count($groups) }} groups found</span>
                <button 
                    class="bg-yellow-600 hover:bg-yellow-700 text-white font-md py-2 px-4 rounded ml-2"
                    wire:click="clearGroupSearch"
                >
                    Clear search
                </button>
            </div>
        @endif
        

        @foreach($groups as $group)
        <div class="bg-gray-100 overflow-hidden rounded px-6 py-2 mb-4">
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
                <div class="overflow-hidden rounded mb-4 mt-4">
                    <div class="flex items-center bg-[#DEE3E3] rounded-t px-4 py-1 justify-between">
                        <p class="font-bold text-base">{{ $flashcard->question }}</p>
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
                        <div class="border-b-2 border-x-2 border-[#DEE3E3] px-4 py-2 rounded-b">
                            <p class="text-gray-800 text-base font-light">{!! nl2br(e($flashcard->answer)) !!}</p>
                        </div>
                    @endif
                </div>
            @endforeach

            <div class="flex items-center justify-between mt-4 mb-2">
                <button wire:click="startEditing({{ $group->id }})" class="bg-blue-500 hover:bg-blue-600 text-white font-md py-0.5 px-2 rounded mr-2">
                    Edit Group
                </button>
                <button wire:click="deleteGroup({{ $group->id }})" class="bg-rose-600 hover:bg-red-700 text-white font-md py-0.5 px-2 rounded">
                    Delete Group
                </button>
            </div>
        @endif
    </div>
    @endforeach
</div>
</div>

<script>
    document.addEventListener('livewire:load', function () {
        Livewire.on('editGroup', () => {
            document.getElementById("groupform").scrollIntoView({
                behavior: 'smooth',
                block: 'start'
            });
        });
    });
</script>

