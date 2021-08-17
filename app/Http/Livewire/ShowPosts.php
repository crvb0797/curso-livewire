<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Posts;

class ShowPosts extends Component
{
    /* public $text, $content; */
    public $search;
    public $sort = 'id', $direction = 'desc';
    protected $listeners = ['render'];

    public function render()
    {
        $posts = Posts::where('title', 'LIKE', '%' . $this->search . '%')
            ->orWhere('content', 'LIKE', '%' . $this->search . '%')
            ->orderBy($this->sort, $this->direction)
            ->get();
        return view('livewire.show-posts', compact('posts'));
    }

    public function order($sort)
    {

        if ($this->sort == $sort) {
            if ($this->direction == 'desc') {
                $this->direction = 'asc';
            } else {
                $this->direction = 'desc';
            }
        } else {
            $this->sort = $sort;
            $this->direction = 'asc';
        }



        $this->sort = $sort;
    }
}
