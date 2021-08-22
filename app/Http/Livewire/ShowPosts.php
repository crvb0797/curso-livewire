<?php

namespace App\Http\Livewire;

use Livewire\Component;
//El modelo de posts
use App\Models\Posts;
//Para imagenes
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;
//Para la paginación dinamica
use Livewire\WithPagination;

class ShowPosts extends Component
{
    use WithFileUploads;
    use WithPagination;

    /* public $text, $content; */
    public $search = '', $post, $image, $identificador, $cant = '10';
    public $sort = 'id', $direction = 'desc';
    protected $listeners = ['render', 'delete'];
    protected  $queryString = [
        'cant' => ['except' => '10'],
        'sort' => ['except' => 'id'],
        'direction' => ['except' => 'desc'],
        'search' => ['except' => '']
    ];
    public $open_edit = false;
    //Aplazamiento de carga
    public $readyToLoad = false;

    protected $rules = [
        'post.title' => 'required',
        'post.content' => 'required',
    ];

    public function mount()
    {
        $this->identificador = rand();
        $this->post = new Posts();
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function render()
    {
        if ($this->readyToLoad) {
            $posts = Posts::where('title', 'LIKE', '%' . $this->search . '%')
                ->orWhere('content', 'LIKE', '%' . $this->search . '%')
                ->orderBy($this->sort, $this->direction)
                ->paginate($this->cant);
        } else {
            $posts = [];
        }


        return view('livewire.show-posts', compact('posts'));
    }

    //Aplazamiento de carga 
    public function loadPosts()
    {
        $this->readyToLoad = true;
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

    public function edit(Posts $post)
    {
        $this->post = $post;
        $this->open_edit = true;
    }

    public function update()
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
        $this->reset(['open_edit', 'image']);
        //Reseteando la imagen
        $this->identificador = rand();
        //Emitiendo el evento para el script de la alerta con sweet alert 2
        $this->emit('alert', 'El post se actualizó con exitó');
    }

    public function delete(Posts $post)
    {
        $post->delete();
    }
}
