<div class="flex justify-center">
    <div class="w-full max-w-2xl mt-8 ml-2 mr-2">
        <div class="flex justify-between items-center mb-8">
            <h1 class="text-2xl font-bold text-left text-white">FlashCards 🃏</h1>
            <a href="{{ route('groups') }}" class="bg-cyan-700 text-white font-medium text-base py-2 px-4 rounded hover:bg-cyan-800">
                Groups
            </a>
        </div>
        <form id="flashcardform" class="bg-white shadow-md rounded px-6 pt-6 pb-6 mb-4" wire:submit.prevent="save">
            <input type="text" wire:model="form.question" placeholder="Title" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-800 leading-tight focus:outline-none focus:shadow-outline mb-4">
            @error('form.question') <span class="text-red-500 text-xs italic">{{ $message }}</span> @enderror
            <textarea wire:model.defer="form.answer" id="answer-textarea" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-800 leading-tight focus:outline-none focus:shadow-outline" id="answer" type="text" placeholder="Content"></textarea>
            @error('form.answer') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
            <div class="flex items-center justify-between">
                <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white font-md py-2 px-4 rounded mt-4">
                    {{ $isEditing ? 'Update' : 'Save' }}
                </button>
                <button wire:click="cancelEdit" wire:click="clearErrors" class="bg-yellow-600 hover:bg-yellow-700 text-white font-md py-2 px-4 rounded mt-4">Clear</button>
            </div>
        </form>

        <div class="relative mb-4">
            <input 
                type="text" 
                wire:model="search" 
                placeholder="type something to search ..." 
                class="shadow placeholder:text-gray-300 appearance-none border rounded w-full py-2 px-3 text-white leading-tight focus:outline-none focus:shadow-outline pl-8 bg-transparent border-white"
            >
        </div>
        
        <!-- searching flashcards -->
        @if(strlen($search) > 0)
            <div class="mb-4">
                <span class="text-white">{{ count($flashcards) }} items found</span>
                <button 
                    class="bg-yellow-600 hover:bg-yellow-700 text-white font-md py-2 px-4 rounded ml-2"
                    wire:click="clearSearch">
                    Clear search
                </button>
            </div>
        @endif

        @foreach($flashcards as $flashcard)
            <div class="bg-white shadow-md rounded px-6 pt-4 pb-4 mb-4">
                <div>
                    <div class="flex items-center justify-between">
                        <p class="font-medium text-base">{{ $flashcard->question }}</p>
                        <button wire:click="expand({{ $flashcard->id }})" class="ml-4 w-8 h-8 flex items-center justify-center">
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
                        <p class="text-gray-700 text-base font-light mt-2 mb-4">{!! nl2br(e($flashcard->answer)) !!}</p>
                        <div class="flex items-center justify-between mb-2">
                            <button wire:click="edit({{ $flashcard->id }})" class="bg-blue-500 hover:bg-blue-600 text-white font-md py-2 px-4 rounded mr-2">Edit</button>
                            <button wire:click="$emit('triggerConfirm', {{ $flashcard->id }})" class="ml-4 bg-rose-600 hover:bg-red-700 text-white font-md py-2 px-4 rounded">
                                Delete
                            </button>
                        </div>
                    @endif
                </div>
            </div>
        @endforeach

    </div>
</div>

<script>
    document.addEventListener('livewire:load', function () {
        Livewire.on('editFlashCard', () => {
            document.getElementById("flashcardform").scrollIntoView({
                behavior: 'smooth',
                block: 'start'
            });
        });
    });
</script>

<!--
<script>
    //for answer area if there is a really long word, that will not wrap around, it will overflow.
    document.addEventListener('livewire:load', function () {
        const textarea = document.getElementById('answer-textarea');
        autosize(textarea);

        Livewire.hook('message.processed', (message, component) => {
            autosize.update(textarea);
        });
    });
</script>
-->

