<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\FlashCard;
use App\Models\Group;
use Illuminate\Validation\Rule;
use DB;

class GroupComponent extends Component
{
    public $groupTitle = '';
    public $groupSearch = '';
    public $flashCardSearch = '';
    public $flashcards = [];
    public $selectedFlashCards = [];
    public $expandedFlashCard;

    public $isEditingGroup = false;
    public $editingGroupId;
    public $expandedGroup = null;

    public function mount()
    {
        $this->flashcards = FlashCard::all();
    }

    public function updatedFlashCardSearch()
    {
        $this->flashcards = FlashCard::where('question', 'like', '%' . strtolower($this->flashCardSearch) . '%')
            ->orWhere('answer', 'like', '%' . strtolower($this->flashCardSearch) . '%')
            ->get();
    }

    public function selectFlashCard($id)
    {
        // If the id is already in the array, remove it
        if (($key = array_search($id, $this->selectedFlashCards)) !== false) {
            unset($this->selectedFlashCards[$key]);
        } else { // If the id is not in the array, add it
            $this->selectedFlashCards[] = $id;
        }

        // Reset array keys
        $this->selectedFlashCards = array_values($this->selectedFlashCards);
        
    }

    public function expand($groupId)
    {
        if ($this->expandedGroup === $groupId) {
            $this->expandedGroup = null;
        } else {
            $this->expandedGroup = $groupId;
        }
    }

    public function expandFlashCard($flashcardId)
    {
        if ($this->expandedFlashCard === $flashcardId) {
            $this->expandedFlashCard = null;
        } else {
            $this->expandedFlashCard = $flashcardId;
        }
    }

    public function removeFlashCard($groupId, $flashcardId)
    {
        $group = Group::find($groupId);
        $group->flashcards()->detach($flashcardId);
    }

    public function createOrUpdateGroup()
    {
        $this->validate([
            'groupTitle' => 'required',
            'selectedFlashCards' => 'required',
        ]);

        if ($this->isEditingGroup) {
            $group = Group::find($this->editingGroupId);
            $group->update(['name' => $this->groupTitle]);

            // Sync the flashcards to update the existing relationships
            $group->flashcards()->sync($this->selectedFlashCards);
        } else {
            $group = Group::create(['name' => $this->groupTitle]);

            // Attach the selected flashcards to the group
            foreach ($this->selectedFlashCards as $flashCardId) {
                $group->flashcards()->attach($flashCardId);
            }
        }

        // Reset the state
        $this->reset('groupTitle', 'selectedFlashCards', 'isEditingGroup', 'editingGroupId');
    }


    public function startEditing($groupId)
    {
        $group = Group::find($groupId);

        $this->groupTitle = $group->name;
        $this->selectedFlashCards = $group->flashcards->pluck('id')->toArray();
        $this->isEditingGroup = true;
        $this->editingGroupId = $groupId;
    }

    public function cancelEditing()
    {
        $this->reset('groupTitle', 'selectedFlashCards', 'isEditingGroup', 'editingGroupId');
    }

    public function deleteGroup($groupId)
    {
        // Lookup the group
        $group = Group::find($groupId);

        // Delete the group
        if ($group) {
            $group->delete();
        }

        // Reset expanded group if it was the one deleted
        if ($this->expandedGroup === $groupId) {
            $this->expandedGroup = null;
        }

        // Show some message to indicate successful deletion
        $this->emit('alert', ['type' => 'success', 'message' => 'Group deleted successfully']);
    }

    public function clearSearch()
    {
        $this->search = '';
    }


    public function render()
    {
        $groups = Group::with('flashcards')->where(DB::raw('LOWER(name)'), 'like', strtolower($this->groupSearch) . '%')->orderBy('created_at', 'desc')->get();

        return view('livewire.group-component', ['groups' => $groups])
            ->layout('groups');
    }
}
