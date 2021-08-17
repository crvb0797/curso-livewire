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

        //Limpiando campos y cerrando el modal
        $this->reset(['open_modal', 'title', 'content']);

        //Emitiendo el evento render para comunicación de componentes 
        $this->emitTo('show-posts', 'render');

        //Emitiendo el evento para el script de la alerta con sweet alert 2
        $this->emit('alert', 'El post se creó con exitó');
    }
}
