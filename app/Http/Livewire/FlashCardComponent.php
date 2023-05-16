<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\FlashCard;

class FlashCardComponent extends Component
{
    public $question;
    public $answer;
    public $flashcards;
    public $isEditing = false;
    public $flashCardId;

    protected $rules = [
        'question' => 'required',
        'answer' => 'required',
    ];

    public function mount()
    {
        $this->flashcards = FlashCard::orderBy('created_at', 'desc')->get();
    }

    public function save()
    {
        $this->validate();

        if ($this->isEditing) {
            $flashCard = FlashCard::find($this->flashCardId);
            $flashCard->update([
                'question' => $this->question,
                'answer' => $this->answer,
            ]);
        } else {
            FlashCard::create([
                'question' => $this->question,
                'answer' => $this->answer,
            ]);
        }

        $this->flashcards = FlashCard::orderBy('created_at', 'desc')->get();
        $this->reset('question', 'answer', 'isEditing', 'flashCardId');

        $this->emit('saved');
    }

    public function edit($id)
    {
        $this->isEditing = true;
        $flashCard = FlashCard::find($id);
        $this->question = $flashCard->question;
        $this->answer = $flashCard->answer;
        $this->flashCardId = $id;
    }

    public function delete($id)
    {
        $flashCard = FlashCard::find($id);
        $flashCard->delete();
        $this->flashcards = FlashCard::all();
    }

    public function render()
    {
        return view('livewire.flash-card-component');
    }
}
