<?php

namespace App\Http\Livewire;

use App\Models\Posts;
use Livewire\Component;

class CreatePost extends Component
{
    public $open_modal = false;
    public $title, $content;

    public function render()
    {
        return view('livewire.create-post');
    }

    public function save()
    {
        Posts::create([
            'title' => $this->title,
            'content' => $this->content
        ]);
    }
}
