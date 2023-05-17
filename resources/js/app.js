import './bootstrap';

Livewire.on('triggerConfirm', function(id) {
    if (confirm('Are you sure you want to delete this flashcard?')) {
        Livewire.emit('deleteConfirmed', id);
    }
})
