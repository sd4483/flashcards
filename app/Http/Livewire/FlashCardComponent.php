<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\FlashCard;

class FlashCardComponent extends Component
{
    public $question;
    public $answer;
    public $flashcards;

    protected $rules = [
        'question' => 'required',
        'answer' => 'required',
    ];

    public function mount()
    {
        $this->flashcards = FlashCard::all();
    }

    public function save()
    {
        $this->validate();

        FlashCard::create([
            'question' => $this->question,
            'answer' => $this->answer,
        ]);

        $this->flashcards = FlashCard::all();

        $this->reset('question', 'answer');

        $this->emit('saved');
    }

    public function render()
    {
        return view('livewire.flash-card-component');
    }
}
