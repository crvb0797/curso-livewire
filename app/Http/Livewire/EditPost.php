<?php

namespace App\Http\Livewire;


use App\Models\Posts;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;

class EditPost extends Component
{

    use WithFileUploads;

    public $post, $open = false, $image, $identificador;

    protected $rules = [
        'post.title' => 'required',
        'post.content' => 'required',
    ];

    public function mount(Posts $post)
    {
        $this->post = $post;
        $this->identificador = rand();
    }

    public function save()
    {
        $this->validate();

        //Eliminado la imagen
        if ($this->image) {
            Storage::delete([$this->post->image]);

            //Subiendo la imagen actualizada
            $this->post->image = $this->image->store('posts');
        }



        $this->post->save();
        //Limpiando campos y cerrando el modal
        $this->reset(['open', 'image']);
        //Reseteando la imagen
        $this->identificador = rand();
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
