<div class="flex justify-center">
    <div class="w-full max-w-md mt-8">
        <form class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4" wire:submit.prevent="save">
            <input type="text" wire:model="question" placeholder="Question" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
            @error('question') <span class="text-red-500 text-xs italic">{{ $message }}</span> @enderror
            <input type="text" wire:model="answer" placeholder="Answer" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline mt-4">
            @error('answer') <span class="text-red-500 text-xs italic">{{ $message }}</span> @enderror
            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded mt-4">
                {{ $isEditing ? 'Update' : 'Save' }}
            </button>
        </form>

        @foreach($flashcards as $flashcard)
            <div class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
                <div class="mb-4">
                    <p class="font-bold text-xl mb-2">{{ $flashcard->question }}</p>
                    <p class="text-gray-700 text-base">{{ $flashcard->answer }}</p>
                </div>
                <button wire:click="edit({{ $flashcard->id }})" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded mr-2">Edit</button>
                <button wire:click="delete({{ $flashcard->id }})" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">Delete</button>
            </div>
        @endforeach
    </div>
</div>
