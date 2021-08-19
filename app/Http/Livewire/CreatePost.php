<?php

namespace App\Http\Livewire;

use App\Models\Posts;
use Livewire\Component;
use Livewire\WithFileUploads;

class CreatePost extends Component
{

    use WithFileUploads;
    public $open_modal = false;
    public $title, $content, $image, $identificador;

    //Método para reiniciar image
    public function mount()
    {
        $this->identificador = rand();
    }


    //Validaciones
    protected $rules = [
        'title' => 'required',
        'content' => 'required',
        'image' => 'required|image|max:2048',
    ];

    /* public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    } */

    public function render()
    {
        return view('livewire.create-post');
    }

    public function save()
    {
        $this->validate();

        $image = $this->image->store('posts');

        Posts::create([
            'title' => $this->title,
            'content' => $this->content,
            'image' => $image,
        ]);

        //Limpiando campos y cerrando el modal
        $this->reset(['open_modal', 'title', 'content', 'image']);

        //Reseteando la imagen
        $this->identificador = rand();

        //Emitiendo el evento render para comunicación de componentes 
        $this->emitTo('show-posts', 'render');

        //Emitiendo el evento para el script de la alerta con sweet alert 2
        $this->emit('alert', 'El post se creó con exitó');
    }
}
