<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\FlashCard;
use DB;

class FlashCardComponent extends Component
{
    public $form = [];
    public $search = '';
    public $flashcards;
    public $isEditing = false;
    public $flashCardId;
    public $expandedFlashCard = null;

    protected $rules = [
        'question' => 'required',
        'answer' => 'required',
    ];
    

    protected $listeners = ['deleteConfirmed' => 'delete'];

    public function mount()
    {
        $this->flashcards = $this->runQuery();
    }

    public function runQuery()
    {
        return FlashCard::query()
            ->where(DB::raw('LOWER(question)'), 'like', strtolower($this->search) . '%')
            ->orWhere(DB::raw('LOWER(answer)'), 'like', '%' . strtolower($this->search) . '%')
            ->orderBy('created_at', 'desc')
            ->get();
    }

    public function updatedSearch()
    {
        $this->flashcards = $this->runQuery();
    }

    public function clearSearch()
    {
        $this->search = '';
        $this->flashcards = $this->runQuery();
    }

    public function save()
    {
        $this->validate([
            'form.question' => 'required',
            'form.answer' => 'required',
        ]);
    
        if ($this->isEditing) {
            $flashCard = FlashCard::find($this->flashCardId);
            $flashCard->update([
                'question' => $this->form['question'],
                'answer' => $this->form['answer'],
            ]);
        } else {
            $flashCard = FlashCard::create($this->form);
    
            $this->expandedFlashCard = $flashCard->id;
        }
    
        $this->flashcards = FlashCard::orderBy('created_at', 'desc')->get();
        $this->reset('form', 'isEditing', 'flashCardId');
    
        $this->emit('saved');
    }

    public function edit($id)
    {
        $this->isEditing = true;
        $flashCard = FlashCard::find($id);
        $this->form['question'] = $flashCard->question;
        $this->form['answer'] = $flashCard->answer;
        $this->flashCardId = $id;

        // Emit an event to the front end
        $this->emit('editFlashCard');
    }

    public function delete($id)
    {
        $flashCard = FlashCard::find($id);
        $flashCard->delete();
        $this->flashcards = FlashCard::orderBy('id', 'desc')->get();
    }

    public function confirmDelete($id)
    {
        if (confirm('Are you sure you want to delete this flashcard?')) {
            $this->delete($id);
        }
    }

    public function expand($id)
    {
        $this->expandedFlashCard = $this->expandedFlashCard === $id ? null : $id;
    }

    public function render()
    {
        return view('livewire.flash-card-component');
    }
}
