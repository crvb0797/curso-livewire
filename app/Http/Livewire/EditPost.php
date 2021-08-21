<?php

namespace App\Http\Livewire;

use App\Models\Posts;
use Livewire\Component;

class EditPost extends Component
{

    public $post, $open = false;

    protected $rules = [
        'post.title' => 'required',
        'post.content' => 'required',
    ];

    public function mount(Posts $post)
    {
        $this->post = $post;
    }

    public function save()
    {
        $this->validate();
        $this->post->save();
        //Limpiando campos y cerrando el modal
        $this->reset(['open']);
        //Emitiendo el evento render para comunicación de componentes 
        $this->emitTo('show-posts', 'render');

        //Emitiendo el evento para el script de la alerta con sweet alert 2
        $this->emit('alert', 'El post se actualizó con exitó');
    }

    public function render()
    {
        return view('livewire.edit-post');
    }
}
