<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    use HasFactory;

    protected $fillable = ['name'];

    public function flashcards()
    {
        return $this->belongsToMany(FlashCard::class, 'flash_cards_groups');
    }
}
