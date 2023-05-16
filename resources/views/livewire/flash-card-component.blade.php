<div>
    <form wire:submit.prevent="save">
        <input type="text" wire:model="question" placeholder="Question">
        @error('question') <span class="error">{{ $message }}</span> @enderror
        <input type="text" wire:model="answer" placeholder="Answer">
        @error('answer') <span class="error">{{ $message }}</span> @enderror
        <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Save</button>
    </form>

    <div>
        @foreach($flashcards as $flashcard)
            <div>
                <h2>Question:</h2>
                <p><strong>{{ $flashcard->question }}</strong></p>
                <h2>Answer:</h2>
                <p>{{ $flashcard->answer }}</p>
            </div>
        @endforeach
    </div>
</div>
